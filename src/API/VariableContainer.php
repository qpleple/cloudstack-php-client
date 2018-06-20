<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\API;

/**
 * Class VariableContainer
 * @package MyENA\CloudStackClientGenerator\API
 */
class VariableContainer implements \Iterator, \Countable
{
    /** @var \MyENA\CloudStackClientGenerator\API\Variable[] */
    private $_storage = [];

    /**
     * @param string $name
     * @return \MyENA\CloudStackClientGenerator\API\Variable|null
     */
    public function get($name)
    {
        if (isset($this->_storage[$name])) {
            return $this->_storage[$name];
        }

        return null;
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\API\Variable $var
     * @return $this
     */
    public function add(Variable $var): VariableContainer
    {
        $this->_storage[$var->getName()] = $var;
        return $this;
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\API\Variable $var
     * @return bool
     */
    public function has(Variable $var): bool
    {
        return isset($this->_storage[$var->getName()]);
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\API\Variable[]
     */
    public function getRequired(): array
    {
        $required = [];
        foreach ($this->_storage as $name => $var) {
            if ($var->isRequired()) {
                $required[$name] = $var;
            }
        }

        return $required;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\API\Variable[]
     */
    public function getOptional(): array
    {
        $optional = [];
        foreach ($this->_storage as $name => $var) {
            if (false === $var->isRequired()) {
                $optional[$name] = $var;
            }
        }

        return $optional;
    }

    /**
     * @return string[]
     */
    public function getTypeMap(): array
    {
        $types = [];
        foreach ($this->_storage as $name => $var) {
            $type = $var->getType();
            if (!isset($types[$type])) {
                $types[$type] = [];
            }

            $types[$type] = $name;
        }

        return $types;
    }

    public function nameSort()
    {
        ksort($this->_storage, SORT_NATURAL);
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\API\Variable
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
     * @return string|null
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
        return null !== key($this->_storage);
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
}