<?php namespace MyENA\CloudStackClientGenerator;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class Configuration
 * @package MyENA\CloudStackClientGenerator
 */
class Configuration implements LoggerAwareInterface {
    use LoggerAwareTrait;

    const DefaultScheme = 'http';
    const DefaultPort = 8080;
    const DefaultAPIPath = 'client/api';
    const DefaultConsolePath = 'client/console';

    /** @var string */
    protected $key = '';
    /** @var string */
    protected $secret = '';

    /** @var string */
    protected $scheme = self::DefaultScheme;
    /** @var string */
    protected $host = '';
    /** @var int */
    protected $port = self::DefaultPort;

    /** @var string */
    protected $apiPath = self::DefaultAPIPath;
    /** @var string */
    protected $consolePath = self::DefaultConsolePath;

    /** @var string */
    protected $compiledAddress = '';

    /** @var string */
    protected $namespace = '';
    /** @var string */
    protected $outputDir = '';

    /** @var \DateTime */
    protected $now;

    /** @var array */
    protected $eventTypeMap = [];

    /** @var \GuzzleHttp\ClientInterface */
    public $HttpClient = null;

    /**
     * Configuration constructor.
     *
     * @param array $config
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(array $config = [], LoggerInterface $logger = null) {
        if (null === $logger) {
            $this->logger = new NullLogger();
        } else {
            $this->logger = $logger;
        }
        $this->now = new \DateTime();
        $this->eventTypeMap = require __DIR__.'/../files/command_event_map.php';

        foreach ($config as $k => $v) {
            if (false === strpos($k, '_')) {
                $this->{'set' . ucfirst($k)}($v);
            } else {
                $this->{'set' . implode('', array_map('ucfirst', explode('_', $k)))}($v);
            }
        }

        if (!isset($this->HttpClient)) {
            $this->HttpClient = new Client();
        }
    }

    public function __debugInfo() {
        $clone = clone $this;
        unset($clone->now, $clone->HttpClient, $clone->logger, $clone->eventTypeMap);
        return get_object_vars($clone);
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger() {
        return $this->logger;
    }

    /**
     * @return \DateTime
     */
    public function getNow() {
        return $this->now;
    }

    /**
     * @return string
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * @param string $key
     * @return Configuration
     */
    public function setKey($key) {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecret() {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return Configuration
     */
    public function setSecret($secret) {
        $this->secret = $secret;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheme() {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     * @return Configuration
     */
    public function setScheme($scheme) {
        $this->scheme = $scheme;
        $this->compiledAddress = '';
        return $this;
    }

    /**
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * @param string $host
     * @return Configuration
     */
    public function setHost($host) {
        $this->host = $host;
        $this->compiledAddress = '';
        return $this;
    }

    /**
     * @return int
     */
    public function getPort() {
        return $this->port;
    }

    /**
     * @param int $port
     * @return Configuration
     */
    public function setPort($port) {
        $this->port = $port;
        $this->compiledAddress = '';
        return $this;
    }

    /**
     * @return string
     */
    public function getApiPath() {
        return $this->apiPath;
    }

    /**
     * @var string $apiPath ;
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
    public function getNamespace() {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     * @return Configuration
     */
    public function setNamespace($namespace) {
        $this->namespace = preg_replace('/[\\\]{2,}/', '\\', trim($namespace, " \t\r\n\0\x0B\\"));
        return $this;
    }

    /**
     * @return string
     */
    public function getOutputDir() {
        return $this->outputDir;
    }

    /**
     * @param string $outputDir
     * @return Configuration
     */
    public function setOutputDir($outputDir) {
        $this->outputDir = $outputDir;
        return $this;
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\API $api
     * @return string
     */
    public function getEventForAPI(API $api): string {
        return $this->eventTypeMap[$api->getName()] ?? '';
    }

    /**
     * @return string
     */
    public function getCompiledAddress() {
        if ('' === $this->compiledAddress) {
            $this->compiledAddress = rtrim(sprintf(
                '%s://%s%s/',
                $this->getScheme(),
                $this->getHost(),
                0 === $this->port ? '' : sprintf(':%d', $this->port)
            ),
                "/");
        }

        return $this->compiledAddress;
    }

    /**
     * @param \GuzzleHttp\ClientInterface $HttpClient
     * @return $this
     */
    public function setHttpClient(ClientInterface $HttpClient) {
        $this->HttpClient = $HttpClient;
        return $this;
    }

    /**
     * @param string $query
     * @return string
     * @throws \Exception
     */
    public function buildSignature($query) {
        if ('' === $query) {
            throw new \Exception(STRTOSIGN_EMPTY_MSG, STRTOSIGN_EMPTY);
        }

        $hash = @hash_hmac('SHA1', strtolower($query), $this->getSecret(), true);
        return urlencode(base64_encode($hash));
    }
}
