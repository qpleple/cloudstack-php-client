#!/usr/bin/env php
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

// Check script is executed from CLI
if (!defined('STDIN')) {
  echo("Error: should only be executed from CLI.");  
  exit;
}

require_once dirname(__FILE__) . "/lib/loader.php";

// Load external liraries
$lib = new Lib();

$reader = new APIReader($lib);

if ($argc > 1 && $argv[1] == "methods") {
    $reader->dumpMethodNames();
} elseif ($argc > 2 && $argv[1] == "method-data" ) {
    $methodName = $argv[2];
    $reader->dumpMethodData($methodName);
} elseif ($argc > 2 && $argv[1] == "method" ) {
    $methodName = $argv[2];
    $reader->dumpMethod($methodName);
} elseif ($argc > 1 && $argv[1] == "class" ) {
    $reader->dumpClass();
} else {
    // No valid arguments given, printing help and exiting
    $lib->render("usage.cli.twig");
}
