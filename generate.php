<?php
include('simple_html_dom.php');

$html = file_get_html("http://download.cloud.com/releases/2.2.0/api/TOC_User.html");
$base_url = "http://download.cloud.com/releases/2.2.0/api/";



foreach($html->find('a') as $a) {
    $url = $a->href;
    if ($url == "index.html" || substr($url, 0, 8) == "user/2.2") {
        continue;
    }
    try {
        // Class generation
        $method = extract_method_data($base_url . $url, false);
        echo_method($method);

        // Test generation
        //$method = extract_method_data($base_url . $url, true);
        //echo_test_call($method);
        //
        //echoln();

        // List of params
        //$method = extract_method_data($base_url . $url, false);
        //echo_params_names($method);

    } catch (Exception $e) { }
}

function extract_method_data($url, $test = false) {
    $html = file_get_html($url);
    $method = array(
        'name' => $html->find('h1', 0)->plaintext,
        'description' => $html->find('span', 0)->plaintext
    );
    
    $params_table = $html->find('table', 0);

    foreach($params_table->find('tr') as $tr) {
        if ($tr->find('td', 0)->plaintext != "Parameter Name" && (!$test || $tr->find('td', 2)->plaintext == "true")) {
            $param_name = $tr->find('td', 0)->plaintext;
            $method['params'][$param_name] = array(
                $tr->find('td', 1)->plaintext,
                $tr->find('td', 2)->plaintext
            );
        }
    }
    
    if (substr($method['name'], 0, 4) == "list") {
        $method['params']['page'] = array("Pagination", "false");
    }
    
    return $method;
}

function echo_test_call($method) {
    echoln("// " . $method['description']);
    
    if ($method['params']) {
        echoln("/*");
        echoln("\$res = \$client->{$method['name']}(");
        $count = 0;
        foreach ($method['params'] as $param => $fields) {
            $count++;
            echoln(
                "    \"\""
                . ($count == count($method['params']) ? "  " : ", ")
                . " // \$"
                . camelCase($param)
                . " : {$fields[0]}"
            );
        }
        echoln(");");
        echoln("var_dump(\$res);");
        echoln("*/");
    } else {
        echoln("// \$client->{$method['name']}();");
    }
}

function echo_method($method) {
    echoln("/**");
    echoln(" * " . $method['description']);
    echoln(" *");
    if ($method['params']) {
        foreach ($method['params'] as $param => $fields) {
            echoln(
                " * @param string \$" 
                . camelCase($param)
                . ($fields[0] == "true" ? " (required)" : "")
                . " {$fields[0]}"
            );
        }
    }
    echoln(" */");
    echoln();
    
    echo "public function {$method['name']}(";
    if ($method['params']) {
        $count = 0;
        foreach ($method['params'] as $param => $fields) {
            $count++;
            $default = $param == "page" ? " = \"1\"" : ($fields[1] == "true" ? "" : " = \"\"");
            echo "\$" . camelCase($param) . $default . ($count == count($method['params']) ? "" : ", ");
        }
    }
    echoln(")");
    echoln("{");
    echoln("    \$this->request(\"{$method['name']}\", array(");
    if ($method['params']) {
        $count = 0;
        foreach ($method['params'] as $param => $fields) {
            $count++;
            echoln(
                "       '{$param}' => \$"
                . camelCase($param)
                . ($count == count($method['params']) ? "" : ", ")
            );
        }
    }
    echoln("    ));");
    echoln();
    echoln("}");
}

function echoln($var = "") {
    echo $var . "\n";
}

function echo_params_names($method) {
    if ($method['params']) {
        foreach ($method['params'] as $param => $fields) {
            echoln($param);
        }
    }
}

function camelCase($param){
    $camelCase = array(
        "account" => "account",
        "accounts" => "accounts",
        "accounttype" => "accountType",
        "algorithm" => "algorithm",
        "allocatedonly" => "allocatedOnly",
        "applied" => "applied",
        "availability" => "availability",
        "available" => "available",
        "bits" => "bits",
        "bootable" => "bootable",
        "cidrlist" => "cidrList",
        "description" => "description",
        "destzoneid" => "destzoneId",
        "deviceid" => "deviceId",
        "diskofferingid" => "diskOfferingId",
        "displayname" => "displayName",
        "displaytext" => "displayText",
        "domain" => "domain",
        "domainid" => "domainId",
        "duration" => "duration",
        "enddate" => "endDate",
        "endip" => "endIp",
        "endport" => "endPort",
        "entrytime" => "entryTime",
        "forced" => "forced",
        "format" => "format",
        "forvirtualnetwork" => "forVirtualNetwork",
        "gateway" => "gateway",
        "group" => "group",
        "groupid" => "groupId",
        "guestiptype" => "guestIpType",
        "haenable" => "haEnable",
        "hostid" => "hostId",
        "hypervisor" => "hypervisor",
        "icmpcode" => "icmpCode",
        "icmptype" => "icmpType",
        "id" => "id",
        "ids" => "ids",
        "intervaltype" => "intervalType",
        "ipaddress" => "ipAddress",
        "ipaddressid" => "ipAddressId",
        "iprange" => "ipRange",
        "iscleanuprequired" => "isCleanuPrequired",
        "isdefault" => "isDefault",
        "isextractable" => "isExtractable",
        "isfeatured" => "isFeatured",
        "isofilter" => "isoFilter",
        "ispublic" => "isPublic",
        "isready" => "isReady",
        "isrecursive" => "isRecursive",
        "isshared" => "isShared",
        "issystem" => "isSystem",
        "jobid" => "jobId",
        "keypair" => "keyPair",
        "level" => "level",
        "maxsnaps" => "maxSnaps",
        "mode" => "mode",
        "name" => "name",
        "netmask" => "netmask",
        "networkdomain" => "networkDomain",
        "networkid" => "networkId",
        "networkids" => "networkIds",
        "networkofferingid" => "networkOfferingId",
        "op" => "op",
        "oscategoryid" => "osCategoryId",
        "ostypeid" => "osTypeId",
        "page" => "page",
        "password" => "password",
        "passwordenabled" => "passwordEnabled",
        "podid" => "podId",
        "policyid" => "policyId",
        "privateport" => "privatePort",
        "protocol" => "protocol",
        "publicipid" => "publicIpId",
        "publicport" => "publicPort",
        "requireshvm" => "requireShvm",
        "resourcetype" => "resourceType",
        "schedule" => "schedule",
        "securitygroupid" => "securityGroupId",
        "securitygroupids" => "securityGroupIds",
        "securitygroupname" => "securityGroupName",
        "serviceofferingid" => "serviceOfferingId",
        "size" => "size",
        "snapshotid" => "snapshotId",
        "snapshottype" => "snapshotType",
        "sourcezoneid" => "sourceZoneId",
        "specifyvlan" => "specifyVlan",
        "startdate" => "startDate",
        "startip" => "startIp",
        "startport" => "startPort",
        "state" => "state",
        "templatefilter" => "templateFilter",
        "templateid" => "templateId",
        "timezone" => "timezone",
        "traffictype" => "trafficType",
        "type" => "type",
        "url" => "url",
        "userdata" => "userData",
        "userid" => "userId",
        "username" => "userName",
        "usersecuritygrouplist" => "userSecurityGroupList",
        "virtualmachineid" => "virtualMachineId",
        "virtualmachineids" => "virtualMachineIds",
        "vlan" => "vlan",
        "vlanid" => "vlanId",
        "volumeid" => "volumeId",
        "zoneid" => "zoneId"
    );
    return $camelCase[$param];
}
?>