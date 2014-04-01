CloudStack PHP Client
=====================

PHP client library for the CloudStack User API v4.3 ([reference](https://cloudstack.apache.org/docs/api/apidocs-4.3/TOC_User.html))

Generate with the CloudStack client generator [leprechau/cloudstack-client-generator](https://github.com/leprechau/cloudstack-client-generator),
others languages are available. Check out this project and the parent fork to know more about it.

Examples
--------

Initialization

    $cloudstack = new CloudStackClient(API_ENDPOINT, API_KEY, SECRET_KEY);

Lists

    $vms = $cloudstack->listVirtualMachines();
    foreach ($vms as $vm) {
        echo("{$vm->id} : {$vm->name} {$vm->state}<br>");
    }

Asynchronous tasks

    $job = $cloudstack->deployVirtualMachine(1, 259, 1);
    echo("VM being deployed. Job id = {$job->jobid}<br>");

    echo("All jobs :<br>");
    foreach ($cloudstack->listAsyncJobs() as $job) {
        echo("{$job->jobid} : {$job->cmd}, status = {$job->jobstatus}<br>");
    }
