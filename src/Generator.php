<?php namespace MyENA\CloudStackClientGenerator;

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

    /** @var array */
    protected $responseTypeHash = [];

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
        $this->twig = new \Twig_Environment($twigLoader);
        $this->twig->addExtension(new \Twig_Extensions_Extension_Text());
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

        $apiData = $this->fetchApiData();
        $capabilities = $this->fetchCapabilities();

        $this->writeOutStaticTemplates($capabilities);
        $this->writeOutClient($apiData, $capabilities);
        $this->writeOutResponseModels($apiData, $capabilities);
    }

    protected function writeOutStaticTemplates(\stdClass $capabilities)
    {
        $srcDir = sprintf('%s/%s', $this->configuration->getOutputDir(), 'src');
        $filesDir = sprintf('%s/%s', $this->configuration->getOutputDir(), 'files');
        $responseDir = sprintf('%s/%s', $srcDir, 'Response');

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
    }

    protected function writeOutClient(array $apiData, \stdClass $capabilities)
    {
        $srcDir = sprintf('%s/%s', $this->configuration->getOutputDir(), 'src');

        file_put_contents(
            $srcDir.'/CloudStackClient.php',
            $this->twig->load('class.php.twig')->render([
                'config' => $this->configuration,
                'capabilities' => $capabilities,
                'methods' => $apiData,
            ])
        );
    }

    protected function writeOutResponseModels(array $apiData, \stdClass $capabilities)
    {
        $srcDir = sprintf('%s/%s', $this->configuration->getOutputDir(), 'src');
        $responseDir = sprintf('%s/%s', $srcDir, 'Response');

        $template = $this->twig->load('response.php.twig');
        foreach ($apiData as $api)
        {
            $className = ucfirst($api['responseClassName']);

            file_put_contents(
                $responseDir.'/'.$className.'.php',
                $template->render([
                    'responseClassName' => $className,
                    'response' => $api['memberVariables'],
                    'config' => $this->configuration,
                    'capabilities' => $capabilities,
                ])
            );
        }

        foreach ($this->responseTypeHash as $className => $memberVariables)
        {
            if (substr($className, -8) != "Response")
            {
                file_put_contents(
                    $responseDir.'/'.ucfirst($className).'.php',
                    $template->render([
                        'responseClassName' => ucfirst($className),
                        'response' => $memberVariables,
                        'config' => $this->configuration,
                        'capabilities' => $capabilities,
                    ])
                );
            }
        }
    }

    /**
     * @return array
     */
    protected function fetchApiData()
    {
        $r = new CloudStackRequest(
            $this->cloudstackConfiguration,
            new CloudStackRequestBody($this->cloudstackConfiguration, 'listApis')
        );

        $data = $this->doRequest($r)->listapisresponse;

        $methods = [];
        foreach($data->api as $api)
        {
            $data = array(
                'name' => trim($api->name),
                'description' => trim($api->description),
                'required' => 0,
                'optional' => 0,
                'params' => [],
                'response' => $api->response,
                'list' => false !== strpos($api->name, 'list'),
                'responseClassName' => ucfirst(trim($api->name) . 'Response'),
            );

            if (!isset($this->responseTypeHash[$data['responseClassName']])) {
                $this->responseTypeHash[$data['responseClassName']] = $this->getResponseDataHelper($api->response);
            }
            $data['memberVariables'] = $this->responseTypeHash[$data['responseClassName']];

            // loop through parameters
            foreach($api->params as $param) {
                // increase counts
                if ($param->required == true) {
                    $data['required']++;
                } else {
                    $data['optional']++;
                }
                // special case for missing descriptions
                switch ($param->name) {
                    case 'pagesize':
                        $param->description = 'the number of entries per page';
                        break;
                    case 'page':
                        $param->description = 'the page number of the result set';
                        break;
                }
                // build parameter data
                $data['params'][trim($param->name)] = [
                    'name' => trim($param->name),
                    'description' => trim($param->description),
                    'required' => (bool) $param->required,
                ];
            }

            ksort($data['params'], SORT_NATURAL);

            $methods[$api->name] = $data;
        }

        return $methods;
    }

    protected function getResponseDataHelper($responses) {
        $responseMeta = array();
        $params = array();
        foreach ($responses as $response) {
            $val = array();
            if (!property_exists($response, 'name')) {
                // blank objects, why do you exist?
                continue;
            }
            $val['name'] = $name = trim($response->name);
            $val['type'] = $type = trim($response->type);
            $val['description'] = $description = trim($response->description);
            if (isset($params[$name])) {
                // there are dupes, this squashes those
                continue;
            }
            $params[$name] = true;
            
            if (in_array($type, ["set", "list", "map", "responseobject", "uservmresponse"])) {
                $val['type'] = "array";
                if (!property_exists($response, 'response')) {
                    $val['class'] = 'string';
                } else {
                    if (!isset($this->responseTypeHash[$name])) {
                        $this->responseTypeHash[$name] = $this->getResponseDataHelper($response->response);
                    }
                    $val['class'] = $name;
                }
            } elseif (in_array($type, ["imageformat", "storagepoolstatus", "hypervisortype", "status", "type", "scopetype", "state", "url", "uuid"])) {
                $val['type'] = "string";
            } elseif (in_array($type, ["integer", "long", "short", "int"])) {
                $val['type'] = 'int';
            }
            $responseMeta[$val['name']] = $val;
        }

        ksort($responseMeta, SORT_NATURAL);

        return $responseMeta;
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