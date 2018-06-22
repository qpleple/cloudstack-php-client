<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration;

use Psr\Log\LoggerInterface;

/**
 * Class OverloadedClasses
 * @package MyENA\CloudStackClientGenerator\Configuration
 */
class OverloadedClasses implements \ArrayAccess, \Iterator, \Countable, \JsonSerializable
{
    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    /** @var \MyENA\CloudStackClientGenerator\Configuration\OverloadedClass[] */
    private $_classes = [];

    /**
     * OverloadedClasses constructor.
     * @param \Psr\Log\LoggerInterface $logger
     * @param array $classes
     */
    public function __construct(LoggerInterface $logger, array $classes = [])
    {
        $this->logger = $logger;
        foreach ($classes as $class) {
            if (is_array($class)) {
                $class = new OverloadedClass($logger, $class['name'] ?? '', $class['overload'] ?? '');
            }
            $this->setOverloadedClass($class);
        }
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\Configuration\OverloadedClass $class
     * @return void
     */
    public function setOverloadedClass(OverloadedClass $class)
    {
        $this->_classes[$class->getName()] = $class;
    }

    /**
     * @param string $name
     * @return \MyENA\CloudStackClientGenerator\Configuration\OverloadedClass|null
     */
    public function getOverloadedClass(string $name)
    {
        return $this->_classes[$name] ?? null;
    }

    /**
     * @param string $name
     * @return void
     */
    public function removeOverloadedClass(string $name)
    {
        unset($this->_classes[$name]);
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Configuration\OverloadedClass
     */
    public function current()
    {
        return current($this->_classes);
    }

    public function next()
    {
        next($this->_classes);
    }

    /**
     * @return string
     */
    public function key()
    {
        return key($this->_classes);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return key($this->_classes) !== null;
    }

    public function rewind()
    {
        reset($this->_classes);
    }

    /**
     * @param string $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->_classes[$offset]);
    }

    /**
     * @param string $offset
     * @return \MyENA\CloudStackClientGenerator\Configuration\OverloadedClass|null
     */
    public function offsetGet($offset)
    {
        return $this->_classes[$offset] ?? null;
    }

    /**
     * @param mixed $offset ignored
     * @param \MyENA\CloudStackClientGenerator\Configuration\OverloadedClass $value
     */
    public function offsetSet($offset, $value)
    {
        $this->setOverloadedClass($value);
    }

    public function offsetUnset($offset)
    {
        unset($this->_classes[$offset]);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->_classes);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'classes' => $this->_classes,
        ];
    }
}