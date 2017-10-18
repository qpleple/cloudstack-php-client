<?php namespace MyENA\CloudStackClientGenerator;

use MyENA\CloudStackClientGenerator\Command\BuildCommand;
use MyENA\CloudStackClientGenerator\Command\GenerateClientCommand;
use MyENA\CloudStackClientGenerator\Command\GenerateEventMapCommand;
use Symfony\Component\Console\Application as BaseApplication;

/**
 * Class Application
 * @package MyENA\CloudStackClientGenerator
 */
class Application extends BaseApplication {
    /**
     * @return array
     */
    protected function getDefaultCommands() {
        $commands = [
            new GenerateClientCommand(),
        ];

        if (!(bool)getenv('PHPCS_PHAR')) {
            $commands[] = new BuildCommand();
            $commands[] = new GenerateEventMapCommand();
        }
        return array_merge(
            parent::getDefaultCommands(),
            $commands
        );
    }
}