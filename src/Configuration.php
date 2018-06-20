<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator;

use MyENA\CloudStackClientGenerator\Configuration\Environments;
use MyENA\CloudStackClientGenerator\Configuration\OverloadedClasses;

/**
 * Class Configuration
 * @package MyENA\CloudStackClientGenerator
 */
class Configuration
{

    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environments */
    protected $environments;

    /** @var \MyENA\CloudStackClientGenerator\Configuration\OverloadedClasses */
    protected $overloadedClasses;

    /** @var array */
    protected $eventTypeMap = [];

    /**
     * Configuration constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->eventTypeMap = require __DIR__ . '/../files/command_event_map.php';

        $this->environments = new Environments($config['environments'] ?? []);
        $this->overloadedClasses = new OverloadedClasses($config['overloaded_classes'] ?? []);
    }

    public function __debugInfo()
    {
        $clone = clone $this;
        unset($clone->now, $clone->HttpClient, $clone->logger, $clone->eventTypeMap);
        return get_object_vars($clone);
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environments
     */
    public function getEnvironments(): Configuration\Environments
    {
        return $this->environments;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Configuration\OverloadedClasses
     */
    public function getOverloadedClasses(): Configuration\OverloadedClasses
    {
        return $this->overloadedClasses;
    }
}
