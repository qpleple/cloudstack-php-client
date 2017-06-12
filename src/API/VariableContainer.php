<?php namespace MyENA\CloudStackClientGenerator\API;

/**
 * Class VariableContainer
 * @package MyENA\CloudStackClientGenerator\API
 */
class VariableContainer implements \Iterator, \Countable {
    /** @var \MyENA\CloudStackClientGenerator\API\Variable[] */
    private $_storage = [];

    /**
     * @param string $name
     * @return \MyENA\CloudStackClientGenerator\API\Variable
     */
    public function get($name) {
        if (isset($this->_storage[$name])) {
            return $this->_storage[$name];
        }

        return null;
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\API\Variable $var
     */
    public function add(Variable $var) {
        $this->_storage[$var->getName()] = $var;
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\API\Variable $var
     * @return bool
     */
    public function has(Variable $var) {
        return isset($this->_storage[$var->getName()]);
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\API\Variable[]
     */
    public function getRequired() {
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
    public function getOptional() {
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
    public function getTypeMap() {
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

    public function nameSort() {
        ksort($this->_storage, SORT_NATURAL);
    }

    public function current() {
        return current($this->_storage);
    }

    public function next() {
        next($this->_storage);
    }

    public function key() {
        return key($this->_storage);
    }

    public function valid() {
        return null !== key($this->_storage);
    }

    public function rewind() {
        reset($this->_storage);
    }

    public function count() {
        return count($this->_storage);
    }
}