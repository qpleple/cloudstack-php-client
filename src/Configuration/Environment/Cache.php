<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration\Environment;

/**
 * Class Cache
 * @package MyENA\CloudStackClientGenerator\Configuration\Environment
 */
class Cache
{
    const DEFAULT_TTL = 5 * 60;

    /** @var int */
    private $defaultTTL = self::DEFAULT_TTL;

    /** @var array */
    private $commandTTLs = [];

    /**
     * Cache constructor.
     * @param array $conf
     */
    public function __construct(array $conf = [])
    {
        $this->defaultTTL = $conf['default_ttl'] ?? self::DEFAULT_TTL;
        if (isset($conf['command_ttls'])) {
            foreach ($conf['command_ttls'] as $command => $ttl) {
                if (!is_string($command)) {
                    throw new \InvalidArgumentException(sprintf(
                        'Key "cache" sub-key "command_ttls" must have strings for keys, %s seen.',
                        gettype($command)
                    ));
                }
                if (is_string($ttl) && ctype_digit($ttl)) {
                    $ttl = (int)$ttl;
                }
                if (!is_int($ttl)) {
                    throw new \InvalidArgumentException(sprintf(
                        'Key "cache" sub-key "command_ttls" must have integers for values, command %s has non-int value of type %s',
                        $command,
                        gettype($ttl)
                    ));
                }
                // TODO: validate that the command exists?
                $this->commandTTLs[$command] = $ttl;
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
     * @return array
     */
    public function getCommandTTLs(): array
    {
        return $this->commandTTLs;
    }

    /**
     * @param string $command
     * @return int
     */
    public function getCommandTTL(string $command): int
    {
        return $this->commandTTLs[$command] ?? $this->getDefaultTTL();
    }
}