<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration\Environment\Source;

use MyENA\CloudStackClientGenerator\Configuration\Environment\SourceProviderInterface;

/**
 * Class Local
 * @package MyENA\CloudStackClientGenerator\Configuration\Environment\Source
 */
class Local implements SourceProviderInterface
{
    private const NAME = 'local';

    /** @var string */
    private $listApisJson = '';
    /** @var bool */
    private $listApisJsonIsFile = false;

    /** @var string */
    private $listCapabilitiesJson = '';
    /** @var bool */
    private $listCapabilitiesJsonIsFile = false;

    /** @var array */
    private $apis;
    /** @var array */
    private $capabilities;

    /**
     * Local constructor.
     * @param array $conf
     */
    public function __construct(array $conf = [])
    {
        $this->listApisJson = trim((string)($conf['list_apis_json'] ?? ''));
        if ('' === $this->listApisJson) {
            throw new \InvalidArgumentException('"list_apis_json" cannot be empty');
        }
        $this->listApisJsonIsFile = $this->isFile($this->listApisJson);
        $this->listCapabilitiesJson = trim((string)($conf['list_capabilities_json'] ?? ''));
        if ('' === $this->listCapabilitiesJson) {
            throw new \InvalidArgumentException('"list_capabilities_json" cannot be empty');
        }
        $this->listCapabilitiesJsonIsFile = $this->isFile($this->listCapabilitiesJson);
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
        if ($this->listApisJsonIsFile) {
            return basename($this->getListApisJson());
        }
        return 'Runtime JSON';
    }

    /**
     * @return string
     */
    public function getListApisJson(): string
    {
        return $this->listApisJson;
    }

    /**
     * @param string $listApisJson
     */
    public function setListApisJson(string $listApisJson): void
    {
        $this->listApisJson = $listApisJson;
    }

    /**
     * @return string
     */
    public function getListCapabilitiesJson(): string
    {
        return $this->listCapabilitiesJson;
    }

    /**
     * @param string $listCapabilitiesJson
     */
    public function setListCapabilitiesJson(string $listCapabilitiesJson): void
    {
        $this->listCapabilitiesJson = $listCapabilitiesJson;
    }

    /**
     * @return array
     */
    public function getApis(): array
    {
        if (!isset($this->apis)) {
            $apis = $this->parseJSON($this->getListApisJson(), $this->listApisJsonIsFile);
            if (is_array($apis)) {
                $this->apis = $apis;
            } elseif (isset($apis->listapisresponse)) {
                $this->apis = $apis->listapisresponse->api;
            } elseif (isset($apis)) {
                $this->apis = $apis->api;
            } else {
                throw new \DomainException(sprintf(
                    'Unable to discern apis from input: %s',
                    json_encode($apis)
                ));
            }
        }
        return $this->apis;
    }

    /**
     * @return \stdClass
     */
    public function getCapabilities(): \stdClass
    {
        if (!isset($this->capabilities)) {
            $caps = $this->parseJSON($this->getListCapabilitiesJson(), $this->listCapabilitiesJsonIsFile);
            if (isset($caps->listcapabilitiesresponse)) {
                $this->capabilities = $caps->listcapabilitiesresponse->capability;
            } elseif (isset($caps->capability)) {
                $this->capabilities = $caps->capability;
            } else {
                throw new \DomainException(sprintf(
                    'Unable to discern capabilities from input: %s',
                    json_encode($caps)
                ));
            }
        }
        return $this->capabilities;
    }

    /**
     * TODO: do better.
     *
     * @param string $in
     * @return bool
     */
    protected function isFile(string $in): bool
    {
        return '[' !== $in[0] && '{' !== $in[0];
    }

    /**
     * @param string $source
     * @param bool $isFile
     * @return array|\stdClass
     */
    protected function parseJSON(string $source, bool $isFile)
    {
        // TODO: find a better way to test for input being a file?
        if ($isFile) {
            if (!file_exists($source)) {
                throw new \RuntimeException(sprintf(
                    'Source "%s" appears to be a file path, but it does not exist',
                    $source
                ));
            }
            if (!is_readable($source)) {
                throw new \RuntimeException(sprintf(
                    'Source "%s" appears to be a file path, but it is not readable',
                    $source
                ));
            }
            $source = file_get_contents($source);
        }
        $decoded = json_decode($source);
        if (JSON_ERROR_NONE === json_last_error()) {
            return $decoded;
        }
        throw new \DomainException(sprintf(
            'Unable to decode JSON: %s',
            json_last_error_msg()
        ));
    }
}