<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration\Environment\Source;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;
use MyENA\CloudStackClientGenerator\Configuration\Environment\SourceProviderInterface;

/**
 * Class Remote
 * @package MyENA\CloudStackClientGenerator\Configuration\Environment\Source
 */
class Remote implements SourceProviderInterface
{
    private const NAME = 'remote';

    const DEFAULT_SCHEME = 'http';
    const DEFAULT_PORT   = 8080;

    /** @var string */
    private $key = '';
    /** @var string */
    private $secret = '';

    /** @var string */
    private $scheme = self::DEFAULT_SCHEME;
    /** @var string */
    private $host = '';
    /** @var int */
    private $port = self::DEFAULT_PORT;

    /** @var string */
    private $apiPath = '';

    /** @var string */
    private $compiledAddress = '';

    /** @var \GuzzleHttp\ClientInterface */
    private $httpClient;

    /** @var array */
    private $apis;
    /** @var \stdClass */
    private $capabilities;

    /**
     * Remote constructor.
     * @param string $apiPath
     * @param array $conf
     */
    public function __construct(string $apiPath, array $conf = [])
    {
        $this->apiPath = $apiPath;
        $clientClass = GuzzleClient::class;
        $clientConfig = [];
        foreach ($conf as $k => $v) {
            if ('httpClient' === $k) {
                list($clientClass, $clientConfig) = $this->parseHttpClientEntry($v, $clientClass);
                continue;
            }
            $this->{"set{$k}"}($v);
        }
        $this->httpClient = new $clientClass($clientConfig);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getHost();
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return void
     */
    public function setKey(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return void
     */
    public function setSecret(string $secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     * @return void
     */
    public function setScheme(string $scheme)
    {
        $this->scheme = $scheme;
        $this->compiledAddress = '';
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return void
     */
    public function setHost(string $host)
    {
        $this->host = $host;
        $this->compiledAddress = '';
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return void
     */
    public function setPort(int $port)
    {
        $this->port = $port;
        $this->compiledAddress = '';
    }

    /**
     * @return string
     */
    public function getApiPath(): string
    {
        return $this->apiPath;
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @param \GuzzleHttp\ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $query
     * @return string
     * @throws \Exception
     */
    public function buildSignature(string $query): string
    {
        if ('' === $query) {
            throw new \Exception(STRTOSIGN_EMPTY_MSG, STRTOSIGN_EMPTY);
        }

        $hash = hash_hmac('SHA1', strtolower($query), $this->getSecret(), true);
        return urlencode(base64_encode($hash));
    }

    /**
     * @return string
     */
    public function getCompiledAddress(): string
    {
        if ('' === $this->compiledAddress) {
            $this->compiledAddress = rtrim(sprintf(
                '%s://%s%s/',
                $this->getScheme(),
                $this->getHost(),
                0 === $this->port ? '' : sprintf(':%d', $this->port)
            ),
                "/");
        }

        return $this->compiledAddress;
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getApis(): array
    {
        if (!isset($this->apis)) {
            $data = $this->do('listApis');
            $this->apis = $data->listapisresponse->api;
        }
        return $this->apis;
    }

    /**
     * @return \stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCapabilities(): \stdClass
    {
        if (!isset($this->capabilities)) {
            $data = $this->do('listCapabilities');
            $this->capabilities = $data->listcapabilitiesresponse->capability;
        }
        return $this->capabilities;
    }

    /**
     * @param string $command
     * @param array $parameters
     * @param array $headers
     * @return \stdClass
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function do(string $command, array $parameters = [], array $headers = []): \stdClass
    {
        static $defaultHeaders = [
            'Accept'       => ['application/json'],
            'Content-Type' => ['application/x-www-form-urlencoded'],
        ];

        $params = ['apikey' => $this->getKey(), 'command' => $command, 'response' => 'json'] + $parameters;

        ksort($params);

        $query = http_build_query($params, '', '&', PHP_QUERY_RFC3986);

        $uri = new Uri(sprintf(
            '%s/%s?%s&signature=%s',
            $this->getCompiledAddress(),
            $this->getApiPath(),
            $query,
            $this->buildSignature($query)
        ));

        $r = new Request('GET', $uri, $headers + $defaultHeaders);

        $resp = $this->getHttpClient()->send($r, [
            RequestOptions::HTTP_ERRORS    => false,
            RequestOptions::DECODE_CONTENT => false,
        ]);

        if (200 !== $resp->getStatusCode()) {
            // attempt to decode response...
            $data = $resp->getBody()->getContents();
            $decoded = @json_decode($data, true);
            if (JSON_ERROR_NONE === json_last_error()) {
                if (1 === count($decoded)) {
                    $decoded = reset($decoded);
                }
                if (isset($decoded['errortext'])) {
                    throw new \RuntimeException($decoded);
                }
            }
            throw new \RuntimeException(sprintf('Received non-200 response: %d %s.  Body: %s', $resp->getStatusCode(),
                $resp->getReasonPhrase(), $data), NO_VALID_JSON_RECEIVED);
        }

        $body = $resp->getBody();

        if (0 === $body->getSize()) {
            throw new \RuntimeException(NO_DATA_RECEIVED_MSG, NO_DATA_RECEIVED);
        }

        $decoded = @json_decode($body->getContents());
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \RuntimeException(sprintf('%s: %s', NO_VALID_JSON_RECEIVED_MSG, json_last_error_msg()),
                NO_VALID_JSON_RECEIVED);
        }

        return $decoded;
    }

    /**
     * @param array|null $v
     * @return array(
     * @type string Client class
     * @type array Client config
     * )
     */
    protected function parseHttpClientEntry($v, string $clientClass): array
    {
        $clientConfig = [];
        if (null === $v) {
            return [$clientClass, $clientConfig];
        }

        if (!is_array($v)) {
            throw new \DomainException(sprintf(
                'Key "http_client" expected to be array, %s seen',
                gettype($v)
            ));
        }

        if (isset($v['class'])) {
            if (!is_string($v['class'])) {
                throw new \DomainException(sprintf(
                    'Key "http_client" sub-key "class" must be string, % seen',
                    gettype($v['class'])
                ));
            } elseif (!class_exists($v['class'], true)) {
                throw new \RuntimeException(sprintf('Specified HttpClient class "%s" not found', $v['class']));
            } elseif (!isset(class_implements($v['class'])[ClientInterface::class])) {
                throw new \DomainException(sprintf(
                    'Specified HttpClient class "%s" does not seem to implement \\GuzzleHttp\\ClientInterface',
                    $v['class']
                ));
            }
            $clientClass = $v['class'];
        }

        if (isset($v['config'])) {
            if (!is_array($v['config'])) {
                throw new \InvalidArgumentException(sprintf(
                    'http_client property config must be array, %s seen.',
                    gettype($v['config'])
                ));
            }
            $clientConfig = $v['config'];
        }

        return [$clientClass, $clientConfig];
    }
}