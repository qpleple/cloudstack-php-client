<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator;

use MyENA\CloudStackClientGenerator\API\ObjectVariable;
use MyENA\CloudStackClientGenerator\API\VariableContainer;

/**
 * Class API
 * @package MyENA\CloudStackClientGenerator
 */
class API
{
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var bool */
    private $async = false;
    /** @var string[] */
    private $related = [];
    /** @var string */
    private $since = '0.0';

    /** @var string */
    private $eventType = '';

    /** @var VariableContainer */
    private $parameters;

    /** @var \MyENA\CloudStackClientGenerator\API\ObjectVariable */
    private $response;

    /**
     * API constructor.
     */
    public function __construct()
    {
        $this->parameters = new VariableContainer();
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
     * @return \MyENA\CloudStackClientGenerator\API
     */
    public function setDescription(string $description): API
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAsync(): bool
    {
        return $this->async;
    }

    /**
     * @param bool $async
     * @return \MyENA\CloudStackClientGenerator\API
     */
    public function setAsync(bool $async): API
    {
        $this->async = (bool)$async;
        return $this;
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
     * @return \MyENA\CloudStackClientGenerator\API
     */
    public function setRelated(array $related): API
    {
        $this->related = $related;
        return $this;
    }

    /**
     * @param string $related
     * @return \MyENA\CloudStackClientGenerator\API
     */
    public function setRelatedString(string $related): API
    {
        // filter to remove extraneous [""] entries from explode...
        $this->related = array_filter(explode(',', $related));
        return $this;
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
     * @return \MyENA\CloudStackClientGenerator\API
     */
    public function setSince(string $since): API
    {
        $this->since = $since;
        return $this;
    }

    /**
     * @param int $indent
     * @param bool $newline
     * @return string
     */
    public function getSinceTag(int $indent = 4, bool $newline = false)
    {
        return buildSinceTagLine($this->getSince(), $indent, $newline);
    }

    /**
     * @return VariableContainer
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\API\ObjectVariable
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\API\ObjectVariable $response
     */
    public function setResponse(ObjectVariable $response)
    {
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }

    /**
     * @param string $eventType
     */
    public function setEventType(string $eventType)
    {
        $this->eventType = $eventType;
    }

    /**
     * @return bool
     */
    public function isList()
    {
        return 0 === strpos($this->getName(), 'list');
    }

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
    public function getRequestClassName()
    {
        return sprintf('%sRequest', ucfirst($this->getName()));
    }

    /**
     * @return string
     */
    public function getSwaggerName(): string {
        return "CloudStack{$this->getRequestClassName()}";
    }
}