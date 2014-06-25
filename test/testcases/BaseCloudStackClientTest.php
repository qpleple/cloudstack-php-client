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
 
require_once dirname(__FILE__) . "/CloudStackClientTestCase.php";

Class BaseCloudStackClientTest extends CloudStackClientTestCase {
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
        
        $config = require CONFIG_FILE;
        $cloudstack = new BaseCloudStackClient($config['endpoint'], $config['api_key'], $config['secret_key']);
        
        $this->assertNotEmpty($cloudstack);
        $this->assertEquals($config['api_key'], $cloudstack->apiKey);
        $this->assertEquals($config['secret_key'], $cloudstack->secretKey);
    }
    
    public function test_signature_empty_str() {
        $this->setExpectedExceptionCode(STRTOSIGN_EMPTY);
        $cloudstack = new BaseCloudStackClient("http://foo", "-", "-");
        $cloudstack->getSignature("");
    }
    
    public function test_signature() {
        // apiKey and secretKey from example code from official API reference
        // @see http://download.cloud.com/releases/2.2.0/api_2.2.4/user/2.2api_examplecode_details.html
        $apiKey = "miVr6X7u6bN_sdahOBpjNejPgEsT35eXq-jB8CG20YI3yaxXcgpyuaIRmFI_EJTVwZ0nUkkJbPmY3y2bciKwFQ";
        $secretKey = "AdpTvsQMZwv9MNvfqDcQhWSL9pHQvq7z13CFP2SU1iToDkkM3d8iZciWEKsGREhMtV9yLVMxmbbJJgrXo8O5jg";
        $queryString = "apikey=" . strtolower($apiKey) . "&command=listvirtualmachines&response=json";
        $cloudstack = new BaseCloudStackClient("http://foo", $apiKey, $secretKey);
        $this->assertEquals($cloudstack->getSignature($queryString), "dPQ94TY7lQAR6tjOVt9smq3xaSY%3D");
    }

    public function test_no_command() {
        $this->setExpectedExceptionCode(NO_COMMAND);
        $cloudstack = new BaseCloudStackClient("http://google.com/", "slqkdjqslkdjlqskjd", "qlskdjlskqjdlkqsjdlkjq");
        $cloudstack->request("");
    }

    public function test_request_args_null() {
        $this->setExpectedExceptionCode(WRONG_REQUEST_ARGS);
        $cloudstack = new BaseCloudStackClient("http://google.com/", "slqkdjqslkdjlqskjd", "qlskdjlskqjdlkqsjdlkjq");
        $cloudstack->request("command-name-non-empty", null);
    }

    public function test_request_args_string() {
        $this->setExpectedExceptionCode(WRONG_REQUEST_ARGS);
        $cloudstack = new BaseCloudStackClient("http://google.com/", "slqkdjqslkdjlqskjd", "qlskdjlskqjdlkqsjdlkjq");
        $cloudstack->request("command-name-non-empty", "foo");
    }
    
    public function test_request() {
        $this->setExpectedExceptionCode(NO_VALID_JSON_RECEIVED);
        $cloudstack = new BaseCloudStackClient("http://google.com/", "slqkdjqslkdjlqskjd", "qlskdjlskqjdlkqsjdlkjq");
        $cloudstack->request("command-name-non-empty", array());
    }

}


