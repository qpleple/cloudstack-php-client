<?php

define("ENDPOINT_EMPTY", 1000);
define("ENDPOINT_EMPTY_MSG", "No endpoint provided.");

define("ENDPOINT_NOT_URL", 1001);
define("ENDPOINT_NOT_URL_MSG", "The endpoint must be a URL (starting by http://): \"%s\"");

define("APIKEY_EMPTY", 1002);
define("APIKEY_EMPTY_MSG", "No API key provided.");

define("SECRETKEY_EMPTY", 1003);
define("SECRETKEY_EMPTY_MSG", "No secret key provided.");

class CloudStackClientException extends Exception { }