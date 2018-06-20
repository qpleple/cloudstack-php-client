CloudStack PHP Client
=====================

PHP client library for the CloudStack API v4.10 ([reference](http://cloudstack.apache.org/api/apidocs-4.9/))

This project was originally forked from the following projects:
  * [qpleple/cloudstack-client-generator](https://github.com/qpleple/cloudstack-client-generator)
  * [qpleple/cloudstack-php-client](https://github.com/qpleple/cloudstack-php-client)

This project combines these two tools into one project.  The code generation is no longer done via scraping of the HTML
 documentation.  We now use the provided ```listApis``` call in the CloudStack API to generate the libraries.

The code generated is tagged for [phpdoc](https://github.com/phpDocumentor/phpDocumentor2).

## Installation

Simply download the latest `php-cs.phar` from the releases page and put it where you'd like.  We recommend adding it to
your path in whatever fashion you prefer.

## Code Generation

### Define a configuration file:

Please see [files/config_prototype.yml](./files/config_prototype.yml) for an example configuration file

### Generate client

```php
php-cs phpcs:generate-client --config="your_config_file.yml" --env="environment in config you wish to generate from"
```

There are 3 directories of files created by this generated process, however you will only directly interact with 3:

- `composer.json` : This will be in the root of the `output_dir`, and should be edited for your specific implementation
- `src/CloudStackClient.php` : This is the class that you will execute all api calls from
- `src/CloudStackConfiguration.php` : This is the configuration class that is required when constructing a Client class

PHP Library Usage
-----------------

### Initialization

```php
    $configuration = new CloudStackConfiguration([
        'api_key'      => '',               // YOUR_API_KEY (required)
        'secret_key'   => '',               // YOUR_SECRET_KEY (required)
        'host'         => 'localhost',      // Your CloudStack host (required)
        'scheme'       => 'http',           // http or https (defaults to http)
        'port'         => 8080,             // api port (defaults to 8080)
        'api_path'     => 'client/api',     // admin api path (defaults to 'client/api')
        'console_path' => 'client/console', // console api path (defaults to 'client/console')
        'http_client'  => null,             // GuzzleHttp\ClientInterface compatible client
    ]);
    
    $client = new CloudStackClient($config);
```

### Lists

```php
    $vms = $client->listVirtualMachines();
    foreach ($vms as $vm) {
        printf("%s : %s %s", $vm->id, $vm->name, $vm->state);
    }
```

### Asynchronous tasks

```php
    $job = $client->deployVirtualMachine(1, 259, 1);
    printf("VM being deployed. Job id = %s", $job->jobid);

    print "All jobs";

    foreach ($client->listAsyncJobs() as $job) {
        printf("%s : %s, status = %s", $job->jobid, $job->cmd, $job->jobstatus);
    }
```

You may also optionally wait for a job to finish:
```php
    $result = $client->waitForAsync($job);
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
     * @param array $optArgs {
     *     @type string $forced Force stop the VM (vm is marked as Stopped even when command fails to be send to the backend).  The caller knows the VM is stopped.
     * }
     * @return \ENA\CloudStack\CloudStackResponse\AsyncJobStartResponse
     */
    public function stopVirtualMachine($id, array $optArgs = []) {
        return $this->doRequest(new CloudStackRequest\StopVirtualMachineRequest(
            $id,
            $optArgs
        ));
    }
```
