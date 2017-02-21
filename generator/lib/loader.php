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

require __DIR__.'/../../vendor/autoload.php';

/**
 * Our reading and parsing functions
 */
require_once __DIR__ . "/APIReader.php";

/* Base CloudStack Client */
require_once __DIR__ . "/../../src/BaseCloudStackClient.php";

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