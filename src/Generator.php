<?php namespace MyENA\CloudStackClientGenerator;

/**
 * Class Generator
 *
 * @package MyENA\CloudStackClientGenerator
 */
class Generator
{
    /** @var \MyENA\CloudStackClientGenerator\Configuration */
    protected $configuration;

    /**
     * Generator constructor.
     *
     * @param \MyENA\CloudStackClientGenerator\Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }
}