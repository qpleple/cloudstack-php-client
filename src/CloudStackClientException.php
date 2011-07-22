<?php
/*
 * This file is part of the CloudStack PHP Client.
 *
 * (c) Quentin Pleplé <quentin.pleple@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
define("ENDPOINT_EMPTY", 1000);
define("ENDPOINT_EMPTY_MSG", "No endpoint provided.");

define("ENDPOINT_NOT_URL", 1001);
define("ENDPOINT_NOT_URL_MSG", "The endpoint must be a URL (starting by http://): \"%s\"");

define("APIKEY_EMPTY", 1002);
define("APIKEY_EMPTY_MSG", "No API key provided.");

define("SECRETKEY_EMPTY", 1003);
define("SECRETKEY_EMPTY_MSG", "No secret key provided.");

define("STRTOSIGN_EMPTY", 1004);
define("STRTOSIGN_EMPTY_MSG", "String to sign empty.");

define("NO_COMMAND", 1005);
define("NO_COMMAND_MSG", "No command given for the request.");

define("WRONG_REQUEST_ARGS", 1006);
define("WRONG_REQUEST_ARGS_MSG", "Arguments for the request must be in an array. Given: %s");

define("NOT_A_CLOUDSTACK_SERVER", 1006);
define("NOT_A_CLOUDSTACK_SERVER_MSG", "The response is not a CloudStack server response. Check your endpoint. Received: %s");

define("NO_VALID_JSON_RECEIVED", 1007);
define("NO_VALID_JSON_RECEIVED_MSG", "The server did not issue a json response.");


define("MISSING_ARGUMENT", 1008);
define("MISSING_ARGUMENT_MSG", "Argument missing: %s");

class CloudStackClientException extends Exception { }