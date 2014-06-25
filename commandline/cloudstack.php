<?php
/*
 * This file is part of the CloudStack PHP Client.
 *
 * (c) Quentin Pleplé <quentin.pleple@gmail.com>
 * (c) Aaron Hurt <ahurt@anbcs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* define file paths */
define("CLOUDSTACKCLIENT_FILE", dirname(__FILE__) . "/../src/CloudStackClient.php");
define("CONFIG_FILE", dirname(__FILE__) . "/../config.php");

/* initial checks */
check(defined('STDIN'), "This script is supposed to be run from command line. Exiting.");
check(file_exists(CLOUDSTACKCLIENT_FILE), "Unable to find CloudStackClient file, looked for " . CLOUDSTACKCLIENT_FILE);
check(file_exists(CONFIG_FILE), "Unable to find config file, looked for " . CONFIG_FILE);
check($argc > 1, "Usage: php cloudstack.php command arg=val arg2=val2 ...");

/* pull in class and configuration */
require CLOUDSTACKCLIENT_FILE;
$config = require CONFIG_FILE;

/* init command and arguments */
$command = $argv[1];
$args = array();

/* parse arguments */
foreach (array_slice($argv, 1) as $kvp) {
    $temps = explode('=', $kvp, 2);
    if (count($temps) == 2) {
        $args[$temps[0]] = $temps[1];
    }
}

/* print parsed arguments */
if (count($args)) {
    $parsed = "";
    foreach ($args as $key => $val) {
        $parsed .= sprintf("%s  =>  %s\n", $key, $val);
    }
    printf("Parsed arguments:\n%s\n\n", $parsed);
}

/**
 * Quick condition checker
 * @param  bool   $cond         condition return to check
 * @param  string $errorMessage message to return
 */
function check($cond, $errorMessage) {
    if (!$cond) {
        err($errorMessage);
    }
}

/**
 * Quick error helper
 * @param  string $errorMessage error message text
 */
function err($errorMessage) {
    die(sprintf("Fatal Error: %s\n", $errorMessage));
}

/* instantiate the client object */
$cloudstack = new BaseCloudStackClient($config['endpoint'], $config['api_key'], $config['secret_key']);

/* execute the request */
try {
    $result = $cloudstack->request($command, $args);
} catch (Exception $e) {
    err($e->getMessage());
}

/* print the result */
printf("Command result:\n%s\n\n", json_encode(array($command => $result), JSON_PRETTY_PRINT));
