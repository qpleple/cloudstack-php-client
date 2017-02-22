CloudStack PHP Client
=====================

PHP client library for the CloudStack API v4.8 ([reference](https://cloudstack.apache.org/docs/api/apidocs-4.8/TOC_User.html))

This project was originally forked from the following projects:
  * [qpleple/cloudstack-client-generator](https://github.com/qpleple/cloudstack-client-generator)
  * [qpleple/cloudstack-php-client](https://github.com/qpleple/cloudstack-php-client)

This project combines these two tools into one project.  The code generation is no longer done via scraping of the HTML
 documentation.  We now use the provided ```listApis``` call in the CloudStack API to generate the libraries.

The code generated can is tagged for [phpdoc](https://github.com/phpDocumentor/phpDocumentor2) and there is an included
 `phpdoc.dist.xml` so generating your own library documentation should be quite simple.

## Code Generation

A quick example:

```php
$generator = new \MyENA\CloudStackClientGenerator\Generator(new \MyENA\CloudStackClientGenerator\Configuration(
    [
        'api_key'    => '',                                 // YOUR_API_KEY (required)
        'secret_key' => '',                                 // YOUR_SECRET_KEY (required)
        'endpoint'   => 'http://localhost:8080/client/api', // Your cloudstack instance address (required)
        'output_dir' => '',                                 // Where you'd like the generated files to go (required)
        'namespace'  => '',                                 // The namespace that will be used in the generated files (optional)
    ]
));

$generator->generate();
```

If you do not specify anything for `output_dir`, all generated files will be placed under [output](./output)

There are 2 directories and 7 files created by this generated process, however you will only directly interact with 3:

- `composer.json` : This will be in the root of the `output_dir`, and should be edited for your specific implementation
- `src/CloudStackClient.php` : This is the class that you will execute all api calls from
- `src/CloudStackConfiguration.php` : This is the configuration class that is required when constructing a Client class

PHP Library Usage
-----------------

###Initialization###

```php
    $configuration = new CloudStackConfiguration([
        'api_key'    => '',                                 // YOUR_API_KEY (required)
        'secret_key' => '',                                 // YOUR_SECRET_KEY (required)
        'endpoint'   => 'http://localhost:8080/client/api', // Your cloudstack instance address (required),
        'http_client' => null,                              // Any http client adapter that supports php-http/httplug
    ]);
    
    $client = new CloudStackClient($config);
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
     *     @type string $forced Force stop the VM (vm is marked as Stopped even when command fails to be send to the backend).  The caller knows the VM is stopped.
     * }
     * @throws \RuntimeException
     * @return \stdClass
     */
    public function stopVirtualMachine($id, array $optArgs = []) {
        if (empty($id)) {
            throw new \RuntimeException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        $req = new CloudStackRequest(
            $this->configuration,
            new CloudStackRequestBody(
                $this->configuration,
                'stopVirtualMachine',
                [
                    'id' => $id
                ] + $optArgs
            )
        );

        return $this->decodeBody($this->doRequest($req), 'stopVirtualMachine');
    }
```
