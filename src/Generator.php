<?php namespace MyENA\CloudStackClientGenerator;

use GuzzleHttp\RequestOptions;
use MyENA\CloudStackClientGenerator\API\API;
use MyENA\CloudStackClientGenerator\API\ObjectVariable;
use MyENA\CloudStackClientGenerator\API\Variable;
use Psr\Http\Message\RequestInterface;

/**
 * Class Generator
 *
 * @package MyENA\CloudStackClientGenerator
 */
class Generator {
    /** @var \MyENA\CloudStackClientGenerator\Configuration */
    protected $configuration;

    /** @var \Twig_Environment */
    protected $twig;

    /** @var \stdClass */
    protected $capabilities;

    /** @var API[] */
    protected $apis = [];

    /** @var \MyENA\CloudStackClientGenerator\API\ObjectVariable[] */
    protected $sharedObjectMap = [];

    /** @var string */
    protected $srcDir;

    /** @var string */
    protected $filesDir;

    /** @var string */
    protected $responseDir;
    /** @var string */
    protected $responseTypesDir;

    /** @var string */
    protected $requestDir;

    /**
     * Generator constructor.
     *
     * @param \MyENA\CloudStackClientGenerator\Configuration $configuration
     */
    public function __construct(Configuration $configuration) {
        $this->configuration = $configuration;

        $twigLoader = new \Twig_Loader_Filesystem(__DIR__ . '/../templates');
        $this->twig = new \Twig_Environment($twigLoader, ['debug' => true]);
        $this->twig->addExtension(new \Twig_Extensions_Extension_Text());
        $this->twig->addFilter(
            'ucfirst',
            new \Twig_SimpleFilter(
                'ucfirst',
                function ($in) {
                    return ucfirst($in);
                },
                ['is_safe' => ['html']]
            )
        );

        $this->srcDir = sprintf('%s/src', $this->configuration->getOutputDir());
        if (!is_dir($this->srcDir) && false === (bool)mkdir($this->srcDir)) {
            throw new \RuntimeException(sprintf('Unable to create directory "%s"', $this->srcDir));
        }

        $this->filesDir = sprintf('%s/files', $this->configuration->getOutputDir());
        if (!is_dir($this->filesDir) && false === (bool)mkdir($this->filesDir)) {
            throw new \RuntimeException(sprintf('Unable to create directory "%s"', $this->filesDir));
        }

        $this->responseDir = sprintf('%s/CloudStackResponse', $this->srcDir);
        if (!is_dir($this->responseDir) && false === (bool)mkdir($this->responseDir)) {
            throw new \RuntimeException(sprintf('Unable to create directory "%s"', $this->responseDir));
        }

        $this->responseTypesDir = sprintf('%s/Types', $this->responseDir);
        if (!is_dir($this->responseTypesDir) && false === (bool)mkdir($this->responseTypesDir)) {
            throw new \RuntimeException(sprintf('Unable to create directory "%s"', $this->responseTypesDir));
        }

        $this->requestDir = sprintf('%s/CloudStackRequest', $this->srcDir);
        if (!is_dir($this->requestDir)&& false === (bool)mkdir($this->requestDir)) {
            throw new \RuntimeException(sprintf('Unable to create directory "%s"', $this->requestDir));
        }
    }

    public function generate() {
        $this->compileAPIs();
        ksort($this->apis, SORT_NATURAL);

        $this->writeOutStaticTemplates();
        $this->writeOutClient();

        $this->writeOutRequestModels();
        $this->writeOutSharedResponseModels();
        $this->writeOutResponseModels();
    }

    protected function writeOutStaticTemplates() {
        $args = ['config' => $this->configuration, 'capabilities' => $this->getCapabilities()];

        file_put_contents(
            $this->configuration->getOutputDir() . '/LICENSE',
            file_get_contents(__DIR__ . '/../LICENSE')
        );

        file_put_contents(
            $this->configuration->getOutputDir() . '/composer.json',
            $this->twig->load('composer.json.twig')->render($args)
        );

        file_put_contents(
            $this->srcDir . '/CloudStackConfiguration.php',
            $this->twig->load('configuration.php.twig')->render($args)
        );

        file_put_contents(
            $this->filesDir . '/constants.php',
            $this->twig->load('constants.php.twig')->render($args)
        );

        file_put_contents(
            $this->srcDir.'/CloudStackEventTypes.php',
            $this->twig->load('eventTypes.php.twig')->render($args)
        );

        file_put_contents(
            $this->responseDir . '/AsyncJobStartResponse.php',
            $this->twig->load('responses/asyncJobStart.php.twig')->render($args)
        );

        file_put_contents(
            $this->responseDir . '/AccessVmConsoleProxyResponse.php',
            $this->twig->load('responses/accessVmConsoleProxy.php.twig')->render($args)
        );

        file_put_contents(
            $this->responseTypesDir . '/DateType.php',
            $this->twig->load('responses/dateType.php.twig')->render($args)
        );

        file_put_contents(
            $this->srcDir . '/CloudStackHelpers.php',
            $this->twig->load('helpers.php.twig')->render($args)
        );

        file_put_contents(
            $this->requestDir.'/CloudStackRequestInterfaces.php',
            $this->twig->load('requests/interfaces.php.twig')->render($args)
        );

        file_put_contents(
            $this->requestDir.'/AccessVmConsoleProxyRequest.php',
            $this->twig->load('requests/accessVmConsoleProxy.php.twig')->render($args)
        );

        file_put_contents(
            $this->srcDir.'/CloudStackExceptions.php',
            $this->twig->load('exceptions.php.twig')->render($args)
        );
    }

    protected function writeOutClient() {
        file_put_contents(
            $this->srcDir . '/CloudStackClient.php',
            $this->twig->load('client.php.twig')->render([
                'config' => $this->configuration,
                'capabilities' => $this->getCapabilities(),
                'apis' => $this->apis,
            ])
        );
    }

    protected function writeOutRequestModels() {
        $capabilities = $this->getCapabilities();
        $template = $this->twig->load('requests/model.php.twig');

        foreach($this->apis as $api) {
            $className = $api->getRequestClassName();
            file_put_contents(
                $this->requestDir . '/' .$className . '.php',
                $template->render([
                    'api' => $api,
                    'config' => $this->configuration,
                    'capabilities' => $capabilities,
                ])
            );
        }
    }

    protected function writeOutSharedResponseModels() {
        $capabilities = $this->getCapabilities();
        $template = $this->twig->load('responses/model.php.twig');

        foreach ($this->sharedObjectMap as $name => $class) {
            $class->getProperties()->nameSort();

            $className = $class->getClassName();
            file_put_contents(
                $this->responseDir . '/' . $className . '.php',
                $template->render([
                    'obj' => $class,
                    'config' => $this->configuration,
                    'capabilities' => $capabilities,
                ])
            );
        }
    }

    protected function writeOutResponseModels() {
        $capabilities = $this->getCapabilities();
        $template = $this->twig->load('responses/model.php.twig');

        foreach ($this->apis as $name => $api) {
            $response = $api->getResponse();
            $className = $response->getClassName();

            file_put_contents(
                $this->responseDir . '/' . $className . '.php',
                $template->render([
                    'obj' => $response,
                    'config' => $this->configuration,
                    'capabilities' => $capabilities,
                ])
            );
        }
    }

    /**
     * @param \stdClass $def
     * @return \MyENA\CloudStackClientGenerator\API\Variable
     */
    protected function buildVariable(\stdClass $def) {

        if (!isset($def->name)) {
            return null;
        }

        $var = new Variable();

        $var->setName(trim($def->name));
        $var->setType($def->type);

        if (isset($def->description)) {
            $var->setDescription(trim($def->description));
        }
        if (isset($def->required)) {
            $var->setRequired((bool)$def->required);
        }
        if (isset($def->length)) {
            $var->setLength((int)$def->length);
        }
        if (isset($def->since)) {
            $var->setSince($def->since);
        }
        if (isset($def->related)) {
            $var->setRelatedString($def->related);
        }

        if ('' === $var->getDescription()) {
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
     * @param \MyENA\CloudStackClientGenerator\API\ObjectVariable $object
     * @param array $defs
     */
    protected function parseObjectProperties(ObjectVariable $object, array $defs) {
        $properties = $object->getProperties();

        foreach ($defs as $def) {
            $name = trim($def->name);

            if (null === $properties->get($name)) {
                $var = $this->buildVariable($def);
                if (null === $var) {
                    continue;
                }

                $properties->add($var);
            }
        }
    }

    /**
     * @param API $api
     * @param array $params
     */
    protected function parseParameters(API $api, array $params) {
        foreach ($params as $param) {
            // blank objects, why do you exist?
            if (!isset($param->name)) {
                continue;
            }

            if (null !== ($var = $this->buildVariable($param))) {
                $api->getParameters()->add($var);
            }
        }
    }

    /**
     * @param API $api
     * @param array $response
     */
    protected function parseResponse(API $api, array $response) {
        $obj = new ObjectVariable($this->configuration->getNamespace());
        $obj->setName($api->getName());
        $obj->setDescription($api->getDescription());
        $obj->setSince($api->getSince());
        $obj->setRelated($api->getRelated());

        foreach ($response as $prop) {
            if (isset($prop->response)) {
                $var = $this->buildSharedResponseObject($prop);
            } else {
                $var = $this->buildVariable($prop);
            }

            if (null === $var) {
                continue;
            }

            $obj->getProperties()->add($var);
        }

        $obj->getProperties()->nameSort();

        $api->setResponse($obj);
    }

    /**
     * @param \stdClass $def
     * @return \MyENA\CloudStackClientGenerator\API\ObjectVariable
     */
    protected function buildSharedResponseObject(\stdClass $def) {
        $name = trim($def->name);

        if (isset($this->sharedObjectMap[$name])) {
            $this->parseObjectProperties($this->sharedObjectMap[$name], $def->response);

            return $this->sharedObjectMap[$name];
        }

        $obj = new ObjectVariable($this->configuration->getNamespace());
        $obj->setName($name);
        $obj->setType($def->type);
        $obj->setDescription($def->type);
        $obj->setShared(true);

        $this->parseObjectProperties($obj, $def->response);

        $this->sharedObjectMap[$obj->getName()] = $obj;

        return $obj;
    }

    /**
     * @return \stdClass
     */
    protected function getCapabilities() {
        if (!isset($this->capabilities)) {
            $cmd = new Command($this->configuration, 'listCapabilities');
            $data = $this->doRequest($cmd->createPsr7Request());
            $this->capabilities = $data->listcapabilitiesresponse;
        }

        return $this->capabilities;
    }

    protected function compileAPIs() {
        $cmd = new Command($this->configuration, 'listApis');

        $data = $this->doRequest($cmd->createPsr7Request())->listapisresponse;

        foreach ($data->api as $apiDef) {
            $api = new API();

            $api->setName(trim($apiDef->name));
            $api->setDescription(trim($apiDef->description));
            $api->setAsync((bool)$apiDef->isasync);
            if (isset($apiDef->since)) {
                $api->setSince($apiDef->since);
            }
            if (isset($apiDef->related)) {
                $api->setRelatedString($apiDef->related);
            }

            $this->parseParameters($api, $apiDef->params);
            $this->parseResponse($api, $apiDef->response);

            $api->getParameters()->nameSort();

            $this->apis[$api->getName()] = $api;
        }
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return \stdClass
     */
    protected function doRequest(RequestInterface $request) {
        $resp = $this->configuration->HttpClient->send($request, [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::DECODE_CONTENT => false,
        ]);

        if (200 !== $resp->getStatusCode()) {
            throw new \RuntimeException(NO_VALID_JSON_RECEIVED_MSG, NO_VALID_JSON_RECEIVED);
        }

        $body = $resp->getBody();

        if (0 === $body->getSize()) {
            throw new \RuntimeException(NO_DATA_RECEIVED_MSG, NO_DATA_RECEIVED);
        }

        $decoded = @json_decode($body->getContents());
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \RuntimeException(NO_VALID_JSON_RECEIVED_MSG, NO_VALID_JSON_RECEIVED);
        }

        return $decoded;
    }
}