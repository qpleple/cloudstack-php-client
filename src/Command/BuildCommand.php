<?php namespace MyENA\CloudStackClientGenerator\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BuildCommand
 * @package MyENA\CloudStackClientGenerator\Command
 */
class BuildCommand extends AbstractCommand {

    /** @var \Phar */
    protected $phar;

    /** @var array */
    protected $addedDirs = [];

    /** @var string */
    protected $rootPath;

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output) {
        parent::initialize($input, $output);
        $this->rootPath = realpath(__DIR__.'/../../');
    }

    protected function configure() {
        $this
            ->setName($this->generateName('build'))
            ->setDescription('Used to build redistributable phar')
            ->setHelp(<<<STRING
This command is designed to be used in conjunction with the "build" script defined in composer.json
STRING
            );
    }

    /**
     * The bulk of this method was taken from here: https://github.com/box-project/box2-lib/blob/master/src/lib/Herrera/Box/Compactor/Php.php#L43
     *
     * @param string $in
     * @return string
     */
    protected function compactPHP(string $in): string {

        $output = '';
        foreach (token_get_all($in) as $token) {
            if (is_string($token)) {
                $output .= $token;
            } elseif (in_array($token[0], [T_COMMENT, T_DOC_COMMENT])) {
                $output .= str_repeat("\n", substr_count($token[1], "\n"));
            } elseif (T_WHITESPACE === $token[0]) {
                // reduce wide spaces
                $whitespace = preg_replace('{[ \t]+}', ' ', $token[1]);
                // normalize newlines to \n
                $whitespace = preg_replace('{(?:\r\n|\r|\n)}', "\n", $whitespace);
                // trim leading spaces
                $whitespace = preg_replace('{\n +}', "\n", $whitespace);
                $output .= $whitespace;
            } else {
                $output .= $token[1];
            }
        }
        return $output;
    }

    /**
     * @param string $in
     * @return string
     */
    protected function resolvePath(string $in): string {
        if (0 === strpos($in, $this->rootPath)) {
            return $in;
        }
        return realpath($this->rootPath.'/'.trim($in, "/"));
    }

    /**
     * @param string $in
     * @return string
     */
    protected function trimRootPath(string $in): string {
        return '/'.trim(str_replace($this->rootPath, '', $in), "/");
    }

    /**
     * Will add a file to the PHAR, optionally attempting to compact it's contents if a it is a php file.
     *
     * @param string $data
     * @param string $file
     */
    protected function addFileFromString(string $data, string $file) {
        $file = $this->trimRootPath($file);
        $this->log->info("Adding file {$file}...");
        if ('.php' === substr($file, -4)) {
            $this->phar->addFromString($file, $this->compactPHP($data));
        } else {
            $this->phar->addFromString($file, $data);
        }
    }

    /**
     * @param string $file
     */
    protected function addFile(string $file) {
        $file = $this->resolvePath($file);
        if (!$file) {
            throw new \RuntimeException("{$file} does not exist");
        }
        $this->addFileFromString(file_get_contents($file), $file);
    }

    /**
     * @param string $dir
     */
    protected function addDirectory(string $dir) {
        static $skipDirs = [
            '/phpunit/',
            '/test/',
            '/tests/',
            '/Tests/',
            '/Tester/',
            '/doc/',
            '/docs/',
        ];

        static $skipFiles = [
            '.',
            '..',
            '.git',
            '.gitignore',
            '.gitattributes',
            '.gitkeep',
            'CHANGELOG',
            'CHANGELOG.md',
            'CHANGELOG.MD',
            'UPGRADING',
            'UPGRADING.md',
            'UPGRADING.MD',
            'README',
            'README.md',
            'README.MD',

        ];

        foreach (glob(rtrim($this->resolvePath($dir), "/").'/*', GLOB_NOSORT) as $f) {
            foreach ($skipDirs as $skipDir) {
                if (false !== strpos($f, $skipDir)) {
                    $this->log->debug("Skipping \"{$this->trimRootPath($f)}\"...");
                    continue 2;
                }
            }
            if (is_dir($f)) {
                $this->addDirectory($f);
            } else {
                $filename = trim(strrchr($f, '/'), "/");
                if (in_array($filename, $skipFiles, true)) {
                    continue;
                }
                $this->addFile($f);
            }
        }
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->log->info('Building php-cs.phar...');

        $target = __DIR__.'/../../build/php-cs.phar';

        if (file_exists($target)) {
            $this->log->info('Cleaning up previous build...');
            if (!unlink($target)) {
                $this->log->error('Unable to remove previous bin.');
                return 1;
            }
        }

        $this->phar = new \Phar($target,
            \FilesystemIterator::CURRENT_AS_FILEINFO |
            \FilesystemIterator::KEY_AS_FILENAME |
            \FilesystemIterator::SKIP_DOTS,
            'php-cs.phar');

        $this->addFile('composer.json');
        $this->addFile('LICENSE');
        $this->addDirectory('files');
        $this->addDirectory('templates');
        $this->addDirectory('src');
        $this->addDirectory('vendor');
        $this->addFile('bin/php-cs');

        $this->phar->setStub(/** @lang PHP */
            <<<PHP
#!/usr/bin/env php
<?php
Phar::mapPhar('php-cs.phar');
putenv('PHPCS_PHAR=1');
define('PHPCS_ROOT', Phar::running(false));
require 'phar://php-cs.phar/bin/php-cs';
__HALT_COMPILER(); ?>
PHP
        );

        return 0;
    }
}