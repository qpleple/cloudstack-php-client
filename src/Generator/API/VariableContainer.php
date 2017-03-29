<?php namespace MyENA\CloudStackClientGenerator\Generator\API;

/**
 * Class VariableContainer
 * @package MyENA\CloudStackClientGenerator\Generator\API
 */
class VariableContainer implements \Iterator, \Countable
{
    /** @var \MyENA\CloudStackClientGenerator\Generator\API\Variable[] */
    private $_storage = [];

    /**
     * @param string $name
     * @return Variable
     */
    public function get($name)
    {
        if (isset($this->_storage[$name]))
            return $this->_storage[$name];

        return null;
    }

    /**
     * @param Variable $var
     */
    public function add(Variable $var)
    {
        $this->_storage[$var->getName()] = $var;
    }

    /**
     * @return Variable[]
     */
    public function getRequired()
    {
        $required = [];
        foreach($this->_storage as $name => $var)
        {
            if ($var->isRequired())
                $required[$name] = $var;
        }

        return $required;
    }

    /**
     * @return Variable[]
     */
    public function getOptional()
    {
        $optional = [];
        foreach($this->_storage as $name => $var)
        {
            if (false === $var->isRequired())
                $optional[$name] = $var;
        }

        return $optional;
    }

    /**
     * @return string[string]
     */
    public function getTypeMap()
    {
        $types = [];
        foreach($this->_storage as $name => $var)
        {
            $type = $var->getType();
            if (!isset($types[$type]))
                $types[$type] = [];

            $types[$type] = $name;
        }

        return $types;
    }

    public function nameSort()
    {
        ksort($this->_storage, SORT_NATURAL);
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return current($this->_storage);
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        next($this->_storage);
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return key($this->_storage);
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return null !== key($this->_storage);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        reset($this->_storage);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->_storage);
    }
}