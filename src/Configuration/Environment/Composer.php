<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Configuration\Environment;

use DCarbone\Go\Time;
use JsonSchema\Validator;

/**
 * Class Composer
 * @package MyENA\CloudStackClientGenerator\Configuration\Environment
 */
class Composer
{
    const DEFAULT_TYPE = 'library';
    const DEFAULT_LICENSE = 'MIT';
    const DEFAULT_DESCRIPTION_TEMPLATE = 'Generated CloudStack API PHP Client built on %s against ACS %s';
    const DEFAULT_AUTHORS = [
        [
            'name'  => 'Quentin Pleplé',
            'email' => 'quentin.pleple@gmail.com',
        ],
        [
            'name'  => 'Aaron Hurt',
            'email' => 'ahurt@anbcs.com',
        ],
        [
            'name'  => 'Nathan Johnson',
            'email' => 'nathan@nathanjohnson.info',
        ],
        [
            'name'  => 'Daniel Carbone',
            'email' => 'daniel.p.carbone@gmail.com',
        ],
        [
            'name'  => 'Bogdan Gabor',
            'email' => 'bgabor@ena.com',
        ],
    ];
    const DEFAULT_REQUIRE = [
        'php'               => '^7.1',
        'ext-json'          => '*',
        'ext-curl'          => '*',
        'psr/log'           => '~1.0',
        'guzzlehttp/psr7'   => '~1.4',
        'guzzlehttp/guzzle' => '~6',
        'doctrine/cache'    => '~1.7',
    ];
    const DEFAULT_AUTOLOAD = [
        'psr-4' => [

        ],
        'files' => [
            'src/CloudStackRequest/CloudStackRequestInterfaces.php',
            'src/CloudStackResponse/CloudStackResponseInterfaces.php',
            'src/CloudStackExceptions.php',
        ],
    ];
    const DEFAULT_SUGGEST = [
        'zircote/swagger-php' => 'Used to generate Swagger documentation from the generated models',
    ];

    const FALLBACK_COMPOSER_SCHEMA = __DIR__ . '/../../../files/composer-schema.json';
    const FALLBACK_ACS_VERSION = '0.0.0';

    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var string */
    private $type;
    /** @var string */
    private $license;
    /** @var array */
    private $authors;
    /** @var array */
    private $require;
    /** @var array */
    private $autoload;
    /** @var array */
    private $suggest;

    /** @var array */
    private $theRest = [];

    /** @var array */
    private $compiled;

    /** @var string */
    private $cloudStackVersion;

    /** @var string */
    private $composerSchema;

    /**
     * Composer constructor.
     * @param string $namespace
     * @param array $config
     */
    public function __construct(string $namespace, array $config = [])
    {
        $namespace = rtrim($namespace, "\\") . '\\';
        if (isset($config['name'])) {
            $this->name = $config['name'];
        } else {
            $this->name = trim(
                implode(
                    '/',
                    array_map(
                        'strtolower',
                        explode(
                            '\\',
                            $namespace
                        )
                    )
                ),
                " \t\n\r\0\x0B/"
            );
        }
        $this->description = $config['description'] ?? null;
        $this->type = $config['type'] ?? self::DEFAULT_TYPE;
        $this->license = $config['license'] ?? self::DEFAULT_LICENSE;
        $this->authors = $this->mergeAuthors($config['authors'] ?? []);
        $this->require = $this->mergeRequire($config['require'] ?? []);
        $this->autoload = $this->mergeAutoload($namespace, $config['autoload'] ?? []);
        $this->suggest = $this->mergeSuggest($config['suggest'] ?? []);
        $this->theRest = $this->cleanConfig($config);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        if (!isset($this->description)) {
            return sprintf(
                self::DEFAULT_DESCRIPTION_TEMPLATE,
                Time::Now()->format(DATE_RFC3339),
                $this->getCloudStackVersion()
            );
        }
        return $this->description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getLicense(): string
    {
        return $this->license;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @return array
     */
    public function getRequire(): array
    {
        return $this->require;
    }

    /**
     * @return array
     */
    public function getAutoload(): array
    {
        return $this->autoload;
    }

    /**
     * @return array
     */
    public function getSuggest(): array
    {
        return $this->suggest;
    }

    /**
     * @return array
     */
    public function getTheRest(): array
    {
        return $this->theRest;
    }

    /**
     * @param string $cloudStackVersion
     */
    public function setCloudStackVersion(string $cloudStackVersion): void
    {
        $this->compiled = null;
        $this->cloudStackVersion = $cloudStackVersion;
    }

    /**
     * @return string
     */
    public function getCloudStackVersion(): string
    {
        return $this->cloudStackVersion ?? self::FALLBACK_ACS_VERSION;
    }

    /**
     * @return array
     */
    public function getCompiled(): array
    {
        if (!isset($this->compiled)) {
            $this->compiled = $this->compile();
        }
        return $this->compiled;
    }

    /**
     * @return string
     */
    public function getComposerSchema(): string
    {
        return $this->loadComposerSchema();
    }

    /**
     * Validates the compiled JSON, throwing an exception if validation errors were found
     *
     * @throws \DomainException
     */
    public function validate(): void
    {
        $validator = new Validator();
        $compiled = $this->getCompiled();
        $validator->validate($compiled, $this->getComposerSchema());
        if (!$validator->isValid()) {
            $msg = "The compiled composer.json has errors:\n";
            foreach ($validator->getErrors() as $i => $err) {
                $msg .= "{$i} - Property: {$err['property']}; Error: {$err['message']}\n";
            }
            throw new \DomainException($msg);
        }
    }

    /**
     * @param array $authors
     * @return array
     */
    private function mergeAuthors(array $authors): array
    {
        return array_merge(self::DEFAULT_AUTHORS, $authors);
    }

    /**
     * @param array $require
     * @return array
     */
    private function mergeRequire(array $require): array
    {
        return self::DEFAULT_REQUIRE + $require;
    }

    /**
     * @param string $namespace
     * @param array $autoload
     * @return array
     */
    private function mergeAutoload(string $namespace, array $autoload): array
    {
        // get base
        $merged = self::DEFAULT_AUTOLOAD;

        // add entry for generated client
        $merged['psr-4'][$namespace] = 'src/';

        // add any other namespaces they defined
        if (isset($autoload['psr-4'])) {
            $merged['psr-4'] += $autoload['psr-4'];
        }

        // add any other files they defined
        if (isset($autoload['files'])) {
            $merged['files'] += $autoload['files'];
        }

        // merge whatever is left, maybe they added some psr-0?
        return $merged + $autoload;
    }

    /**
     * @param array $suggest
     * @return array
     */
    private function mergeSuggest(array $suggest): array
    {
        return self::DEFAULT_SUGGEST + $suggest;
    }

    /**
     * @param array $config
     * @return array
     */
    private function cleanConfig(array $config): array
    {
        unset(
            $config['name'],
            $config['description'],
            $config['type'],
            $config['license'],
            $config['authors'],
            $config['require'],
            $config['autoload'],
            $config['suggest']
        );
        return $config;
    }

    /**
     * @return string
     */
    private function loadComposerSchema(): string
    {
        if (!isset($this->composerSchema)) {
            // try to fetch schema
            $ch = curl_init('https://getcomposer.org/schema.json');
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT        => 2, // very low timeout so we aren't waiting here long.
            ]);
            $data = curl_exec($ch);
            $err = curl_errno($ch);
            curl_close($ch);
            if (0 === $err) {
                $this->composerSchema = $data;
            } else {
                $this->composerSchema = file_get_contents(self::FALLBACK_COMPOSER_SCHEMA);
            }
        }
        return $this->composerSchema;
    }

    /**
     * @return array
     */
    private function compile(): array
    {
        $a = [
                'name'        => $this->getName(),
                'type'        => $this->getType(),
                'description' => $this->getDescription(),
                'license'     => $this->getLicense(),
                'authors'     => $this->getAuthors(),
                'require'     => $this->getRequire(),
                'autoload'    => $this->getAutoload(),
                'suggest'     => $this->getSuggest(),
            ] + $this->getTheRest();
        return $a;
    }
}