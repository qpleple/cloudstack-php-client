<?php namespace MyENA\CloudStackClientGenerator\Generator\API;

use MyENA\CloudStackClientGenerator\Configuration;

/**
 * Class VariableObject
 * @package MyENA\CloudStackClientGenerator\Generator\API
 */
class ObjectVariable extends Variable
{
    /** @var bool */
    private $shared = false;

    /** @var Configuration */
    private $configuration;

    /** @var VariableContainer */
    private $properties;

    /**
     * Response constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->properties = new VariableContainer();
    }

    /**
     * @return bool
     */
    public function isShared()
    {
        return $this->shared;
    }

    /**
     * @param bool $shared
     */
    public function setShared($shared)
    {
        $this->shared = (bool)$shared;
    }

    /**
     * @return VariableContainer
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @return string
     */
    public function getFQName()
    {
        return sprintf('\\%s\\Response\\%s', $this->configuration->getNamespace(), $this->getClassName());
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        if ($this->isShared())
            return ucfirst($this->getName());

        return ucfirst($this->getName()).'Response';
    }

    /**
     * TODO: This loops through the properties entirely to many times.
     *
     * @return string
     */
    public function buildConstructor()
    {
        $dates = [];
        $objects = [];

        foreach($this->getProperties() as $name => $property)
        {
            if ('date' === $property->getType())
                $dates[] = $property->getName();

            if ($property instanceof ObjectVariable)
                $objects[] = $property->getName();
        }

        $datesCnt = count($dates);
        $objectsCnt = count($objects);

        $c = <<<STRING
    /**
     * {$this->getClassName()} Constructor
     * @param array \$data
     */
    public function __construct(array \$data) {

STRING;

        // if this is a very simple class, just return the loop and move on.
        if (0 === $datesCnt && 0 === $objectsCnt)
        {
            return $c.<<<STRING
        foreach (\$data as \$k => \$v) {
            \$this->\$k = \$v;
        }
    }
STRING;
        }

        // otherwise, do stuff.
        // TODO: This could stand to be improved.

        foreach($this->getProperties() as $name => $property)
        {
            if ($property->isCollection() && $property instanceof ObjectVariable)
                $c .= "        \$this->{$name} = [];\n";
        }


        $c .= "        foreach(\$data as \$k => \$v) {\n";

        $first = true;

        foreach($this->getProperties() as $name => $property)
        {
            $name = $property->getName();

            if (in_array($name, $dates, true))
            {
                if ($first)
                {
                    $c .= '            if ';
                    $first = false;
                }
                else
                {
                    $c .= ' else if ';
                }

                $c .= <<<STRING
('{$name}' === \$k && '' !== (\$v = trim((string)\$v))) {
                \$this->{$name} = Types\\DateType::fromApiDate(\$v);
            }
STRING;

            }

            if ($property instanceof ObjectVariable)
            {
                if ($first)
                {
                    $c .= '            if ';
                    $first = false;
                }
                else
                {
                    $c .= ' else if ';
                }

                if ($property->isCollection())
                {
                    $c .= <<<STRING
('{$name}' === \$k && is_array(\$v)) {
                foreach(\$v as \$value) {
                    \$this->{$name}[] = new {$property->getClassName()}(\$value);
                }
            }
STRING;

                }
                else
                {
                    $c .= <<<STRING
('{$name}' === \$k && null !== \$v) {
                \$this->{$name} = new {$property->getClassName()}(\$value);
            }
STRING;

                }
            }
        }

        return $c . <<<STRING
 else {
                \$this->\$k = \$v;
            }
        }
    }
STRING;
    }

    /**
     * @inheritDoc
     */
    public function getPHPType()
    {
        return $this->getFQName();
    }

    /**
     * @inheritDoc
     */
    public function getSwaggerItemsTag()
    {
        return "     *  @SWG\\Items(ref=\"#/definitions/{$this->getClassName()}\"),";
    }
}