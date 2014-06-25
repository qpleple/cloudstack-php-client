CloudStack PHP Client
=====================

PHP client library for the CloudStack API v4.3 ([reference](https://cloudstack.apache.org/docs/api/apidocs-4.3/TOC_User.html))

This project was originally forked from the following projects:
  * [qpleple/cloudstack-client-generator](https://github.com/qpleple/cloudstack-client-generator)
  * [qpleple/cloudstack-php-client](https://github.com/qpleple/cloudstack-php-client)

This project combines these two tools into one project.  The code generation is no longer done via scraping of the HTML documentation.  We now use the provided ```listApis``` call in the CloudStack API to generate the libraries.

There is also an enhanced command line testing tool located in `commandline/commandline.php` that can be used to execute CloudStack APIs from the console.

The code generated can is tagged for [phpdoc](https://github.com/phpDocumentor/phpDocumentor2) and there is an included `phpdoc.dist.xml` so generating your own library documentation should be quite simple.

PHP Library Usage
-----------------

###Initialization###

```php
    $cloudstack = new CloudStackClient(API_ENDPOINT, API_KEY, SECRET_KEY);
```

###Lists##

```php
    $vms = $cloudstack->listVirtualMachines();
    foreach ($vms as $vm) {
        printf("%s : %s %s", $vm->id, $vm->name, $vm->state);
    }
```

###Asynchronous tasks###

```php
    $job = $cloudstack->deployVirtualMachine(1, 259, 1);
    printf("VM being deployed. Job id = %s", $job->jobid);

    print "All jobs";

    foreach ($cloudstack->listAsyncJobs() as $job) {
        printf("%s : %s, status = %s", $job->jobid, $job->cmd, $job->jobstatus);
    }
```

Code Generation
---------------

Required arguments are enumerated in the function definition and all optional arguments should be passed as an associative array.

Here is an example of a method generated that has one required (`$id`) and one optional (`$forced`) argument:

```php
    /**
     * Stops a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $forced Force stop the VM (vm is marked as Stopped even when command fails to be send to
     *     the backend).  The caller knows the VM is stopped.
     * }
     */
    public function stopVirtualMachine($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("stopVirtualMachine",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }
```

Basic Usage
-----------

Running the script without any arguments will give you brief usage information:

    $ php generator.php

    Usage :
     * php generate.php methods                     -> list currently available methods and descriptions
     * php generate.php method-data {method_name}   -> parsed data for {method_name}
     * php generate.php method {method_name}        -> generated code for {method_name}
     * php generate.php class                       -> generated code for all the methods in one class


Configuration
-------------

Configuration for the generator and command line application is contained in `config-example.php` and should be modified and copied to `config.php` before attempting to use the commandline or generator.

```php
return array(
    "api_key"    => "",                 // YOUR_API_KEY
    "secret_key" => "",                 // YOUR_SECRET_KEY
    "endpoint"   => "",                 // example: http://YOUR_DOMAIN_NAME/client/api
    "language"   => "php",              // language for api generation (php or python)
    "class_name" => "CloudStackClient"  // the class name for generated code
);
```

Options
-------

### methods ###

This command shows all available methods returned from ```listApis``` including descriptions.

    $ php generator.php methods

    createCondition - Creates a condition
    reconnectHost - Reconnects a host.
    copyTemplate - Copies a template from one zone to another.
    listRouters - List routers.
    listNiciraNvpDeviceNetworks - lists network that are using a nicira nvp device
    addNicToVirtualMachine - Adds VM to specified network by creating a NIC
    extractVolume - Extracts volume
    ~~~ snip ~~~

### method-data ###

This command dumps the raw data parsed from the JSON feed returned from the CloudStack API for a single method.

    $ php generator.php method-data stopVirtualMachine

    array(5) {
      ["name"]=>
      string(18) "stopVirtualMachine"
      ["description"]=>
      string(24) "Stops a virtual machine."
      ["required"]=>
      int(1)
      ["optional"]=>
      int(1)
      ["params"]=>
      array(2) {
        [0]=>
        array(3) {
          ["name"]=>
          string(2) "id"
          ["description"]=>
          string(29) "The ID of the virtual machine"
          ["required"]=>
          bool(true)
        }
        [1]=>
        array(3) {
          ["name"]=>
          string(6) "forced"
          ["description"]=>
          string(131) "Force stop the VM (vm is marked as Stopped even when command fails to be send to the backend).  The caller knows the VM is stopped."
          ["required"]=>
          bool(false)
        }
      }
    }

### method ###

This command displays the generated code for a single method.

    $ php generator.php method stopVirtualMachine

        /**
         * Stops a virtual machine.
         *
         * @param string $id The ID of the virtual machine
         * @param array  $optArgs {
         *     @type string $forced Force stop the VM (vm is marked as Stopped even when command fails to be send to
         *     the backend).  The caller knows the VM is stopped.
         * }
         */
        public function stopVirtualMachine($id, array $optArgs = array()) {
            if (empty($id)) {
                throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
            }
            return $this->request("stopVirtualMachine",
                array_merge(array(
                    'id' => $id
                ), $optArgs)
            );
        }

### class ###

This command will generate code for all methods returned from the CloudStack API.

    $ php generator.php class

    ~~~ snip ~~~
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
     * Pull in base client and exceptoion classes
     */
    require_once dirname(__FILE__) . "/BaseCloudStackClient.php";
    require_once dirname(__FILE__) . "/CloudStackClientException.php";

    /**
     * CloudStackClient class extension of BaseCloudStackClient class
     */
    class CloudStackClient extends BaseCloudStackClient {

    ~~~ snip ~~~

It is usually helpful to redirect the output of the class command to a file.  The included `src/CloudStackClient.php` was generated with:

    php generator.php > ../src/CloudStackClient.php

Notes
-----

This code has been tested and is being used in production with a significant CloudStack implementation and is actively maintained.  Please feel free to share and modify as needed.  Pull requests are always welcome.  Thank you to everyone who has contributed and used this code in the past.
