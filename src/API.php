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

    /** @var bool */
    private $pageable;

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
    public function getSinceTag(int $indent = 4, bool $newline = false): string
    {
        return buildSinceTagLine($this->getSince(), $indent, $newline);
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\API\VariableContainer
     */
    public function getParameters(): VariableContainer
    {
        return $this->parameters;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\API\ObjectVariable
     */
    public function getResponse(): ObjectVariable
    {
        return $this->response;
    }

    /**
     * @param \MyENA\CloudStackClientGenerator\API\ObjectVariable $response
     * @return \MyENA\CloudStackClientGenerator\API
     */
    public function setResponse(ObjectVariable $response): API
    {
        $this->response = $response;
        return $this;
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
     * @return \MyENA\CloudStackClientGenerator\API
     */
    public function setEventType(string $eventType): API
    {
        $this->eventType = $eventType;
        return $this;
    }

    /**
     * @return bool
     */
    public function isList(): bool
    {
        return 0 === strpos($this->getName(), 'list');
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
     * @return \MyENA\CloudStackClientGenerator\API
     */
    public function setName(string $name): API
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCacheable(): bool
    {
        $name = $this->getName();
        return 'getApiLimit' !== $name && (0 === strpos($name, 'get') || 0 === strpos($name, 'list'));
    }

    /**
     * @return bool
     */
    public function isPageable(): bool
    {
        if (!isset($this->pageable)) {
            $pageFound = $pageSizeFound = false;
            foreach ($this->getParameters() as $parameter) {
                switch ($parameter->getName()) {
                    case 'page':
                        $pageFound = true;
                        break;
                    case 'pagesize':
                        $pageSizeFound = true;
                        break;
                }
                if ($pageFound && $pageSizeFound) {
                    break;
                }
            }
            $this->pageable = $pageFound && $pageSizeFound;
        }
        return $this->pageable;
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
    public function getSwaggerName(): string
    {
        return "CloudStack{$this->getRequestClassName()}";
    }
}