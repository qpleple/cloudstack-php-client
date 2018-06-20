<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\API;

use function MyENA\CloudStackClientGenerator\buildSwaggerDefinitionTag;
use function MyENA\CloudStackClientGenerator\escapeSwaggerString;

/**
 * Class ObjectVariable
 * @package MyENA\CloudStackClientGenerator\API
 */
class ObjectVariable extends Variable
{
    /** @var bool */
    private $shared = false;

    /** @var string */
    private $namespace;

    /** @var VariableContainer */
    private $properties;

    /**
     * ObjectVariable constructor.
     * @param bool $inResponse
     * @param string $namespace
     */
    public function __construct(bool $inResponse, string $namespace)
    {
        parent::__construct($inResponse);
        $this->namespace = $namespace;
        $this->properties = new VariableContainer();
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

        foreach ($this->getProperties() as $name => $property) {
            if ('date' === $property->getType()) {
                $dates[] = $property->getName();
            }

            if ($property instanceof ObjectVariable) {
                $objects[] = $property->getName();
            }
        }

        $datesCnt = count($dates);
        $objectsCnt = count($objects);

        $c = <<<STRING
    /**
     * {$this->getClassName()} Constructor
     *
     * @param array \$data
     */
    public function __construct(array \$data) {

STRING;

        // if this is a very simple class, just return the loop and move on.
        if (0 === $datesCnt && 0 === $objectsCnt) {
            return $c . <<<STRING
        foreach (\$data as \$k => \$v) {
            \$this->{\$k} = \$v;
        }
    }
STRING;
        }

        // otherwise, do stuff.
        // TODO: This could stand to be improved.

        foreach ($this->getProperties() as $name => $property) {
            if ($property->isCollection() && $property instanceof ObjectVariable) {
                $c .= "        \$this->{$name} = [];\n";
            }
        }


        $c .= "        foreach(\$data as \$k => \$v) {\n";

        $first = true;

        foreach ($this->getProperties() as $name => $property) {
            $name = $property->getName();

            if (in_array($name, $dates, true)) {
                if ($first) {
                    $c .= '            if ';
                    $first = false;
                } else {
                    $c .= ' else if ';
                }

                $c .= <<<STRING
('{$name}' === \$k && '' !== (\$v = trim((string)\$v))) {
                \$this->{$name} = Types\\DateType::fromApiDate(\$v);
            }
STRING;

            }

            if ($property instanceof ObjectVariable) {
                if ($first) {
                    $c .= '            if ';
                    $first = false;
                } else {
                    $c .= ' else if ';
                }

                if ($property->isCollection()) {
                    $c .= <<<STRING
('{$name}' === \$k && is_array(\$v)) {
                foreach(\$v as \$value) {
                    \$this->{$name}[] = new {$property->getClassName()}(\$value);
                }
            }
STRING;

                } else {
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
                \$this->{\$k} = \$v;
            }
        }
    }
STRING;
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
    public function getClassName()
    {
        if ($this->isShared()) {
            return ucfirst($this->getName());
        }

        return ucfirst($this->getName()) . 'Response';
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
     * @inheritDoc
     */
    public function getPHPType(): string
    {
        return $this->getFQName();
    }

    /**
     * @return string
     */
    public function getFQName()
    {
        if (!isset($this->namespace) || $this->namespace === '') {
            return sprintf('\\CloudStackResponse\\%s', $this->getClassName());
        }
        return sprintf('\\%s\\CloudStackResponse\\%s', $this->namespace, $this->getClassName());
    }

    /**
     * @return string
     */
    public function getSwaggerName(): string
    {
        return "CloudStack{$this->getClassName()}";
    }

    /**
     * @inheritDoc
     */
    public function getSwaggerItemsTag(): string
    {
        return "@SWG\\Items(ref=\"{$this->getSwaggerRefValue()}\")";
    }

    /**
     * @return string
     */
    public function getSwaggerRefValue(): string
    {
        return "#/definitions/{$this->getSwaggerName()}";
    }

    /**
     * @param int $indent
     * @param bool $newline
     * @return string
     */
    public function getSwaggerDefinitionTag(int $indent = 4, bool $newline = false): string
    {
        return buildSwaggerDefinitionTag(
            $this->getSwaggerName(),
            escapeSwaggerString($this->getDescription()),
            $this->getProperties(),
            $indent,
            $newline);
    }
}