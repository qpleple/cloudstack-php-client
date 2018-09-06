<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Command;

use MyENA\CloudStackClientGenerator\Configuration;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;
use function MyENA\CloudStackClientGenerator\tryResolvePath;

/**
 * Class AbstractCommand
 * @package MyENA\CloudStackClientGenerator\Command
 */
abstract class AbstractCommand extends Command
{
    protected const OPT_CONFIG          = 'config';
    protected const OPT_ENV             = 'env';
    protected const OPT_REMOTE          = 'remote';
    protected const OPT_REMOTE_SCHEME   = 'remote-scheme';
    protected const OPT_REMOTE_HOST     = 'remote-host';
    protected const OPT_REMOTE_PORT     = 'remote-port';
    protected const OPT_REMOTE_KEY      = 'remote-key';
    protected const OPT_REMOTE_SECRET   = 'remote-secret';
    protected const OPT_LOCAL           = 'local';
    protected const OPT_LOCAL_API_JSON  = 'local-api-json';
    protected const OPT_LOCAL_CAPS_JSON = 'local-caps-json';
    protected const OPT_API_PATH        = 'apipath';
    protected const OPT_CONSOLE_PATH    = 'consolepath';
    protected const OPT_OUT             = 'out';
    protected const OPT_NAMESPACE       = 'namespace';

    /** @var \Psr\Log\LoggerInterface */
    protected $log;

    /** @var \MyENA\CloudStackClientGenerator\Configuration */
    protected $config;

    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment */
    protected $env;

    /** @var \MyENA\CloudStackClientGenerator\Configuration\Environment\SourceProviderInterface */
    protected $source;

    /**
     * @param string $commandName
     * @return string
     */
    protected function generateName(string $commandName): string
    {
        return "phpcs:{$commandName}";
    }

    protected function addConfigOptions()
    {
        $this
            ->addOption(
                self::OPT_CONFIG,
                null,
                InputOption::VALUE_REQUIRED,
                'Configuration file to use'
            )
            ->addOption(
                self::OPT_ENV,
                null,
                InputOption::VALUE_REQUIRED,
                'If configuration file defined, which environment to use from config'
            )
            ->addOption(
                self::OPT_REMOTE,
                null,
                InputOption::VALUE_NONE,
                'Whether to pull APIs and Capabilities using Remote configuration'
            )
            ->addOption(
                self::OPT_REMOTE_SCHEME,
                null,
                InputOption::VALUE_REQUIRED,
                'If using Remote, HTTP Scheme to use (http or https)',
                Configuration\Environment\Source\Remote::DEFAULT_SCHEME
            )
            ->addOption(
                self::OPT_REMOTE_HOST,
                null,
                InputOption::VALUE_REQUIRED,
                'If using Remote, Hostname of running CloudStack instance'
            )
            ->addOption(
                self::OPT_REMOTE_PORT,
                null,
                InputOption::VALUE_REQUIRED,
                'If using Remote, API Client port to use',
                Configuration\Environment\Source\Remote::DEFAULT_PORT
            )
            ->addOption(
                self::OPT_REMOTE_KEY,
                null,
                InputOption::VALUE_REQUIRED,
                'If using Remote, CloudStack API Key'
            )
            ->addOption(
                self::OPT_REMOTE_SECRET,
                null,
                InputOption::VALUE_REQUIRED,
                'If using Remote, CloudStack API Secret'
            )
            ->addOption(
                self::OPT_LOCAL,
                null,
                InputOption::VALUE_NONE,
                'Whether to pull APIs and Capabilities from Local configuration'
            )
            ->addOption(
                self::OPT_LOCAL_API_JSON,
                null,
                InputOption::VALUE_REQUIRED,
                'If using Local, either the Path to a file containing output from "listApis" or the JSON itself'
            )
            ->addOption(
                self::OPT_LOCAL_CAPS_JSON,
                null,
                InputOption::VALUE_REQUIRED,
                'If using Local, either the path to a file containing output from "listCapbilities" or the JSON itself'
            )
            ->addOption(
                self::OPT_API_PATH,
                null,
                InputOption::VALUE_REQUIRED,
                'API path to use',
                Configuration\Environment::DEFAULT_API_PATH
            )
            ->addOption(
                self::OPT_CONSOLE_PATH,
                null,
                InputOption::VALUE_REQUIRED,
                'Console path to use',
                Configuration\Environment::DEFAULT_CONSOLE_PATH
            )
            ->addOption(
                self::OPT_OUT,
                'O',
                InputOption::VALUE_REQUIRED,
                'Output Directory'
            )
            ->addOption(
                self::OPT_NAMESPACE,
                null,
                InputOption::VALUE_REQUIRED,
                'Namespace for generated code'
            );
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
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
    protected function initializeConfig(InputInterface $input, OutputInterface $output): bool
    {
        $this->config = new Configuration($this->log, []);

        // attempt to parse config file
        if ($file = $input->getOption(self::OPT_CONFIG)) {
            $file = tryResolvePath($file);
            if (!file_exists($file) || !is_readable($file)) {
                $this->log->error("Config file {$file} either does not exist or is not readable");
                return false;
            }
            if (!$this->parseYAML($file, (string)$input->getOption(self::OPT_ENV))) {
                return false;
            }
        } else {
            $environment = new Configuration\Environment($this->log, ['name' => 'adhoc']);
            $this->config->getEnvironments()->setEnvironment($environment);
            $this->env = $environment;
            $this->log->info('No config file specified, using adhoc');
        }

        $local = (bool)$input->getOption(self::OPT_LOCAL);
        $remote = (bool)$input->getOption(self::OPT_REMOTE);

        if (!$local && !$remote) {
            if ($this->env->getLocal()) {
                $local = true;
            } elseif ($this->env->getRemote()) {
                $remote = true;
            }
        }

        if ($local) {
            $source = $this->env->getLocal();
            if (null === $source) {
                $source = new Configuration\Environment\Source\Local();
            }
            if ($opt = $input->getOption(self::OPT_LOCAL_API_JSON)) {
                $source->setListApisJson($opt);
            }
            if ($opt = $input->getOption(self::OPT_LOCAL_CAPS_JSON)) {
                $source->setListCapabilitiesJson($opt);
            }
            if ('' === $source->getListApisJson()) {
                $this->log->error('"list_apis_json" cannot be empty');
                return false;
            }
            if ('' === $source->getListCapabilitiesJson()) {
                $this->log->error('"list_capabilities_json" cannot be empty');
                return false;
            }
            $this->env->setRemote(null);
        } elseif ($remote) {
            $source = $this->env->getRemote();
            if (null === $source) {
                $source = new Configuration\Environment\Source\Remote($this->env->getAPIPath());
            }
            if (Configuration\Environment\Source\Remote::DEFAULT_SCHEME === $source->getScheme()) {
                $source->setScheme($input->getOption(self::OPT_REMOTE_SCHEME));
            }
            if (Configuration\Environment\Source\Remote::DEFAULT_PORT === $source->getPort()) {
                $source->setPort($input->getOption(self::OPT_REMOTE_PORT));
            }
            if ($key = $input->getOption(self::OPT_REMOTE_KEY)) {
                $source->setKey($key);
            }
            if ($secret = $input->getOption(self::OPT_REMOTE_SECRET)) {
                $source->setSecret($secret);
            }
            if ('' === $source->getHost()) {
                $this->log->error('"host" cannot be empty');
                return false;
            }
            if ('' === $source->getKey()) {
                $this->log->error('"key" cannot be empty');
                return false;
            }
            if ('' === $source->getSecret()) {
                $this->log->error('"secret" cannot be empty');
                return false;
            }
            $this->env->setLocal(null);
        } else {
            throw new \LogicException('Unable to determine source');
        }

        // Set any runtime command options
        if (Configuration\Environment::DEFAULT_API_PATH === $this->env->getApiPath() &&
            Configuration\Environment::DEFAULT_API_PATH !== ($apiPath = $input->getOption('apipath'))) {
            $this->env->setApiPath($apiPath);
        }
        if ($consolePath = $input->getOption('consolepath')) {
            $this->env->setConsolePath($consolePath);
        }
        if ($out = $input->getOption('out')) {
            $this->env->setOut(tryResolvePath($out));
        }
        if ($ns = $input->getOption('namespace')) {
            $this->env->setNamespace($ns);
        }

        // Do some basic validation
        if ('' === $this->env->getOut()) {
            $this->log->error('The "out" option must be passed!');
        } else {
            if (!is_dir($this->env->getOut()) && !mkdir($this->env->getOut())) {
                $this->log->error("Unable to create output directory \"{$this->env->getOut()}\"");
                return false;
            } else {
                if (!is_writable($this->env->getOut())) {
                    $this->log->error("Output directory \"{$this->env->getOut()}\" is not writable");
                    return false;
                }
            }
        }

        $this->source = $source;

        // we good, lets go.
        return true;
    }

    /**
     * @param string $file
     * @param string $env
     * @return bool
     */
    protected function parseYAML(string $file, string $env = ''): bool
    {
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

        $this->config = new Configuration($this->log, $parsed);

        if ('' !== $env) {
            $environment = $this->config->getEnvironments()->getEnvironment($env);
            if (null === $environment) {
                $this->log->error("Config file \"{$file}\" does not contain specified environment \"{$env}\"");
                return false;
            }
            $this->env = $environment;
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
}