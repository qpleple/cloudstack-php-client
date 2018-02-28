<?php namespace MyENA\CloudStackClientGenerator\Command;

use MyENA\CloudStackClientGenerator\Client;
use MyENA\CloudStackClientGenerator\Configuration;
use Psr\Log\NullLogger;
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

    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment */
    protected $env;

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
                Configuration\Environment::DefaultScheme
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
                Configuration\Environment::DefaultPort
            )
            ->addOption(
                'apipath',
                null,
                InputOption::VALUE_REQUIRED,
                'API path to use',
                Configuration\Environment::DefaultAPIPath
            )
            ->addOption(
                'consolepath',
                null,
                InputOption::VALUE_REQUIRED,
                'Console path to use',
                Configuration\Environment::DefaultConsolePath
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
            )
        ;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output) {
        if ((bool)$output->isQuiet()) {
            $this->log = new NullLogger();
        } else {
            $this->log = new ConsoleLogger($output);
        }
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return bool
     */
    protected function initializeConfig(InputInterface $input, OutputInterface $output): bool {
        $this->config = new Configuration([]);

        // attempt to parse config file
        if ($file = $input->getOption('config')) {
            $file = Configuration\Environment::tryResolvePath($file);
            if (!file_exists($file) || !is_readable($file)) {
                $this->log->error("Config file {$file} either does not exist or is not readable");
                return false;
            }
            if (!$this->parseYAML($file, (string)$input->getOption('env'))) {
                return false;
            }
        } else {
            $environment = new Configuration\Environment([
                'name' => 'adhoc',
            ]);
            $this->config->getEnvironments()->setEnvironment($environment);
            $this->env = $environment;
            $this->log->info('No config file specified, using adhoc');
        }
        if ($this->env->getLogger() === null || $this->env->getLogger() instanceof NullLogger) {
            $this->env->setLogger($this->log); // TODO: might just set null logger again, do we care?
        }

        // Set any runtime command options
        if (Configuration\Environment::DefaultScheme === $this->env->getScheme() &&
            Configuration\Environment::DefaultScheme !== ($scheme = $input->getOption('scheme'))) {
            $this->env->setScheme($scheme);
        }
        if ($host = $input->getOption('host')) {
            $this->env->setHost($host);
        }
        if (Configuration\Environment::DefaultPort === $this->env->getPort() &&
            Configuration\Environment::DefaultPort !== ($port = $input->getOption('port'))) {
            $this->env->setPort($port);
        }
        if (Configuration\Environment::DefaultAPIPath === $this->env->getApiPath() &&
            Configuration\Environment::DefaultAPIPath !== ($apiPath = $input->getOption('apipath'))) {
            $this->env->setApiPath($apiPath);
        }
        if ($consolePath = $input->getOption('consolepath')) {
            $this->env->setConsolePath($consolePath);
        }
        if ($key = $input->getOption('key')) {
            $this->env->setKey($key);
        }
        if ($secret = $input->getOption('secret')) {
            $this->env->setSecret($secret);
        }
        if ($out = $input->getOption('out')) {
            $this->env->setOut(Configuration\Environment::tryResolvePath($out));
        }
        if ($ns = $input->getOption('namespace')) {
            $this->env->setNamespace($ns);
        }

        // Do some basic validation
        if ('' === $this->env->getHost()) {
            $this->log->error('"host" cannot be empty');
            return false;
        }
        if ('' === $this->env->getKey()) {
            $this->log->error('"key" cannot be empty');
            return false;
        }
        if ('' === $this->env->getSecret()) {
            $this->log->error('"secret" cannot be empty');
            return false;
        }
        if ('' === $this->env->getOut()) {
            $this->log->error('The "out" option must be passed!');
        } else if (!is_dir($this->env->getOut()) && !mkdir($this->env->getOut())) {
            $this->log->error("Unable to create output directory \"{$this->env->getOut()}\"");
            return false;
        } else if (!is_writable($this->env->getOut())) {
            $this->log->error("Output directory \"{$this->env->getOut()}\" is not writable");
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

        $this->config = new Configuration($parsed);

        if ('' !== $env) {
            $environment = $this->config->getEnvironments()->getEnvironment($env);
            if (null === $environment) {
                $this->log->error("Config file \"{$file}\" does not contain specified environment \"{$env}\"");
                return false;
            }
        } else {
            $first = $this->config->getEnvironments()->first();
            if (null === $first) {
                $this->log->error("Config file \"{$file}\" contains no environments");
                return false;
            }
            $this->env = $first;
        }

        $this->log->info("Using \"{$this->env->getName()}\" configuration");

        return true;
    }

    /**
     * @return \MyENA\CloudStackClientGenerator\Client
     */
    protected function getClient(): Client {
        if (!isset($this->client)) {
            $this->client = new Client($this->env);
        }
        return $this->client;
    }
}