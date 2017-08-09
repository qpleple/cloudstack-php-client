<?php namespace MyENA\CloudStackClientGenerator\API;

/**
 * Class Variable
 * @package MyENA\CloudStackClientGenerator\API
 */
class Variable {
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

    /** @var string */
    private $phpdocDescription;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        unset($this->phpdocDescription);
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength($length) {
        $this->length = $length;
    }

    /**
     * @return bool
     */
    public function isRequired() {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired($required) {
        $this->required = $required;
    }

    /**
     * @param int $offset
     * @return string
     */
    public function getRequiredTag($offset = 4) {
        if ($this->required) {
            return sprintf("%s * @required\n", str_repeat(' ', $offset));
        }

        return sprintf("%s * @optional\n", str_repeat(' ', $offset));
    }

    /**
     * @return string
     */
    public function getSince() {
        return $this->since;
    }

    /**
     * @param string $since
     */
    public function setSince($since) {
        $this->since = $since;
    }

    /**
     * @param int $offset
     * @return string
     */
    public function getSinceTag($offset = 4) {
        if ('0.0' === $this->since) {
            return '';
        }

        return sprintf("%s * @since %s\n", str_repeat(' ', $offset), $this->since);
    }

    /**
     * @return bool
     */
    public function isCollection() {
        static $collectionTypes = ['set', 'list', 'map', 'responseobject', 'uservmresponse'];

        return in_array($this->getType(), $collectionTypes, true);
    }

    /**
     * @return string[]
     */
    public function getRelated() {
        return $this->related;
    }

    /**
     * @param string[] $related
     */
    public function setRelated(array $related) {
        $this->related = $related;
    }

    /**
     * @param string $related
     */
    public function setRelatedString($related) {
        $this->related = explode(',', $related);
    }

    /**
     * @return string
     */
    public function getPHPType() {
        $type = $this->getType();
        switch ($type) {

            case 'set':
            case 'list':
            case 'uservmresponse':
            case 'map':
                return 'array';

            case 'responseobject':
                return 'mixed';

            case 'integer':
            case 'long':
            case 'short':
            case 'int':
                return 'integer';

            case 'date':
            case 'tzdate':
                return '\\DateTime|string';

            case 'object': // TODO: This one might be overly greedy, currently matches "baremetalrcturl"

            case 'imageformat':
            case 'storagepoolstatus':
            case 'hypervisortype':
            case 'status':
            case 'type':
            case 'scopetype':
            case 'state':
            case 'url':
            case 'uuid':
            case 'powerstate':
            case 'outofbandmanagementresponse':
                return 'string';

            // Catch these here so we can analyze outliers easier...
            case 'string':
            case 'boolean':
                return $type;

            default:
                return $type;
        }
    }

    /**
     * @return string
     */
    public function getPHPDocDescription() {
        if (!isset($this->phpdocDescription)) {
            $this->phpdocDescription = implode(
                "\n",
                array_map(function($v) { return "     * {$v}"; },
                    explode("\n",
                        wordwrap($this->getDescription(), 100)
                    )
                )
            );
        }

        return $this->phpdocDescription;
    }

    /**
     * @return string
     */
    public function getPropertyDocBloc() {
        $bloc = "    /**\n";
        $bloc .= "{$this->getPHPDocDescription()}\n";
        $bloc .= "     * @var {$this->getPHPTypeTagValue()}\n";
        $bloc .= $this->getSinceTag();
        $bloc .= $this->getRequiredTag();

        $bloc .= <<<STRING
     * @SWG\Property(
     *  type="{$this->getPHPType()}",
STRING;

        if ($this->isCollection()) {
            $bloc .= "\n" . $this->getSwaggerItemsTag();
        }

        return $bloc . <<<STRING

     *  description="{$this->getDescription()}"
     * )
     */
STRING;

    }

    /***
     * @return string
     */
    public function getSwaggerItemsTag() {
        // TODO: Do better.
        return "     * @SWG\\Items(type=\"{$this->getPHPType()}\"),";
    }

    /**
     * @return string
     */
    public function getPHPTypeTagValue() {
        $tag = $this->getPHPType();

        if ('array' !== $tag && $this->isCollection()) {
            $tag .= '[]';
        }

        return $tag;
    }

    /**
     * @return string
     */
    public function getValidityCheck() {
        // TODO: needs implementing
    }
}