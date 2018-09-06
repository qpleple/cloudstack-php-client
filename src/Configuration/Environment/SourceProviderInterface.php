<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration\Environment;

/**
 * Interface SourceProviderInterface
 * @package MyENA\CloudStackClientGenerator\Configuration\Environment
 */
interface SourceProviderInterface
{
    /**
     * Must return the name of this source
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Must return a string describing this specific source
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Must return the "->listapisresponse->api" portion of the "listApis" response
     *
     * @return array
     */
    public function getApis(): array;

    /**
     * Must return the "->listcapabilitiesresponse->capability" portion of the "listCapabilities" response
     *
     * @return \stdClass
     */
    public function getCapabilities(): \stdClass;
}