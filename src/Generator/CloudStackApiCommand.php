<?php namespace MyENA\CloudStackClientGenerator\Generator;

/**
 * Class CloudStackApiCommand
 * @package MyENA\CloudStackClientGenerator\Generator
 */
class CloudStackApiCommand extends AbstractCloudStackCommand {
    /**
     * @inheritDoc
     */
    public function getKey() {
        return 'command';
    }

    /**
     * @inheritDoc
     */
    public function getPath() {
        return $this->getConfiguration()->getApiPath();
    }
}
