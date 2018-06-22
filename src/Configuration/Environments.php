<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration;

use Psr\Log\LoggerInterface;

/**
 * Class Environments
 * @package MyENA\CloudStackClientGenerator\Configuration
 */
class Environments implements \ArrayAccess, \Iterator, \Countable, \JsonSerializable
{
    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment[] */
    private $_storage = [];

    /**
     * Environments constructor.
     * @param \Psr\Log\LoggerInterface $logger
     * @param array $environments
     */
    public function __construct(LoggerInterface $logger, array $environments = [])
    {
        $this->logger = $logger;
        foreach ($environments as $name => $env) {
            if (is_array($env)) {
                $env = new Environment($logger, ['name' => $name] + $env);
            }
            $this->setEnvironment($env);
        }
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\Configuration\Environment $environment
     * @return void
     */
    public function setEnvironment(Environment $environment)
    {
        $this->_storage[$environment->getName()] = $environment;
    }

    /**
     * @param string $name
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment|null
     */
    public function getEnvironment(string $name)
    {
        return $this->_storage[$name] ?? null;
    }

    /**
     * @param string $name
     */
    public function removeEnvironment(string $name)
    {
        unset($this->_storage[$name]);
    }

    /**
     * @return mixed|\MyENA\CloudStackClientGenerator\Configuration\Environment|null
     */
    public function first()
    {
        return 0 < count($this->_storage) ? reset($this->_storage) : null;
    }

    /**
     * @param string $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->_storage[$offset]);
    }

    /**
     * @param string $offset
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment|null
     */
    public function offsetGet($offset)
    {
        return $this->_storage[$offset] ?? null;
    }

    /**
     * @param mixed $offset ignored
     * @param \MyENA\CloudStackClientGenerator\Configuration\Environment $value
     */
    public function offsetSet($offset, $value)
    {
        $this->setEnvironment($value);
    }

    /**
     * @param string $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->_storage[$offset]);
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment
     */
    public function current()
    {
        return current($this->_storage);
    }

    public function next()
    {
        next($this->_storage);
    }

    /**
     * @return string
     */
    public function key()
    {
        return key($this->_storage);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return key($this->_storage) !== null;
    }

    public function rewind()
    {
        reset($this->_storage);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->_storage);
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Configuration\Environment[]
     */
    public function jsonSerialize()
    {
        return $this->_storage;
    }
}