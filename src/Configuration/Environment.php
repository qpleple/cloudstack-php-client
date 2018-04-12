<?php namespace MyENA\CloudStackClientGenerator\Configuration;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Psr\Log\NullLogger;

/**
 * Class Environment
 * @package MyENA\CloudStackClientGenerator\Configuration
 */
class Environment implements LoggerAwareInterface, \JsonSerializable {

    use LoggerAwareTrait;

    const DefaultScheme = 'http';
    const DefaultPort = 8080;
    const DefaultAPIPath = 'client/api';
    const DefaultConsolePath = 'client/console';

    const ValidNamespaceRegex = '{^[a-zA-Z][a-zA-Z0-9_]*(\\\[a-zA-Z][a-zA-Z0-9_]*)*$}';

    /** @var string */
    private $name = '';

    /** @var string */
    private $key = '';
    /** @var string */
    private $secret = '';

    /** @var string */
    private $scheme = self::DefaultScheme;
    /** @var string */
    private $host = '';
    /** @var int */
    private $port = self::DefaultPort;

    /** @var string */
    private $apiPath = self::DefaultAPIPath;
    /** @var string */
    private $consolePath = self::DefaultConsolePath;

    /** @var string */
    private $compiledAddress = '';

    /** @var string */
    private $composerPackage = '';

    /** @var string */
    private $namespace = '';
    /** @var string */
    private $out = '';

    /** @var \GuzzleHttp\ClientInterface */
    private $httpClient;

    /**
     * TODO: do better
     * @var array
     */
    private static $settableParams = [
        'name'            => true,
        'key'             => true,
        'secret'          => true,
        'scheme'          => true,
        'host'            => true,
        'port'            => true,
        'apiPath'         => true,
        'consolePath'     => true,
        'composerPackage' => true,
        'namespace'       => true,
        'out'             => true,
    ];

    /** @var array */
    private static $logLevels = [
        LogLevel::DEBUG     => true,
        LogLevel::INFO      => true,
        LogLevel::NOTICE    => true,
        LogLevel::WARNING   => true,
        LogLevel::ERROR     => true,
        LogLevel::ALERT     => true,
        LogLevel::CRITICAL  => true,
        LogLevel::EMERGENCY => true,
    ];

    /**
     * Environment constructor.
     *
     * TODO: clean this up a bit.
     *
     * @param array $config
     */
    public function __construct(array $config = []) {
        $clientClass = Client::class;
        $clientConfig = [];
        $loggerClass = class_exists('\\MyEna\\DefaultANSILogger', true)
            ? '\\MyEna\\DefaultANSILogger'
            : NullLogger::class;
        $loggerLevel = LogLevel::INFO;
        foreach ($config as $k => $v) {
            if ('http_client' === $k) {
                if (null === $v) {
                    continue;
                }
                if (!is_array($v)) {
                    throw new \DomainException(sprintf(
                        'Key "http_client" expected to be array, %s seen',
                        gettype($v)
                    ));
                }
                if (isset($v['class'])) {
                    if (!class_exists($v['class'], true)) {
                        throw new \RuntimeException(sprintf('Specified HttpClient class "%s" not found', $v['class']));
                    }
                    if (!isset(class_implements($v['class'])['GuzzleHttp\\ClientInterface'])) {
                        throw new \DomainException(sprintf(
                            'Specified HttpClient class "%s" does not seem to implement \\GuzzleHttp\\ClientInterface',
                            $v['class']
                        ));
                    }
                    $clientClass = $v['class'];
                }
                if (isset($v['config'])) {
                    if (!is_array($v['config'])) {
                        throw new \InvalidArgumentException(sprintf(
                            'http_client property config must be array, %s seen.',
                            gettype($v['config'])
                        ));
                    }
                    $clientConfig = $v['config'];
                }
                continue;
            } else if ('logger' === $k) {
                if (null === $v) {
                    continue;
                }
                if (!is_array($v)) {
                    throw new \DomainException(sprintf(
                        'Key "logger" expected to be array, %s seen',
                        gettype($v)
                    ));
                }
                if (isset($v['class'])) {
                    if (!class_exists($v['class'], true)) {
                        throw new \RuntimeException(sprintf(
                            'Specified Logger class "%s" not found',
                            $v['class']
                        ));
                    }
                    if (!isset(class_implements($v['class'])['Psr\\Log\\LoggerInterface'])) {
                        throw new \InvalidArgumentException(sprintf(
                            'Specified Logger class "%s" does not seem to implement \\Psr\\Log\\LoggerInterface',
                            $v['class']
                        ));
                    }
                    $loggerClass = $v['class'];
                }
                if (isset($v['level'])) {
                    if (!isset(self::$logLevels[$v['level']])) {
                        throw new \OutOfBoundsException(sprintf(
                            'Specified Logger level "%s" is not in valid range  ["%s"]',
                            $v['level'],
                            implode('", "', self::$logLevels)
                        ));
                    }
                    $loggerLevel = $v['level'];
                }
                continue;
            }

            if (false !== strpos($k, '_')) {
                // TODO: this is a bit...clumsy.
                $k = lcfirst(implode('', array_map('ucfirst', explode('_', $k))));
            }

            if (!isset(self::$settableParams[$k])) {
                throw new \DomainException(sprintf('"%s" is not a configurable value', $k));
            }

            $this->{'set'.ucfirst($k)}($v);
        }

        $this->httpClient = new $clientClass($clientConfig);
        $this->logger = new $loggerClass();
        if (method_exists($this->logger, 'setLevel')) {
            $this->logger->setLevel($loggerLevel);
        } else if (method_exists($this->logger, 'setLogLevel')) {
            $this->logger->setLogLevel($loggerLevel);
        } else if (method_exists($this->logger, 'setLoggerLevel')) {
            $this->logger->setLoggerLevel($loggerLevel);
        } else {
            $this->logger->warning(sprintf(
                'Unable to find method by which to set log level with logger "%s"',
                get_class($this->logger)
            ));
        }

        if ('' === $this->composerPackage) {
            $this->composerPackage = trim(
                implode(
                    '/',
                    array_map(
                        'strtolower',
                        explode(
                            '\\',
                            $this->namespace
                        )
                    )
                ),
                " \t\n\r\0\x0B/"
            );
        }
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $key
     * @return void
     */
    public function setKey(string $key) {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey(): string {
        return $this->key;
    }

    /**
     * @param string $secret
     * @return void
     */
    public function setSecret(string $secret) {
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getSecret(): string {
        return $this->secret;
    }

    /**
     * @param string $scheme
     * @return void
     */
    public function setScheme(string $scheme) {
        $this->scheme = $scheme;
        $this->compiledAddress = '';
    }

    /**
     * @return string
     */
    public function getScheme(): string {
        return $this->scheme;
    }

    /**
     * @param string $host
     * @return void
     */
    public function setHost(string $host) {
        $this->host = $host;
        $this->compiledAddress = '';
    }

    /**
     * @return string
     */
    public function getHost(): string {
        return $this->host;
    }

    /**
     * @param int $port
     * @return void
     */
    public function setPort(int $port) {
        $this->port = $port;
        $this->compiledAddress = '';
    }

    /**
     * @return int
     */
    public function getPort(): int {
        return $this->port;
    }

    /**
     * @param string $apiPath
     * @return void
     */
    public function setAPIPath(string $apiPath) {
        $this->apiPath = trim($apiPath, " \t\n\r\0\x0B/");
    }

    /**
     * @return string
     */
    public function getAPIPath(): string {
        return $this->apiPath;
    }

    /**
     * @param string $consolePath
     * @return void
     */
    public function setConsolePath(string $consolePath) {
        $this->consolePath = trim($consolePath, " \t\n\r\0\x0B/");
    }

    /**
     * @return string
     */
    public function getConsolePath(): string {
        return $this->consolePath;
    }

    /**
     * @param string $namespace
     * @return void
     */
    public function setNamespace(string $namespace) {
        if (!preg_match(self::ValidNamespaceRegex, $namespace)) {
            throw new \InvalidArgumentException(sprintf(
                'Provided namespace "%s" violates "%s"',
                $namespace,
                self::ValidNamespaceRegex
            ));
        }
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getNamespace(): string {
        return $this->namespace;
    }

    /**
     * @param string $out
     * @return void
     */
    public function setOut(string $out) {
        $this->out = self::tryResolvePath($out);
    }

    /**
     * @return string
     */
    public function getOut(): string {
        return $this->out;
    }

    /**
     * @param string $composerPackage
     */
    public function setComposerPackage(string $composerPackage) {
        $this->composerPackage = $composerPackage;
    }

    /**
     * @return string
     */
    public function getComposerPackage(): string {
        return $this->composerPackage;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger(): LoggerInterface {
        return $this->logger;
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function getHttpClient(): ClientInterface {
        return $this->httpClient;
    }

    /**
     * @param \GuzzleHttp\ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient) {
        $this->httpClient = $httpClient;
    }

    /**
     * @return string
     */
    public function getCompiledAddress(): string {
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
     * @param string $query
     * @return string
     * @throws \Exception
     */
    public function buildSignature(string $query): string {
        if ('' === $query) {
            throw new \Exception(STRTOSIGN_EMPTY_MSG, STRTOSIGN_EMPTY);
        }

        $hash = @hash_hmac('SHA1', strtolower($query), $this->getSecret(), true);
        return urlencode(base64_encode($hash));
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            'name'        => $this->getName(),
            'scheme'      => $this->getScheme(),
            'host'        => $this->getHost(),
            'port'        => $this->getPort(),
            'apiPath'     => $this->getAPIPath(),
            'consolePath' => $this->getConsolePath(),
            'namespace'   => $this->getNamespace(),
            'outputDir'   => $this->getOut(),
        ];
    }

    /**
     * Will attempt to detect and expand a relative path.
     *
     * // TODO: This is probably a bad idea and I should stop being lazy.
     *
     * @param string $in
     * @return string
     */
    public static function tryResolvePath(string $in): string {
        if (0 === strpos($in, './')) {
            if ($rp = realpath(PHPCS_ROOT.'/'.substr($in, 2))) {
                return $rp;
            }
            return PHPCS_ROOT.'/'.substr($in, 2);
        } else if (0 !== strpos($in, '/')) {
            if ($rp = realpath(PHPCS_ROOT.'/'.ltrim($in, "/"))) {
                return $rp;
            }
            return PHPCS_ROOT.'/'.ltrim($in, "/");
        } else {
            return $in;
        }
    }
}
