<?php namespace MyENA\CloudStackClientGenerator\API;

/**
 * Class API
 * @package MyENA\CloudStackClientGenerator\API
 */
class API {
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

    /** @var VariableContainer */
    private $parameters;

    /** @var ObjectVariable */
    private $response;

    /**
     * API constructor.
     */
    public function __construct() {
        $this->parameters = new VariableContainer();
    }

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
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function isAsync() {
        return $this->async;
    }

    /**
     * @param bool $async
     */
    public function setAsync($async) {
        $this->async = (bool)$async;
    }

    /**
     * @return \string[]
     */
    public function getRelated() {
        return $this->related;
    }

    /**
     * @param \string[] $related
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
     * @return VariableContainer
     */
    public function getParameters() {
        return $this->parameters;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\API\ObjectVariable
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * @param ObjectVariable $response
     */
    public function setResponse(ObjectVariable $response) {
        $this->response = $response;
    }

    /**
     * @return bool
     */
    public function isList() {
        return 0 === strpos($this->getName(), 'list');
    }
}