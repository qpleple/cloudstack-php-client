<?php namespace MyENA\CloudStackClientGenerator;

use MyENA\CloudStackClientGenerator\API\ObjectVariable;
use MyENA\CloudStackClientGenerator\API\VariableContainer;

/**
 * Class API
 * @package MyENA\CloudStackClientGenerator
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

    /** @var \MyENA\CloudStackClientGenerator\API\ObjectVariable */
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
        // filter to remove extraneous [""] entries from explode...
        $this->related = array_filter(explode(',', $related));
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
     * @param \MyENA\CloudStackClientGenerator\API\ObjectVariable $response
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

    /**
     * @return string
     */
    public function getRequestClassName() {
        return sprintf('%sRequest', ucfirst($this->getName()));
    }
}