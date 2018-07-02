<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration\Environment\Cache;

use MyENA\CloudStackClientGenerator\Configuration\Environment\Cache;
use function MyENA\CloudStackClientGenerator\parseTTL;

/**
 * Class Command
 * @package MyENA\CloudStackClientGenerator\Configuration\Environment\Cache
 */
class Command implements \JsonSerializable
{
    /** @var string */
    private $name;
    /** @var bool */
    private $enabled;
    /** @var int */
    private $ttl;

    /**
     * CommandCache constructor.
     * @param string $name
     * @param array $config
     */
    public function __construct(string $name, array $config = [])
    {
        $this->name = $name;
        $this->enabled = (bool)($config['enabled'] ?? true);
        $this->ttl = parseTTL(($config['ttl'] ?? Cache::DEFAULT_TTL));
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return int
     */
    public function getTTL(): int
    {
        return $this->ttl;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $a = [
            'name'    => $this->getName(),
            'enabled' => $this->isEnabled(),
            'ttl'     => $this->getTTL(),
        ];
        return $a;
    }
}