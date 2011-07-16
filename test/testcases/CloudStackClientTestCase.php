<?php
define("CONFIG_FILE", dirname(__FILE__) . "/../../config.php");

require_once dirname(__FILE__) . "/../../src/BaseCloudStackClient.php";
require_once 'PHPUnit/Framework/TestCase.php';

Class CloudStackClientTestCase extends PHPUnit_Framework_TestCase {
    public function setExpectedExceptionCode($code) {
        $this->setExpectedException('CloudStackClientException', "", $code);
    }

}