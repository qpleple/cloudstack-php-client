<?php
/**
 * This file is part of the CloudStack PHP Client.
 *
 * (c) Quentin Pleplé <quentin.pleple@gmail.com>
 * (c) Aaron Hurt <ahurt@anbcs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Exception error code
 */
define("ENDPOINT_EMPTY", 1000);

/**
 * Exception error message text
 */
define("ENDPOINT_EMPTY_MSG", "No endpoint provided.");

/**
 * Exception error code
 */
define("ENDPOINT_NOT_URL", 1001);

/**
 * Exception error message text
 */
define("ENDPOINT_NOT_URL_MSG", "The endpoint must be a URL (starting wih http:// or https://). Given: \"%s\"");

/**
 * Exception error code
 */
define("APIKEY_EMPTY", 1002);

/**
 * Exception error message text
 */
define("APIKEY_EMPTY_MSG", "No API key provided.");

/**
 * Exception error code
 */
define("SECRETKEY_EMPTY", 1003);

/**
 * Exception error message text
 */
define("SECRETKEY_EMPTY_MSG", "No secret key provided.");

/**
 * Exception error code
 */
define("STRTOSIGN_EMPTY", 1004);

/**
 * Exception error message text
 */
define("STRTOSIGN_EMPTY_MSG", "String to sign empty.");

/**
 * Exception error code
 */
define("NO_COMMAND", 1005);

/**
 * Exception error message text
 */
define("NO_COMMAND_MSG", "No command given for the request.");

/**
 * Exception error code
 */
define("WRONG_REQUEST_ARGS", 1006);

/**
 * Exception error message text
 */
define("WRONG_REQUEST_ARGS_MSG", "Arguments for the request must be in an array. Given: %s");

/**
 * Exception error code
 */
define("NOT_A_CLOUDSTACK_SERVER", 1006);

/**
 * Exception error message text
 */
define("NOT_A_CLOUDSTACK_SERVER_MSG", "The response is not a CloudStack server response. Check your endpoint. Received: %s");

/**
 * Exception error code
 */
define("NO_VALID_JSON_RECEIVED", 1007);

/**
 * Exception error message text
 */
define("NO_VALID_JSON_RECEIVED_MSG", "The server did not issue a json response.");

/**
 * Exception error code
 */
define("MISSING_ARGUMENT", 1008);

/**
 * Exception error message text
 */
define("MISSING_ARGUMENT_MSG", "Missing argument: %s");

/**
 * Exception error code
 */
define("NO_DATA_RECEIVED", 1009);

/**
 * Exception error message text
 */
define("NO_DATA_RECEIVED_MSG", "The server did not return any data.");

/**
 * Exception error code
 */
define("WRONG_ARGUMENT_TYPE", 1010);

/**
 * Exception error message text
 */
define("WRONG_ARGUMENT_TYPE_MSG", "Wrong argument type for %s - Expected: %s Got: %s");
