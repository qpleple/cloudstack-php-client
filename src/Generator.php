<?php namespace MyENA\CloudStackClientGenerator;

use MyENA\CloudStackClientGenerator\Generator\API;
use MyENA\CloudStackClientGenerator\Generator\CloudStackConfiguration;
use MyENA\CloudStackClientGenerator\Generator\CloudStackRequest;
use MyENA\CloudStackClientGenerator\Generator\CloudStackRequestBody;
use Psr\Http\Message\RequestInterface;

/**
 * Class Generator
 *
 * @package MyENA\CloudStackClientGenerator
 */
class Generator
{
    /** @var \MyENA\CloudStackClientGenerator\Configuration */
    protected $configuration;

    /** @var \Twig_Environment */
    protected $twig;

    /** @var \MyENA\CloudStackClientGenerator\Generator\CloudStackConfiguration */
    protected $cloudstackConfiguration;

    /** @var API[] */
    protected $apis = [];

    /** @var \MyENA\CloudStackClientGenerator\Generator\API\ObjectVariable[] */
    protected $sharedObjectMap = [];

    /**
     * Generator constructor.
     *
     * @param \MyENA\CloudStackClientGenerator\Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;

        $this->cloudstackConfiguration = new CloudStackConfiguration(
            [
                'api_key' => $configuration->getApiKey(),
                'secret_key' => $configuration->getSecretKey(),
                'host' => $configuration->getHost(),
                'port' => $configuration->getPort(),
            ],
            $configuration->getLogger()
        );

        $twigLoader = new \Twig_Loader_Filesystem(__DIR__.'/../templates');
        $this->twig = new \Twig_Environment($twigLoader, ['debug' => true]);
        $this->twig->addExtension(new \Twig_Extensions_Extension_Text());
        $this->twig->addExtension(new \Twig_Extension_Escaper());
        $this->twig->addExtension(new \Twig_Extension_Debug());
    }

    public function generate()
    {
        $srcDir = sprintf('%s/%s', $this->configuration->getOutputDir(), 'src');
        if (!is_dir($srcDir) && false === (bool)mkdir($srcDir))
            throw new \RuntimeException(sprintf('Unable to create directory "%s"', $srcDir));

        $filesDir = sprintf('%s/%s', $this->configuration->getOutputDir(), 'files');
        if (!is_dir($filesDir) && false === (bool)mkdir($filesDir))
            throw new \RuntimeException(sprintf('Unable to create directory "%s"', $filesDir));

        $responseDir = sprintf('%s/%s', $srcDir, 'Response');
        if (!is_dir($responseDir) && false === (bool)mkdir($responseDir))
            throw new \RuntimeException(sprintf('Unable to create directory "%s"', $responseDir));

        $typesDir = sprintf('%s/%s', $responseDir, 'Types');
        if (!is_dir($typesDir) && false === (bool)mkdir($typesDir))
            throw new \RuntimeException(sprintf('Unable to create directory "%s"', $typesDir));

        $this->compileAPIs();
        ksort($this->apis, SORT_NATURAL);

        $capabilities = $this->fetchCapabilities();

        $this->writeOutStaticTemplates($capabilities);
        $this->writeOutClient($capabilities);
        $this->writeOutResponseModels($capabilities);
    }

    protected function writeOutStaticTemplates(\stdClass $capabilities)
    {
        $srcDir = sprintf('%s/%s', $this->configuration->getOutputDir(), 'src');
        $filesDir = sprintf('%s/%s', $this->configuration->getOutputDir(), 'files');
        $responseDir = sprintf('%s/%s', $srcDir, 'Response');
        $typesDir = sprintf('%s/%s', $responseDir, 'Types');

        $args = ['config' => $this->configuration, 'capabilities' => $capabilities];

        file_put_contents(
            $this->configuration->getOutputDir().'/LICENSE',
            file_get_contents(__DIR__.'/../LICENSE')
        );

        file_put_contents(
            $this->configuration->getOutputDir().'/composer.json',
            $this->twig->load('composer.json.twig')->render($args)
        );

        file_put_contents(
            $srcDir.'/CloudStackConfiguration.php',
            $this->twig->load('configuration.php.twig')->render($args)
        );

        file_put_contents(
            $srcDir.'/CloudStackRequest.php',
            $this->twig->load('request.php.twig')->render($args)
        );

        file_put_contents(
            $srcDir.'/CloudStackRequestBody.php',
            $this->twig->load('requestBody.php.twig')->render($args)
        );

        file_put_contents(
            $srcDir.'/CloudStackUri.php',
            $this->twig->load('uri.php.twig')->render($args)
        );

        file_put_contents(
            $filesDir.'/constants.php',
            $this->twig->load('constants.php.twig')->render($args)
        );

        file_put_contents(
            $responseDir.'/AbstractResponse.php',
            $this->twig->load('abstractResponse.php.twig')->render($args)
        );

        file_put_contents(
            $responseDir.'/AsyncJobStartResponse.php',
            $this->twig->load('asyncJobStartResponse.php.twig')->render($args)
        );

        file_put_contents(
            $typesDir.'/DateType.php',
            $this->twig->load('dateType.php.twig')->render($args)
        );
    }

    protected function writeOutClient(\stdClass $capabilities)
    {
        $srcDir = sprintf('%s/%s', $this->configuration->getOutputDir(), 'src');

        file_put_contents(
            $srcDir.'/CloudStackClient.php',
            $this->twig->load('client.php.twig')->render([
                'config' => $this->configuration,
                'capabilities' => $capabilities,
                'apis' => $this->apis,
            ])
        );
    }

    protected function writeOutResponseModels(\stdClass $capabilities)
    {
        $srcDir = sprintf('%s/%s', $this->configuration->getOutputDir(), 'src');
        $responseDir = sprintf('%s/%s', $srcDir, 'Response');

        $template = $this->twig->load('responseObject.php.twig');

        foreach($this->apis as $name => $api)
        {
            $response = $api->getResponse();
            $className = $response->getClassName();

            $api->getResponse()->getProperties()->nameSort();

            file_put_contents(
                $responseDir.'/'.$className.'.php',
                $template->render([
                    'obj' => $response,
                    'config' => $this->configuration,
                    'capabilities' => $capabilities,
                ])
            );
        }

        foreach($this->sharedObjectMap as $name => $class)
        {
            $class->getProperties()->nameSort();

            $className = $class->getClassName();
            file_put_contents(
                $responseDir.'/'.$className.'.php',
                $template->render([
                    'obj' => $class,
                    'config' => $this->configuration,
                    'capabilities' => $capabilities,
                ])
            );
        }
    }

    /**
     * @param \stdClass $def
     * @return \MyENA\CloudStackClientGenerator\Generator\API\Variable
     */
    protected function buildVariable(\stdClass $def)
    {
        if (!isset($def->name))
            return null;

        $var = new API\Variable();

        $var->setName(trim($def->name));
        $var->setType($def->type);

        if (isset($def->description))
            $var->setDescription(trim($def->description));
        if (isset($def->required))
            $var->setRequired((bool)$def->required);
        if (isset($def->length))
            $var->setLength((int)$def->length);
        if (isset($def->since))
            $var->setSince($def->since);
        if (isset($def->related))
            $var->setRelatedString($def->related);

        if ('' === $var->getDescription())
        {
            switch ($var->getName()) {
                case 'pagesize':
                    $var->setDescription('the number of entries per page');
                    break;
                case 'page':
                    $var->setDescription('the page number of the result set');
                    break;
            }
        }

        return $var;
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\Generator\API\ObjectVariable $object
     * @param array $defs
     */
    protected function parseObjectProperties(API\ObjectVariable $object, array $defs)
    {
        $properties = $object->getProperties();

        foreach($defs as $def)
        {
            $name = trim($def->name);

            if (null === $properties->get($name))
            {
                $var = $this->buildVariable($def);
                if (null === $var)
                    continue;

                $properties->add($var);
            }
        }
    }

    /**
     * @param API $api
     * @param array $params
     */
    protected function parseParameters(API $api, array $params)
    {
        foreach($params as $param)
        {
            // blank objects, why do you exist?
            if (!isset($param->name))
                continue;

            if (null !== ($var = $this->buildVariable($param)))
                $api->getParameters()->add($var);
        }
    }

    /**
     * @param API $api
     * @param array $response
     */
    protected function parseResponse(API $api, array $response)
    {
        $obj = new API\ObjectVariable($this->configuration);
        $obj->setName($api->getName());
        $obj->setDescription($api->getDescription());
        $obj->setSince($api->getSince());
        $obj->setRelated($api->getRelated());

        foreach($response as $prop)
        {
            if (isset($prop->response))
                $var = $this->buildSharedObject($prop);
            else
                $var = $this->buildVariable($prop);

            if (null === $var)
                continue;

            $obj->getProperties()->add($var);
        }

        $api->setResponse($obj);
    }

    /**
     * @param \stdClass $def
     * @return \MyENA\CloudStackClientGenerator\Generator\API\ObjectVariable
     */
    protected function buildSharedObject(\stdClass $def)
    {
        $name = trim($def->name);

        if (isset($this->sharedObjectMap[$name]))
        {
            $this->parseObjectProperties($this->sharedObjectMap[$name], $def->response);

            return $this->sharedObjectMap[$name];
        }

        $obj = new API\ObjectVariable($this->configuration);
        $obj->setName($name);
        $obj->setType($def->type);
        $obj->setDescription($def->type);
        $obj->setShared(true);

        $this->parseObjectProperties($obj, $def->response);

        $this->sharedObjectMap[$obj->getName()] = $obj;

        return $obj;
    }

    protected function compileAPIs()
    {
        $r = new CloudStackRequest(
            $this->cloudstackConfiguration,
            new CloudStackRequestBody($this->cloudstackConfiguration, 'listApis')
        );

        $data = $this->doRequest($r)->listapisresponse;

        foreach($data->api as $apiDef)
        {
            $api = new API();

            $api->setName(trim($apiDef->name));
            $api->setDescription(trim($apiDef->description));
            $api->setAsync((bool)$apiDef->isasync);
            if (isset($apiDef->since))
                $api->setSince($apiDef->since);
            if (isset($apiDef->related))
                $api->setRelatedString($apiDef->related);

            $this->parseParameters($api, $apiDef->params);
            $this->parseResponse($api, $apiDef->response);

            $this->apis[$api->getName()] = $api;
        }
    }

    /**
     * @return \stdClass
     */
    protected function fetchCapabilities()
    {
        $r = new CloudStackRequest(
            $this->cloudstackConfiguration,
            new CloudStackRequestBody($this->cloudstackConfiguration, 'listCapabilities')
        );

        $data = $this->doRequest($r);

        return $data->listcapabilitiesresponse;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return \stdClass
     */
    protected function doRequest(RequestInterface $request)
    {
        $resp = $this->cloudstackConfiguration->HttpClient->sendRequest($request);

        if (200 !== $resp->getStatusCode())
            throw new \RuntimeException(NO_VALID_JSON_RECEIVED_MSG, NO_VALID_JSON_RECEIVED);

        $body = $resp->getBody();

        if (0 === $body->getSize())
            throw new \RuntimeException(NO_DATA_RECEIVED_MSG, NO_DATA_RECEIVED);

        $json = '';
        while (!$body->eof() && $data = $body->read(8192))
        {
            $json .= $data;
        }

        $decoded = @json_decode($json);
        if (JSON_ERROR_NONE !== json_last_error())
            throw new \RuntimeException(NO_VALID_JSON_RECEIVED_MSG, NO_VALID_JSON_RECEIVED);

        return $decoded;
    }
}