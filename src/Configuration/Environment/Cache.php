<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration\Environment;

/**
 * Class Cache
 * @package MyENA\CloudStackClientGenerator\Configuration\Environment
 */
class Cache
{
    const DEFAULT_ENABLED = true;
    const DEFAULT_TTL = 5 * 60;

    /** @var int */
    private $defaultTTL;
    /** @var bool */
    private $defaultEnabled;
    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment\CommandCache[] */
    private $commands = [];

    /**
     * Cache constructor.
     * @param array $cacheConfig
     */
    public function __construct(array $cacheConfig = [])
    {
        $this->defaultTTL = (int)($cacheConfig['default_ttl'] ?? self::DEFAULT_TTL);
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
                $this->commands[$command] = new CommandCache($command, $commandConfig);
            }
        }
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
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\CommandCache[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * @param string $command
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment\CommandCache|null
     */
    public function getCommand(string $command): ?CommandCache
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
}