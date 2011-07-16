<?php
if (!defined('STDIN')) {
    echo "This script is supposed to be run from command line. Exiting.\n";
    exit;
}

require_once dirname(__FILE__) . "/../src/CloudStackClient.php";

try {
    throw new Exception("haha", 2);
} catch (Exception $e) {
    if ($e->getCode() == 0) {
        printf("Fatal Error: %s\n", $e->getMessage());
    } else {
        printf("Fatal Error (code %s): %s\n", $e->getCode(), $e->getMessage());
    }
    
}