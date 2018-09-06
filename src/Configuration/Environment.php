<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration;

use MyENA\CloudStackClientGenerator\Configuration\Environment\Cache;
use MyENA\CloudStackClientGenerator\Configuration\Environment\Composer;
use MyENA\CloudStackClientGenerator\Configuration\Environment\Logging;
use MyENA\CloudStackClientGenerator\Configuration\Environment\Source\Local;
use MyENA\CloudStackClientGenerator\Configuration\Environment\Source\Remote;
use MyENA\CloudStackClientGenerator\Configuration\Environment\SourceProviderInterface;
use Psr\Log\LoggerInterface;
use function MyENA\CloudStackClientGenerator\tryResolvePath;

/**
 * Class Environment
 * @package MyENA\CloudStackClientGenerator\Configuration
 */
class Environment implements \JsonSerializable
{
    const DEFAULT_API_PATH     = 'client/api';
    const DEFAULT_CONSOLE_PATH = 'client/console';

    const VALID_NAMESPACE_REGEX = '{^[a-zA-Z][a-zA-Z0-9_]*(\\\[a-zA-Z][a-zA-Z0-9_]*)*$}';

    /**
     * TODO: do better
     * @var array
     */
    private static $settableParams = [
        'name'        => true,
        'apiPath'     => true,
        'consolePath' => true,
        'namespace'   => true,
        'out'         => true,
    ];

    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    /** @var string */
    private $name = '';

    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment\Source\Local */
    private $local;
    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment\Source\Remote */
    private $remote;

    /** @var string */
    private $apiPath = self::DEFAULT_API_PATH;
    /** @var string */
    private $consolePath = self::DEFAULT_CONSOLE_PATH;

    /** @var string */
    private $namespace = '';
    /** @var string */
    private $out = '';

    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment\Cache */
    private $cache;
    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment\Composer */
    private $composer;
    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment\Logging */
    private $logging;

    /**
     * Environment constructor.
     * @param \Psr\Log\LoggerInterface $logger
     * @param array $config
     */
    public function __construct(LoggerInterface $logger, array $config = [])
    {
        $this->logger = $logger;

        // create some defaults, will be overridden if defined.
        $this->cache = new Cache();
        $this->logging = new Logging();

        $localConf = null;
        $remoteConf = null;

        foreach ($config as $k => $v) {
            if (false !== strpos($k, '_')) {
                // TODO: this is a bit...clumsy.
                $k = lcfirst(implode('', array_map('ucfirst', explode('_', $k))));
            }

            if ('cache' === $k) {
                $this->cache = $this->parseCacheEntry($v);
                continue;
            } elseif ('composer' === $k) {
                $this->composer = $this->parseComposerEntry($config['namespace'] ?? '', $v);
                continue;
            } elseif ('logging' === $k) {
                $this->logging = $this->parseLoggingEntry($v);
                continue;
            } elseif ('remote' === $k) {
                $remoteConf = $v;
                continue;
            } elseif ('local' === $k) {
                $localConf = $v;
                continue;
            }

            if (!isset(self::$settableParams[$k])) {
                throw new \DomainException(sprintf('"%s" is not a configurable value', $k));
            }

            $this->{'set' . ucfirst($k)}($v);
        }

        if (isset($remoteConf)) {
            $this->remote = $this->parseRemoteEntry($remoteConf);
        }
        if (isset($localConf)) {
            $this->local = $this->parseLocalEntry($localConf);
        }

        $this->logger->debug(sprintf('Environment %s configuration loaded', $this->name));
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
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Composer
     */
    public function getComposer(): Composer
    {
        return $this->composer;
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
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Logging
     */
    public function getLogging(): Logging
    {
        return $this->logging;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Source\Local|null
     */
    public function getLocal(): ?Local
    {
        return $this->local ?? null;
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\Configuration\Environment\Source\Local|null $local
     */
    public function setLocal(?Local $local): void
    {
        $this->local = $local;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Source\Remote|null
     */
    public function getRemote(): ?Remote
    {
        return $this->remote ?? null;
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\Configuration\Environment\Source\Remote|null $remote
     */
    public function setRemote(?Remote $remote): void
    {
        $this->remote = $remote;
    }

    /**
     * @return null|\MyENA\CloudStackClientGenerator\Configuration\Environment\SourceProviderInterface
     */
    public function getSourceProvider(): ?SourceProviderInterface
    {
        if ($source = $this->getLocal()) {
            return $source;
        }
        return $this->getRemote();
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name'        => $this->getName(),
            'apiPath'     => $this->getAPIPath(),
            'consolePath' => $this->getConsolePath(),
            'namespace'   => $this->getNamespace(),
            'outputDir'   => $this->getOut(),
        ];
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

    /**
     * @param $v
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Logging
     */
    protected function parseLoggingEntry($v): Logging
    {
        return new Logging(is_array($v) ? $v : []);
    }

    /**
     * @param $v
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Source\Remote
     */
    protected function parseRemoteEntry($v)
    {
        return new Remote($this->getAPIPath(), $v);
    }

    /**
     * @param $v
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Source\Local
     */
    protected function parseLocalEntry($v)
    {
        return new Local($v);
    }
}