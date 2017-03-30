<?php namespace MyENA\CloudStackClientGenerator\Generator;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class CloudStackRequest
 */
class CloudStackRequest implements RequestInterface
{
    // Custom properties
    /** @var AbstractCloudStackCommand */
    private $command;

    /** @var array */
    private $_normalizedHeaders = ['accept' => 'Accept', 'content-type' => 'Content-Type'];

    // PSR-7 properties below

    /** @var string */
    private $protocolVersion = '1.1';
    /** @var array */
    private $headers = ['Accept' => ['application/json'], 'Content-Type' => ['application/x-www-form-urlencoded']];
    /** @var \Psr\Http\Message\StreamInterface */
    private $body = null;
    /** @var string */
    private $requestTarget = null;
    /** @var string */
    private $method = 'GET';
    /** @var \Psr\Http\Message\UriInterface */
    private $uri = null;

    /**
     * CloudStackRequest constructor.
     *
     * @param AbstractCloudStackCommand $command
     */
    public function __construct(AbstractCloudStackCommand $command) {
        $this->command = $command;
    }

    /**
     * @return string HTTP protocol version.
     */
    public function getProtocolVersion() {
        return $this->protocolVersion;
    }

    /**
     * @param string $version HTTP protocol version
     * @return static
     */
    public function withProtocolVersion($version) {
        $clone = clone $this;
        $clone->protocolVersion = $version;
        return $clone;
    }

    /**
     * @return string[][] Returns an associative array of the message's headers. Each
     *     key MUST be a header name, and each value MUST be an array of strings
     *     for that header.
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * @param string $name Case-insensitive header field name.
     * @return bool Returns true if any header names match the given header
     *     name using a case-insensitive string comparison. Returns false if
     *     no matching header name is found in the message.
     */
    public function hasHeader($name) {
        return isset($this->_normalizedHeaders[strtolower($name)]);
    }

    /**
     * @param string $name Case-insensitive header field name.
     * @return string[] An array of string values as provided for the given
     *    header. If the header does not appear in the message, this method MUST
     *    return an empty array.
     */
    public function getHeader($name) {
        $lower = strtolower($name);
        if (!isset($this->_normalizedHeaders[$lower])) {
            return [];
        }

        return $this->headers[$this->_normalizedHeaders[$lower]];
    }

    /**
     * @param string $name Case-insensitive header field name.
     * @return string A string of values as provided for the given header
     *    concatenated together using a comma. If the header does not appear in
     *    the message, this method MUST return an empty string.
     */
    public function getHeaderLine($name) {
        $lower = strtolower($name);
        if (!isset($this->_normalizedHeaders[$name])) {
            return '';
        }

        return implode(',', $this->headers[$this->_normalizedHeaders[$lower]]);
    }

    /**
     * @param string $name Case-insensitive header field name.
     * @param string|string[] $value Header value(s).
     * @return static
     * @throws \InvalidArgumentException for invalid header names or values.
     */
    public function withHeader($name, $value) {
        $type = gettype($value);

        if ('string' !== $type && 'array' !== $type) {
            throw new \InvalidArgumentException(sprintf('$value must be array or string, %s seen.', gettype($value)));
        }

        $lower = strtolower($name);

        $clone = clone $this;
        $clone->_normalizedHeaders[$lower] = $name;

        if ('string' === $type) {
            $clone->headers[$name] = [$value];
        } else {
            $clone->headers[$name] = $value;
        }

        return $clone;
    }

    /**
     * @param string $name Case-insensitive header field name to add.
     * @param string|string[] $value Header value(s).
     * @return static
     * @throws \InvalidArgumentException for invalid header names or values.
     */
    public function withAddedHeader($name, $value)
    {
        $type = gettype($value);
        if ('string' !== $type && 'array' !== $type) {
            throw new \InvalidArgumentException('$value must be array or string, %s seen.', gettype($value));
        }

        $lower = strtolower($name);

        if (isset($this->_normalizedHeaders[$lower])) {
            $headerValues = $this->headers[$this->_normalizedHeaders[$lower]];
        } else {
            $headerValues = [];
        }

        if ('string' === $type) {
            $headerValues[] = $value;
        } else {
            $headerValues = array_merge($headerValues, $value);
        }

        $clone = clone $this;

        $clone->_normalizedHeaders[$lower] = $name;
        $clone->headers[$name] = $headerValues;

        return $clone;
    }

    /**
     * @param string $name Case-insensitive header field name to remove.
     * @return static
     */
    public function withoutHeader($name) {
        $clone = clone $this;

        $lower = strtolower($name);
        if (isset($clone->_normalizedHeaders[$lower])) {
            unset($clone->headers[$clone->_normalizedHeaders[$lower]], $clone->_normalizedHeaders[$lower]);
        }

        return $clone;
    }

    /**
     * @return \Psr\Http\Message\StreamInterface Returns the body as a stream.
     */
    public function getBody() {
        if (null === $this->body) {
            $this->body = new CloudStackRequestBody($this->command);
        }
        return $this->body;
    }

    /**
     * @param \Psr\Http\Message\StreamInterface $body Body.
     * @return static
     * @throws \InvalidArgumentException When the body is not valid.
     */
    public function withBody(StreamInterface $body) {
        if ($body instanceof CloudStackRequestBody) {
            $clone = clone $this;
            $clone->body = $body;
            return $clone;
        }

        throw new \InvalidArgumentException(sprintf(
            'May only provide instance of CloudStackRequestBody to CloudStackRequest, "%s" seen.',
            get_class($body)
        ));
    }

    /**
     * @return string
     */
    public function getRequestTarget() {
        if (null === $this->requestTarget) {
            $uri = $this->getUri();
            $p = $uri->getPath();
            $q = $uri->getQuery();

            if ('' === $p) {
                $t = '/';
            } else {
                $t = $p;
            }

            if ('' !== $q) {
                $t = sprintf('%s?%s', $t, $q);
            }

            $this->requestTarget = $t;
        }

        return $this->requestTarget;
    }

    /**
     * @param mixed $requestTarget
     * @return static
     */
    public function withRequestTarget($requestTarget) {
        $clone = clone $this;
        $clone->requestTarget = trim($requestTarget);
        return $clone;
    }

    /**
     * @return string Returns the request method.
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * @param string $method Case-sensitive method.
     * @return static
     * @throws \InvalidArgumentException for invalid HTTP methods.
     */
    public function withMethod($method) {
        $upper = strtoupper($method);
        if ('POST' === $upper) {
            $clone = clone $this;
            $clone->method = $upper;
            return $clone;
        }

        throw new \InvalidArgumentException('CloudStack API supports only POST requests');
    }

    /**
     * @return \Psr\Http\Message\UriInterface Returns a UriInterface instance
     *     representing the URI of the request.
     */
    public function getUri() {
        if (!isset($this->uri)) {
            $this->uri = new CloudStackUri($this->command);
        }

        return $this->uri;
    }

    /**
     * @param \Psr\Http\Message\UriInterface $uri New request URI to use.
     * @param bool $preserveHost Preserve the original state of the Host header.
     * @return static
     */
    public function withUri(UriInterface $uri, $preserveHost = false) {
        if ($uri === $this->uri) {
            return $this;
        }

        $clone = clone $this;
        $clone->uri = $uri;

        if ($preserveHost) {
            $clone->uri = $this->uri->withHost($this->uri->getHost());
        }

        return $clone;
    }
}
