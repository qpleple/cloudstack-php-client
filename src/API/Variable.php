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

    /** @var bool */
    private $inResponse;

    /**
     * Variable constructor.
     * @param bool $inResponse Whether this property is contained by a response object. If false, assume part of Request object.
     */
    public function __construct(bool $inResponse) {
        $this->inResponse = $inResponse;
    }

    /**
     * @return bool
     */
    public function inResponse(): bool {
        return $this->inResponse;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * @param bool $swaggerQuotes Will escape all double-quotes with '""'
     * @return string
     */
    public function getDescription(bool $swaggerQuotes = false): string {
        return $swaggerQuotes ? str_replace('"', '""', $this->description) : $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description) {
        unset($this->phpdocDescription);
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string {
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
    public function getLength(): int {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length) {
        $this->length = $length;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required) {
        $this->required = $required;
    }

    /**
     * @param int $offset
     * @return string
     */
    public function getRequiredTag(int $offset = 4): string {
        if ($this->required) {
            return sprintf("%s * @required\n", str_repeat(' ', $offset));
        }

        return sprintf("%s * @optional\n", str_repeat(' ', $offset));
    }

    /**
     * @return string
     */
    public function getSince(): string {
        return $this->since;
    }

    /**
     * @param string $since
     */
    public function setSince(string $since) {
        $this->since = $since;
    }

    /**
     * @param int $offset
     * @return string
     */
    public function getSinceTag(int $offset = 4): string {
        if ('0.0' === $this->since) {
            return '';
        }

        return sprintf("%s * @since %s\n", str_repeat(' ', $offset), $this->since);
    }

    /**
     * @return bool
     */
    public function isCollection(): bool {
        static $collectionTypes = ['set', 'list', 'map', 'responseobject', 'uservmresponse'];
        return in_array($this->getType(), $collectionTypes, true);
    }

    /**
     * @return bool
     */
    public function isDate(): bool {
        static $dateTypes = ['date', 'tzdate'];
        return in_array($this->getType(), $dateTypes, true);
    }

    /**
     * @return string[]
     */
    public function getRelated(): array {
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
    public function setRelatedString(string $related) {
        $this->related = explode(',', $related);
    }

    /**
     * @return string
     */
    public function getPHPType(): string {
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
                return '\\DateTime';

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
    public function getPHPDocDescription(): string {
        if (!isset($this->phpdocDescription)) {
            $this->phpdocDescription = implode(
                "\n",
                array_map(function($v) {
                    return "     * {$v}";
                },
                    explode("\n",
                        wordwrap(ucfirst($this->getDescription(false)), 100)
                    )
                )
            );
        }

        return $this->phpdocDescription;
    }

    /**
     * @return string
     */
    public function getPropertyDocBloc(): string {
        $bloc = "    /**\n";
        $bloc .= "{$this->getPHPDocDescription()}\n";
        $bloc .= "     * @var {$this->getPHPTypeTagValue()}\n";
        $bloc .= $this->getSinceTag();
        $bloc .= $this->getRequiredTag();
        $bloc .= <<<STRING
     * @SWG\Property(
     *    type="
STRING;
        if ($this->isCollection()) {
            $bloc .= "array\",\n";
            $bloc .= "     *    {$this->getSwaggerItemsTag()},\n";
        } else if ($this instanceof ObjectVariable) {
            $bloc .= "object\",\n";
            $bloc .= "     *    @SWG\\Schema(ref=\"{$this->getSwaggerRefValue()}\"),\n";
        } else if ('mixed' === $this->getPHPType()) {
            $bloc .= "string\",\n";
        } else if ($this->isDate()) {
            $bloc .= "string\",\n";
        } else {
            $bloc .= "{$this->getPHPType()}\",\n";
        }

        $description = ucfirst($this->getDescription(true));
        return $bloc.<<<STRING
     *    description="{$description}"
     * )
     */
STRING;

    }

    /***
     * @return string
     */
    public function getSwaggerItemsTag(): string {
        // TODO: This will need to be updated to properly model things like details maps and request tags...
        return "@SWG\\Items(type=\"string\")";
    }

    /**
     * @return string
     */
    public function getPHPTypeTagValue() {
        if ($this->inResponse() && $this->isDate()) {
            $tag = '\\DateTime|string Value will try to be parsed as a \\DateTime, falling back to the raw string value if unable';
        } else {
            $tag = $this->getPHPType();
        }

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