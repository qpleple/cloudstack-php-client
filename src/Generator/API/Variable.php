<?php namespace MyENA\CloudStackClientGenerator\Generator\API;

/**
 * Class Variable
 * @package MyENA\CloudStackClientGenerator\Generator\API
 */
class Variable
{
    /** @var string */
    private $name = '';
    /** @var string */
    private $description = '';
    /** @var string */
    private $type = 'string';
    /** @var int */
    private $length = 0;
    /** @var bool */
    private $required = false;
    /** @var string */
    private $since = '0.0';
    /** @var string[] */
    private $related = [];

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * @return string
     */
    public function getSince()
    {
        return $this->since;
    }

    /**
     * @param string $since
     */
    public function setSince($since)
    {
        $this->since = $since;
    }

    /**
     * @return bool
     */
    public function isCollection()
    {
        static $collectionTypes = ['set', 'list', 'map', 'responseobject', 'uservmresponse'];

        return in_array($this->getType(), $collectionTypes, true);
    }

    /**
     * @return \string[]
     */
    public function getRelated()
    {
        return $this->related;
    }

    /**
     * @param \string[] $related
     */
    public function setRelated(array $related)
    {
        $this->related = $related;
    }

    /**
     * @param string $related
     */
    public function setRelatedString($related)
    {
        $this->related = explode(',', $related);
    }

    /**
     * @return string
     */
    public function getPHPType()
    {
        switch(($type = $this->getType()))
        {

            case 'set':
            case 'list':
            case 'uservmresponse':
                return 'array';

            case 'map':
            case 'responseobject':
                return 'mixed';

            case 'integer':
            case 'long':
            case 'short':
            case 'int':
                return 'integer';

            case 'date':
                return '\\DateTime';

            case 'imageformat':
            case 'storagepoolstatus':
            case 'hypervisortype':
            case 'status':
            case 'type':
            case 'scopetype':
            case 'state':
            case 'url':
            case 'uuid':
                return 'string';

            default:
                return $type;
        }
    }

    /**
     * @return string
     */
    public function getPropertyDocBloc()
    {
        $bloc = <<<STRING
    /**
     * @SWG\Property(
     *  type="{$this->getPHPType()}",
STRING;

        if ($this->isCollection())
            $bloc .= "\n".$this->getSwaggerItemsTag();

        return $bloc. <<<STRING

     *  description="{$this->getDescription()}"
     * )
     * @var {$this->getPHPTypeTagValue()}
     */
STRING;

    }

    public function getParameterDocBloc()
    {
        return '';
    }

    /***
     * @return string
     */
    public function getSwaggerItemsTag()
    {
        // TODO: Do better.
        return "     * @SWG\\Items(type=\"{$this->getPHPType()}\"),";
    }

    /**
     * @return string
     */
    public function getPHPTypeTagValue()
    {
        $tag = $this->getPHPType();

        if ($this->isCollection())
            $tag .= '[]';

        return $tag;
    }
}