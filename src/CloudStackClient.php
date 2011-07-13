<?php
class CloudStackClient extends BaseCloudStackClient {
    protected $apiKey;
    protected $secretKey;
    protected $apiEndPoint; // Does not ends with a "/"
    
	//
	// Usage types in the CloudStack platform
	//
	
	// Tracks the total running time of a VM per usage record period. If the VM is upgraded during the usage period, you will get a separate Usage Record for the new upgraded VM.
	const RUNNING_VM = 1;
	
	// Tracks the total time the VM has been created to the time when it has been destroyed. This usage type is also useful in determining usage for specific templates such as Windows-based templates.
	const ALLOCATED_VM = 2;
	
    // Tracks the public IP address owned by the account.
    const IP_ADDRESS = 3;
	
	// Tracks the total number of bytes sent by all the VMs for an account. Cloud.com does not currently track network traffic per VM.
	const NETWORK_BYTES_SENT = 4;
	
	// Tracks the total number of bytes received by all the VMs for an account. Cloud.com does not currently track network traffic per VM.
	const NETWORK_BYTES_RECEIVED = 5;
	
	// Tracks the total time a disk volume has been created to the time when it has been destroyed.
	const VOLUME = 6;
	
	// Tracks the total time a template (either created from a snapshot or uploaded to the cloud) has been created to the time it has been destroyed. The size of the template is also returned.
	const TEMPLATE = 7;
	
	// Tracks the total time an ISO has been uploaded to the time it has been removed from the cloud. The size of the ISO is also returned.
	const ISO = 8;
	
	// Tracks the total time a snapshot has been created to the time it has been destroyed.
	const SNAPSHOT = 9;
	
	// Tracks the total time a security group rule has been applied to a VM. Cloud.com does not track the creation/deletions of a security.
	const SECURITY_GROUP_RULE = 10;
	
	// Tracks the total time a load balancer policy has been created to the time it has been removed. Cloud.com does not track whether a VM has been assigned to a policy.
	const LOAD_BALANCER_POLICY = 11;

	
	public function __construct($apiEndPoint, $apiKey, $secretKey) {
	    // $apiEndPoint does not ends with a "/"
	    $this->apiEndPoint = substr($apiEndPoint, -1) == "/" ? substr($apiEndPoint, 0, -1) : $apiEndPoint;
		$this->apiKey = $apiKey;
		$this->secretKey = $secretKey;
	}
	
    function getSignature($queryString){
        return base64_encode(@hash_hmac("SHA1", $queryString, $this->secretKey, true));
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
        $query .= "&signature=" . urlencode(strtolower($this->getSignature($query)));
    
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
