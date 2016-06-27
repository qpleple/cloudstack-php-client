<?php
/*
 * This file is part of the CloudStack Client Generator.
 *
 * (c) Quentin Pleplé <quentin.pleple@gmail.com>
 * (c) Aaron Hurt <ahurt@anbcs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Templating library
 * see http://www.twig-project.org/
 */
require_once dirname(__FILE__) . "/Twig/Autoloader.php";
Twig_Autoloader::register();

/**
 * Twig Extentions
 * see https://github.com/fabpot/Twig-extensions
 */
require_once dirname(__FILE__) . "/Twig-extensions/Twig/Extensions/Autoloader.php";
Twig_Extensions_Autoloader::register();

/**
 * Our reading and parsing functions
 */
require_once dirname(__FILE__) . "/APIReader.php";

/* Base CloudStack Client */
require_once dirname(__FILE__) . "/../../src/BaseCloudStackClient.php";

/**
* Initiate external libraries and proxies some methods
* for better readability
*/
class Lib {
    private $twig;
    public $config;
    public $cloudstack;

    function __construct() {
        // Initialize templating engine
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(__DIR__ . "/../templates");
        $this->twig = new Twig_Environment($loader);
        $this->twig->addExtension(new Twig_Extensions_Extension_Text());
        /* load config and create cloudstack client connection */
        $this->config = require __DIR__ . "/../../config.php";
        $this->cloudstack = new BaseCloudStackClient($this->config['endpoint'], $this->config['api_key'], $this->config['secret_key']);
    }

    public function render($template, $args = array()) {
        $this->twig->loadTemplate($template)->display($args);
    }
}