<?php
class CloudStackClient extends BaseCloudStackClient {
    protected $apiKey;
    protected $secretKey;
    protected $apiEndPoint; // Does not ends with a "/"
	
	public function __construct($apiEndPoint, $apiKey, $secretKey) {
	    // $apiEndPoint does not ends with a "/"
	    $this->apiEndPoint = substr($apiEndPoint, -1) == "/" ? substr($apiEndPoint, 0, -1) : $apiEndPoint;
		$this->apiKey = $apiKey;
		$this->secretKey = $secretKey;
	}
	
    function getSignature($queryString){
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
        $url = $this->apiEndPoint . "?" . $query;
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
