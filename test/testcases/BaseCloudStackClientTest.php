<?php
require_once dirname(__FILE__) . "/../../src/BaseCloudStackClient.php";
require_once 'PHPUnit/Framework/TestCase.php';

Class BaseCloudStackClientTest extends PHPUnit_Framework_TestCase {
    public function setExpectedExceptionCode($code) {
        $this->setExpectedException('CloudStackClientException', "", $code);
    }
    
    public function test_endpoint_empty() {
        $this->setExpectedExceptionCode(ENDPOINT_EMPTY);
        new BaseCloudStackClient("", "-", "-");
    }
    
    public function test_endpoint_not_url() {
        $this->setExpectedExceptionCode(ENDPOINT_NOT_URL);
        new BaseCloudStackClient("http:/fooh", "", "");
    }
    
    public function test_apikey_empty() {
        $this->setExpectedExceptionCode(APIKEY_EMPTY);
        new BaseCloudStackClient("http://foo", "", "");
    }
    
    public function test_secretkey_empty() {
        $this->setExpectedExceptionCode(SECRETKEY_EMPTY);
        new BaseCloudStackClient("http://foo", "-", "");
    }
    
    public function test_endpoint_ending_slash() {
    }
    
    public function test_attributes() {
        // Endpoint handling ending slash
        $cloudstack = new BaseCloudStackClient("http://foo", "-", "-");
        $this->assertEquals("http://foo", $cloudstack->endpoint);
        
        $cloudstack = new BaseCloudStackClient("http://foo/", "-", "-");
        $this->assertEquals("http://foo", $cloudstack->endpoint);
        
        $config = require dirname(__FILE__) . "/../config.php";
        $cloudstack = new BaseCloudStackClient($config['endpoint'], $config['api_key'], $config['secret_key']);
        
        $this->assertNotEmpty($cloudstack);
        $this->assertEquals($config['api_key'], $cloudstack->apiKey);
        $this->assertEquals($config['secret_key'], $cloudstack->secretKey);
    }
}


