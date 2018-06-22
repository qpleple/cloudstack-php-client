<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration;

use Psr\Log\LoggerInterface;

/**
 * Class OverloadedClass
 * @package MyENA\CloudStackClientGenerator\Configuration
 */
class OverloadedClass implements \JsonSerializable
{
    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    /** @var string */
    private $name;
    /** @var string */
    private $overload;

    /**
     * OverloadedClass constructor.
     * @param \Psr\Log\LoggerInterface $logger
     * @param string $name
     * @param string $overload
     */
    public function __construct(LoggerInterface $logger, string $name, string $overload)
    {
        $this->logger = $logger;
        $this->name = $name;
        $this->overload = $overload;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOverload(): string
    {
        return $this->overload;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'name'     => $this->getName(),
            'overload' => $this->getOverload(),
        ];
    }
}