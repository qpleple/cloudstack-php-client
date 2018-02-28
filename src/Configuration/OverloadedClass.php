<?php namespace MyENA\CloudStackClientGenerator\Configuration;

/**
 * Class OverloadedClass
 * @package MyENA\CloudStackClientGenerator\Configuration
 */
class OverloadedClass implements \JsonSerializable {

    /** @var string */
    private $name;
    /** @var string */
    private $overload;

    /**
     * ClassMapEntry constructor.
     * @param string $name Name of response class being overloaded
     * @param string $overload Fully qualified class name of the overloading class
     */
    public function __construct(string $name, string $overload) {
        $this->name = $name;
        $this->overload = $overload;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOverload(): string {
        return $this->overload;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            'name'     => $this->getName(),
            'overload' => $this->getOverload(),
        ];
    }
}