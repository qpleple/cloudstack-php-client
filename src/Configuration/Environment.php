<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use MyENA\CloudStackClientGenerator\Configuration\Environment\Cache;
use MyENA\CloudStackClientGenerator\Configuration\Environment\Composer;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Psr\Log\NullLogger;
use function MyENA\CloudStackClientGenerator\tryResolvePath;

/**
 * Class Environment
 * @package MyENA\CloudStackClientGenerator\Configuration
 */
class Environment implements LoggerAwareInterface, \JsonSerializable
{
    use LoggerAwareTrait;

    const DEFAULT_SCHEME = 'http';
    const DEFAULT_PORT = 8080;
    const DEFAULT_API_PATH = 'client/api';
    const DEFAULT_CONSOLE_PATH = 'client/console';

    const VALID_NAMESPACE_REGEX = '{^[a-zA-Z][a-zA-Z0-9_]*(\\\[a-zA-Z][a-zA-Z0-9_]*)*$}';

    /**
     * TODO: do better
     * @var array
     */
    private static $settableParams = [
        'name'        => true,
        'key'         => true,
        'secret'      => true,
        'scheme'      => true,
        'host'        => true,
        'port'        => true,
        'apiPath'     => true,
        'consolePath' => true,
        'namespace'   => true,
        'out'         => true,
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

    /** @var string */
    private $name = '';

    /** @var string */
    private $key = '';
    /** @var string */
    private $secret = '';

    /** @var string */
    private $scheme = self::DEFAULT_SCHEME;
    /** @var string */
    private $host = '';
    /** @var int */
    private $port = self::DEFAULT_PORT;

    /** @var string */
    private $apiPath = self::DEFAULT_API_PATH;
    /** @var string */
    private $consolePath = self::DEFAULT_CONSOLE_PATH;

    /** @var string */
    private $compiledAddress = '';

    /** @var string */
    private $namespace = '';
    /** @var string */
    private $out = '';

    /** @var \GuzzleHttp\ClientInterface */
    private $httpClient;

    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment\Cache */
    private $cache;
    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment\Composer */
    private $composer;

    /**
     * Environment constructor.
     *
     * TODO: clean this up a bit.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        // create default cache config, will be overwritten below if defined.
        $this->cache = new Cache();

        $clientClass = Client::class;
        $clientConfig = [];

        $loggerClass = class_exists('\\MyENA\\DefaultANSILogger', true)
            ? '\\MyENA\\DefaultANSILogger'
            : NullLogger::class;
        $loggerLevel = LogLevel::INFO;

        foreach ($config as $k => $v) {
            if (false !== strpos($k, '_')) {
                // TODO: this is a bit...clumsy.
                $k = lcfirst(implode('', array_map('ucfirst', explode('_', $k))));
            }

            if ('httpClient' === $k) {
                list($clientClass, $clientConfig) = $this->parseHttpClientEntry($v, $clientClass);
                continue;
            } elseif ('logger' === $k) {
                list($loggerClass, $loggerLevel) = $this->parseLoggerEntry($v, $loggerClass, $loggerLevel);
                continue;
            } elseif ('cache' === $k) {
                $this->cache = $this->parseCacheEntry($v);
                continue;
            } elseif ('composer' === $k) {
                $this->composer = $this->parseComposerEntry($config['namespace'] ?? '', $v);
                continue;
            }

            if (!isset(self::$settableParams[$k])) {
                throw new \DomainException(sprintf('"%s" is not a configurable value', $k));
            }

            $this->{'set' . ucfirst($k)}($v);
        }

        $this->httpClient = new $clientClass($clientConfig);
        $this->logger = new $loggerClass();

        if (method_exists($this->logger, 'setLevel')) {
            $this->logger->setLevel($loggerLevel);
        } elseif (method_exists($this->logger, 'setLogLevel')) {
            $this->logger->setLogLevel($loggerLevel);
        } elseif (method_exists($this->logger, 'setLoggerLevel')) {
            $this->logger->setLoggerLevel($loggerLevel);
        } else {
            $this->logger->warning(sprintf(
                'Unable to find method by which to set log level with logger "%s"',
                get_class($this->logger)
            ));
        }

        $this->logger->debug(sprintf('Environment %s configuration loaded', $this->name));
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return void
     */
    public function setKey(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @param \GuzzleHttp\ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Composer
     */
    public function getComposer(): Composer
    {
        return $this->composer;
    }

    /**
     * @return string
     */
    public function getCompiledAddress(): string
    {
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
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     * @return void
     */
    public function setScheme(string $scheme)
    {
        $this->scheme = $scheme;
        $this->compiledAddress = '';
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return void
     */
    public function setHost(string $host)
    {
        $this->host = $host;
        $this->compiledAddress = '';
    }

    /**
     * @param string $query
     * @return string
     * @throws \Exception
     */
    public function buildSignature(string $query): string
    {
        if ('' === $query) {
            throw new \Exception(STRTOSIGN_EMPTY_MSG, STRTOSIGN_EMPTY);
        }

        $hash = hash_hmac('SHA1', strtolower($query), $this->getSecret(), true);
        return urlencode(base64_encode($hash));
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return void
     */
    public function setSecret(string $secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return void
     */
    public function setPort(int $port)
    {
        $this->port = $port;
        $this->compiledAddress = '';
    }

    /**
     * @return string
     */
    public function getAPIPath(): string
    {
        return $this->apiPath;
    }

    /**
     * @param string $apiPath
     * @return void
     */
    public function setAPIPath(string $apiPath)
    {
        $this->apiPath = trim($apiPath, " \t\n\r\0\x0B/");
    }

    /**
     * @return string
     */
    public function getConsolePath(): string
    {
        return $this->consolePath;
    }

    /**
     * @param string $consolePath
     * @return void
     */
    public function setConsolePath(string $consolePath)
    {
        $this->consolePath = trim($consolePath, " \t\n\r\0\x0B/");
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     * @return void
     */
    public function setNamespace(string $namespace)
    {
        if (!preg_match(self::VALID_NAMESPACE_REGEX, $namespace)) {
            throw new \InvalidArgumentException(sprintf(
                'Provided namespace "%s" violates "%s"',
                $namespace,
                self::VALID_NAMESPACE_REGEX
            ));
        }
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getOut(): string
    {
        return $this->out;
    }

    /**
     * @param string $out
     * @return void
     */
    public function setOut(string $out)
    {
        $this->out = tryResolvePath($out);
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Cache|null
     */
    public function getCache(): ?Cache
    {
        return $this->cache ?? null;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
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
     * @param array|null $v
     * @return array(
     * @type string Client class
     * @type array Client config
     * )
     */
    protected function parseHttpClientEntry($v, string $clientClass): array
    {
        $clientConfig = [];
        if (null === $v) {
            return [$clientClass, $clientConfig];
        }

        if (!is_array($v)) {
            throw new \DomainException(sprintf(
                'Key "http_client" expected to be array, %s seen',
                gettype($v)
            ));
        }

        if (isset($v['class'])) {
            if (!is_string($v['class'])) {
                throw new \DomainException(sprintf(
                    'Key "http_client" sub-key "class" must be string, % seen',
                    gettype($v['class'])
                ));
            } elseif (!class_exists($v['class'], true)) {
                throw new \RuntimeException(sprintf('Specified HttpClient class "%s" not found', $v['class']));
            } elseif (!isset(class_implements($v['class'])[ClientInterface::class])) {
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

        return [$clientClass, $clientConfig];
    }

    /**
     * @param null|array $v
     * @return array(
     * @type string Logger class
     * @type string Logger level
     * )
     */
    protected function parseLoggerEntry($v, string $loggerClass, string $loggerLevel): array
    {
        if (null === $v) {
            return [$loggerClass, $loggerLevel];
        }

        if (!is_array($v)) {
            throw new \DomainException(sprintf(
                'Key "logger" expected to be array, %s seen',
                gettype($v)
            ));
        }

        if (isset($v['class'])) {
            if (!is_string($v['class'])) {
                throw new \DomainException(sprintf(
                    'Key "logger" sub-key "class" must be string, %s seen.',
                    gettype($v['class'])
                ));
            } elseif (!class_exists($v['class'], true)) {
                throw new \RuntimeException(sprintf(
                    'Specified Logger class "%s" not found',
                    $v['class']
                ));
            } elseif (!isset(class_implements($v['class'])[LoggerInterface::class])) {
                throw new \InvalidArgumentException(sprintf(
                    'Specified Logger class "%s" does not seem to implement \\Psr\\Log\\LoggerInterface',
                    $v['class']
                ));
            }
            $loggerClass = $v['class'];
        }

        if (isset($v['level'])) {
            if (!is_string($v['level'])) {
                throw new \DomainException(sprintf(
                    'Key "logger" sub-key "level" must be string, %s seen.',
                    gettype($v['level'])
                ));
            } elseif (!isset(self::$logLevels[$v['level']])) {
                throw new \OutOfBoundsException(sprintf(
                    'Specified Logger level "%s" is not in valid range  ["%s"]',
                    $v['level'],
                    implode('", "', self::$logLevels)
                ));
            }
            $loggerLevel = $v['level'];
        }

        return [$loggerClass, $loggerLevel];
    }

    /**
     * @param $v
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Cache|null
     */
    protected function parseCacheEntry($v): ?Cache
    {
        if (null === $v) {
            return null;
        }

        if (!is_array($v)) {
            throw new \InvalidArgumentException(sprintf(
                'Key "cache" must be array, %s seen.',
                gettype($v)
            ));
        }

        return new Cache($v);
    }

    /**
     * @param string $namespace
     * @param $v
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Composer
     */
    protected function parseComposerEntry(string $namespace, $v): Composer
    {
        return new Composer($namespace, is_array($v) ? $v : []);
    }
}