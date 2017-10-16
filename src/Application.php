<?php namespace MyENA\CloudStackClientGenerator;

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
        return array_merge(
            parent::getDefaultCommands(),
            array_filter(array_map(function ($file) {
                $basename = basename($file);
                if (0 === strpos($basename, 'Abstract')) {
                    return null;
                }
                $class = sprintf('%s\\Command\\%s', __NAMESPACE__, str_replace('.php', '', $basename));
                return new $class;
            },
                glob(__DIR__ . '/Command/*Command.php', GLOB_NOSORT)))
        );
    }
}