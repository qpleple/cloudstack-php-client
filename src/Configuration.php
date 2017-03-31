<?php namespace MyENA\CloudStackClientGenerator;

use Http\Client\HttpClient;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class Configuration
 *
 * @package MyENA\CloudStackClientGenerator
 */
class Configuration implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var string */
    protected $apiKey = '';
    /** @var string */
    protected $secretKey = '';
    
    /** @var string  */
    protected $scheme = 'http';
    /** @var string */
    protected $host = '';
    /** @var int */
    protected $port = 8080;

    /** @var string */
    protected $pathPrefix = 'client';
    /** @var string */
    protected $apiPath = 'api';
    /** @var string */
    protected $consolePath = 'console';
    
    /** @var string */
    protected $namespace = '';
    /** @var string */
    protected $outputDir = __DIR__.'/../output';

    /** @var \DateTime */
    protected $now;
    
    /** @var \Http\Client\HttpClient */
    public $HttpClient = null;

    /**
     * Configuration constructor.
     *
     * @param array $config
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(array $config = [], LoggerInterface $logger = null)
    {
        if (null === $logger)
            $this->logger = new NullLogger();
        else
            $this->logger = $logger;

        if (isset($config['endpoint'])) {
            throw new \InvalidArgumentException('The "endpoint" configuration parameter is deprecated, please use the component url params');
        }

        foreach($config as $k => $v) {
            if (false === strpos($k, '_')) {
                $this->{'set'.ucfirst($k)}($v);
            } else {
                $this->{'set'.implode('', array_map('ucfirst', explode('_', $k)))}($v);
            }
        }

        $this->now = new \DateTime();

        $this->postConstructValidation();
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @return \DateTime
     */
    public function getNow()
    {
        return $this->now;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return Configuration
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     * @return Configuration
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     * @return Configuration
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return Configuration
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return Configuration
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getPathPrefix()
    {
        return $this->pathPrefix;
    }

    /**
     * @param string $pathPrefix
     * @return Configuration
     */
    public function setPathPrefix($pathPrefix)
    {
        $this->pathPrefix = trim($pathPrefix, " \t\n\r\0\x0B/");
        return $this;
    }

    /**
     * @return string
     */
    public function getApiPath() {
        return $this->apiPath;
    }

    /**
     * @var string $apiPath;
     * @return Configuration
     */
    public function setApiPath($apiPath) {
        $this->apiPath = trim($apiPath, " \t\r\n\0\x0B/");
        return $this;
    }

    /*
     * @return string
     */
    public function getConsolePath() {
        return $this->consolePath;
    }

    /**
     * @param string $consolePath
     * @return Configuration
     */
    public function setConsolePath($consolePath) {
        $this->consolePath = trim($consolePath, " \t\n\r\0\x0B/");
        return $this;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     * @return Configuration
     */
    public function setNamespace($namespace)
    {
        $this->namespace = preg_replace('/[\\\]{2,}/', '\\', trim($namespace, " \t\r\n\0\x0B\\"));
        return $this;
    }

    /**
     * @return string
     */
    public function getOutputDir()
    {
        return $this->outputDir;
    }

    /**
     * @param string $outputDir
     * @return Configuration
     */
    public function setOutputDir($outputDir)
    {
        $this->outputDir = $outputDir;

        if (!is_dir($outputDir) || !is_writable($outputDir))
            throw new \RuntimeException(sprintf('Unable to locate dir "%s" or it is not writable', $outputDir));

        return $this;
    }

    /**
     * @param \Http\Client\HttpClient $HttpClient
     * @return Configuration
     */
    public function setHttpClient(HttpClient $HttpClient)
    {
        $this->HttpClient = $HttpClient;
        return $this;
    }

    /**
     * @param string $query
     * @return string
     * @throws \Exception
     */
    public function buildSignature($query)
    {
        if ('' === $query)
            throw new \Exception(STRTOSIGN_EMPTY_MSG, STRTOSIGN_EMPTY);

        $hash = @hash_hmac('SHA1', strtolower($query), $this->getSecretKey(), true);
        return urlencode(base64_encode($hash));
    }

    protected function postConstructValidation()
    {
        static $knownClients = array(
            '\\Http\\Client\\Curl\\Client',
            '\\Http\\Adapter\\Guzzle6\\Client',
            '\\Http\\Adapter\\Guzzle5\\Client',
            '\\Http\\Adapter\\Buzz\\Client'
        );

        foreach($knownClients as $clientClass)
        {
            if (class_exists($clientClass, true))
            {
                $this->HttpClient = new $clientClass;
                break;
            }
        }

        if ('' === $this->host)
            throw new \RuntimeException(ENDPOINT_EMPTY_MSG, ENDPOINT_EMPTY);

        if ('' === $this->apiKey)
            throw new \RuntimeException(APIKEY_EMPTY_MSG, APIKEY_EMPTY);

        if ('' === $this->secretKey)
            throw new \RuntimeException(SECRETKEY_EMPTY_MSG, SECRETKEY_EMPTY);
    }
}
