<?php
require_once dirname(__FILE__) . "/CloudStackClientException.php";

class BaseCloudStackClient {
    public $apiKey;
    public $secretKey;
    public $endpoint; // Does not ends with a "/"
	
	public function __construct($endpoint, $apiKey, $secretKey) {
	    // API endpoint
	    if (empty($endpoint)) {
	        throw new CloudStackClientException(ENDPOINT_EMPTY_MSG, ENDPOINT_EMPTY);
	    }
	    
	    if (!preg_match("|^http://.*$|", $endpoint)) {
	        throw new CloudStackClientException(sprintf(ENDPOINT_NOT_URL_MSG, $endpoint), ENDPOINT_NOT_URL);
	    }
	    
	    // $endpoint does not ends with a "/"
	    $this->endpoint = substr($endpoint, -1) == "/" ? substr($endpoint, 0, -1) : $endpoint;
	    
	    // API key
	    if (empty($apiKey)) {
	        throw new CloudStackClientException(APIKEY_EMPTY_MSG, APIKEY_EMPTY);
	    }
		$this->apiKey = $apiKey;
		
		// API secret
		if (empty($secretKey)) {
		    throw new CloudStackClientException(SECRETKEY_EMPTY_MSG, SECRETKEY_EMPTY);
		}
		$this->secretKey = $secretKey;
	}
	
    public function getSignature($queryString) {
        //echo("queryString = $queryString\n");
        $hash = @hash_hmac("SHA1", $queryString, $this->secretKey, true);
        //echo("hash = $hash\n");
        $base64 = base64_encode($hash);
        //echo("base64 = $base64\n");
        return $base64;
    }

    /**
    * @param $path Path for the request. Starts with a "/"
    * @param $args Array of arguments
    */
    protected function request($command, $args) {
        foreach ($args as $key => $value) {
            if ($value == "") {
                unset($args[$key]);
            }
        }
        // Building the query
        $args['apikey'] = $this->apiKey;
        $args['command'] = $command;
        $args['response'] = "json";
        ksort($args);
        $query = http_build_query($args);
        $query = str_replace("+", "%20", $query);
        $query .= "&signature=" . urlencode($this->getSignature(strtolower($query)));
    
        $httpRequest = new HttpRequest();
        $httpRequest->setMethod(HTTP_METH_POST);
        $url = $this->endpoint . "?" . $query;
        echo $url;
        $httpRequest->setUrl($url);
    
        $httpRequest->send();
        $data = $httpRequest->getResponseData();
        $result = @json_decode($data['body']);
        
        // Error handling
        if ($httpRequest->getResponseCode() > 204) {
            $field = strtolower($command) . "response";
            throw new Exception($result->{$field}->errortext);
            //$message = $result->errortext;
            //if ($message) {
            //    if ($message instanceof stdClass) {
            //        $r = (array)$message;
            //        $msg = '';
            //        foreach ($r as $k=>$v)
            //            $msg .= "{$k}: {$v} ";
            //
            //        throw new Exception(trim($msg));
            //    } else {
            //        throw new Exception($message);
            //    }
            //}
            //throw new Exception($data['body']);
        }
        return $result;
    }
}
