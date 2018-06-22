<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration\Environment;

/**
 * Class Logging
 * @package MyENA\CloudStackClientGenerator\Configuration\Environment
 */
class Logging
{
    /** @var bool */
    private $enabled;
    /** @var bool */
    private $debug = false;

    /**
     * Logging constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->enabled = (bool)($config['enabled'] ?? true);
        $this->debug = (bool)($config['debug'] ?? false);
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->enabled && $this->debug;
    }
}