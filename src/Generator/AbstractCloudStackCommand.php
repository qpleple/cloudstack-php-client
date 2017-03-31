<?php namespace MyENA\CloudStackClientGenerator\Generator;

use MyENA\CloudStackClientGenerator\Configuration;

/**
 * Class AbstractCloudStackCommand
 * @package MyENA\CloudStackClientGenerator\Generator
 */
abstract class AbstractCloudStackCommand {

    /** @var Configuration */
    private $configuration;

    /**
     * Name of command itself
     * @var string
     */
    private $command;

    /**
     * Map of parameters to pass to CloudStack
     * @var array
     */
    private $parameters = [];

    /**
     * Map of key-sorted parameters with "command" key added
     * @var array
     */
    private $compiledParameters = [];

    /**
     * Ready-to-execute represetation of command
     * @var string
     */
    private $compiledQuery = '';

    /**
     * CloudStackCommand Constructor
     * @var Configuration $configuration
     * @var string $command
     * @var array $parameters
     */
    public function __construct(Configuration $configuration, $command, array $parameters = []) {
        $this->configuration = $configuration;

        if (!is_string($command)) {
            throw new \InvalidArgumentException(sprintf(WRONG_ARGUMENT_TYPE_MSG, 'command', 'string', gettype($command)), WRONG_ARGUMENT_TYPE);
        }

        $this->command = trim((string)$command);

        if ('' === $this->command) {
            throw new \InvalidArgumentException(sprintf(WRONG_ARGUMENT_TYPE_MSG, 'command', 'non-empty string', ''), WRONG_ARGUMENT_TYPE);
        }

        $params = [];
        foreach($parameters as $k => $v) {
            $paramStr = null;
            switch(gettype($v)) {
                case 'boolean':
                    $paramStr = $v ? 'true' : 'false';
                    break;
                case 'integer':
                case 'double':
                    $paramStr = strval($v);
                    break;
                case 'string':
                    $paramStr = $v;
                    break;
            }

            if (!is_string($paramStr)) {
                throw new \InvalidArgumentException(sprintf(WRONG_ARGUMENT_TYPE_MSG, $k, 'string', gettype($v)), WRONG_ARGUMENT_TYPE);
            }

            if ('' === $paramStr) {
                continue;
            }

            $params[strtolower($k)] = $paramStr;
        }

        $this->parameters = $params;
    }

    /**
     * @return Configuration
     */
    public function getConfiguration() {
        return $this->configuration;
    }

    /**
     * @return string
     */
    abstract public function getKey();

    /**
     * @return string
     */
    abstract public function getPath();

    /**
     * @return string
     */
    public function getCommand() {
        return $this->command;
    }

    /**
     * @return array
     */
    public function getParameters() {
        if (0 === count($this->compiledParameters)) {
            $this->compiledParameters = [
                    'apikey' => $this->configuration->getApiKey(),
                    $this->getKey() => $this->getCommand(),
                    'response' => 'json',
                ] + $this->parameters;
            ksort($this->compiledParameters);
        }

        return $this->compiledParameters;
    }

    /**
     * @return string
     */
    public function getCompiledQuery() {
        if ('' === $this->compiledQuery) {
            $query = http_build_query($this->getParameters(), '', '&', PHP_QUERY_RFC3986);
            $this->compiledQuery = sprintf('%s&signature=%s', $query, $this->configuration->buildSignature($query));
        }

        return $this->compiledQuery;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->getCompiledQuery();
    }
}