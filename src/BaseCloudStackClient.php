<?php
/**
 * This file is part of the CloudStack PHP Client.
 *
 * (c) Quentin Pleplé <quentin.pleple@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Pull in exception class definiations
 */
require_once dirname(__FILE__) . "/CloudStackClientException.php";

/**
 * BaseCloudstackClient class
 */
class BaseCloudStackClient {
    /**
     * CloudStack API client key
     * @var string
     */
    public $apiKey;

    /**
     * CloudStack API client secret key
     * @var string
     */
    public $secretKey;

    /**
     * CloudStack API client endpoint
     * @var string
     */
    public $endpoint; // Does not ends with a "/"

    /**
     * Creates a new CloudStack Client Object
     * @param string $endpoint  CloudStack API endpoint url
     * @param string $apiKey    CloudStack API key
     * @param string $secretKey CloudStack API secret key
     * @throws CloudStackClientException on error
     */
    public function __construct($endpoint, $apiKey, $secretKey) {
        /* API endpoint */
        if (empty($endpoint)) {
            throw new CloudStackClientException(ENDPOINT_EMPTY_MSG, ENDPOINT_EMPTY);
        }

        if (!preg_match("|^http://.*$|", $endpoint)) {
            throw new CloudStackClientException(sprintf(ENDPOINT_NOT_URL_MSG, $endpoint), ENDPOINT_NOT_URL);
        }

        /* ensure endpoint does not have a trailing slash */
        $this->endpoint = substr($endpoint, -1) == "/" ? substr($endpoint, 0, -1) : $endpoint;

        /* API key */
        if (empty($apiKey)) {
            throw new CloudStackClientException(APIKEY_EMPTY_MSG, APIKEY_EMPTY);
        }
        $this->apiKey = $apiKey;

        /* API secret */
        if (empty($secretKey)) {
            throw new CloudStackClientException(SECRETKEY_EMPTY_MSG, SECRETKEY_EMPTY);
        }
        $this->secretKey = $secretKey;
    }

    /**
     * Generate API Signature
     * @param  string $queryString CloudStack API query string to sign
     * @return string              Properly formatted CloudStack API signature
     * @throws CloudStackClientException on error
     */
    public function getSignature($queryString) {
        if (empty($queryString)) {
            throw new CloudStackClientException(STRTOSIGN_EMPTY_MSG, STRTOSIGN_EMPTY);
        }

        $hash = @hash_hmac("SHA1", $queryString, $this->secretKey, true);
        return urlencode(base64_encode($hash));
    }

    /**
     * Convert paramaters to strings
     * @param  string $mixed  Value to convert to string
     * @return string|false   String value on success false on error
     */
    public function getStringValue($mixed) {
        switch(gettype($mixed)) {
            case 'boolean':
                if ($mixed === true) {
                    return "true";
                }
                return "false";
            break;
            case 'integer':
            case 'double':
                return strval($mixed);
            break;
            case 'string':
                return $mixed;
            break;
        }
    }

    /**
     * Execute CloudStack API request
     * @param  string $command API command to execute
     * @param  array  $args    Array of comand arguments
     * @return mixed           CloudStack API response
     * @throws CloudStackClientException on error
     */
    public function request($command, array $args = array()) {
        if (empty($command)) {
            throw new CloudStackClientException(NO_COMMAND_MSG, NO_COMMAND);
        }

        if (!is_array($args)) {
            throw new CloudStackClientException(sprintf(WRONG_REQUEST_ARGS_MSG, $args), WRONG_REQUEST_ARGS);
        }

        /* init paramaters */
        $params = array();

        /* build paramaters from passed arguments */
        foreach ($args as $key => $value) {
            /* ensure we only add strings */
            $pvalue = $this->getstringvalue($value);
            /* check new value */
            if (!is_string($pvalue)) {
                throw new CloudStackClientException(sprintf(WRONG_ARGUMENT_TYPE_MSG, $key, 'string', gettype($value)), WRONG_ARGUMENT_TYPE);
            }
            /* check length */
            if (strlen($pvalue)) {
                $params[$key] = $pvalue;
            }
        }

        /* merge sanitized paramaters with  */
        $params = array_merge($params, array('apikey' => $this->apiKey, 'command' => $command, 'response' => 'json'));
        ksort($params);
        $query = http_build_query($params, '', '&', PHP_QUERY_RFC3986);
        $query = sprintf("%s&signature=%s", $query, $this->getSignature(strtolower($query)));

        /* Initialize curl */
        $ch = curl_init();
        $curl_opts = array(
            CURLOPT_URL => $this->endpoint,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $query,
            CURLOPT_RETURNTRANSFER => true,
        );
        curl_setopt_array($ch, $curl_opts);

        /* Execute curl to get data and return code */
        $data = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        /* Close curl - free handle */
        curl_close($ch);

        if (empty($data)) {
            throw new CloudStackClientException(NO_DATA_RECEIVED_MSG, NO_DATA_RECEIVED);
        }

        $result = @json_decode($data);
        if (empty($result)) {
            throw new CloudStackClientException(NO_VALID_JSON_RECEIVED_MSG, NO_VALID_JSON_RECEIVED);
        }

        $propertyResponse = sprintf("%sresponse", strtolower($command));

        /* standard presentation of errors */
        if (property_exists($result, "errorresponse") && property_exists($result->errorresponse, "errortext")) {
            throw new CloudStackClientException($result->errorresponse->errortext);
        }

        if (!property_exists($result, $propertyResponse)) {
            /* some commands drop the trailing 's' in the response: listPools becomes 'listpoolresponse' */
            $propertyResponse = sprintf("%sresponse", substr(strtolower($command), 0, -1));
            if (!property_exists($result, $propertyResponse)) {
                throw new CloudStackClientException(sprintf("Unable to parse the response. Got code %d and message: %s", $code, $data));
            }
        }

        $response = $result->{$propertyResponse};

        /* sometimes we get errorcode and errortext inside the command response */
        if (property_exists($response, "errorcode") && property_exists($response, "errortext")) {
            throw new CloudStackClientException($response->errortext);
        }

        /* list handling : most of lists are on the same pattern as listVirtualMachines :
           { "listvirtualmachinesresponse" : { "virtualmachine" : [ ... ] } } */
        preg_match('/list(\w+)s/', strtolower($command), $listMatches);
        if (!empty($listMatches)) {
            $objectName = $listMatches[1];
            if (property_exists($response, $objectName)) {
                $resultArray = $response->{$objectName};
                if (is_array($resultArray)) {
                    return $resultArray;
                }
            } else {
                /* sometimes, the 's' is kept, as in :
                   { "listasyncjobsresponse" : { "asyncjobs" : [ ... ] } } */
                $objectName = sprintf("%ss", $listMatches[1]);
                if (property_exists($response, $objectName)) {
                    $resultArray = $response->{$objectName};
                    if (is_array($resultArray)) {
                        return $resultArray;
                    }
                }
            }
        }

        return $response;
    }
}
