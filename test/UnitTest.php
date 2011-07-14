<?php
require_once dirname(__FILE__) . "/../src/BaseCloudStackClient.php";
require_once dirname(__FILE__) . "/../src/CloudStackClient.php";
$config = require dirname(__FILE__) . "/credentials.php";
require_once 'PHPUnit/Framework/TestCase.php';

Class UnitTest extends PHPUnit_Framework_TestCase {
   function testa() {
       global $config;
       $cloudstack = new CloudStackClient($config['endpoint'], $config['api_key'], $config['secret_key']);
       $this->assertTrue($cloudstack != null);
       
       var_dump($cloudstack->listVirtualMachines());
   }
   
}

function e($str) {
    echo "$str\n";
}