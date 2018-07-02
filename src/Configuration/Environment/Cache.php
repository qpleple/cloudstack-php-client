<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration\Environment;

use MyENA\CloudStackClientGenerator\Configuration\Environment\Cache\Command;
use function MyENA\CloudStackClientGenerator\parseTTL;

/**
 * Class Cache
 * @package MyENA\CloudStackClientGenerator\Configuration\Environment
 */
class Cache implements \JsonSerializable
{
    const DEFAULT_ENABLED = true;
    const DEFAULT_TTL = 5 * 60;

    /** @var string|null */
    private $idPrefix;
    /** @var int */
    private $defaultTTL;
    /** @var bool */
    private $defaultEnabled;
    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment\Cache\Command[] */
    private $commands = [];

    /**
     * Cache constructor.
     * @param array $cacheConfig
     */
    public function __construct(array $cacheConfig = [])
    {
        $this->idPrefix = $cacheConfig['id_prefix'] ?? null;
        $this->defaultTTL = parseTTL($cacheConfig['default_ttl'] ?? self::DEFAULT_TTL);
        $this->defaultEnabled = (bool)($cacheConfig['default_enabled'] ?? self::DEFAULT_ENABLED);
        if (isset($cacheConfig['commands'])) {
            foreach ($cacheConfig['commands'] as $command => $commandConfig) {
                if (!is_string($command)) {
                    throw new \InvalidArgumentException(sprintf(
                        'Key "cache" sub-key "command_ttls" must have strings for keys, %s seen.',
                        gettype($command)
                    ));
                }
                if (!is_array($commandConfig)) {
                    throw new \InvalidArgumentException(sprintf(
                        'Key "cache" sub-key "commands" key "%s" must have array value, %s seen.',
                        $command,
                        gettype($commandConfig)
                    ));
                }
                $this->commands[$command] = new Command($command, $commandConfig);
            }
        }
    }

    /**
     * @return null|string
     */
    public function getIDPrefix(): ?string
    {
        return $this->idPrefix;
    }

    /**
     * @return int
     */
    public function getDefaultTTL(): int
    {
        return $this->defaultTTL;
    }

    /**
     * @return bool
     */
    public function isDefaultEnabled(): bool
    {
        return $this->defaultEnabled;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Cache\Command[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * @param string $command
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\Cache\Command|null
     */
    public function getCommand(string $command): ?Command
    {
        return $this->commands[$command] ?? null;
    }

    /**
     * @param string $command
     * @return bool
     */
    public function isCommandEnabled(string $command): bool
    {
        if ($command = $this->getCommand($command)) {
            return $command->isEnabled();
        }
        return $this->isDefaultEnabled();
    }

    /**
     * @param string $command
     * @return int
     */
    public function getCommandTTL(string $command): int
    {
        if ($command = $this->getCommand($command)) {
            return $command->getTTL();
        }
        return self::DEFAULT_TTL;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $a = [
            'idPrefix'       => $this->getIDPrefix(),
            'defaultTTL'     => $this->getDefaultTTL(),
            'defaultEnabled' => $this->isDefaultEnabled(),
            'commands'       => $this->getCommands(),
        ];
        return $a;
    }
}