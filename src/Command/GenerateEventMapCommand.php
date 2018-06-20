<?php declare(strict_types=1);

namespace MyENA\CloudStackClientGenerator\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class APIImplementation
{
    /** @var string */
    public $class;
    /** @var string */
    public $event;
    /** @var string */
    public $method;
}

class APICommand
{
    /** @var string */
    public $name;
    /** @var string */
    public $event;
}

/**
 * Class GenerateEventMapCommand
 * @package MyENA\CloudStackClientGenerator\Command
 */
class GenerateEventMapCommand extends AbstractCommand
{
    /** @var \MyENA\CloudStackClientGenerator\Command\APIImplementation[] */
    protected $implementations = [];
    /** @var \MyENA\CloudStackClientGenerator\Command\APICommand[] */
    protected $commands = [];

    /** @var array */
    protected $map = [];

    protected function configure()
    {
        $this
            ->setName($this->generateName('generate-event-map'))
            ->setDescription('Generate ["commandName" => EVENT] map')
            ->setHelp(<<<STRING

STRING
            )
            ->addArgument(
                'src',
                InputArgument::REQUIRED,
                'Full path to CloudStack code'
            );
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $src = $input->getArgument('src');
        if (!is_dir($src) || !is_readable($src)) {
            $this->log->error("Specified directory \"{$src}\" does not exist or is not readable");
            return 1;
        }

        // Here in case we need it later.
//        $this->parseImplementations("{$src}/server/src");
        $this->parseCommands($src);

        $mapFile = __DIR__ . '/../../files/command_event_map.php';
        $f = fopen($mapFile, 'w+');
        if (!$f) {
            $this->log->error(<<<STRING
Unable to open {$mapFile}
 
STRING
            );
            return 1;
        }

        fwrite($f, <<<STRING
<?php return [

STRING
        );

        foreach ($this->commands as $command) {
            fwrite($f, "    '{$command->name}' => '{$command->event}',\n");
        }

        fwrite($f, '];');
        fclose($f);

        return 0;
    }

    /**
     * @param string $commands_dir
     */
    protected function parseCommands(string $commands_dir)
    {
        $this->globerize($commands_dir, function (string $file, $basename) {
            if (false === strpos($basename, '.java')) {
                return;
            }

            if (false !== strpos($basename, 'Test.java')) {
                return;
            }

            $fh = fopen($file, 'r');
            if (!$fh) {
                $this->log->error("Unable to open file {$file}");
                exit(1);
            }

            $command = null;
            $line_num = 0;

            $name_is_class_var = false;
            $name_class_var = null;

            while (!feof($fh) && $line = fgets($fh)) {
                $line_num++;
                $line = trim($line);
                if (0 === strlen($line)) {
                    continue;
                }

                // TODO: be less lazy
//        if (false !== strpos($line, 'public abstract class')) {
//            break;
//        }

                if (0 === strpos($line, '@APICommand')) {
                    $before = $line_num;
                    $annotation = $this->parseAnnotation($fh, $line, $line_num);
                    preg_match('/name\s?=\s?([^,]+)/', $annotation, $matches);
                    if (2 !== count($matches)) {
                        $this->log->error(<<<STRING
Unable to parse command name from @APICommand annotation:
file: {$file}
range: {$before} - {$line_num}
annotation: {$annotation}

STRING
                        );
                        exit(1);
                    }

                    if (!isset($command)) {
                        $command = new APICommand();
                    }

                    $name = trim($matches[1]);

                    if ($name[0] !== '"') {
                        $name_is_class_var = true;
                        $split = explode('.', $name, 2);
                        $name_class_var = trim(end($split));
                        continue;
                    }

                    $command->name = trim($name, "\"");
                } else {
                    if (isset($command) && $command instanceof APICommand) {
                        if ($name_is_class_var &&
                            !isset($command->name) &&
                            strpos($line, "String {$name_class_var}") !== false) {
                            $split = explode('=', $line, 2);
                            if (count($split) !== 2) {
                                $this->log->error(<<<STRING
Unexpected format of API Name var definition:
file: {$file}
line_num: {$line_num}
line: {$line}

STRING
                                );
                                exit(1);
                            }
                            $command->name = trim($split[1], " \t\r\n\0\x0B\"");
                        } else {
                            if (strpos($line, 'getEventType()') !== false) {
                                $before = $line_num;
                                while (!feof($fh) && $line = fgets($fh)) {
                                    $line_num++;
                                    $line = trim($line);
                                    preg_match('/^return\s+EventTypes\.([a-zA-Z0-9_\.]+)/', $line, $matches);
                                    if (2 !== count($matches)) {
                                        if ($line_num - $before > 3) {
                                            $this->log->notice(<<<STRING
Unable to parse event from "getEventType" method in 3 lines:
file: {$file}
range: {$before} - {$line_num}

STRING
                                            );
                                            unset($command);
                                            continue 2;
                                        }
                                    } else {
                                        $command->event = $matches[1];
                                        break;
                                    }
                                }
                                $this->commands[] = $command;
                                unset($command);
                            }
                        }
                    }
                }
            }

            fclose($fh);
        });
    }

    protected function globerize(string $dir, \Closure $cb, int $flags = GLOB_NOSORT)
    {
        foreach (glob($dir, $flags) as $item) {
            $basename = basename($item);
            if (0 === strpos($basename, '.')) {
                continue;
            }
            if (is_dir($item)) {
                $this->globerize($item . '/*', $cb, $flags);
            } else {
                $cb($item, $basename);
            }
        }
    }

    /**
     * @param resource $fh
     * @param string $line
     * @param int $line_num
     * @return string
     */
    protected function parseAnnotation($fh, string $line, int &$line_num): string
    {
        if (false === strpos($line, '(')) {
            return $line;
        }

        $compiled = '';
        $open = 0;
        $closed = 0;

        $cb = function (string $line) use (&$compiled, &$open, &$closed) {
            foreach (str_split($line) as $chr) {
                if ('(' === $chr) {
                    $open++;
                } else {
                    if (')' === $chr) {
                        $closed++;
                    } else {
                        if ("\n" === $chr || "\r" === $chr) {
                            continue;
                        }
                    }
                }
                $compiled .= $chr;
            }
        };

        $cb($line);

        if ($open === $closed) {
            return $compiled;
        }

        while ($open !== $closed && !feof($fh) && $line = fgets($fh)) {
            $line_num++;
            $cb(trim($line));
        }

        return $compiled;
    }

    /**
     * @param string $implementations_dir
     */
    protected function parseImplementations(string $implementations_dir)
    {
        // NOTE: This is here in case we need it later...
        $this->globerize($implementations_dir, function (string $file, string $basename) {
            if (false === strpos($basename, '.java')) {
                return;
            }

            $fh = fopen($file, 'r');
            if (!$fh) {
                $this->log->error("Unable to open file {$file}");
                exit(1);
            }

            $implementation = null;
            $line_num = 0;

            while (!feof($fh) && $line = fgets($fh)) {
                $line_num++;
                $line = trim($line);
                if (0 === strlen($line)) {
                    continue;
                }
                $ord = ord($line[0]);
                if (null === $implementation) {
                    if (0 === strpos($line, '@ActionEvent')) {
                        $implementation = new APIImplementation();
                        $implementation->class = str_replace('.java', '', $basename);
                        preg_match('/eventType\s?=\s?EventTypes\.([a-zA-Z\._]+)/',
                            $this->parseAnnotation($fh, $line, $line_num), $matches);
                        if (2 !== count($matches)) {
                            $this->log->notice(<<<STRING
Unable to parse ActionEvent:
file: {$file}
{$line_num}: {$line}

STRING
                            );
                            continue;
                        }
                        $implementation->event = $matches[1];
                    }
                } else {
                    if (97 <= $ord && $ord <= 122 && $implementation instanceof APIImplementation) {
                        preg_match('/^(?:public|private)\s[a-zA-Z0-9<>\[\]]+\s([a-zA-Z0-9]+)/', $line, $matches);
                        if (2 !== count($matches)) {
                            $var = var_export($matches, true);
                            $this->log->error(<<<STRING
Unable to parse method line:
file: {$file}
{$line_num}: {$line}
{$var}

STRING
                            );
                            exit(1);
                        }
                        $implementation->method = $matches[1];
                        $this->implementations[] = $implementation;
                        $implementation = null;
                    }
                }
            }

            fclose($fh);
        });
    }

}