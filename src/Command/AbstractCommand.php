<?php namespace MyENA\CloudStackClientGenerator\Command;

use MyENA\CloudStackClientGenerator\Client;
use MyENA\CloudStackClientGenerator\Configuration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class AbstractCommand
 * @package MyENA\CloudStackClientGenerator\Command
 */
abstract class AbstractCommand extends Command {
    /** @var \Psr\Log\LoggerInterface */
    protected $log;

    /** @var \MyENA\CloudStackClientGenerator\Configuration */
    protected $config;

    /** @var \MyENA\CloudStackClientGenerator\Client */
    private $client;

    /**
     * @param string $commandName
     * @return string
     */
    protected function generateName(string $commandName): string {
        return "phpcs:{$commandName}";
    }

    protected function addConfigOptions() {
        $this
            ->addOption(
                'config',
                null,
                InputOption::VALUE_REQUIRED,
                'Configuration file to use'
            )
            ->addOption(
                'env',
                null,
                InputOption::VALUE_REQUIRED,
                'If configuration file defined, which environment to use from config'
            )
            ->addOption(
                'scheme',
                null,
                InputOption::VALUE_REQUIRED,
                'HTTP Scheme to use (http or https)',
                Configuration::DefaultScheme
            )
            ->addOption(
                'host',
                null,
                InputOption::VALUE_REQUIRED,
                'Hostname of running CloudStack instance'
            )
            ->addOption(
                'port',
                null,
                InputOption::VALUE_REQUIRED,
                'API Client port to use',
                Configuration::DefaultPort
            )
            ->addOption(
                'apipath',
                null,
                InputOption::VALUE_REQUIRED,
                'API path to use',
                Configuration::DefaultAPIPath
            )
            ->addOption(
                'consolepath',
                null,
                InputOption::VALUE_REQUIRED,
                'Console path to use',
                Configuration::DefaultConsolePath
            )
            ->addOption(
                'key',
                null,
                InputOption::VALUE_REQUIRED,
                'CloudStack API Key'
            )
            ->addOption(
                'secret',
                null,
                InputOption::VALUE_REQUIRED,
                'CloudStack API Secret'
            )
            ->addOption(
                'out',
                'O',
                InputOption::VALUE_REQUIRED,
                'Output Directory'
            )
            ->addOption(
                'namespace',
                null,
                InputOption::VALUE_REQUIRED,
                'Namespace for generated code'
            );
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output) {
        $this->log = new ConsoleLogger($output);
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return bool
     */
    protected function initializeConfig(InputInterface $input, OutputInterface $output): bool {
        $this->config = new Configuration([], $this->log);

        // attempt to parse config file
        if ($file = $input->getOption('config')) {
            $file = $this->tryResolvePath($file);
            if (!file_exists($file) || !is_readable($file)) {
                $this->log->error("Config file {$file} either does not exist or is not readable");
                return false;
            }
            if (!$this->parseYAML($file, (string)$input->getOption('env'))) {
                return false;
            }
        }

        // Set any runtime command options
        if (Configuration::DefaultScheme === $this->config->getScheme() &&
            Configuration::DefaultScheme !== ($scheme = $input->getOption('scheme'))) {
            $this->config->setScheme($scheme);
        }
        if ($host = $input->getOption('host')) {
            $this->config->setHost($host);
        }
        if (Configuration::DefaultPort === $this->config->getPort() &&
            Configuration::DefaultPort !== ($port = $input->getOption('port'))) {
            $this->config->setPort($port);
        }
        if (Configuration::DefaultAPIPath === $this->config->getApiPath() &&
            Configuration::DefaultAPIPath !== ($apiPath = $input->getOption('apipath'))) {
            $this->config->setApiPath($apiPath);
        }
        if ($consolePath = $input->getOption('consolepath')) {
            $this->config->setConsolePath($consolePath);
        }
        if ($key = $input->getOption('key')) {
            $this->config->setKey($key);
        }
        if ($secret = $input->getOption('secret')) {
            $this->config->setSecret($secret);
        }
        if ($out = $input->getOption('out')) {
            $this->config->setOutputDir($this->tryResolvePath($out));
        }
        if ($ns = $input->getOption('namespace')) {
            $this->config->setNamespace($ns);
        }

        // Do some basic validation
        if ('' === $this->config->getHost()) {
            $this->log->error('"host" cannot be empty');
            return false;
        }
        if ('' === $this->config->getKey()) {
            $this->log->error('"key" cannot be empty');
            return false;
        }
        if ('' === $this->config->getSecret()) {
            $this->log->error('"secret" cannot be empty');
            return false;
        }
        if ('' === $this->config->getOutputDir()) {
            $this->log->error('The "out" option must be passed!');
        } else if (!is_dir($this->config->getOutputDir()) && !mkdir($this->config->getOutputDir())) {
            $this->log->error("Unable to create output directory \"{$this->config->getOutputDir()}\"");
            return false;
        } else if (!is_writable($this->config->getOutputDir())) {
            $this->log->error("Output directory \"{$this->config->getOutputDir()}\" is not writable");
            return false;
        }

        // we good, lets go.
        return true;
    }

    /**
     * @param string $file
     * @param string $env
     * @return bool
     */
    protected function parseYAML(string $file, string $env = ''): bool {
        $this->log->debug("Parsing config file \"{$file}\"...");
        try {
            $parsed = Yaml::parse(file_get_contents($file));
        } catch (\Exception $e) {
            $this->log->error("Unable to parse file \"{$file}\": {$e->getMessage()}");
            return false;
        }

        if (!isset($parsed['php_cs_generator'])) {
            $this->log->error("Config file \"{$file}\" is missing root key \"php_cs_generator\"");
            return false;
        }

        $parsed = $parsed['php_cs_generator'];

        if ('' !== $env) {
            if (isset($parsed[$env])) {
                $parsed = $parsed[$env];
            } else {
                $this->log->error("Config file \"{$file}\" does not contain specified environment \"{$env}\"");
                return false;
            }
            $this->log->info("Using \"{$env}\" configuration");
        } else {
            $this->log->info('No env specified, using first entry in config: "'.key($parsed).'"');
            $parsed = reset($parsed);
        }

        foreach ($parsed as $k => $v) {
            if ('path' === substr($k, -4)) {
                $k = substr($k, 0, strlen($k) - 4).'Path';
            } else if ('out' === $k) {
                $k = 'outputDir';
                $v = $this->tryResolvePath($v);
            }
            $this->config->{'set'.ucfirst($k)}($v);
        }

        return true;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Client
     */
    protected function getClient(): Client {
        if (!isset($this->client)) {
            $this->client = new Client($this->config);
        }
        return $this->client;
    }

    /**
     * Will attempt to detect and expand a relative path.
     *
     * // TODO: This is probably a bad idea and I should stop being lazy.
     *
     * @param string $in
     * @return string
     */
    protected function tryResolvePath(string $in): string {
        if (0 === strpos($in, './')) {
            if ($rp = realpath(PHPCS_ROOT.'/'.substr($in, 2))) {
                return $rp;
            }
            return PHPCS_ROOT.'/'.substr($in, 2);
        } else if (0 !== strpos($in, '/')) {
            if ($rp = realpath(PHPCS_ROOT.'/'.ltrim($in, "/"))) {
                return $rp;
            }
            return PHPCS_ROOT.'/'.ltrim($in, "/");
        } else {
            return $in;
        }
    }
}