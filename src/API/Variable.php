<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\API;

use function MyENA\CloudStackClientGenerator\buildRequiredTagLine;
use function MyENA\CloudStackClientGenerator\buildSinceTagLine;
use function MyENA\CloudStackClientGenerator\escapeSwaggerString;
use function MyENA\CloudStackClientGenerator\tagIndent;

/**
 * Class Variable
 * @package MyENA\CloudStackClientGenerator\API
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

    /** @var string */
    private $phpdocDescription;

    /** @var bool */
    private $inResponse;

    /**
     * Variable constructor.
     * @param bool $inResponse Whether this property is contained by a response object. If false, assume part of Request object.
     */
    public function __construct(bool $inResponse)
    {
        $this->inResponse = $inResponse;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length)
    {
        $this->length = $length;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required)
    {
        $this->required = $required;
    }

    /**
     * @return string
     */
    public function getSince(): string
    {
        return $this->since;
    }

    /**
     * @param string $since
     */
    public function setSince(string $since)
    {
        $this->since = $since;
    }

    /**
     * @return string[]
     */
    public function getRelated(): array
    {
        return $this->related;
    }

    /**
     * @param string[] $related
     */
    public function setRelated(array $related)
    {
        $this->related = $related;
    }

    /**
     * @param string $related
     */
    public function setRelatedString(string $related)
    {
        $this->related = explode(',', $related);
    }

    /**
     * @return string
     */
    public function getPropertyDocBloc(): string
    {
        $bloc = "    /**\n";
        $bloc .= "{$this->getPHPDocDescription()}\n";
        $bloc .= "     * @var {$this->getPHPTypeTagValue()}\n";
        $bloc .= $this->getSinceTagLine();
        $bloc .= $this->getRequiredTagLine();
        return $bloc . "\n     */";
    }

    /**
     * @param int $indentLevel
     * @return string
     */
    public function getPHPDocDescription(int $indentLevel = 4): string
    {
        if (!isset($this->phpdocDescription)) {
            $this->phpdocDescription = implode(
                "\n",
                array_map(
                    function ($v) use ($indentLevel) {
                        return sprintf('%s * %s', str_repeat(' ', $indentLevel), $v);
                    },
                    explode("\n",
                        wordwrap(ucfirst($this->getDescription()), 100)
                    )
                )
            );
        }

        return $this->phpdocDescription;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        unset($this->phpdocDescription);
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPHPTypeTagValue()
    {
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
     * @return bool
     */
    public function inResponse(): bool
    {
        return $this->inResponse;
    }

    /**
     * @return bool
     */
    public function isDate(): bool
    {
        static $dateTypes = ['date', 'tzdate'];
        return in_array($this->getType(), $dateTypes, true);
    }

    /**
     * @return string
     */
    public function getPHPType(): string
    {
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
    public function getType(): string
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
     * @return bool
     */
    public function isCollection(): bool
    {
        static $collectionTypes = ['set', 'list', 'map', 'responseobject', 'uservmresponse'];
        return in_array($this->getType(), $collectionTypes, true);
    }

    /**
     * @param int $indent
     * @param bool $newline
     * @return string
     */
    public function getSinceTagLine(int $indent = 4, bool $newline = false): string
    {
        return buildSinceTagLine($this->getSince(), $indent, $newline);
    }

    /**
     * @param int $indent
     * @param bool $newline
     * @return string
     */
    public function getRequiredTagLine(int $indent = 4, bool $newline = false): string
    {
        return buildRequiredTagLine($this->isRequired(), $indent, $newline);
    }

    /**
     * @return string
     */
    public function getSwaggerItemsTag(): string
    {
        // TODO: This will need to be updated to properly model things like details maps and request tags...
        return "@SWG\\Items(type=\"string\")";
    }

    /**
     * @param bool $trailingComma
     * @param bool $inline
     * @param int $indent
     * @param int $nestLevel
     * @return string
     */
    public function getSwaggerTypeField(
        bool $trailingComma = false,
        bool $inline = true,
        int $indent = 4,
        int $nestLevel = 1
    ): string {
        $parts = [];

        if ($this->isCollection()) {
            $parts[] = 'type="array"';
            $parts[] = $this->getSwaggerItemsTag();
        } elseif ($this instanceof ObjectVariable) {
            $parts[] = 'type="object"';
            $parts[] = 'ref="' . $this->getSwaggerRefValue() . '"';
        } elseif ('mixed' === $this->getPHPType() || $this->isDate()) {
            $parts[] = 'type="string"';
        } else {
            $parts[] = 'type="' . $this->getPHPType() . '"';
        }

        if ($inline) {
            return implode(',', $parts) . ($trailingComma ? ',' : '');
        }

        $tag = '';
        foreach ($parts as $i => $part) {
            if ($i > 0) {
                $tag .= ",\n";
            }
            $tag .= tagIndent($indent, $nestLevel * 4) . $part;
        }

        return $tag . ($trailingComma ? ',' : '');
    }

    /**
     * @param bool $trailingComma
     * @return string
     */
    public function getSwaggerDescriptionField(bool $trailingComma = false): string
    {
        if ('' === $this->getDescription()) {
            return '';
        }
        return 'description="' . ucfirst(escapeSwaggerString($this->getDescription())) . '"' . ($trailingComma ? ',' : '');
    }

    /**
     * @param bool $inline
     * @param int $indent
     * @param int $nestLevel
     * @return string
     */
    public function getSwaggerPropertyTag(bool $inline = true, int $indent = 4, int $nestLevel = 1): string
    {
        if ($inline) {
            return sprintf(
                '@SWG\\Property(property="%s",%s%s)',
                $this->getName(),
                $this->getSwaggerTypeField(true),
                $this->getSwaggerDescriptionField(false)
            );
        }

        $tag = tagIndent($indent, $nestLevel * 4) . "@SWG\\Property(\n";
        $tag .= tagIndent($indent, ($nestLevel + 1) * 4) . "property=\"{$this->getName()}\",\n";
        $tag .= $this->getSwaggerTypeField(true, false, $indent, $nestLevel + 1) . "\n";
        $tag .= tagIndent($indent, ($nestLevel + 1) * 4) . $this->getSwaggerDescriptionField(false) . "\n";

        return $tag . tagIndent($indent, $nestLevel * 4) . ')';
    }

    /**
     * @return string
     */
    public function getValidityCheck()
    {
        // TODO: needs implementing
    }
}