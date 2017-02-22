<?php
/**
 * Generated Date: 2017-02-21
 * API Version: 4.8.2
 *
 * This file is part of the CloudStack PHP Client.
 *
 * (c) Quentin Pleplé <quentin.pleple@gmail.com>
 * (c) Aaron Hurt <ahurt@anbcs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Pull in base client and exception classes
 */
require_once dirname(__FILE__) . "/BaseCloudStackClient.php";
require_once dirname(__FILE__) . "/CloudStackClientException.php";

/**
 * CloudStackClient class extension of BaseCloudStackClient class
 */
class CloudStackClient extends BaseCloudStackClient {

    /**
     * Lists all network ACL items
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $pagesize the number of entries per page
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $page the page number of the result set
     *     @type string $aclid list network ACL items by ACL ID
     *     @type string $projectid list objects by project
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $keyword List by keyword
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $protocol list network ACL items by protocol
     *     @type string $networkid list network ACL items by network ID
     *     @type string $traffictype list network ACL items by traffic type - ingress or egress
     *     @type string $action list network ACL items by action
     *     @type string $id Lists network ACL Item with the specified ID
     * }
     * @return \stdClass
     */
    public function listNetworkACLs(array $optArgs = []) {
        return $this->request('listNetworkACLs',
            $optArgs
        );
    }

    /**
     * Creates a condition
     *
     * @param string $threshold Threshold value.
     * @param string $relationaloperator Relational Operator to be used with threshold.
     * @param string $counterid ID of the Counter.
     * @param array  $optArgs {
     *     @type string $account the account of the condition. Must be used with the domainId parameter.
     *     @type string $domainid the domain ID of the account.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createCondition($threshold, $relationaloperator, $counterid, array $optArgs = []) {
        if (empty($threshold)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'threshold'), MISSING_ARGUMENT);
        }
        if (empty($relationaloperator)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'relationaloperator'), MISSING_ARGUMENT);
        }
        if (empty($counterid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'counterid'), MISSING_ARGUMENT);
        }
        return $this->request('createCondition',
            [
                'threshold' => $threshold,
                'relationaloperator' => $relationaloperator,
                'counterid' => $counterid
            ] + $optArgs
        );
    }

    /**
     * Reconnects a host.
     *
     * @param string $id the host ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function reconnectHost($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('reconnectHost',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Copies a template from one zone to another.
     *
     * @param string $id Template ID.
     * @param string $destzoneid ID of the zone the template is being copied to.
     * @param array  $optArgs {
     *     @type string $sourcezoneid ID of the zone the template is currently hosted on. If not specified and template is cross-zone, then we will sync this template to region wide image store.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function copyTemplate($id, $destzoneid, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($destzoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'destzoneid'), MISSING_ARGUMENT);
        }
        return $this->request('copyTemplate',
            [
                'id' => $id,
                'destzoneid' => $destzoneid
            ] + $optArgs
        );
    }

    /**
     * List routers.
     *
     * @param array  $optArgs {
     *     @type string $forvpc if true is passed for this parameter, list only VPC routers
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $id the ID of the disk router
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $version list virtual router elements by version
     *     @type string $podid the Pod ID of the router
     *     @type string $vpcid List networks by VPC
     *     @type string $hostid the host ID of the router
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $projectid list objects by project
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $name the name of the router
     *     @type string $networkid list by network id
     *     @type string $zoneid the Zone ID of the router
     *     @type string $pagesize the number of entries per page
     *     @type string $state the state of the router
     *     @type string $clusterid the cluster ID of the router
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     * }
     * @return \stdClass
     */
    public function listRouters(array $optArgs = []) {
        return $this->request('listRouters',
            $optArgs
        );
    }

    /**
     * lists network that are using a nicira nvp device
     *
     * @param string $nvpdeviceid nicira nvp device ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listNiciraNvpDeviceNetworks($nvpdeviceid, array $optArgs = []) {
        if (empty($nvpdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'nvpdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('listNiciraNvpDeviceNetworks',
            [
                'nvpdeviceid' => $nvpdeviceid
            ] + $optArgs
        );
    }

    /**
     * Adds VM to specified network by creating a NIC
     *
     * @param string $virtualmachineid Virtual Machine ID
     * @param string $networkid Network ID
     * @param array  $optArgs {
     *     @type string $ipaddress IP Address for the new network
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addNicToVirtualMachine($virtualmachineid, $networkid, array $optArgs = []) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        if (empty($networkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'networkid'), MISSING_ARGUMENT);
        }
        return $this->request('addNicToVirtualMachine',
            [
                'virtualmachineid' => $virtualmachineid,
                'networkid' => $networkid
            ] + $optArgs
        );
    }

    /**
     * Extracts volume
     *
     * @param string $id the ID of the volume
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param string $zoneid the ID of the zone where the volume is located
     * @param array  $optArgs {
     *     @type string $url the url to which the volume would be extracted
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function extractVolume($id, $mode, $zoneid, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'mode'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('extractVolume',
            [
                'id' => $id,
                'mode' => $mode,
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * Lists Cisco ASA 1000v appliances
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $resourceid Cisco ASA 1000v resource ID
     *     @type string $physicalnetworkid the Physical Network ID
     *     @type string $hostname Hostname or ip address of the Cisco ASA 1000v appliance.
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listCiscoAsa1000vResources(array $optArgs = []) {
        return $this->request('listCiscoAsa1000vResources',
            $optArgs
        );
    }

    /**
     * Lists network serviceproviders for a given physical network.
     *
     * @param array  $optArgs {
     *     @type string $state list providers by state
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $physicalnetworkid the Physical Network ID
     *     @type string $pagesize the number of entries per page
     *     @type string $name list providers by name
     * }
     * @return \stdClass
     */
    public function listNetworkServiceProviders(array $optArgs = []) {
        return $this->request('listNetworkServiceProviders',
            $optArgs
        );
    }

    /**
     * Adds account to a project
     *
     * @param string $projectid ID of the project to add the account to
     * @param array  $optArgs {
     *     @type string $email email to which invitation to the project is going to be sent
     *     @type string $account name of the account to be added to the project
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addAccountToProject($projectid, array $optArgs = []) {
        if (empty($projectid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'projectid'), MISSING_ARGUMENT);
        }
        return $this->request('addAccountToProject',
            [
                'projectid' => $projectid
            ] + $optArgs
        );
    }

    /**
     * delete a Cisco Nexus VSM device
     *
     * @param string $id Id of the Cisco Nexus 1000v VSM device to be deleted
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteCiscoNexusVSM($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteCiscoNexusVSM',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes an egress firewall rule
     *
     * @param string $id the ID of the firewall rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteEgressFirewallRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteEgressFirewallRule',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists all available Internal Load Balancer elements.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $enabled list internal load balancer elements by enabled state
     *     @type string $id list internal load balancer elements by id
     *     @type string $keyword List by keyword
     *     @type string $nspid list internal load balancer elements by network service provider id
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listInternalLoadBalancerElements(array $optArgs = []) {
        return $this->request('listInternalLoadBalancerElements',
            $optArgs
        );
    }

    /**
     * Adds a new cluster
     *
     * @param string $hypervisor hypervisor type of the cluster: XenServer,KVM,VMware,Hyperv,BareMetal,Simulator,Ovm3
     * @param string $clustername the cluster name
     * @param string $clustertype type of the cluster: CloudManaged, ExternalManaged
     * @param string $zoneid the Zone ID for the cluster
     * @param string $podid the Pod ID for the host
     * @param array  $optArgs {
     *     @type string $ovm3cluster Ovm3 native OCFS2 clustering enabled for cluster
     *     @type string $url the URL
     *     @type string $ovm3vip Ovm3 vip to use for pool (and cluster)
     *     @type string $vsmusername the username for the VSM associated with this cluster
     *     @type string $publicvswitchtype Type of virtual switch used for public traffic in the cluster. Allowed values are, vmwaresvs (for VMware standard vSwitch) and vmwaredvs (for VMware distributed vSwitch)
     *     @type string $vsmpassword the password for the VSM associated with this cluster
     *     @type string $allocationstate Allocation state of this cluster for allocation of new resources
     *     @type string $guestvswitchtype Type of virtual switch used for guest traffic in the cluster. Allowed values are, vmwaresvs (for VMware standard vSwitch) and vmwaredvs (for VMware distributed vSwitch)
     *     @type string $vsmipaddress the ipaddress of the VSM associated with this cluster
     *     @type string $ovm3pool Ovm3 native pooling enabled for cluster
     *     @type string $publicvswitchname Name of virtual switch used for public traffic in the cluster.  This would override zone wide traffic label setting.
     *     @type string $username the username for the cluster
     *     @type string $guestvswitchname Name of virtual switch used for guest traffic in the cluster. This would override zone wide traffic label setting.
     *     @type string $password the password for the host
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addCluster($hypervisor, $clustername, $clustertype, $zoneid, $podid, array $optArgs = []) {
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hypervisor'), MISSING_ARGUMENT);
        }
        if (empty($clustername)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'clustername'), MISSING_ARGUMENT);
        }
        if (empty($clustertype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'clustertype'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'podid'), MISSING_ARGUMENT);
        }
        return $this->request('addCluster',
            [
                'hypervisor' => $hypervisor,
                'clustername' => $clustername,
                'clustertype' => $clustertype,
                'zoneid' => $zoneid,
                'podid' => $podid
            ] + $optArgs
        );
    }

    /**
     * Lists all available network offerings.
     *
     * @param array  $optArgs {
     *     @type string $id list network offerings by ID
     *     @type string $istagged true if offering has tags specified
     *     @type string $name list network offerings by name
     *     @type string $networkid the ID of the network. Pass this in if you want to see the available network offering that a network can be changed to.
     *     @type string $supportedservices list network offerings supporting certain services
     *     @type string $availability the availability of network offering. Default value is required
     *     @type string $displaytext list network offerings by display text
     *     @type string $tags list network offerings by tags
     *     @type string $forvpc the network offering can be used only for network creation inside the VPC
     *     @type string $guestiptype list network offerings by guest type: shared or isolated
     *     @type string $specifyvlan the tags for the network offering.
     *     @type string $isdefault true if need to list only default network offerings. Default value is false
     *     @type string $state list network offerings by state
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $sourcenatsupported true if need to list only netwok offerings where source NAT is supported, false otherwise
     *     @type string $traffictype list by traffic type
     *     @type string $zoneid list network offerings available for network creation in specific zone
     *     @type string $page the page number of the result set
     *     @type string $specifyipranges true if need to list only network offerings which support specifying ip ranges
     * }
     * @return \stdClass
     */
    public function listNetworkOfferings(array $optArgs = []) {
        return $this->request('listNetworkOfferings',
            $optArgs
        );
    }

    /**
     * Lists Cisco VNMC controllers
     *
     * @param array  $optArgs {
     *     @type string $resourceid Cisco VNMC resource ID
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     * @return \stdClass
     */
    public function listCiscoVnmcResources(array $optArgs = []) {
        return $this->request('listCiscoVnmcResources',
            $optArgs
        );
    }

    /**
     * Upload a data disk to the cloudstack cloud.
     *
     * @param string $format the format for the volume/template. Possible values include QCOW2, OVA, and VHD.
     * @param string $name the name of the volume/template
     * @param string $zoneid the ID of the zone the volume/template is to be hosted on
     * @param array  $optArgs {
     *     @type string $projectid Upload volume/template for the project
     *     @type string $diskofferingid the ID of the disk offering. This must be a custom sized offering since during upload of volume/template size is unknown.
     *     @type string $account an optional accountName. Must be used with domainId.
     *     @type string $checksum the MD5 checksum value of this volume/template
     *     @type string $domainid an optional domainId. If the account parameter is used, domainId must also be used.
     *     @type string $imagestoreuuid Image store uuid
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function getUploadParamsForVolume($format, $name, $zoneid, array $optArgs = []) {
        if (empty($format)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'format'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('getUploadParamsForVolume',
            [
                'format' => $format,
                'name' => $name,
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * List hypervisors
     *
     * @param array  $optArgs {
     *     @type string $zoneid the zone id for listing hypervisors.
     * }
     * @return \stdClass
     */
    public function listHypervisors(array $optArgs = []) {
        return $this->request('listHypervisors',
            $optArgs
        );
    }

    /**
     * Updates a configuration.
     *
     * @param string $name the name of the configuration
     * @param array  $optArgs {
     *     @type string $accountid the ID of the Account to update the parameter value for corresponding account
     *     @type string $zoneid the ID of the Zone to update the parameter value for corresponding zone
     *     @type string $clusterid the ID of the Cluster to update the parameter value for corresponding cluster
     *     @type string $storageid the ID of the Storage pool to update the parameter value for corresponding storage pool
     *     @type string $value the value of the configuration
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateConfiguration($name, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('updateConfiguration',
            [
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Create site to site vpn connection
     *
     * @param string $s2svpngatewayid id of the vpn gateway
     * @param string $s2scustomergatewayid id of the customer gateway
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the vpn to the end user or not
     *     @type string $passive connection is passive or not
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createVpnConnection($s2svpngatewayid, $s2scustomergatewayid, array $optArgs = []) {
        if (empty($s2svpngatewayid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 's2svpngatewayid'), MISSING_ARGUMENT);
        }
        if (empty($s2scustomergatewayid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 's2scustomergatewayid'), MISSING_ARGUMENT);
        }
        return $this->request('createVpnConnection',
            [
                's2svpngatewayid' => $s2svpngatewayid,
                's2scustomergatewayid' => $s2scustomergatewayid
            ] + $optArgs
        );
    }

    /**
     * Lists all volumes.
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $hostid list volumes on specified host
     *     @type string $keyword List by keyword
     *     @type string $podid the pod id the disk volume belongs to
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $pagesize the number of entries per page
     *     @type string $type the type of disk volume
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $projectid list objects by project
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $storageid the ID of the storage pool, available to ROOT admin only
     *     @type string $name the name of the disk volume
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $displayvolume list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $zoneid the ID of the availability zone
     *     @type string $diskofferingid list volumes by disk offering
     *     @type string $page the page number of the result set
     *     @type string $id the ID of the disk volume
     *     @type string $virtualmachineid the ID of the virtual machine
     * }
     * @return \stdClass
     */
    public function listVolumes(array $optArgs = []) {
        return $this->request('listVolumes',
            $optArgs
        );
    }

    /**
     * Suspends a project
     *
     * @param string $id id of the project to be suspended
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function suspendProject($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('suspendProject',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes a load balancer
     *
     * @param string $id the ID of the Load Balancer
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteLoadBalancer($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteLoadBalancer',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Authorizes a particular ingress rule for this security group
     *
     * @param array  $optArgs {
     *     @type string $cidrlist the cidr list associated
     *     @type string $securitygroupid The ID of the security group. Mutually exclusive with securityGroupName parameter
     *     @type string $usersecuritygrouplist user to security group mapping
     *     @type string $securitygroupname The name of the security group. Mutually exclusive with securityGroupId parameter
     *     @type string $icmpcode error code for this icmp message
     *     @type string $account an optional account for the security group. Must be used with domainId.
     *     @type string $icmptype type of the icmp message being sent
     *     @type string $protocol TCP is default. UDP is the other supported protocol
     *     @type string $endport end port for this ingress rule
     *     @type string $startport start port for this ingress rule
     *     @type string $projectid an optional project of the security group
     *     @type string $domainid an optional domainId for the security group. If the account parameter is used, domainId must also be used.
     * }
     * @return \stdClass
     */
    public function authorizeSecurityGroupIngress(array $optArgs = []) {
        return $this->request('authorizeSecurityGroupIngress',
            $optArgs
        );
    }

    /**
     * Lists load balancers
     *
     * @param array  $optArgs {
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $sourceipaddress the source IP address of the load balancer
     *     @type string $keyword List by keyword
     *     @type string $id the ID of the load balancer
     *     @type string $name the name of the load balancer
     *     @type string $networkid the network ID of the load balancer
     *     @type string $sourceipaddressnetworkid the network ID of the source IP address
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $scheme the scheme of the load balancer. Supported value is internal in the current release
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $projectid list objects by project
     * }
     * @return \stdClass
     */
    public function listLoadBalancers(array $optArgs = []) {
        return $this->request('listLoadBalancers',
            $optArgs
        );
    }

    /**
     * Lists implementors of implementor of a network traffic type or implementors of all network traffic types
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $traffictype Optional. The network traffic type, if specified, return its implementor. Otherwise, return all traffic types with their implementor
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listTrafficTypeImplementors(array $optArgs = []) {
        return $this->request('listTrafficTypeImplementors',
            $optArgs
        );
    }

    /**
     * Adds a netscaler load balancer device
     *
     * @param string $username Credentials to reach netscaler load balancer device
     * @param string $networkdevicetype Netscaler device type supports NetscalerMPXLoadBalancer, NetscalerVPXLoadBalancer, NetscalerSDXLoadBalancer
     * @param string $url URL of the netscaler load balancer appliance.
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $password Credentials to reach netscaler load balancer device
     * @param array  $optArgs {
     *     @type string $gslbproviderpublicip public IP of the site
     *     @type string $isexclusivegslbprovider true if NetScaler device being added is for providing GSLB service exclusively and can not be used for LB
     *     @type string $gslbproviderprivateip public IP of the site
     *     @type string $gslbprovider true if NetScaler device being added is for providing GSLB service
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addNetscalerLoadBalancer($username, $networkdevicetype, $url, $physicalnetworkid, $password, array $optArgs = []) {
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($networkdevicetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'networkdevicetype'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        return $this->request('addNetscalerLoadBalancer',
            [
                'username' => $username,
                'networkdevicetype' => $networkdevicetype,
                'url' => $url,
                'physicalnetworkid' => $physicalnetworkid,
                'password' => $password
            ] + $optArgs
        );
    }

    /**
     * Import LDAP users
     *
     * @param string $accounttype Type of the account.  Specify 0 for user, 1 for root admin, and 2 for domain admin
     * @param array  $optArgs {
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone parameter, see Time Zone Format.
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $accountdetails details for account used to store specific parameters
     *     @type string $group Specifies the group name from which the ldap users are to be imported. If no group is specified, all the users will be imported.
     *     @type string $page the page number of the result set
     *     @type string $domainid Specifies the domain to which the ldap users are to be imported. If no domain is specified, a domain will created using group parameter. If the group is also not specified, a domain name based on the OU information will be created. If no OU hierarchy exists, will be defaulted to ROOT domain
     *     @type string $account Creates the user under the specified account. If no account is specified, the username will be used as the account name.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function importLdapUsers($accounttype, array $optArgs = []) {
        if (empty($accounttype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'accounttype'), MISSING_ARGUMENT);
        }
        return $this->request('importLdapUsers',
            [
                'accounttype' => $accounttype
            ] + $optArgs
        );
    }

    /**
     * lists F5 load balancer devices
     *
     * @param array  $optArgs {
     *     @type string $lbdeviceid f5 load balancer device ID
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     * @return \stdClass
     */
    public function listF5LoadBalancers(array $optArgs = []) {
        return $this->request('listF5LoadBalancers',
            $optArgs
        );
    }

    /**
     * Deletes a specified domain
     *
     * @param string $id ID of domain to delete
     * @param array  $optArgs {
     *     @type string $cleanup true if all domain resources (child domains, accounts) have to be cleaned up, false otherwise
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteDomain($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteDomain',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * adds a range of portable public IP's to a region
     *
     * @param string $startip the beginning IP address in the portable IP range
     * @param string $netmask the netmask of the portable IP range
     * @param string $regionid Id of the Region
     * @param string $gateway the gateway for the portable IP range
     * @param string $endip the ending IP address in the portable IP range
     * @param array  $optArgs {
     *     @type string $vlan VLAN id, if not specified defaulted to untagged
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createPortableIpRange($startip, $netmask, $regionid, $gateway, $endip, array $optArgs = []) {
        if (empty($startip)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'startip'), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'netmask'), MISSING_ARGUMENT);
        }
        if (empty($regionid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'regionid'), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'gateway'), MISSING_ARGUMENT);
        }
        if (empty($endip)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'endip'), MISSING_ARGUMENT);
        }
        return $this->request('createPortableIpRange',
            [
                'startip' => $startip,
                'netmask' => $netmask,
                'regionid' => $regionid,
                'gateway' => $gateway,
                'endip' => $endip
            ] + $optArgs
        );
    }

    /**
     * Adds Traffic Monitor Host for Direct Network Usage
     *
     * @param string $url URL of the traffic monitor Host
     * @param string $zoneid Zone in which to add the external firewall appliance.
     * @param array  $optArgs {
     *     @type string $includezones Traffic going into the listed zones will be metered
     *     @type string $excludezones Traffic going into the listed zones will not be metered
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addTrafficMonitor($url, $zoneid, array $optArgs = []) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('addTrafficMonitor',
            [
                'url' => $url,
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * configures a netscaler load balancer device
     *
     * @param string $lbdeviceid Netscaler load balancer device ID
     * @param array  $optArgs {
     *     @type string $lbdevicededicated true if this netscaler device to dedicated for a account, false if the netscaler device will be shared by multiple accounts
     *     @type string $lbdevicecapacity capacity of the device, Capacity will be interpreted as number of networks device can handle
     *     @type string $inline true if netscaler load balancer is intended to be used in in-line with firewall, false if netscaler load balancer will side-by-side with firewall
     *     @type string $podids Used when NetScaler device is provider of EIP service. This parameter represents the list of pod's, for which there exists a policy based route on datacenter L3 router to route pod's subnet IP to a NetScaler device.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function configureNetscalerLoadBalancer($lbdeviceid, array $optArgs = []) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('configureNetscalerLoadBalancer',
            [
                'lbdeviceid' => $lbdeviceid
            ] + $optArgs
        );
    }

    /**
     * Creates a template of a virtual machine. The virtual machine must be in a STOPPED state. A template created from this command is automatically designated as a private template visible to the account that created it.
     *
     * @param string $ostypeid the ID of the OS Type that best represents the OS of this template.
     * @param string $displaytext the display text of the template. This is usually used for display purposes.
     * @param string $name the name of the template
     * @param array  $optArgs {
     *     @type string $isfeatured true if this template is a featured template, false otherwise
     *     @type string $projectid create template for the project
     *     @type string $bits 32 or 64 bit
     *     @type string $isdynamicallyscalable true if template contains XS/VMWare tools inorder to support dynamic scaling of VM cpu/memory
     *     @type string $virtualmachineid Optional, VM ID. If this presents, it is going to create a baremetal template for VM this ID refers to. This is only for VM whose hypervisor type is BareMetal
     *     @type string $ispublic true if this template is a public template, false otherwise
     *     @type string $volumeid the ID of the disk volume the template is being created from. Either this parameter, or snapshotId has to be passed in
     *     @type string $templatetag the tag for this template.
     *     @type string $passwordenabled true if the template supports the password reset feature; default is false
     *     @type string $url Optional, only for baremetal hypervisor. The directory name where template stored on CIFS server
     *     @type string $details Template details in key/value pairs using format details[i].keyname=keyvalue. Example: details[0].hypervisortoolsversion=xenserver61
     *     @type string $snapshotid the ID of the snapshot the template is being created from. Either this parameter, or volumeId has to be passed in
     *     @type string $requireshvm true if the template requres HVM, false otherwise
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createTemplate($ostypeid, $displaytext, $name, array $optArgs = []) {
        if (empty($ostypeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ostypeid'), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('createTemplate',
            [
                'ostypeid' => $ostypeid,
                'displaytext' => $displaytext,
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * List all virtual machine instances that are assigned to a load balancer rule.
     *
     * @param string $id the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $lbvmips true if load balancer rule VM IP information to be included; default is false
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $applied true if listing all virtual machines currently applied to the load balancer rule; default is true
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listLoadBalancerRuleInstances($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('listLoadBalancerRuleInstances',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Migrate volume
     *
     * @param string $storageid destination storage pool ID to migrate the volume to
     * @param string $volumeid the ID of the volume
     * @param array  $optArgs {
     *     @type string $livemigrate if the volume should be live migrated when it is attached to a running vm
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function migrateVolume($storageid, $volumeid, array $optArgs = []) {
        if (empty($storageid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'storageid'), MISSING_ARGUMENT);
        }
        if (empty($volumeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'volumeid'), MISSING_ARGUMENT);
        }
        return $this->request('migrateVolume',
            [
                'storageid' => $storageid,
                'volumeid' => $volumeid
            ] + $optArgs
        );
    }

    /**
     * Deletes a load balancer health check policy.
     *
     * @param string $id the ID of the load balancer health check policy
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteLBHealthCheckPolicy($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteLBHealthCheckPolicy',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates a physical network
     *
     * @param string $id physical network id
     * @param array  $optArgs {
     *     @type string $tags Tag the physical network
     *     @type string $vlan the VLAN for the physical network
     *     @type string $state Enabled/Disabled
     *     @type string $networkspeed the speed for the physical network[1G/10G]
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updatePhysicalNetwork($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updatePhysicalNetwork',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Deletes a static route
     *
     * @param string $id the ID of the static route
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteStaticRoute($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteStaticRoute',
            [
                'id' => $id
            ]
        );
    }

    /**
     * delete a Palo Alto firewall device
     *
     * @param string $fwdeviceid Palo Alto firewall device ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deletePaloAltoFirewall($fwdeviceid) {
        if (empty($fwdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'fwdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('deletePaloAltoFirewall',
            [
                'fwdeviceid' => $fwdeviceid
            ]
        );
    }

    /**
     * List traffic monitor Hosts.
     *
     * @param string $zoneid zone Id
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listTrafficMonitors($zoneid, array $optArgs = []) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('listTrafficMonitors',
            [
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * Register a public key in a keypair under a certain name
     *
     * @param string $publickey Public key material of the keypair
     * @param string $name Name of the keypair
     * @param array  $optArgs {
     *     @type string $projectid an optional project for the ssh key
     *     @type string $domainid an optional domainId for the ssh key. If the account parameter is used, domainId must also be used.
     *     @type string $account an optional account for the ssh key. Must be used with domainId.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function registerSSHKeyPair($publickey, $name, array $optArgs = []) {
        if (empty($publickey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'publickey'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('registerSSHKeyPair',
            [
                'publickey' => $publickey,
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Migrate current NFS secondary storages to use object store.
     *
     * @param string $provider the image store provider name
     * @param array  $optArgs {
     *     @type string $url the URL for the image store
     *     @type string $details the details for the image store. Example: details[0].key=accesskey&details[0].value=s389ddssaa&details[1].key=secretkey&details[1].value=8dshfsss
     *     @type string $name the name for the image store
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateCloudToUseObjectStore($provider, array $optArgs = []) {
        if (empty($provider)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'provider'), MISSING_ARGUMENT);
        }
        return $this->request('updateCloudToUseObjectStore',
            [
                'provider' => $provider
            ] + $optArgs
        );
    }

    /**
     * Lists autoscale vm groups.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $projectid list objects by project
     *     @type string $lbruleid the ID of the loadbalancer
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $id the ID of the autoscale vm group
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $zoneid the availability zone ID
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $policyid the ID of the policy
     *     @type string $vmprofileid the ID of the profile
     * }
     * @return \stdClass
     */
    public function listAutoScaleVmGroups(array $optArgs = []) {
        return $this->request('listAutoScaleVmGroups',
            $optArgs
        );
    }

    /**
     * Returns an encrypted password for the VM
     *
     * @param string $id The ID of the virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function getVMPassword($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('getVMPassword',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Adds secondary storage.
     *
     * @param string $url the URL for the secondary storage
     * @param array  $optArgs {
     *     @type string $zoneid the Zone ID for the secondary storage
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addSecondaryStorage($url, array $optArgs = []) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        return $this->request('addSecondaryStorage',
            [
                'url' => $url
            ] + $optArgs
        );
    }

    /**
     * Lists vm groups
     *
     * @param array  $optArgs {
     *     @type string $id list instance groups by ID
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $pagesize the number of entries per page
     *     @type string $projectid list objects by project
     *     @type string $name list instance groups by name
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     * }
     * @return \stdClass
     */
    public function listInstanceGroups(array $optArgs = []) {
        return $this->request('listInstanceGroups',
            $optArgs
        );
    }

    /**
     * Creates a network
     *
     * @param string $name the name of the network
     * @param string $zoneid the zone ID for the network
     * @param string $displaytext the display text of the network
     * @param string $networkofferingid the network offering ID
     * @param array  $optArgs {
     *     @type string $physicalnetworkid the physical network ID the network belongs to
     *     @type string $endip the ending IP address in the network IP range. If not specified, will be defaulted to startIP
     *     @type string $endipv6 the ending IPv6 address in the IPv6 network range
     *     @type string $vlan the ID or VID of the network
     *     @type string $projectid an optional project for the SSH key
     *     @type string $displaynetwork an optional field, whether to the display the network to the end user or not.
     *     @type string $gateway the gateway of the network. Required for shared networks and isolated networks when it belongs to VPC
     *     @type string $acltype Access control type; supported values are account and domain. In 3.0 all shared networks should have aclType=Domain, and all isolated networks - Account. Account means that only the account owner can use the network, domain - all accounts in the domain can use the network
     *     @type string $subdomainaccess Defines whether to allow subdomains to use networks dedicated to their parent domain(s). Should be used with aclType=Domain, defaulted to allow.subdomain.network.access global config if not specified
     *     @type string $account account that will own the network
     *     @type string $netmask the netmask of the network. Required for shared networks and isolated networks when it belongs to VPC
     *     @type string $vpcid the VPC network belongs to
     *     @type string $networkdomain network domain
     *     @type string $ip6cidr the CIDR of IPv6 network, must be at least /64
     *     @type string $domainid domain ID of the account owning a network
     *     @type string $isolatedpvlan the isolated private VLAN for this network
     *     @type string $startipv6 the beginning IPv6 address in the IPv6 network range
     *     @type string $aclid Network ACL ID associated for the network
     *     @type string $ip6gateway the gateway of the IPv6 network. Required for Shared networks
     *     @type string $startip the beginning IP address in the network IP range
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createNetwork($name, $zoneid, $displaytext, $networkofferingid, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        if (empty($networkofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'networkofferingid'), MISSING_ARGUMENT);
        }
        return $this->request('createNetwork',
            [
                'name' => $name,
                'zoneid' => $zoneid,
                'displaytext' => $displaytext,
                'networkofferingid' => $networkofferingid
            ] + $optArgs
        );
    }

    /**
     * Lists projects and provides detailed information for listed projects
     *
     * @param array  $optArgs {
     *     @type string $state list projects by state
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $displaytext list projects by display text
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $id list projects by project ID
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $name list projects by name
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $pagesize the number of entries per page
     *     @type string $tags List projects by tags (key/value pairs)
     * }
     * @return \stdClass
     */
    public function listProjects(array $optArgs = []) {
        return $this->request('listProjects',
            $optArgs
        );
    }

    /**
     * Enables an account
     *
     * @param array  $optArgs {
     *     @type string $id Account id
     *     @type string $domainid Enables specified account in this domain.
     *     @type string $account Enables specified account.
     * }
     * @return \stdClass
     */
    public function enableAccount(array $optArgs = []) {
        return $this->request('enableAccount',
            $optArgs
        );
    }

    /**
     * Destroyes a system virtual machine.
     *
     * @param string $id The ID of the system virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function destroySystemVm($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('destroySystemVm',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists all public ip addresses
     *
     * @param array  $optArgs {
     *     @type string $ipaddress lists the specified IP address
     *     @type string $physicalnetworkid lists all public IP addresses by physical network ID
     *     @type string $allocatedonly limits search results to allocated public IP addresses
     *     @type string $keyword List by keyword
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $forloadbalancing list only IPs used for load balancing
     *     @type string $projectid list objects by project
     *     @type string $pagesize the number of entries per page
     *     @type string $isstaticnat list only static NAT IP addresses
     *     @type string $page the page number of the result set
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $forvirtualnetwork the virtual network for the IP address
     *     @type string $vpcid List IPs belonging to the VPC
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $id lists IP address by ID
     *     @type string $state lists all public IP addresses by state
     *     @type string $zoneid lists all public IP addresses by zone ID
     *     @type string $issourcenat list only source NAT IP addresses
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $associatednetworkid lists all public IP addresses associated to the network specified
     *     @type string $vlanid lists all public IP addresses by VLAN ID
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     * }
     * @return \stdClass
     */
    public function listPublicIpAddresses(array $optArgs = []) {
        return $this->request('listPublicIpAddresses',
            $optArgs
        );
    }

    /**
     * Lists all available OS mappings for given hypervisor
     *
     * @param array  $optArgs {
     *     @type string $ostypeid list mapping by Guest OS Type UUID
     *     @type string $id list mapping by its UUID
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $hypervisorversion list Guest OS mapping by hypervisor version. Must be used with hypervisor parameter
     *     @type string $page the page number of the result set
     *     @type string $hypervisor list Guest OS mapping by hypervisor
     * }
     * @return \stdClass
     */
    public function listGuestOsMapping(array $optArgs = []) {
        return $this->request('listGuestOsMapping',
            $optArgs
        );
    }

    /**
     * Updates remote access vpn
     *
     * @param string $id id of the remote access vpn
     * @param array  $optArgs {
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $fordisplay an optional field, whether to the display the vpn to the end user or not
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateRemoteAccessVpn($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateRemoteAccessVpn',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Puts storage pool into maintenance state
     *
     * @param string $id Primary storage ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function enableStorageMaintenance($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('enableStorageMaintenance',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates a load balancer
     *
     * @param string $id the ID of the load balancer
     * @param array  $optArgs {
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateLoadBalancer($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateLoadBalancer',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Removes a load balancer rule association with global load balancer rule
     *
     * @param string $loadbalancerrulelist the list load balancer rules that will be assigned to gloabal load balancer rule
     * @param string $id The ID of the load balancer rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeFromGlobalLoadBalancerRule($loadbalancerrulelist, $id) {
        if (empty($loadbalancerrulelist)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'loadbalancerrulelist'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('removeFromGlobalLoadBalancerRule',
            [
                'loadbalancerrulelist' => $loadbalancerrulelist,
                'id' => $id
            ]
        );
    }

    /**
     * Lists site 2 site vpn gateways
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $page the page number of the result set
     *     @type string $id id of the vpn gateway
     *     @type string $projectid list objects by project
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $vpcid id of vpc
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listVpnGateways(array $optArgs = []) {
        return $this->request('listVpnGateways',
            $optArgs
        );
    }

    /**
     * Get SolidFire Volume's Iscsi Name
     *
     * @param string $volumeid CloudStack Volume UUID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function getSolidFireVolumeIscsiName($volumeid) {
        if (empty($volumeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'volumeid'), MISSING_ARGUMENT);
        }
        return $this->request('getSolidFireVolumeIscsiName',
            [
                'volumeid' => $volumeid
            ]
        );
    }

    /**
     * Lists clusters.
     *
     * @param array  $optArgs {
     *     @type string $showcapacities flag to display the capacity of the clusters
     *     @type string $pagesize the number of entries per page
     *     @type string $id lists clusters by the cluster ID
     *     @type string $page the page number of the result set
     *     @type string $zoneid lists clusters by Zone ID
     *     @type string $podid lists clusters by Pod ID
     *     @type string $managedstate whether this cluster is managed by cloudstack
     *     @type string $allocationstate lists clusters by allocation state
     *     @type string $keyword List by keyword
     *     @type string $name lists clusters by the cluster name
     *     @type string $clustertype lists clusters by cluster type
     *     @type string $hypervisor lists clusters by hypervisor type
     * }
     * @return \stdClass
     */
    public function listClusters(array $optArgs = []) {
        return $this->request('listClusters',
            $optArgs
        );
    }

    /**
     * Lists dedicated pods.
     *
     * @param array  $optArgs {
     *     @type string $affinitygroupid list dedicated pods by affinity group
     *     @type string $domainid the ID of the domain associated with the pod
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $account the name of the account associated with the pod. Must be used with domainId.
     *     @type string $podid the ID of the pod
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listDedicatedPods(array $optArgs = []) {
        return $this->request('listDedicatedPods',
            $optArgs
        );
    }

    /**
     * Stops a router.
     *
     * @param string $id the ID of the router
     * @param array  $optArgs {
     *     @type string $forced Force stop the VM. The caller knows the VM is stopped.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function stopRouter($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('stopRouter',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Attaches a disk volume to a virtual machine.
     *
     * @param string $id the ID of the disk volume
     * @param string $virtualmachineid the ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $deviceid the ID of the device to map the volume to within the guest OS. If no deviceId is passed in, the next available deviceId will be chosen. Possible values for a Linux OS are:* 0 - /dev/xvda* 1 - /dev/xvdb* 2 - /dev/xvdc* 4 - /dev/xvde* 5 - /dev/xvdf* 6 - /dev/xvdg* 7 - /dev/xvdh* 8 - /dev/xvdi* 9 - /dev/xvdj
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function attachVolume($id, $virtualmachineid, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('attachVolume',
            [
                'id' => $id,
                'virtualmachineid' => $virtualmachineid
            ] + $optArgs
        );
    }

    /**
     * Updates VPC offering
     *
     * @param string $id the id of the VPC offering
     * @param array  $optArgs {
     *     @type string $name the name of the VPC offering
     *     @type string $displaytext the display text of the VPC offering
     *     @type string $state update state for the VPC offering; supported states - Enabled/Disabled
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateVPCOffering($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateVPCOffering',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Resets the SSH Key for virtual machine. The virtual machine must be in a "Stopped" state. [async]
     *
     * @param string $id The ID of the virtual machine
     * @param string $keypair name of the ssh key pair used to login to the virtual machine
     * @param array  $optArgs {
     *     @type string $account an optional account for the ssh key. Must be used with domainId.
     *     @type string $projectid an optional project for the ssh key
     *     @type string $domainid an optional domainId for the virtual machine. If the account parameter is used, domainId must also be used.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function resetSSHKeyForVirtualMachine($id, $keypair, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($keypair)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'keypair'), MISSING_ARGUMENT);
        }
        return $this->request('resetSSHKeyForVirtualMachine',
            [
                'id' => $id,
                'keypair' => $keypair
            ] + $optArgs
        );
    }

    /**
     * Adds a Cisco Asa 1000v appliance
     *
     * @param string $hostname Hostname or ip address of the Cisco ASA 1000v appliance.
     * @param string $clusterid the Cluster ID
     * @param string $insideportprofile Nexus port profile associated with inside interface of ASA 1000v
     * @param string $physicalnetworkid the Physical Network ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addCiscoAsa1000vResource($hostname, $clusterid, $insideportprofile, $physicalnetworkid) {
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostname'), MISSING_ARGUMENT);
        }
        if (empty($clusterid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'clusterid'), MISSING_ARGUMENT);
        }
        if (empty($insideportprofile)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'insideportprofile'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        return $this->request('addCiscoAsa1000vResource',
            [
                'hostname' => $hostname,
                'clusterid' => $clusterid,
                'insideportprofile' => $insideportprofile,
                'physicalnetworkid' => $physicalnetworkid
            ]
        );
    }

    /**
     * Lists autoscale policies.
     *
     * @param array  $optArgs {
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $action the action to be executed if all the conditions evaluate to true for the specified duration.
     *     @type string $pagesize the number of entries per page
     *     @type string $vmgroupid the ID of the autoscale vm group
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $id the ID of the autoscale policy
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $conditionid the ID of the condition of the policy
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listAutoScalePolicies(array $optArgs = []) {
        return $this->request('listAutoScalePolicies',
            $optArgs
        );
    }

    /**
     * Issues a Nuage VSP REST API resource request
     *
     * @param string $networkofferingid the network offering id
     * @param string $resource the resource in Nuage VSP
     * @param string $method the Nuage VSP REST API method type
     * @param string $zoneid the Zone ID for the network
     * @param array  $optArgs {
     *     @type string $resourcefilter the resource filter in Nuage VSP
     *     @type string $physicalnetworkid the ID of the physical network in to which Nuage VSP Controller is added
     *     @type string $resourceid the ID of the resource in Nuage VSP
     *     @type string $childresource the child resource in Nuage VSP
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function issueNuageVspResourceRequest($networkofferingid, $resource, $method, $zoneid, array $optArgs = []) {
        if (empty($networkofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'networkofferingid'), MISSING_ARGUMENT);
        }
        if (empty($resource)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resource'), MISSING_ARGUMENT);
        }
        if (empty($method)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'method'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('issueNuageVspResourceRequest',
            [
                'networkofferingid' => $networkofferingid,
                'resource' => $resource,
                'method' => $method,
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * Cleanups VM reservations in the database.
     *
     * @return \stdClass
     */
    public function cleanVMReservations() {
        return $this->request('cleanVMReservations');
    }

    /**
     * Creates an affinity/anti-affinity group
     *
     * @param string $name name of the affinity group
     * @param string $type Type of the affinity group from the available affinity/anti-affinity group types
     * @param array  $optArgs {
     *     @type string $account an account for the affinity group. Must be used with domainId.
     *     @type string $domainid domainId of the account owning the affinity group
     *     @type string $projectid create affinity group for project
     *     @type string $description optional description of the affinity group
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createAffinityGroup($name, $type, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'type'), MISSING_ARGUMENT);
        }
        return $this->request('createAffinityGroup',
            [
                'name' => $name,
                'type' => $type
            ] + $optArgs
        );
    }

    /**
     * Adds F5 external load balancer appliance.
     *
     * @param string $url URL of the external load balancer appliance.
     * @param string $zoneid Zone in which to add the external load balancer appliance.
     * @param string $username Username of the external load balancer appliance.
     * @param string $password Password of the external load balancer appliance.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addExternalLoadBalancer($url, $zoneid, $username, $password) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        return $this->request('addExternalLoadBalancer',
            [
                'url' => $url,
                'zoneid' => $zoneid,
                'username' => $username,
                'password' => $password
            ]
        );
    }

    /**
     * Lists all DeploymentPlanners available.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listDeploymentPlanners(array $optArgs = []) {
        return $this->request('listDeploymentPlanners',
            $optArgs
        );
    }

    /**
     * Lists all alerts.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $id the ID of the alert
     *     @type string $page the page number of the result set
     *     @type string $name list by alert name
     *     @type string $keyword List by keyword
     *     @type string $type list by alert type
     * }
     * @return \stdClass
     */
    public function listAlerts(array $optArgs = []) {
        return $this->request('listAlerts',
            $optArgs
        );
    }

    /**
     * Deleting resource tag(s)
     *
     * @param string $resourceids Delete tags for resource id(s)
     * @param string $resourcetype Delete tag by resource type
     * @param array  $optArgs {
     *     @type string $tags Delete tags matching key/value pairs
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteTags($resourceids, $resourcetype, array $optArgs = []) {
        if (empty($resourceids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourceids'), MISSING_ARGUMENT);
        }
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourcetype'), MISSING_ARGUMENT);
        }
        return $this->request('deleteTags',
            [
                'resourceids' => $resourceids,
                'resourcetype' => $resourcetype
            ] + $optArgs
        );
    }

    /**
     * Deletes a F5 external load balancer appliance added in a zone.
     *
     * @param string $id Id of the external loadbalancer appliance.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteExternalLoadBalancer($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteExternalLoadBalancer',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes account from the project
     *
     * @param string $projectid ID of the project to remove the account from
     * @param string $account name of the account to be removed from the project
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteAccountFromProject($projectid, $account) {
        if (empty($projectid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'projectid'), MISSING_ARGUMENT);
        }
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'account'), MISSING_ARGUMENT);
        }
        return $this->request('deleteAccountFromProject',
            [
                'projectid' => $projectid,
                'account' => $account
            ]
        );
    }

    /**
     * add a baremetal ping pxe server
     *
     * @param string $pingdir Root directory on PING storage server
     * @param string $pxeservertype type of pxe device
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $username Credentials to reach external pxe device
     * @param string $password Credentials to reach external pxe device
     * @param string $tftpdir Tftp root directory of PXE server
     * @param string $pingstorageserverip PING storage server ip
     * @param string $url URL of the external pxe device
     * @param array  $optArgs {
     *     @type string $pingcifsusername Username of PING storage server
     *     @type string $podid Pod Id
     *     @type string $pingcifspassword Password of PING storage server
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addBaremetalPxePingServer($pingdir, $pxeservertype, $physicalnetworkid, $username, $password, $tftpdir, $pingstorageserverip, $url, array $optArgs = []) {
        if (empty($pingdir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'pingdir'), MISSING_ARGUMENT);
        }
        if (empty($pxeservertype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'pxeservertype'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($tftpdir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'tftpdir'), MISSING_ARGUMENT);
        }
        if (empty($pingstorageserverip)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'pingstorageserverip'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        return $this->request('addBaremetalPxePingServer',
            [
                'pingdir' => $pingdir,
                'pxeservertype' => $pxeservertype,
                'physicalnetworkid' => $physicalnetworkid,
                'username' => $username,
                'password' => $password,
                'tftpdir' => $tftpdir,
                'pingstorageserverip' => $pingstorageserverip,
                'url' => $url
            ] + $optArgs
        );
    }

    /**
     * Retrieves a Cisco Nexus 1000v Virtual Switch Manager device associated with a Cluster
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $zoneid Id of the CloudStack cluster in which the Cisco Nexus 1000v VSM appliance.
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $clusterid Id of the CloudStack cluster in which the Cisco Nexus 1000v VSM appliance.
     * }
     * @return \stdClass
     */
    public function listCiscoNexusVSMs(array $optArgs = []) {
        return $this->request('listCiscoNexusVSMs',
            $optArgs
        );
    }

    /**
     * List private gateways
     *
     * @param array  $optArgs {
     *     @type string $state list gateways by state
     *     @type string $keyword List by keyword
     *     @type string $projectid list objects by project
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $pagesize the number of entries per page
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $ipaddress list gateways by ip address
     *     @type string $id list private gateway by id
     *     @type string $vlan list gateways by vlan
     *     @type string $page the page number of the result set
     *     @type string $vpcid list gateways by vpc
     * }
     * @return \stdClass
     */
    public function listPrivateGateways(array $optArgs = []) {
        return $this->request('listPrivateGateways',
            $optArgs
        );
    }

    /**
     * deletes a range of portable public IP's associated with a region
     *
     * @param string $id Id of the portable ip range
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deletePortableIpRange($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deletePortableIpRange',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates a region
     *
     * @param string $id Id of region to update
     * @param array  $optArgs {
     *     @type string $name updates region with this name
     *     @type string $endpoint updates region with this end point
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateRegion($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateRegion',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Update the default Ip of a VM Nic
     *
     * @param string $nicid the ID of the nic to which you want to assign private IP
     * @param array  $optArgs {
     *     @type string $ipaddress Secondary IP Address
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateVmNicIp($nicid, array $optArgs = []) {
        if (empty($nicid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'nicid'), MISSING_ARGUMENT);
        }
        return $this->request('updateVmNicIp',
            [
                'nicid' => $nicid
            ] + $optArgs
        );
    }

    /**
     * Updates the volume.
     *
     * @param array  $optArgs {
     *     @type string $chaininfo The chain info of the volume
     *     @type string $displayvolume an optional field, whether to the display the volume to the end user or not.
     *     @type string $path The path of the volume
     *     @type string $storageid Destination storage pool UUID for the volume
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $state The state of the volume
     *     @type string $id the ID of the disk volume
     * }
     * @return \stdClass
     */
    public function updateVolume(array $optArgs = []) {
        return $this->request('updateVolume',
            $optArgs
        );
    }

    /**
     * List ucs manager
     *
     * @param array  $optArgs {
     *     @type string $zoneid the zone id
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $id the ID of the ucs manager
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listUcsManagers(array $optArgs = []) {
        return $this->request('listUcsManagers',
            $optArgs
        );
    }

    /**
     * Return true if the plugin is enabled
     *
     * @return \stdClass
     */
    public function quotaIsEnabled() {
        return $this->request('quotaIsEnabled');
    }

    /**
     * Lists all available networks.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $specifyipranges true if need to list only networks which support specifying IP ranges
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $displaynetwork list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $pagesize the number of entries per page
     *     @type string $type the type of the network. Supported values are: isolated and shared
     *     @type string $keyword List by keyword
     *     @type string $canusefordeploy list networks available for VM deployment
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $acltype list networks by ACL (access control list) type. Supported values are account and domain
     *     @type string $physicalnetworkid list networks by physical network id
     *     @type string $vpcid List networks by VPC
     *     @type string $traffictype type of the traffic
     *     @type string $projectid list objects by project
     *     @type string $forvpc the network belongs to VPC
     *     @type string $supportedservices list networks supporting certain services
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $restartrequired list networks by restartRequired
     *     @type string $issystem true if network is system, false otherwise
     *     @type string $id list networks by ID
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $zoneid the zone ID of the network
     * }
     * @return \stdClass
     */
    public function listNetworks(array $optArgs = []) {
        return $this->request('listNetworks',
            $optArgs
        );
    }

    /**
     * Uploads a custom certificate for the console proxy VMs to use for SSL. Can be used to upload a single certificate signed by a known CA. Can also be used, through multiple calls, to upload a chain of certificates from CA to the custom certificate itself.
     *
     * @param string $domainsuffix DNS domain suffix that the certificate is granted for.
     * @param string $certificate The certificate to be uploaded.
     * @param array  $optArgs {
     *     @type string $privatekey The private key for the attached certificate.
     *     @type string $name A name / alias for the certificate.
     *     @type string $id An integer providing the location in a chain that the certificate will hold. Usually, this can be left empty. When creating a chain, the top level certificate should have an ID of 1, with each step in the chain incrementing by one. Example, CA with id = 1, Intermediate CA with id = 2, Site certificate with ID = 3
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function uploadCustomCertificate($domainsuffix, $certificate, array $optArgs = []) {
        if (empty($domainsuffix)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainsuffix'), MISSING_ARGUMENT);
        }
        if (empty($certificate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'certificate'), MISSING_ARGUMENT);
        }
        return $this->request('uploadCustomCertificate',
            [
                'domainsuffix' => $domainsuffix,
                'certificate' => $certificate
            ] + $optArgs
        );
    }

    /**
     * Lists image stores.
     *
     * @param array  $optArgs {
     *     @type string $protocol the image store protocol
     *     @type string $name the name of the image store
     *     @type string $zoneid the Zone ID for the image store
     *     @type string $provider the image store provider
     *     @type string $page the page number of the result set
     *     @type string $id the ID of the storage pool
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listImageStores(array $optArgs = []) {
        return $this->request('listImageStores',
            $optArgs
        );
    }

    /**
     * Lists all the system wide capacities.
     *
     * @param array  $optArgs {
     *     @type string $podid lists capacity by the Pod ID
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $sortby Sort the results. Available values: Usage
     *     @type string $zoneid lists capacity by the Zone ID
     *     @type string $pagesize the number of entries per page
     *     @type string $clusterid lists capacity by the Cluster ID
     *     @type string $type lists capacity by type* CAPACITY_TYPE_MEMORY = 0* CAPACITY_TYPE_CPU = 1* CAPACITY_TYPE_STORAGE = 2* CAPACITY_TYPE_STORAGE_ALLOCATED = 3* CAPACITY_TYPE_VIRTUAL_NETWORK_PUBLIC_IP = 4* CAPACITY_TYPE_PRIVATE_IP = 5* CAPACITY_TYPE_SECONDARY_STORAGE = 6* CAPACITY_TYPE_VLAN = 7* CAPACITY_TYPE_DIRECT_ATTACHED_PUBLIC_IP = 8* CAPACITY_TYPE_LOCAL_STORAGE = 9.
     *     @type string $fetchlatest recalculate capacities and fetch the latest
     * }
     * @return \stdClass
     */
    public function listCapacity(array $optArgs = []) {
        return $this->request('listCapacity',
            $optArgs
        );
    }

    /**
     * Creates a profile that contains information about the virtual machine which will be provisioned automatically by autoscale feature.
     *
     * @param string $serviceofferingid the service offering of the auto deployed virtual machine
     * @param string $templateid the template of the auto deployed virtual machine
     * @param string $zoneid availability zone for the auto deployed virtual machine
     * @param array  $optArgs {
     *     @type string $autoscaleuserid the ID of the user used to launch and destroy the VMs
     *     @type string $fordisplay an optional field, whether to the display the profile to the end user or not
     *     @type string $destroyvmgraceperiod the time allowed for existing connections to get closed before a vm is destroyed
     *     @type string $counterparam counterparam list. Example: counterparam[0].name=snmpcommunity&counterparam[0].value=public&counterparam[1].name=snmpport&counterparam[1].value=161
     *     @type string $otherdeployparams parameters other than zoneId/serviceOfferringId/templateId of the auto deployed virtual machine
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createAutoScaleVmProfile($serviceofferingid, $templateid, $zoneid, array $optArgs = []) {
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'serviceofferingid'), MISSING_ARGUMENT);
        }
        if (empty($templateid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'templateid'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('createAutoScaleVmProfile',
            [
                'serviceofferingid' => $serviceofferingid,
                'templateid' => $templateid,
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * Creates a security group
     *
     * @param string $name name of the security group
     * @param array  $optArgs {
     *     @type string $domainid an optional domainId for the security group. If the account parameter is used, domainId must also be used.
     *     @type string $projectid Create security group for project
     *     @type string $description the description of the security group
     *     @type string $account an optional account for the security group. Must be used with domainId.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createSecurityGroup($name, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('createSecurityGroup',
            [
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Releases a dedicated guest vlan range to the system
     *
     * @param string $id the ID of the dedicated guest vlan range
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function releaseDedicatedGuestVlanRange($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('releaseDedicatedGuestVlanRange',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Create a new keypair and returns the private key
     *
     * @param string $name Name of the keypair
     * @param array  $optArgs {
     *     @type string $account an optional account for the ssh key. Must be used with domainId.
     *     @type string $domainid an optional domainId for the ssh key. If the account parameter is used, domainId must also be used.
     *     @type string $projectid an optional project for the ssh key
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createSSHKeyPair($name, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('createSSHKeyPair',
            [
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Cancels host maintenance.
     *
     * @param string $id the host ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function cancelHostMaintenance($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('cancelHostMaintenance',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates a service offering.
     *
     * @param string $id the ID of the service offering to be updated
     * @param array  $optArgs {
     *     @type string $sortkey sort key of the service offering, integer
     *     @type string $displaytext the display text of the service offering to be updated
     *     @type string $name the name of the service offering to be updated
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateServiceOffering($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateServiceOffering',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists all LDAP Users
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $listtype Determines whether all ldap users are returned or just non-cloudstack users
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listLdapUsers(array $optArgs = []) {
        return $this->request('listLdapUsers',
            $optArgs
        );
    }

    /**
     * Release the dedication for host
     *
     * @param string $hostid the ID of the host
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function releaseDedicatedHost($hostid) {
        if (empty($hostid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostid'), MISSING_ARGUMENT);
        }
        return $this->request('releaseDedicatedHost',
            [
                'hostid' => $hostid
            ]
        );
    }

    /**
     * Adds a Nuage VSP device
     *
     * @param string $port the port to communicate to Nuage VSD
     * @param string $physicalnetworkid the ID of the physical network in to which Nuage VSP is added
     * @param string $retrycount the number of retries on failure to communicate to Nuage VSD
     * @param string $retryinterval the time to wait after failure before retrying to communicate to Nuage VSD
     * @param string $apiversion the version of the API to use to communicate to Nuage VSD
     * @param string $hostname the hostname of the Nuage VSD
     * @param string $password the password of CMS user in Nuage VSD
     * @param string $username the user name of the CMS user in Nuage VSD
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addNuageVspDevice($port, $physicalnetworkid, $retrycount, $retryinterval, $apiversion, $hostname, $password, $username) {
        if (empty($port)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'port'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($retrycount)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'retrycount'), MISSING_ARGUMENT);
        }
        if (empty($retryinterval)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'retryinterval'), MISSING_ARGUMENT);
        }
        if (empty($apiversion)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'apiversion'), MISSING_ARGUMENT);
        }
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostname'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        return $this->request('addNuageVspDevice',
            [
                'port' => $port,
                'physicalnetworkid' => $physicalnetworkid,
                'retrycount' => $retrycount,
                'retryinterval' => $retryinterval,
                'apiversion' => $apiversion,
                'hostname' => $hostname,
                'password' => $password,
                'username' => $username
            ]
        );
    }

    /**
     * Updates a storage pool.
     *
     * @param string $id the Id of the storage pool
     * @param array  $optArgs {
     *     @type string $enabled false to disable the pool for allocation of new volumes, true to enable it back.
     *     @type string $capacitybytes bytes CloudStack can provision from this storage pool
     *     @type string $capacityiops IOPS CloudStack can provision from this storage pool
     *     @type string $tags comma-separated list of tags for the storage pool
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateStoragePool($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateStoragePool',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Deletes a storage network IP Range.
     *
     * @param string $id the uuid of the storage network ip range
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteStorageNetworkIpRange($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteStorageNetworkIpRange',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists all available virtual router elements.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $id list virtual router elements by id
     *     @type string $pagesize the number of entries per page
     *     @type string $nspid list virtual router elements by network service provider id
     *     @type string $page the page number of the result set
     *     @type string $enabled list network offerings by enabled state
     * }
     * @return \stdClass
     */
    public function listVirtualRouterElements(array $optArgs = []) {
        return $this->request('listVirtualRouterElements',
            $optArgs
        );
    }

    /**
     * Create an Internal Load Balancer element.
     *
     * @param string $nspid the network service provider ID of the internal load balancer element
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createInternalLoadBalancerElement($nspid) {
        if (empty($nspid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'nspid'), MISSING_ARGUMENT);
        }
        return $this->request('createInternalLoadBalancerElement',
            [
                'nspid' => $nspid
            ]
        );
    }

    /**
     * Deletes a firewall rule
     *
     * @param string $id the ID of the firewall rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteFirewallRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteFirewallRule',
            [
                'id' => $id
            ]
        );
    }

    /**
     * add a baremetal host
     *
     * @param string $hypervisor hypervisor type of the host
     * @param string $password the password for the host
     * @param string $zoneid the Zone ID for the host
     * @param string $username the username for the host
     * @param string $url the host URL
     * @param string $podid the Pod ID for the host
     * @param array  $optArgs {
     *     @type string $ipaddress ip address intentionally allocated to this host after provisioning
     *     @type string $allocationstate Allocation state of this Host for allocation of new resources
     *     @type string $clustername the cluster name for the host
     *     @type string $hosttags list of tags to be added to the host
     *     @type string $clusterid the cluster ID for the host
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addBaremetalHost($hypervisor, $password, $zoneid, $username, $url, $podid, array $optArgs = []) {
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hypervisor'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'podid'), MISSING_ARGUMENT);
        }
        return $this->request('addBaremetalHost',
            [
                'hypervisor' => $hypervisor,
                'password' => $password,
                'zoneid' => $zoneid,
                'username' => $username,
                'url' => $url,
                'podid' => $podid
            ] + $optArgs
        );
    }

    /**
     * delete a nicira nvp device
     *
     * @param string $nvpdeviceid Nicira device ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteNiciraNvpDevice($nvpdeviceid) {
        if (empty($nvpdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'nvpdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteNiciraNvpDevice',
            [
                'nvpdeviceid' => $nvpdeviceid
            ]
        );
    }

    /**
     * Get SolidFire Account ID
     *
     * @param string $storageid Storage Pool UUID
     * @param string $accountid CloudStack Account UUID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function getSolidFireAccountId($storageid, $accountid) {
        if (empty($storageid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'storageid'), MISSING_ARGUMENT);
        }
        if (empty($accountid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'accountid'), MISSING_ARGUMENT);
        }
        return $this->request('getSolidFireAccountId',
            [
                'storageid' => $storageid,
                'accountid' => $accountid
            ]
        );
    }

    /**
     * lists all available apis on the server, provided by the Api Discovery plugin
     *
     * @param array  $optArgs {
     *     @type string $name API name
     * }
     * @return \stdClass
     */
    public function listApis(array $optArgs = []) {
        return $this->request('listApis',
            $optArgs
        );
    }

    /**
     * Deletes a project
     *
     * @param string $id id of the project to be deleted
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteProject($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteProject',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Removes secondary IP from the NIC.
     *
     * @param string $id the ID of the secondary ip address to nic
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeIpFromNic($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('removeIpFromNic',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Update password of a host/pool on management server.
     *
     * @param string $password the new password for the host/cluster
     * @param string $username the username for the host/cluster
     * @param array  $optArgs {
     *     @type string $update_passwd_on_host if the password should also be updated on the hosts
     *     @type string $hostid the host ID
     *     @type string $clusterid the cluster ID
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateHostPassword($password, $username, array $optArgs = []) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        return $this->request('updateHostPassword',
            [
                'password' => $password,
                'username' => $username
            ] + $optArgs
        );
    }

    /**
     * Deletes an IP forwarding rule
     *
     * @param string $id the ID of the forwarding rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteIpForwardingRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteIpForwardingRule',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists BigSwitch BCF Controller devices
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $physicalnetworkid the Physical Network ID
     *     @type string $bcfdeviceid bigswitch BCF controller device ID
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listBigSwitchBcfDevices(array $optArgs = []) {
        return $this->request('listBigSwitchBcfDevices',
            $optArgs
        );
    }

    /**
     * Returns user data associated with the VM
     *
     * @param string $virtualmachineid The ID of the virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function getVirtualMachineUserData($virtualmachineid) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('getVirtualMachineUserData',
            [
                'virtualmachineid' => $virtualmachineid
            ]
        );
    }

    /**
     * Adds Swift.
     *
     * @param string $url the URL for swift
     * @param array  $optArgs {
     *     @type string $username the username for swift
     *     @type string $account the account for swift
     *     @type string $key key for the user for swift
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addSwift($url, array $optArgs = []) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        return $this->request('addSwift',
            [
                'url' => $url
            ] + $optArgs
        );
    }

    /**
     * Creates a global load balancer rule
     *
     * @param string $name name of the load balancer rule
     * @param string $regionid region where the global load balancer is going to be created.
     * @param string $gslbservicetype GSLB service type (tcp, udp, http)
     * @param string $gslbdomainname domain name for the GSLB service.
     * @param array  $optArgs {
     *     @type string $gslbstickysessionmethodname session sticky method (sourceip) if not specified defaults to sourceip
     *     @type string $description the description of the load balancer rule
     *     @type string $gslblbmethod load balancer algorithm (roundrobin, leastconn, proximity) that method is used to distribute traffic across the zones participating in global server load balancing, if not specified defaults to 'round robin'
     *     @type string $account the account associated with the global load balancer. Must be used with the domainId parameter.
     *     @type string $domainid the domain ID associated with the load balancer
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createGlobalLoadBalancerRule($name, $regionid, $gslbservicetype, $gslbdomainname, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($regionid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'regionid'), MISSING_ARGUMENT);
        }
        if (empty($gslbservicetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'gslbservicetype'), MISSING_ARGUMENT);
        }
        if (empty($gslbdomainname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'gslbdomainname'), MISSING_ARGUMENT);
        }
        return $this->request('createGlobalLoadBalancerRule',
            [
                'name' => $name,
                'regionid' => $regionid,
                'gslbservicetype' => $gslbservicetype,
                'gslbdomainname' => $gslbdomainname
            ] + $optArgs
        );
    }

    /**
     * Resizes a volume
     *
     * @param string $id the ID of the disk volume
     * @param array  $optArgs {
     *     @type string $size New volume size in GB
     *     @type string $diskofferingid new disk offering id
     *     @type string $miniops New minimum number of IOPS
     *     @type string $shrinkok Verify OK to Shrink
     *     @type string $maxiops New maximum number of IOPS
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function resizeVolume($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('resizeVolume',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * List registered keypairs
     *
     * @param array  $optArgs {
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $name A key pair name to look for
     *     @type string $projectid list objects by project
     *     @type string $fingerprint A public key fingerprint to look for
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listSSHKeyPairs(array $optArgs = []) {
        return $this->request('listSSHKeyPairs',
            $optArgs
        );
    }

    /**
     * delete a Brocade VCS Switch
     *
     * @param string $vcsdeviceid Brocade Switch ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteBrocadeVcsDevice($vcsdeviceid) {
        if (empty($vcsdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vcsdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteBrocadeVcsDevice',
            [
                'vcsdeviceid' => $vcsdeviceid
            ]
        );
    }

    /**
     * Creates a static route
     *
     * @param string $gatewayid the gateway id we are creating static route for
     * @param string $cidr static route cidr
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createStaticRoute($gatewayid, $cidr) {
        if (empty($gatewayid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'gatewayid'), MISSING_ARGUMENT);
        }
        if (empty($cidr)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'cidr'), MISSING_ARGUMENT);
        }
        return $this->request('createStaticRoute',
            [
                'gatewayid' => $gatewayid,
                'cidr' => $cidr
            ]
        );
    }

    /**
     * Lists Nicira NVP devices
     *
     * @param array  $optArgs {
     *     @type string $nvpdeviceid nicira nvp device ID
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $physicalnetworkid the Physical Network ID
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listNiciraNvpDevices(array $optArgs = []) {
        return $this->request('listNiciraNvpDevices',
            $optArgs
        );
    }

    /**
     * Deletes a global load balancer rule.
     *
     * @param string $id the ID of the global load balancer rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteGlobalLoadBalancerRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteGlobalLoadBalancerRule',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Activates a project
     *
     * @param string $id id of the project to be modified
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function activateProject($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('activateProject',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Get the SF Volume Access Group ID
     *
     * @param string $clusterid Cluster UUID
     * @param string $storageid Storage Pool UUID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function getSolidFireVolumeAccessGroupId($clusterid, $storageid) {
        if (empty($clusterid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'clusterid'), MISSING_ARGUMENT);
        }
        if (empty($storageid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'storageid'), MISSING_ARGUMENT);
        }
        return $this->request('getSolidFireVolumeAccessGroupId',
            [
                'clusterid' => $clusterid,
                'storageid' => $storageid
            ]
        );
    }

    /**
     * Release dedication of zone
     *
     * @param string $zoneid the ID of the Zone
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function releaseDedicatedZone($zoneid) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('releaseDedicatedZone',
            [
                'zoneid' => $zoneid
            ]
        );
    }

    /**
     * Creates snapshot for a vm.
     *
     * @param string $virtualmachineid The ID of the vm
     * @param array  $optArgs {
     *     @type string $name The display name of the snapshot
     *     @type string $quiescevm quiesce vm if true
     *     @type string $description The description of the snapshot
     *     @type string $snapshotmemory snapshot memory if true
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createVMSnapshot($virtualmachineid, array $optArgs = []) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('createVMSnapshot',
            [
                'virtualmachineid' => $virtualmachineid
            ] + $optArgs
        );
    }

    /**
     * Enables static NAT for given IP address
     *
     * @param string $virtualmachineid the ID of the virtual machine for enabling static NAT feature
     * @param string $ipaddressid the public IP address ID for which static NAT feature is being enabled
     * @param array  $optArgs {
     *     @type string $vmguestip VM guest NIC secondary IP address for the port forwarding rule
     *     @type string $networkid The network of the VM the static NAT will be enabled for. Required when public IP address is not associated with any guest network yet (VPC case)
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function enableStaticNat($virtualmachineid, $ipaddressid, array $optArgs = []) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ipaddressid'), MISSING_ARGUMENT);
        }
        return $this->request('enableStaticNat',
            [
                'virtualmachineid' => $virtualmachineid,
                'ipaddressid' => $ipaddressid
            ] + $optArgs
        );
    }

    /**
     * configures a F5 load balancer device
     *
     * @param string $lbdeviceid F5 load balancer device ID
     * @param array  $optArgs {
     *     @type string $lbdevicecapacity capacity of the device, Capacity will be interpreted as number of networks device can handle
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function configureF5LoadBalancer($lbdeviceid, array $optArgs = []) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('configureF5LoadBalancer',
            [
                'lbdeviceid' => $lbdeviceid
            ] + $optArgs
        );
    }

    /**
     * Creates an IP forwarding rule
     *
     * @param string $startport the start port for the rule
     * @param string $protocol the protocol for the rule. Valid values are TCP or UDP.
     * @param string $ipaddressid the public IP address ID of the forwarding rule, already associated via associateIp
     * @param array  $optArgs {
     *     @type string $openfirewall if true, firewall rule for source/end public port is automatically created; if false - firewall rule has to be created explicitly. Has value true by default
     *     @type string $endport the end port for the rule
     *     @type string $cidrlist the CIDR list to forward traffic from
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createIpForwardingRule($startport, $protocol, $ipaddressid, array $optArgs = []) {
        if (empty($startport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'startport'), MISSING_ARGUMENT);
        }
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'protocol'), MISSING_ARGUMENT);
        }
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ipaddressid'), MISSING_ARGUMENT);
        }
        return $this->request('createIpForwardingRule',
            [
                'startport' => $startport,
                'protocol' => $protocol,
                'ipaddressid' => $ipaddressid
            ] + $optArgs
        );
    }

    /**
     * Updates an IP address
     *
     * @param string $id the ID of the public IP address to update
     * @param array  $optArgs {
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $fordisplay an optional field, whether to the display the IP to the end user or not
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateIpAddress($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateIpAddress',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * lists network that are using a brocade vcs switch
     *
     * @param string $vcsdeviceid brocade vcs switch ID
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listBrocadeVcsDeviceNetworks($vcsdeviceid, array $optArgs = []) {
        if (empty($vcsdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vcsdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('listBrocadeVcsDeviceNetworks',
            [
                'vcsdeviceid' => $vcsdeviceid
            ] + $optArgs
        );
    }

    /**
     * Lists storage providers.
     *
     * @param string $type the type of storage provider: either primary or image
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listStorageProviders($type, array $optArgs = []) {
        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'type'), MISSING_ARGUMENT);
        }
        return $this->request('listStorageProviders',
            [
                'type' => $type
            ] + $optArgs
        );
    }

    /**
     * Lists Regions
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $name List Region by region name.
     *     @type string $id List Region by region ID.
     * }
     * @return \stdClass
     */
    public function listRegions(array $optArgs = []) {
        return $this->request('listRegions',
            $optArgs
        );
    }

    /**
     * Updates a disk offering.
     *
     * @param string $id ID of the disk offering
     * @param array  $optArgs {
     *     @type string $displaytext updates alternate display text of the disk offering with this value
     *     @type string $name updates name of the disk offering with this value
     *     @type string $displayoffering an optional field, whether to display the offering to the end user or not.
     *     @type string $sortkey sort key of the disk offering, integer
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateDiskOffering($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateDiskOffering',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists all network ACLs
     *
     * @param array  $optArgs {
     *     @type string $vpcid list network ACLs by VPC ID
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $projectid list objects by project
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $keyword List by keyword
     *     @type string $networkid list network ACLs by network ID
     *     @type string $pagesize the number of entries per page
     *     @type string $name list network ACLs by specified name
     *     @type string $id Lists network ACL with the specified ID.
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listNetworkACLLists(array $optArgs = []) {
        return $this->request('listNetworkACLLists',
            $optArgs
        );
    }

    /**
     * Adds a Palo Alto firewall device
     *
     * @param string $networkdevicetype supports only PaloAltoFirewall
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $url URL of the Palo Alto appliance.
     * @param string $username Credentials to reach Palo Alto firewall device
     * @param string $password Credentials to reach Palo Alto firewall device
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addPaloAltoFirewall($networkdevicetype, $physicalnetworkid, $url, $username, $password) {
        if (empty($networkdevicetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'networkdevicetype'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        return $this->request('addPaloAltoFirewall',
            [
                'networkdevicetype' => $networkdevicetype,
                'physicalnetworkid' => $physicalnetworkid,
                'url' => $url,
                'username' => $username,
                'password' => $password
            ]
        );
    }

    /**
     * List profile in ucs manager
     *
     * @param string $ucsmanagerid the id for the ucs manager
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listUcsProfiles($ucsmanagerid, array $optArgs = []) {
        if (empty($ucsmanagerid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ucsmanagerid'), MISSING_ARGUMENT);
        }
        return $this->request('listUcsProfiles',
            [
                'ucsmanagerid' => $ucsmanagerid
            ] + $optArgs
        );
    }

    /**
     * Recovers a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function recoverVirtualMachine($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('recoverVirtualMachine',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists capabilities
     *
     * @return \stdClass
     */
    public function listCapabilities() {
        return $this->request('listCapabilities');
    }

    /**
     * Release the dedication for cluster
     *
     * @param string $clusterid the ID of the Cluster
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function releaseDedicatedCluster($clusterid) {
        if (empty($clusterid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'clusterid'), MISSING_ARGUMENT);
        }
        return $this->request('releaseDedicatedCluster',
            [
                'clusterid' => $clusterid
            ]
        );
    }

    /**
     * Updates a VPC
     *
     * @param string $id the id of the VPC
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the vpc to the end user or not
     *     @type string $name the name of the VPC
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $displaytext the display text of the VPC
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateVPC($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateVPC',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Starts an existing internal lb vm.
     *
     * @param string $id the ID of the internal lb vm
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function startInternalLoadBalancerVM($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('startInternalLoadBalancerVM',
            [
                'id' => $id
            ]
        );
    }

    /**
     * associate a profile to a blade
     *
     * @param string $profiledn profile dn
     * @param string $bladeid blade id
     * @param string $ucsmanagerid ucs manager id
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function associateUcsProfileToBlade($profiledn, $bladeid, $ucsmanagerid) {
        if (empty($profiledn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'profiledn'), MISSING_ARGUMENT);
        }
        if (empty($bladeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'bladeid'), MISSING_ARGUMENT);
        }
        if (empty($ucsmanagerid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ucsmanagerid'), MISSING_ARGUMENT);
        }
        return $this->request('associateUcsProfileToBlade',
            [
                'profiledn' => $profiledn,
                'bladeid' => $bladeid,
                'ucsmanagerid' => $ucsmanagerid
            ]
        );
    }

    /**
     * Lists project's accounts
     *
     * @param string $projectid ID of the project
     * @param array  $optArgs {
     *     @type string $account list accounts of the project by account name
     *     @type string $role list accounts of the project by role
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listProjectAccounts($projectid, array $optArgs = []) {
        if (empty($projectid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'projectid'), MISSING_ARGUMENT);
        }
        return $this->request('listProjectAccounts',
            [
                'projectid' => $projectid
            ] + $optArgs
        );
    }

    /**
     * Updates an existing autoscale vm profile.
     *
     * @param string $id the ID of the autoscale vm profile
     * @param array  $optArgs {
     *     @type string $destroyvmgraceperiod the time allowed for existing connections to get closed before a vm is destroyed
     *     @type string $counterparam counterparam list. Example: counterparam[0].name=snmpcommunity&counterparam[0].value=public&counterparam[1].name=snmpport&counterparam[1].value=161
     *     @type string $templateid the template of the auto deployed virtual machine
     *     @type string $autoscaleuserid the ID of the user used to launch and destroy the VMs
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $fordisplay an optional field, whether to the display the profile to the end user or not
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateAutoScaleVmProfile($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateAutoScaleVmProfile',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Updates a port forwarding rule. Only the private port and the virtual machine can be updated.
     *
     * @param string $id the ID of the port forwarding rule
     * @param array  $optArgs {
     *     @type string $virtualmachineid the ID of the virtual machine for the port forwarding rule
     *     @type string $vmguestip VM guest nic Secondary ip address for the port forwarding rule
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $privateport the private port of the port forwarding rule
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updatePortForwardingRule($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updatePortForwardingRule',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists dedicated hosts.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $affinitygroupid list dedicated hosts by affinity group
     *     @type string $page the page number of the result set
     *     @type string $hostid the ID of the host
     *     @type string $account the name of the account associated with the host. Must be used with domainId.
     *     @type string $keyword List by keyword
     *     @type string $domainid the ID of the domain associated with the host
     * }
     * @return \stdClass
     */
    public function listDedicatedHosts(array $optArgs = []) {
        return $this->request('listDedicatedHosts',
            $optArgs
        );
    }

    /**
     * Adds a BigSwitch BCF Controller device
     *
     * @param string $hostname Hostname of ip address of the BigSwitch BCF Controller.
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $password Password of the BigSwitch BCF Controller.
     * @param string $nat NAT support of the BigSwitch BCF Controller.
     * @param string $username Username of the BigSwitch BCF Controller.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addBigSwitchBcfDevice($hostname, $physicalnetworkid, $password, $nat, $username) {
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostname'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($nat)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'nat'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        return $this->request('addBigSwitchBcfDevice',
            [
                'hostname' => $hostname,
                'physicalnetworkid' => $physicalnetworkid,
                'password' => $password,
                'nat' => $nat,
                'username' => $username
            ]
        );
    }

    /**
     * Lists all port forwarding rules for an IP address.
     *
     * @param array  $optArgs {
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $page the page number of the result set
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $ipaddressid the ID of IP address of the port forwarding services
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $projectid list objects by project
     *     @type string $networkid list port forwarding rules for certain network
     *     @type string $pagesize the number of entries per page
     *     @type string $id Lists rule with the specified ID.
     * }
     * @return \stdClass
     */
    public function listPortForwardingRules(array $optArgs = []) {
        return $this->request('listPortForwardingRules',
            $optArgs
        );
    }

    /**
     * List template visibility and all accounts that have permissions to view this template.
     *
     * @param string $id the template ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listTemplatePermissions($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('listTemplatePermissions',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Creates a Storage network IP range.
     *
     * @param string $netmask the netmask for storage network
     * @param string $gateway the gateway for storage network
     * @param string $startip the beginning IP address
     * @param string $podid UUID of pod where the ip range belongs to
     * @param array  $optArgs {
     *     @type string $vlan Optional. The vlan the ip range sits on, default to Null when it is not specificed which means you network is not on any Vlan. This is mainly for Vmware as other hypervisors can directly reterive bridge from pyhsical network traffic type table
     *     @type string $endip the ending IP address
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createStorageNetworkIpRange($netmask, $gateway, $startip, $podid, array $optArgs = []) {
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'netmask'), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'gateway'), MISSING_ARGUMENT);
        }
        if (empty($startip)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'startip'), MISSING_ARGUMENT);
        }
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'podid'), MISSING_ARGUMENT);
        }
        return $this->request('createStorageNetworkIpRange',
            [
                'netmask' => $netmask,
                'gateway' => $gateway,
                'startip' => $startip,
                'podid' => $podid
            ] + $optArgs
        );
    }

    /**
     * Upload a certificate to CloudStack
     *
     * @param string $privatekey Private key
     * @param string $certificate SSL certificate
     * @param array  $optArgs {
     *     @type string $account account that will own the SSL certificate
     *     @type string $projectid an optional project for the SSL certificate
     *     @type string $password Password for the private key
     *     @type string $certchain Certificate chain of trust
     *     @type string $domainid domain ID of the account owning the SSL certificate
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function uploadSslCert($privatekey, $certificate, array $optArgs = []) {
        if (empty($privatekey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'privatekey'), MISSING_ARGUMENT);
        }
        if (empty($certificate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'certificate'), MISSING_ARGUMENT);
        }
        return $this->request('uploadSslCert',
            [
                'privatekey' => $privatekey,
                'certificate' => $certificate
            ] + $optArgs
        );
    }

    /**
     * Adds the GloboDNS external host
     *
     * @param string $password Password for GloboDNS
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $url GloboDNS url
     * @param string $username Username for GloboDNS
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addGloboDnsHost($password, $physicalnetworkid, $url, $username) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        return $this->request('addGloboDnsHost',
            [
                'password' => $password,
                'physicalnetworkid' => $physicalnetworkid,
                'url' => $url,
                'username' => $username
            ]
        );
    }

    /**
     * Retrieves the current status of asynchronous job.
     *
     * @param string $jobid the ID of the asychronous job
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function queryAsyncJobResult($jobid) {
        if (empty($jobid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'jobid'), MISSING_ARGUMENT);
        }
        return $this->request('queryAsyncJobResult',
            [
                'jobid' => $jobid
            ]
        );
    }

    /**
     * Creates a load balancer
     *
     * @param string $instanceport the TCP port of the virtual machine where the network traffic will be load balanced to
     * @param string $scheme the load balancer scheme. Supported value in this release is Internal
     * @param string $sourceipaddressnetworkid the network id of the source ip address
     * @param string $name name of the load balancer
     * @param string $networkid The guest network the load balancer will be created for
     * @param string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     * @param string $sourceport the source port the network traffic will be load balanced from
     * @param array  $optArgs {
     *     @type string $description the description of the load balancer
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $sourceipaddress the source IP address the network traffic will be load balanced from
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createLoadBalancer($instanceport, $scheme, $sourceipaddressnetworkid, $name, $networkid, $algorithm, $sourceport, array $optArgs = []) {
        if (empty($instanceport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'instanceport'), MISSING_ARGUMENT);
        }
        if (empty($scheme)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'scheme'), MISSING_ARGUMENT);
        }
        if (empty($sourceipaddressnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'sourceipaddressnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($networkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'networkid'), MISSING_ARGUMENT);
        }
        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'algorithm'), MISSING_ARGUMENT);
        }
        if (empty($sourceport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'sourceport'), MISSING_ARGUMENT);
        }
        return $this->request('createLoadBalancer',
            [
                'instanceport' => $instanceport,
                'scheme' => $scheme,
                'sourceipaddressnetworkid' => $sourceipaddressnetworkid,
                'name' => $name,
                'networkid' => $networkid,
                'algorithm' => $algorithm,
                'sourceport' => $sourceport
            ] + $optArgs
        );
    }

    /**
     * Cancels maintenance for primary storage
     *
     * @param string $id the primary storage ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function cancelStorageMaintenance($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('cancelStorageMaintenance',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Remove a VMware datacenter from a zone.
     *
     * @param string $zoneid The id of Zone from which VMware datacenter has to be removed.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeVmwareDc($zoneid) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('removeVmwareDc',
            [
                'zoneid' => $zoneid
            ]
        );
    }

    /**
     * Creates and automatically starts a virtual machine based on a service offering, disk offering, and template.
     *
     * @param string $templateid the ID of the template for the virtual machine
     * @param string $zoneid availability zone for the virtual machine
     * @param string $serviceofferingid the ID of the service offering for the virtual machine
     * @param array  $optArgs {
     *     @type string $diskofferingid the ID of the disk offering for the virtual machine. If the template is of ISO format, the diskOfferingId is for the root disk volume. Otherwise this parameter is used to indicate the offering for the data disk volume. If the templateId parameter passed is from a Template object, the diskOfferingId refers to a DATA Disk Volume created. If the templateId parameter passed is from an ISO object, the diskOfferingId refers to a ROOT Disk Volume created.
     *     @type string $displayname an optional user generated name for the virtual machine
     *     @type string $projectid Deploy vm for the project
     *     @type string $affinitygroupids comma separated list of affinity groups id that are going to be applied to the virtual machine. Mutually exclusive with affinitygroupnames parameter
     *     @type string $deploymentplanner Deployment planner to use for vm allocation. Available to ROOT admin only
     *     @type string $domainid an optional domainId for the virtual machine. If the account parameter is used, domainId must also be used.
     *     @type string $startvm true if start vm after creating; defaulted to true if not specified
     *     @type string $iptonetworklist ip to network mapping. Can't be specified with networkIds parameter. Example: iptonetworklist[0].ip=10.10.10.11&iptonetworklist[0].ipv6=fc00:1234:5678::abcd&iptonetworklist[0].networkid=uuid - requests to use ip 10.10.10.11 in network id=uuid
     *     @type string $keyboard an optional keyboard device type for the virtual machine. valid value can be one of de,de-ch,es,fi,fr,fr-be,fr-ch,is,it,jp,nl-be,no,pt,uk,us
     *     @type string $displayvm an optional field, whether to the display the vm to the end user or not.
     *     @type string $name host name for the virtual machine
     *     @type string $hypervisor the hypervisor on which to deploy the virtual machine. The parameter is required and respected only when hypervisor info is not set on the ISO/Template passed to the call
     *     @type string $ipaddress the ip address for default vm's network
     *     @type string $hostid destination Host ID to deploy the VM to - parameter available for root admin only
     *     @type string $networkids list of network ids used by virtual machine. Can't be specified with ipToNetworkList parameter
     *     @type string $ip6address the ipv6 address for default vm's network
     *     @type string $securitygroupids comma separated list of security groups id that going to be applied to the virtual machine. Should be passed only when vm is created from a zone with Basic Network support. Mutually exclusive with securitygroupnames parameter
     *     @type string $details used to specify the custom parameters.
     *     @type string $rootdisksize Optional field to resize root disk on deploy. Value is in GB. Only applies to template-based deployments. Analogous to details[0].rootdisksize, which takes precedence over this parameter if both are provided
     *     @type string $userdata an optional binary data that can be sent to the virtual machine upon a successful deployment. This binary data must be base64 encoded before adding it to the request. Using HTTP GET (via querystring), you can send up to 2KB of data after base64 encoding. Using HTTP POST(via POST body), you can send up to 32K of data after base64 encoding.
     *     @type string $group an optional group for the virtual machine
     *     @type string $affinitygroupnames comma separated list of affinity groups names that are going to be applied to the virtual machine.Mutually exclusive with affinitygroupids parameter
     *     @type string $size the arbitrary size for the DATADISK volume. Mutually exclusive with diskOfferingId
     *     @type string $keypair name of the ssh key pair used to login to the virtual machine
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $account an optional account for the virtual machine. Must be used with domainId.
     *     @type string $securitygroupnames comma separated list of security groups names that going to be applied to the virtual machine. Should be passed only when vm is created from a zone with Basic Network support. Mutually exclusive with securitygroupids parameter
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deployVirtualMachine($templateid, $zoneid, $serviceofferingid, array $optArgs = []) {
        if (empty($templateid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'templateid'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'serviceofferingid'), MISSING_ARGUMENT);
        }
        return $this->request('deployVirtualMachine',
            [
                'templateid' => $templateid,
                'zoneid' => $zoneid,
                'serviceofferingid' => $serviceofferingid
            ] + $optArgs
        );
    }

    /**
     * Deletes a Pod.
     *
     * @param string $id the ID of the Pod
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deletePod($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deletePod',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes a particular egress rule from this security group
     *
     * @param string $id The ID of the egress rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function revokeSecurityGroupEgress($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('revokeSecurityGroupEgress',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Removes a condition
     *
     * @param string $id the ID of the condition.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteCondition($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteCondition',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Creates a network ACL for the given VPC
     *
     * @param string $vpcid ID of the VPC associated with this network ACL list
     * @param string $name Name of the network ACL list
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the list to the end user or not
     *     @type string $description Description of the network ACL list
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createNetworkACLList($vpcid, $name, array $optArgs = []) {
        if (empty($vpcid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vpcid'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('createNetworkACLList',
            [
                'vpcid' => $vpcid,
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Creates a port forwarding rule
     *
     * @param string $publicport the starting port of port forwarding rule's public port range
     * @param string $protocol the protocol for the port forwarding rule. Valid values are TCP or UDP.
     * @param string $virtualmachineid the ID of the virtual machine for the port forwarding rule
     * @param string $privateport the starting port of port forwarding rule's private port range
     * @param string $ipaddressid the IP address id of the port forwarding rule
     * @param array  $optArgs {
     *     @type string $publicendport the ending port of port forwarding rule's private port range
     *     @type string $vmguestip VM guest nic secondary IP address for the port forwarding rule
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $privateendport the ending port of port forwarding rule's private port range
     *     @type string $openfirewall if true, firewall rule for source/end public port is automatically created; if false - firewall rule has to be created explicitly. If not specified 1) defaulted to false when PF rule is being created for VPC guest network 2) in all other cases defaulted to true
     *     @type string $cidrlist the cidr list to forward traffic from
     *     @type string $networkid the network of the virtual machine the port forwarding rule will be created for. Required when public IP address is not associated with any guest network yet (VPC case).
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createPortForwardingRule($publicport, $protocol, $virtualmachineid, $privateport, $ipaddressid, array $optArgs = []) {
        if (empty($publicport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'publicport'), MISSING_ARGUMENT);
        }
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'protocol'), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        if (empty($privateport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'privateport'), MISSING_ARGUMENT);
        }
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ipaddressid'), MISSING_ARGUMENT);
        }
        return $this->request('createPortForwardingRule',
            [
                'publicport' => $publicport,
                'protocol' => $protocol,
                'virtualmachineid' => $virtualmachineid,
                'privateport' => $privateport,
                'ipaddressid' => $ipaddressid
            ] + $optArgs
        );
    }

    /**
     * Deletes a secondary staging store .
     *
     * @param string $id the staging store ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteSecondaryStagingStore($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteSecondaryStagingStore',
            [
                'id' => $id
            ]
        );
    }

    /**
     * lists netscaler load balancer devices
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $lbdeviceid netscaler load balancer device ID
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     * @return \stdClass
     */
    public function listNetscalerLoadBalancers(array $optArgs = []) {
        return $this->request('listNetscalerLoadBalancers',
            $optArgs
        );
    }

    /**
     * Creates VPC offering
     *
     * @param string $displaytext the display text of the vpc offering
     * @param string $name the name of the vpc offering
     * @param string $supportedservices services supported by the vpc offering
     * @param array  $optArgs {
     *     @type string $serviceofferingid the ID of the service offering for the VPC router appliance
     *     @type string $serviceproviderlist provider to service mapping. If not specified, the provider for the service will be mapped to the default provider on the physical network
     *     @type string $servicecapabilitylist desired service capabilities as part of vpc offering
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createVPCOffering($displaytext, $name, $supportedservices, array $optArgs = []) {
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($supportedservices)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'supportedservices'), MISSING_ARGUMENT);
        }
        return $this->request('createVPCOffering',
            [
                'displaytext' => $displaytext,
                'name' => $name,
                'supportedservices' => $supportedservices
            ] + $optArgs
        );
    }

    /**
     * Creates a egress firewall rule for a given network
     *
     * @param string $protocol the protocol for the firewall rule. Valid values are TCP/UDP/ICMP.
     * @param string $networkid the network id of the port forwarding rule
     * @param array  $optArgs {
     *     @type string $type type of firewallrule: system/user
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $icmptype type of the icmp message being sent
     *     @type string $cidrlist the cidr list to forward traffic from
     *     @type string $endport the ending port of firewall rule
     *     @type string $startport the starting port of firewall rule
     *     @type string $icmpcode error code for this icmp message
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createEgressFirewallRule($protocol, $networkid, array $optArgs = []) {
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'protocol'), MISSING_ARGUMENT);
        }
        if (empty($networkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'networkid'), MISSING_ARGUMENT);
        }
        return $this->request('createEgressFirewallRule',
            [
                'protocol' => $protocol,
                'networkid' => $networkid
            ] + $optArgs
        );
    }

    /**
     * Destroys a router.
     *
     * @param string $id the ID of the router
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function destroyRouter($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('destroyRouter',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Delete one or more alerts.
     *
     * @param array  $optArgs {
     *     @type string $ids the IDs of the alerts
     *     @type string $type delete by alert type
     *     @type string $enddate end date range to delete alerts (including) this date (use format "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $startdate start date range to delete alerts (including) this date (use format "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     * }
     * @return \stdClass
     */
    public function deleteAlerts(array $optArgs = []) {
        return $this->request('deleteAlerts',
            $optArgs
        );
    }

    /**
     * Updates load balancer stickiness policy
     *
     * @param string $id id of lb stickiness policy
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the policy to the end user or not
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateLBStickinessPolicy($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateLBStickinessPolicy',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists usage records for accounts
     *
     * @param string $enddate End date range for usage record query (use format "yyyy-MM-dd" or the new format "yyyy-MM-dd HH:mm:ss", e.g. startDate=2015-01-01 or startdate=2015-01-01 10:30:00).
     * @param string $startdate Start date range for usage record query (use format "yyyy-MM-dd" or the new format "yyyy-MM-dd HH:mm:ss", e.g. startDate=2015-01-01 or startdate=2015-01-01 11:00:00).
     * @param array  $optArgs {
     *     @type string $usageid List usage records for the specified usage UUID. Can be used only together with TYPE parameter.
     *     @type string $type List usage records for the specified usage type
     *     @type string $accountid List usage records for the specified account
     *     @type string $account List usage records for the specified user.
     *     @type string $projectid List usage records for specified project
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $domainid List usage records for the specified domain.
     *     @type string $keyword List by keyword
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listUsageRecords($enddate, $startdate, array $optArgs = []) {
        if (empty($enddate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'enddate'), MISSING_ARGUMENT);
        }
        if (empty($startdate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'startdate'), MISSING_ARGUMENT);
        }
        return $this->request('listUsageRecords',
            [
                'enddate' => $enddate,
                'startdate' => $startdate
            ] + $optArgs
        );
    }

    /**
     * Updates the snapshot policy.
     *
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the snapshot policy to the end user or not.
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $id the ID of the snapshot policy
     * }
     * @return \stdClass
     */
    public function updateSnapshotPolicy(array $optArgs = []) {
        return $this->request('updateSnapshotPolicy',
            $optArgs
        );
    }

    /**
     * Assign load balancer rule or list of load balancer rules to a global load balancer rules.
     *
     * @param string $id the ID of the global load balancer rule
     * @param string $loadbalancerrulelist the list load balancer rules that will be assigned to global load balancer rule
     * @param array  $optArgs {
     *     @type string $gslblbruleweightsmap Map of LB rule id's and corresponding weights (between 1-100) in the GSLB rule, if not specified weight of a LB rule is defaulted to 1. Specified as 'gslblbruleweightsmap[0].loadbalancerid=UUID&gslblbruleweightsmap[0].weight=10'
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function assignToGlobalLoadBalancerRule($id, $loadbalancerrulelist, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($loadbalancerrulelist)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'loadbalancerrulelist'), MISSING_ARGUMENT);
        }
        return $this->request('assignToGlobalLoadBalancerRule',
            [
                'id' => $id,
                'loadbalancerrulelist' => $loadbalancerrulelist
            ] + $optArgs
        );
    }

    /**
     * Lists all available ovs elements.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $enabled list network offerings by enabled state
     *     @type string $id list ovs elements by id
     *     @type string $keyword List by keyword
     *     @type string $nspid list ovs elements by network service provider id
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listOvsElements(array $optArgs = []) {
        return $this->request('listOvsElements',
            $optArgs
        );
    }

    /**
     * Updates traffic type of a physical network
     *
     * @param string $id traffic type id
     * @param array  $optArgs {
     *     @type string $vmwarenetworklabel The network name label of the physical device dedicated to this traffic on a VMware host
     *     @type string $ovm3networklabel The network name of the physical device dedicated to this traffic on an OVM3 host
     *     @type string $xennetworklabel The network name label of the physical device dedicated to this traffic on a XenServer host
     *     @type string $kvmnetworklabel The network name label of the physical device dedicated to this traffic on a KVM host
     *     @type string $hypervnetworklabel The network name label of the physical device dedicated to this traffic on a Hyperv host
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateTrafficType($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateTrafficType',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists all Pods.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $name list Pods by name
     *     @type string $showcapacities flag to display the capacity of the pods
     *     @type string $id list Pods by ID
     *     @type string $zoneid list Pods by Zone ID
     *     @type string $keyword List by keyword
     *     @type string $allocationstate list pods by allocation state
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listPods(array $optArgs = []) {
        return $this->request('listPods',
            $optArgs
        );
    }

    /**
     * Lists all LDAP configurations
     *
     * @param array  $optArgs {
     *     @type string $hostname Hostname
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $port Port
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listLdapConfigurations(array $optArgs = []) {
        return $this->request('listLdapConfigurations',
            $optArgs
        );
    }

    /**
     * Enables a user account
     *
     * @param string $id Enables user by user ID.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function enableUser($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('enableUser',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists all supported OS categories for this cloud.
     *
     * @param array  $optArgs {
     *     @type string $id list Os category by id
     *     @type string $name list os category by name
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listOsCategories(array $optArgs = []) {
        return $this->request('listOsCategories',
            $optArgs
        );
    }

    /**
     * Adds a SRX firewall device
     *
     * @param string $url URL of the SRX appliance.
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $password Credentials to reach SRX firewall device
     * @param string $networkdevicetype supports only JuniperSRXFirewall
     * @param string $username Credentials to reach SRX firewall device
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addSrxFirewall($url, $physicalnetworkid, $password, $networkdevicetype, $username) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($networkdevicetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'networkdevicetype'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        return $this->request('addSrxFirewall',
            [
                'url' => $url,
                'physicalnetworkid' => $physicalnetworkid,
                'password' => $password,
                'networkdevicetype' => $networkdevicetype,
                'username' => $username
            ]
        );
    }

    /**
     * Adds a Nicira NVP device
     *
     * @param string $transportzoneuuid The Transportzone UUID configured on the Nicira Controller
     * @param string $hostname Hostname of ip address of the Nicira NVP Controller.
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $username Credentials to access the Nicira Controller API
     * @param string $password Credentials to access the Nicira Controller API
     * @param array  $optArgs {
     *     @type string $l3gatewayserviceuuid The L3 Gateway Service UUID configured on the Nicira Controller
     *     @type string $l2gatewayserviceuuid The L2 Gateway Service UUID configured on the Nicira Controller
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addNiciraNvpDevice($transportzoneuuid, $hostname, $physicalnetworkid, $username, $password, array $optArgs = []) {
        if (empty($transportzoneuuid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'transportzoneuuid'), MISSING_ARGUMENT);
        }
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostname'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        return $this->request('addNiciraNvpDevice',
            [
                'transportzoneuuid' => $transportzoneuuid,
                'hostname' => $hostname,
                'physicalnetworkid' => $physicalnetworkid,
                'username' => $username,
                'password' => $password
            ] + $optArgs
        );
    }

    /**
     * Updates ACL item with specified ID
     *
     * @param string $id the ID of the network ACL item
     * @param array  $optArgs {
     *     @type string $endport the ending port of ACL
     *     @type string $cidrlist the cidr list to allow traffic from/to
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $protocol the protocol for the ACL rule. Valid values are TCP/UDP/ICMP/ALL or valid protocol number
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $number The network of the vm the ACL will be created for
     *     @type string $icmptype type of the ICMP message being sent
     *     @type string $action scl entry action, allow or deny
     *     @type string $traffictype the traffic type for the ACL,can be Ingress or Egress, defaulted to Ingress if not specified
     *     @type string $startport the starting port of ACL
     *     @type string $icmpcode error code for this ICMP message
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateNetworkACLItem($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateNetworkACLItem',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Assigns secondary IP to NIC
     *
     * @param string $nicid the ID of the nic to which you want to assign private IP
     * @param array  $optArgs {
     *     @type string $ipaddress Secondary IP Address
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addIpToNic($nicid, array $optArgs = []) {
        if (empty($nicid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'nicid'), MISSING_ARGUMENT);
        }
        return $this->request('addIpToNic',
            [
                'nicid' => $nicid
            ] + $optArgs
        );
    }

    /**
     * Creates a vm group
     *
     * @param string $name the name of the instance group
     * @param array  $optArgs {
     *     @type string $projectid The project of the instance group
     *     @type string $account the account of the instance group. The account parameter must be used with the domainId parameter.
     *     @type string $domainid the domain ID of account owning the instance group
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createInstanceGroup($name, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('createInstanceGroup',
            [
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Deletes a network ACL
     *
     * @param string $id the ID of the network ACL
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteNetworkACLList($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteNetworkACLList',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates account information for the authenticated user
     *
     * @param string $newname new name for the account
     * @param array  $optArgs {
     *     @type string $domainid the ID of the domain where the account exists
     *     @type string $accountdetails details for account used to store specific parameters
     *     @type string $account the current account name
     *     @type string $id Account id
     *     @type string $networkdomain Network domain for the account's networks; empty string will update domainName with NULL value
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateAccount($newname, array $optArgs = []) {
        if (empty($newname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'newname'), MISSING_ARGUMENT);
        }
        return $this->request('updateAccount',
            [
                'newname' => $newname
            ] + $optArgs
        );
    }

    /**
     * Deletes network device.
     *
     * @param string $id Id of network device to delete
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteNetworkDevice($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteNetworkDevice',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists snapshot policies.
     *
     * @param array  $optArgs {
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $keyword List by keyword
     *     @type string $id the ID of the snapshot policy
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $volumeid the ID of the disk volume
     * }
     * @return \stdClass
     */
    public function listSnapshotPolicies(array $optArgs = []) {
        return $this->request('listSnapshotPolicies',
            $optArgs
        );
    }

    /**
     * Configures an Internal Load Balancer element.
     *
     * @param string $id the ID of the internal lb provider
     * @param string $enabled Enables/Disables the Internal Load Balancer element
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function configureInternalLoadBalancerElement($id, $enabled) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($enabled)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'enabled'), MISSING_ARGUMENT);
        }
        return $this->request('configureInternalLoadBalancerElement',
            [
                'id' => $id,
                'enabled' => $enabled
            ]
        );
    }

    /**
     * Releases host reservation.
     *
     * @param string $id the host ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function releaseHostReservation($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('releaseHostReservation',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Creates a domain
     *
     * @param string $name creates domain with this name
     * @param array  $optArgs {
     *     @type string $networkdomain Network domain for networks in the domain
     *     @type string $parentdomainid assigns new domain a parent domain by domain ID of the parent.  If no parent domain is specied, the ROOT domain is assumed.
     *     @type string $domainid Domain UUID, required for adding domain from another Region
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createDomain($name, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('createDomain',
            [
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Deletes a keypair by name
     *
     * @param string $name Name of the keypair
     * @param array  $optArgs {
     *     @type string $account the account associated with the keypair. Must be used with the domainId parameter.
     *     @type string $projectid the project associated with keypair
     *     @type string $domainid the domain ID associated with the keypair
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteSSHKeyPair($name, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('deleteSSHKeyPair',
            [
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Deletes snapshot policies for the account.
     *
     * @param array  $optArgs {
     *     @type string $id the Id of the snapshot policy
     *     @type string $ids list of snapshots policy IDs separated by comma
     * }
     * @return \stdClass
     */
    public function deleteSnapshotPolicies(array $optArgs = []) {
        return $this->request('deleteSnapshotPolicies',
            $optArgs
        );
    }

    /**
     * Lists load balancer health check policies.
     *
     * @param array  $optArgs {
     *     @type string $id the ID of the health check policy
     *     @type string $keyword List by keyword
     *     @type string $lbruleid the ID of the load balancer rule
     *     @type string $pagesize the number of entries per page
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listLBHealthCheckPolicies(array $optArgs = []) {
        return $this->request('listLBHealthCheckPolicies',
            $optArgs
        );
    }

    /**
     * A command to list events.
     *
     * @param array  $optArgs {
     *     @type string $entrytime the time the event was entered
     *     @type string $startdate the start date range of the list you want to retrieve (use format "yyyy-MM-dd" or the new format "yyyy-MM-dd HH:mm:ss")
     *     @type string $duration the duration of the event
     *     @type string $pagesize the number of entries per page
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $page the page number of the result set
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $level the event level (INFO, WARN, ERROR)
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $projectid list objects by project
     *     @type string $type the event type (see event types)
     *     @type string $id the ID of the event
     *     @type string $keyword List by keyword
     *     @type string $enddate the end date range of the list you want to retrieve (use format "yyyy-MM-dd" or the new format "yyyy-MM-dd HH:mm:ss")
     * }
     * @return \stdClass
     */
    public function listEvents(array $optArgs = []) {
        return $this->request('listEvents',
            $optArgs
        );
    }

    /**
     * Assigns a certificate to a load balancer rule
     *
     * @param string $certid the ID of the certificate
     * @param string $lbruleid the ID of the load balancer rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function assignCertToLoadBalancer($certid, $lbruleid) {
        if (empty($certid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'certid'), MISSING_ARGUMENT);
        }
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbruleid'), MISSING_ARGUMENT);
        }
        return $this->request('assignCertToLoadBalancer',
            [
                'certid' => $certid,
                'lbruleid' => $lbruleid
            ]
        );
    }

    /**
     * Adds a new host.
     *
     * @param string $username the username for the host
     * @param string $hypervisor hypervisor type of the host
     * @param string $password the password for the host
     * @param string $zoneid the Zone ID for the host
     * @param string $podid the Pod ID for the host
     * @param string $url the host URL
     * @param array  $optArgs {
     *     @type string $hosttags list of tags to be added to the host
     *     @type string $allocationstate Allocation state of this Host for allocation of new resources
     *     @type string $clustername the cluster name for the host
     *     @type string $clusterid the cluster ID for the host
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addHost($username, $hypervisor, $password, $zoneid, $podid, $url, array $optArgs = []) {
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hypervisor'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'podid'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        return $this->request('addHost',
            [
                'username' => $username,
                'hypervisor' => $hypervisor,
                'password' => $password,
                'zoneid' => $zoneid,
                'podid' => $podid,
                'url' => $url
            ] + $optArgs
        );
    }

    /**
     * Update a Nuage VSP device
     *
     * @param string $physicalnetworkid the ID of the physical network in to which Nuage VSP is added
     * @param array  $optArgs {
     *     @type string $port the port to communicate to Nuage VSD
     *     @type string $hostname the hostname of the Nuage VSD
     *     @type string $apiversion the version of the API to use to communicate to Nuage VSD
     *     @type string $password the password of CMS user in Nuage VSD
     *     @type string $retryinterval the time to wait after failure before retrying to communicate to Nuage VSD
     *     @type string $retrycount the number of retries on failure to communicate to Nuage VSD
     *     @type string $username the user name of the CMS user in Nuage VSD
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateNuageVspDevice($physicalnetworkid, array $optArgs = []) {
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        return $this->request('updateNuageVspDevice',
            [
                'physicalnetworkid' => $physicalnetworkid
            ] + $optArgs
        );
    }

    /**
     * Lists dedicated clusters.
     *
     * @param array  $optArgs {
     *     @type string $clusterid the ID of the cluster
     *     @type string $domainid the ID of the domain associated with the cluster
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $affinitygroupid list dedicated clusters by affinity group
     *     @type string $keyword List by keyword
     *     @type string $account the name of the account associated with the cluster. Must be used with domainId.
     * }
     * @return \stdClass
     */
    public function listDedicatedClusters(array $optArgs = []) {
        return $this->request('listDedicatedClusters',
            $optArgs
        );
    }

    /**
     * Delete site to site vpn gateway
     *
     * @param string $id id of customer gateway
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteVpnGateway($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteVpnGateway',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Expunge a virtual machine. Once expunged, it cannot be recoverd.
     *
     * @param string $id The ID of the virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function expungeVirtualMachine($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('expungeVirtualMachine',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Adds a network device of one of the following types: ExternalDhcp, ExternalFirewall, ExternalLoadBalancer, PxeServer
     *
     * @param array  $optArgs {
     *     @type string $networkdeviceparameterlist parameters for network device
     *     @type string $networkdevicetype Network device type, now supports ExternalDhcp, PxeServer, NetscalerMPXLoadBalancer, NetscalerVPXLoadBalancer, NetscalerSDXLoadBalancer, F5BigIpLoadBalancer, JuniperSRXFirewall, PaloAltoFirewall
     * }
     * @return \stdClass
     */
    public function addNetworkDevice(array $optArgs = []) {
        return $this->request('addNetworkDevice',
            $optArgs
        );
    }

    /**
     * Creates and automatically starts a virtual machine based on a service offering, disk offering, and template.
     *
     * @param string $maxmembers the maximum number of members in the vmgroup, The number of instances in the vm group will be equal to or less than this number.
     * @param string $scaleuppolicyids list of scaleup autoscale policies
     * @param string $vmprofileid the autoscale profile that contains information about the vms in the vm group.
     * @param string $lbruleid the ID of the load balancer rule
     * @param string $scaledownpolicyids list of scaledown autoscale policies
     * @param string $minmembers the minimum number of members in the vmgroup, the number of instances in the vm group will be equal to or more than this number.
     * @param array  $optArgs {
     *     @type string $interval the frequency at which the conditions have to be evaluated
     *     @type string $fordisplay an optional field, whether to the display the group to the end user or not
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createAutoScaleVmGroup($maxmembers, $scaleuppolicyids, $vmprofileid, $lbruleid, $scaledownpolicyids, $minmembers, array $optArgs = []) {
        if (empty($maxmembers)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'maxmembers'), MISSING_ARGUMENT);
        }
        if (empty($scaleuppolicyids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'scaleuppolicyids'), MISSING_ARGUMENT);
        }
        if (empty($vmprofileid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vmprofileid'), MISSING_ARGUMENT);
        }
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbruleid'), MISSING_ARGUMENT);
        }
        if (empty($scaledownpolicyids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'scaledownpolicyids'), MISSING_ARGUMENT);
        }
        if (empty($minmembers)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'minmembers'), MISSING_ARGUMENT);
        }
        return $this->request('createAutoScaleVmGroup',
            [
                'maxmembers' => $maxmembers,
                'scaleuppolicyids' => $scaleuppolicyids,
                'vmprofileid' => $vmprofileid,
                'lbruleid' => $lbruleid,
                'scaledownpolicyids' => $scaledownpolicyids,
                'minmembers' => $minmembers
            ] + $optArgs
        );
    }

    /**
     * Starts a router.
     *
     * @param string $id the ID of the router
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function rebootRouter($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('rebootRouter',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes a Network Service Provider.
     *
     * @param string $id the ID of the network service provider
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteNetworkServiceProvider($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteNetworkServiceProvider',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Creates a load balancer health check policy
     *
     * @param string $lbruleid the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $unhealthythreshold Number of consecutive health check failures before declaring an instance unhealthy
     *     @type string $healthythreshold Number of consecutive health check success before declaring an instance healthy
     *     @type string $responsetimeout Time to wait when receiving a response from the health check (2sec - 60 sec)
     *     @type string $description the description of the load balancer health check policy
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $pingpath HTTP ping path
     *     @type string $intervaltime Amount of time between health checks (1 sec - 20940 sec)
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createLBHealthCheckPolicy($lbruleid, array $optArgs = []) {
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbruleid'), MISSING_ARGUMENT);
        }
        return $this->request('createLBHealthCheckPolicy',
            [
                'lbruleid' => $lbruleid
            ] + $optArgs
        );
    }

    /**
     * Archive one or more events.
     *
     * @param array  $optArgs {
     *     @type string $ids the IDs of the events
     *     @type string $type archive by event type
     *     @type string $startdate start date range to archive events (including) this date (use format "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $enddate end date range to archive events (including) this date (use format "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     * }
     * @return \stdClass
     */
    public function archiveEvents(array $optArgs = []) {
        return $this->request('archiveEvents',
            $optArgs
        );
    }

    /**
     * Lists all configurations.
     *
     * @param array  $optArgs {
     *     @type string $storageid the ID of the Storage pool to update the parameter value for corresponding storage pool
     *     @type string $pagesize the number of entries per page
     *     @type string $accountid the ID of the Account to update the parameter value for corresponding account
     *     @type string $category lists configurations by category
     *     @type string $zoneid the ID of the Zone to update the parameter value for corresponding zone
     *     @type string $clusterid the ID of the Cluster to update the parameter value for corresponding cluster
     *     @type string $showhidden Whether to show hidden parameters
     *     @type string $keyword List by keyword
     *     @type string $name lists configuration by name
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listConfigurations(array $optArgs = []) {
        return $this->request('listConfigurations',
            $optArgs
        );
    }

    /**
     * Updates a host.
     *
     * @param string $id the ID of the host to update
     * @param array  $optArgs {
     *     @type string $hosttags list of tags to be added to the host
     *     @type string $allocationstate Change resource state of host, valid values are [Enable, Disable]. Operation may failed if host in states not allowing Enable/Disable
     *     @type string $oscategoryid the id of Os category to update the host with
     *     @type string $url the new uri for the secondary storage: nfs://host/path
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateHost($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateHost',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists project invitations and provides detailed information for listed invitations
     *
     * @param array  $optArgs {
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $state list invitations by state
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $activeonly if true, list only active invitations - having Pending state and ones that are not timed out yet
     *     @type string $keyword List by keyword
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $projectid list by project id
     *     @type string $pagesize the number of entries per page
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $id list invitations by id
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listProjectInvitations(array $optArgs = []) {
        return $this->request('listProjectInvitations',
            $optArgs
        );
    }

    /**
     * Removes a Guest OS Mapping.
     *
     * @param string $id ID of the guest OS mapping
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeGuestOsMapping($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('removeGuestOsMapping',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists Brocade VCS Switches
     *
     * @param array  $optArgs {
     *     @type string $vcsdeviceid Brocade VCS switch ID
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     * @return \stdClass
     */
    public function listBrocadeVcsDevices(array $optArgs = []) {
        return $this->request('listBrocadeVcsDevices',
            $optArgs
        );
    }

    /**
     * Deletes an ISO file.
     *
     * @param string $id the ID of the ISO file
     * @param array  $optArgs {
     *     @type string $zoneid the ID of the zone of the ISO file. If not specified, the ISO will be deleted from all the zones
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteIso($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteIso',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Creates site to site vpn customer gateway
     *
     * @param string $ikepolicy IKE policy of the customer gateway
     * @param string $cidrlist guest cidr list of the customer gateway
     * @param string $ipsecpsk IPsec Preshared-Key of the customer gateway
     * @param string $gateway public ip address id of the customer gateway
     * @param string $esppolicy ESP policy of the customer gateway
     * @param array  $optArgs {
     *     @type string $dpd If DPD is enabled for VPN connection
     *     @type string $esplifetime Lifetime of phase 2 VPN connection to the customer gateway, in seconds
     *     @type string $projectid create site-to-site VPN customer gateway for the project
     *     @type string $name name of this customer gateway
     *     @type string $account the account associated with the gateway. Must be used with the domainId parameter.
     *     @type string $ikelifetime Lifetime of phase 1 VPN connection to the customer gateway, in seconds
     *     @type string $forceencap Force Encapsulation for NAT traversal
     *     @type string $domainid the domain ID associated with the gateway. If used with the account parameter returns the gateway associated with the account for the specified domain.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createVpnCustomerGateway($ikepolicy, $cidrlist, $ipsecpsk, $gateway, $esppolicy, array $optArgs = []) {
        if (empty($ikepolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ikepolicy'), MISSING_ARGUMENT);
        }
        if (empty($cidrlist)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'cidrlist'), MISSING_ARGUMENT);
        }
        if (empty($ipsecpsk)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ipsecpsk'), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'gateway'), MISSING_ARGUMENT);
        }
        if (empty($esppolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'esppolicy'), MISSING_ARGUMENT);
        }
        return $this->request('createVpnCustomerGateway',
            [
                'ikepolicy' => $ikepolicy,
                'cidrlist' => $cidrlist,
                'ipsecpsk' => $ipsecpsk,
                'gateway' => $gateway,
                'esppolicy' => $esppolicy
            ] + $optArgs
        );
    }

    /**
     * Lists traffic types of a given physical network.
     *
     * @param string $physicalnetworkid the Physical Network ID
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listTrafficTypes($physicalnetworkid, array $optArgs = []) {
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        return $this->request('listTrafficTypes',
            [
                'physicalnetworkid' => $physicalnetworkid
            ] + $optArgs
        );
    }

    /**
     * Updates resource limits for an account or domain.
     *
     * @param string $resourcetype Type of resource to update. Values are 0, 1, 2, 3, 4, 6, 7, 8, 9, 10 and 11. 0 - Instance. Number of instances a user can create. 1 - IP. Number of public IP addresses a user can own. 2 - Volume. Number of disk volumes a user can create. 3 - Snapshot. Number of snapshots a user can create. 4 - Template. Number of templates that a user can register/create. 6 - Network. Number of guest network a user can create. 7 - VPC. Number of VPC a user can create. 8 - CPU. Total number of CPU cores a user can use. 9 - Memory. Total Memory (in MB) a user can use. 10 - PrimaryStorage. Total primary storage space (in GiB) a user can use. 11 - SecondaryStorage. Total secondary storage space (in GiB) a user can use.
     * @param array  $optArgs {
     *     @type string $domainid Update resource limits for all accounts in specified domain. If used with the account parameter, updates resource limits for a specified account in specified domain.
     *     @type string $projectid Update resource limits for project
     *     @type string $max Maximum resource limit.
     *     @type string $account Update resource for a specified account. Must be used with the domainId parameter.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateResourceLimit($resourcetype, array $optArgs = []) {
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourcetype'), MISSING_ARGUMENT);
        }
        return $this->request('updateResourceLimit',
            [
                'resourcetype' => $resourcetype
            ] + $optArgs
        );
    }

    /**
     * This deprecated function used to locks an account. Look for the API DisableAccount instead
     *
     * @param string $account Locks the specified account.
     * @param string $domainid Locks the specified account on this domain.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function lockAccount($account, $domainid) {
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'account'), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        return $this->request('lockAccount',
            [
                'account' => $account,
                'domainid' => $domainid
            ]
        );
    }

    /**
     * Deletes an traffic monitor host.
     *
     * @param string $id Id of the Traffic Monitor Host.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteTrafficMonitor($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteTrafficMonitor',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Creates a user for an account that already exists
     *
     * @param string $password Clear text password (Default hashed to SHA256SALT). If you wish to use any other hashing algorithm, you would need to write a custom authentication adapter See Docs section.
     * @param string $firstname firstname
     * @param string $username Unique username.
     * @param string $email email
     * @param string $lastname lastname
     * @param string $account Creates the user under the specified account. If no account is specified, the username will be used as the account name.
     * @param array  $optArgs {
     *     @type string $userid User UUID, required for adding account from external provisioning system
     *     @type string $domainid Creates the user under the specified domain. Has to be accompanied with the account parameter
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone parameter, see Time Zone Format.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createUser($password, $firstname, $username, $email, $lastname, $account, array $optArgs = []) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($firstname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'firstname'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($email)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'email'), MISSING_ARGUMENT);
        }
        if (empty($lastname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lastname'), MISSING_ARGUMENT);
        }
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'account'), MISSING_ARGUMENT);
        }
        return $this->request('createUser',
            [
                'password' => $password,
                'firstname' => $firstname,
                'username' => $username,
                'email' => $email,
                'lastname' => $lastname,
                'account' => $account
            ] + $optArgs
        );
    }

    /**
     * Deletes a autoscale policy.
     *
     * @param string $id the ID of the autoscale policy
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteAutoScalePolicy($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteAutoScalePolicy',
            [
                'id' => $id
            ]
        );
    }

    /**
     * delete a SRX firewall device
     *
     * @param string $fwdeviceid srx firewall device ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteSrxFirewall($fwdeviceid) {
        if (empty($fwdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'fwdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteSrxFirewall',
            [
                'fwdeviceid' => $fwdeviceid
            ]
        );
    }

    /**
     * Updates network ACL list
     *
     * @param string $id the ID of the network ACL
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the list to the end user or not
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateNetworkACLList($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateNetworkACLList',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists supported methods of network isolation
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listNetworkIsolationMethods(array $optArgs = []) {
        return $this->request('listNetworkIsolationMethods',
            $optArgs
        );
    }

    /**
     * Lists all available disk offerings.
     *
     * @param array  $optArgs {
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $name name of the disk offering
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $pagesize the number of entries per page
     *     @type string $id ID of the disk offering
     * }
     * @return \stdClass
     */
    public function listDiskOfferings(array $optArgs = []) {
        return $this->request('listDiskOfferings',
            $optArgs
        );
    }

    /**
     * Detaches a disk volume from a virtual machine.
     *
     * @param array  $optArgs {
     *     @type string $id the ID of the disk volume
     *     @type string $virtualmachineid the ID of the virtual machine where the volume is detached from
     *     @type string $deviceid the device ID on the virtual machine where volume is detached from
     * }
     * @return \stdClass
     */
    public function detachVolume(array $optArgs = []) {
        return $this->request('detachVolume',
            $optArgs
        );
    }

    /**
     * Deletes a user for an account
     *
     * @param string $id id of the user to be deleted
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteUser($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteUser',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes a network ACL
     *
     * @param string $id the ID of the network ACL
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteNetworkACL($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteNetworkACL',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists all available snapshots for the account.
     *
     * @param array  $optArgs {
     *     @type string $intervaltype valid values are HOURLY, DAILY, WEEKLY, and MONTHLY.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $projectid list objects by project
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $zoneid list snapshots by zone id
     *     @type string $pagesize the number of entries per page
     *     @type string $volumeid the ID of the disk volume
     *     @type string $name lists snapshot by snapshot name
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $id lists snapshot by snapshot ID
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $snapshottype valid values are MANUAL or RECURRING.
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listSnapshots(array $optArgs = []) {
        return $this->request('listSnapshots',
            $optArgs
        );
    }

    /**
     * Deletes a VPC
     *
     * @param string $id the ID of the VPC
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteVPC($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteVPC',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes security group
     *
     * @param array  $optArgs {
     *     @type string $projectid the project of the security group
     *     @type string $domainid the domain ID of account owning the security group
     *     @type string $account the account of the security group. Must be specified with domain ID
     *     @type string $id The ID of the security group. Mutually exclusive with name parameter
     *     @type string $name The ID of the security group. Mutually exclusive with id parameter
     * }
     * @return \stdClass
     */
    public function deleteSecurityGroup(array $optArgs = []) {
        return $this->request('deleteSecurityGroup',
            $optArgs
        );
    }

    /**
     * List the counters
     *
     * @param array  $optArgs {
     *     @type string $source Source of the counter.
     *     @type string $keyword List by keyword
     *     @type string $name Name of the counter.
     *     @type string $pagesize the number of entries per page
     *     @type string $id ID of the Counter.
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listCounters(array $optArgs = []) {
        return $this->request('listCounters',
            $optArgs
        );
    }

    /**
     * Delete a certificate to CloudStack
     *
     * @param string $id Id of SSL certificate
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteSslCert($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteSslCert',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates a hypervisor capabilities.
     *
     * @param array  $optArgs {
     *     @type string $securitygroupenabled set true to enable security group for this hypervisor.
     *     @type string $id ID of the hypervisor capability
     *     @type string $maxguestslimit the max number of Guest VMs per host for this hypervisor.
     * }
     * @return \stdClass
     */
    public function updateHypervisorCapabilities(array $optArgs = []) {
        return $this->request('updateHypervisorCapabilities',
            $optArgs
        );
    }

    /**
     * Creates a physical network
     *
     * @param string $name the name of the physical network
     * @param string $zoneid the Zone ID for the physical network
     * @param array  $optArgs {
     *     @type string $networkspeed the speed for the physical network[1G/10G]
     *     @type string $tags Tag the physical network
     *     @type string $vlan the VLAN for the physical network
     *     @type string $broadcastdomainrange the broadcast domain range for the physical network[Pod or Zone]. In Acton release it can be Zone only in Advance zone, and Pod in Basic
     *     @type string $domainid domain ID of the account owning a physical network
     *     @type string $isolationmethods the isolation method for the physical network[VLAN/L3/GRE]
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createPhysicalNetwork($name, $zoneid, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('createPhysicalNetwork',
            [
                'name' => $name,
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * Updates load balancer
     *
     * @param string $id the ID of the load balancer rule to update
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $name the name of the load balancer rule
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     *     @type string $description the description of the load balancer rule
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateLoadBalancerRule($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateLoadBalancerRule',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Deletes a template from the system. All virtual machines using the deleted template will not be affected.
     *
     * @param string $id the ID of the template
     * @param array  $optArgs {
     *     @type string $zoneid the ID of zone of the template
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteTemplate($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteTemplate',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists all hypervisor capabilities.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $id ID of the hypervisor capability
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $hypervisor the hypervisor for which to restrict the search
     * }
     * @return \stdClass
     */
    public function listHypervisorCapabilities(array $optArgs = []) {
        return $this->request('listHypervisorCapabilities',
            $optArgs
        );
    }

    /**
     * List resource tag(s)
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $resourcetype list by resource type
     *     @type string $pagesize the number of entries per page
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $projectid list objects by project
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $resourceid list by resource id
     *     @type string $page the page number of the result set
     *     @type string $value list by value
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $key list by key
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $customer list by customer name
     * }
     * @return \stdClass
     */
    public function listTags(array $optArgs = []) {
        return $this->request('listTags',
            $optArgs
        );
    }

    /**
     * Delete site to site vpn customer gateway
     *
     * @param string $id id of customer gateway
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteVpnCustomerGateway($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteVpnCustomerGateway',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes a Cisco Vnmc controller
     *
     * @param string $resourceid Cisco Vnmc resource ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteCiscoVnmcResource($resourceid) {
        if (empty($resourceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourceid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteCiscoVnmcResource',
            [
                'resourceid' => $resourceid
            ]
        );
    }

    /**
     * List ISO visibility and all accounts that have permissions to view this ISO.
     *
     * @param string $id the template ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listIsoPermissions($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('listIsoPermissions',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Create a virtual router element.
     *
     * @param string $nspid the network service provider ID of the virtual router element
     * @param array  $optArgs {
     *     @type string $providertype The provider type. Supported types are VirtualRouter (default) and VPCVirtualRouter
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createVirtualRouterElement($nspid, array $optArgs = []) {
        if (empty($nspid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'nspid'), MISSING_ARGUMENT);
        }
        return $this->request('createVirtualRouterElement',
            [
                'nspid' => $nspid
            ] + $optArgs
        );
    }

    /**
     * Updates an existing autoscale policy.
     *
     * @param string $id the ID of the autoscale policy
     * @param array  $optArgs {
     *     @type string $quiettime the cool down period for which the policy should not be evaluated after the action has been taken
     *     @type string $conditionids the list of IDs of the conditions that are being evaluated on every interval
     *     @type string $duration the duration for which the conditions have to be true before action is taken
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateAutoScalePolicy($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateAutoScalePolicy',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Release the dedication for the pod
     *
     * @param string $podid the ID of the Pod
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function releaseDedicatedPod($podid) {
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'podid'), MISSING_ARGUMENT);
        }
        return $this->request('releaseDedicatedPod',
            [
                'podid' => $podid
            ]
        );
    }

    /**
     * Dedicates a zones.
     *
     * @param string $zoneid the ID of the zone
     * @param string $domainid the ID of the containing domain
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function dedicateZone($zoneid, $domainid, array $optArgs = []) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        return $this->request('dedicateZone',
            [
                'zoneid' => $zoneid,
                'domainid' => $domainid
            ] + $optArgs
        );
    }

    /**
     * Creates site to site vpn local gateway
     *
     * @param string $vpcid public ip address id of the vpn gateway
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the vpn to the end user or not
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createVpnGateway($vpcid, array $optArgs = []) {
        if (empty($vpcid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vpcid'), MISSING_ARGUMENT);
        }
        return $this->request('createVpnGateway',
            [
                'vpcid' => $vpcid
            ] + $optArgs
        );
    }

    /**
     * Deletes a counter
     *
     * @param string $id the ID of the counter
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteCounter($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteCounter',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Dedicate an existing cluster
     *
     * @param string $clusterid the ID of the Cluster
     * @param string $domainid the ID of the containing domain
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function dedicateCluster($clusterid, $domainid, array $optArgs = []) {
        if (empty($clusterid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'clusterid'), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        return $this->request('dedicateCluster',
            [
                'clusterid' => $clusterid,
                'domainid' => $domainid
            ] + $optArgs
        );
    }

    /**
     * Adds an external firewall appliance
     *
     * @param string $username Username of the external firewall appliance.
     * @param string $password Password of the external firewall appliance.
     * @param string $zoneid Zone in which to add the external firewall appliance.
     * @param string $url URL of the external firewall appliance.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addExternalFirewall($username, $password, $zoneid, $url) {
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        return $this->request('addExternalFirewall',
            [
                'username' => $username,
                'password' => $password,
                'zoneid' => $zoneid,
                'url' => $url
            ]
        );
    }

    /**
     * link an existing cloudstack domain to group or OU in ldap
     *
     * @param string $type type of the ldap name. GROUP or OU
     * @param string $accounttype Type of the account to auto import. Specify 0 for user and 2 for domain admin
     * @param string $domainid The id of the domain which has to be linked to LDAP.
     * @param string $name name of the group or OU in LDAP
     * @param array  $optArgs {
     *     @type string $admin domain admin username in LDAP
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function linkDomainToLdap($type, $accounttype, $domainid, $name, array $optArgs = []) {
        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'type'), MISSING_ARGUMENT);
        }
        if (empty($accounttype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'accounttype'), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('linkDomainToLdap',
            [
                'type' => $type,
                'accounttype' => $accounttype,
                'domainid' => $domainid,
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Update a Storage network IP range, only allowed when no IPs in this range have been allocated.
     *
     * @param string $id UUID of storage network ip range
     * @param array  $optArgs {
     *     @type string $endip the ending IP address
     *     @type string $netmask the netmask for storage network
     *     @type string $vlan Optional. the vlan the ip range sits on
     *     @type string $startip the beginning IP address
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateStorageNetworkIpRange($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateStorageNetworkIpRange',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists all pending asynchronous jobs for the account.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $startdate the start date of the async job
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listAsyncJobs(array $optArgs = []) {
        return $this->request('listAsyncJobs',
            $optArgs
        );
    }

    /**
     * Adds a Brocade VCS Switch
     *
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $password Credentials to access the Brocade VCS Switch API
     * @param string $username Credentials to access the Brocade VCS Switch API
     * @param string $hostname Hostname of ip address of the Brocade VCS Switch.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addBrocadeVcsDevice($physicalnetworkid, $password, $username, $hostname) {
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostname'), MISSING_ARGUMENT);
        }
        return $this->request('addBrocadeVcsDevice',
            [
                'physicalnetworkid' => $physicalnetworkid,
                'password' => $password,
                'username' => $username,
                'hostname' => $hostname
            ]
        );
    }

    /**
     * List Usage Types
     *
     * @return \stdClass
     */
    public function listUsageTypes() {
        return $this->request('listUsageTypes');
    }

    /**
     * Lists secondary staging stores.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $id the ID of the staging store
     *     @type string $protocol the staging store protocol
     *     @type string $provider the staging store provider
     *     @type string $name the name of the staging store
     *     @type string $pagesize the number of entries per page
     *     @type string $zoneid the Zone ID for the staging store
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listSecondaryStagingStores(array $optArgs = []) {
        return $this->request('listSecondaryStagingStores',
            $optArgs
        );
    }

    /**
     * lists network that are using a F5 load balancer device
     *
     * @param string $lbdeviceid f5 load balancer device ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listF5LoadBalancerNetworks($lbdeviceid, array $optArgs = []) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('listF5LoadBalancerNetworks',
            [
                'lbdeviceid' => $lbdeviceid
            ] + $optArgs
        );
    }

    /**
     * Creates a VLAN IP range.
     *
     * @param array  $optArgs {
     *     @type string $account account who will own the VLAN. If VLAN is Zone wide, this parameter should be ommited
     *     @type string $startip the beginning IP address in the VLAN IP range
     *     @type string $physicalnetworkid the physical network id
     *     @type string $endip the ending IP address in the VLAN IP range
     *     @type string $vlan the ID or VID of the VLAN. If not specified, will be defaulted to the vlan of the network or if vlan of the network is null - to Untagged
     *     @type string $networkid the network id
     *     @type string $podid optional parameter. Have to be specified for Direct Untagged vlan only.
     *     @type string $endipv6 the ending IPv6 address in the IPv6 network range
     *     @type string $forvirtualnetwork true if VLAN is of Virtual type, false if Direct
     *     @type string $zoneid the Zone ID of the VLAN IP range
     *     @type string $gateway the gateway of the VLAN IP range
     *     @type string $ip6gateway the gateway of the IPv6 network. Required for Shared networks and Isolated networks when it belongs to VPC
     *     @type string $projectid project who will own the VLAN. If VLAN is Zone wide, this parameter should be ommited
     *     @type string $startipv6 the beginning IPv6 address in the IPv6 network range
     *     @type string $domainid domain ID of the account owning a VLAN
     *     @type string $ip6cidr the CIDR of IPv6 network, must be at least /64
     *     @type string $netmask the netmask of the VLAN IP range
     * }
     * @return \stdClass
     */
    public function createVlanIpRange(array $optArgs = []) {
        return $this->request('createVlanIpRange',
            $optArgs
        );
    }

    /**
     * Adds backup image store.
     *
     * @param string $provider the image store provider name
     * @param array  $optArgs {
     *     @type string $name the name for the image store
     *     @type string $url the URL for the image store
     *     @type string $zoneid the Zone ID for the image store
     *     @type string $details the details for the image store. Example: details[0].key=accesskey&details[0].value=s389ddssaa&details[1].key=secretkey&details[1].value=8dshfsss
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addImageStore($provider, array $optArgs = []) {
        if (empty($provider)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'provider'), MISSING_ARGUMENT);
        }
        return $this->request('addImageStore',
            [
                'provider' => $provider
            ] + $optArgs
        );
    }

    /**
     * Creates an account from an LDAP user
     *
     * @param string $username Unique username.
     * @param string $accounttype Type of the account.  Specify 0 for user, 1 for root admin, and 2 for domain admin
     * @param array  $optArgs {
     *     @type string $domainid Creates the user under the specified domain.
     *     @type string $accountid Account UUID, required for adding account from external provisioning system
     *     @type string $networkdomain Network domain for the account's networks
     *     @type string $accountdetails details for account used to store specific parameters
     *     @type string $account Creates the user under the specified account. If no account is specified, the username will be used as the account name.
     *     @type string $userid User UUID, required for adding account from external provisioning system
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone parameter, see Time Zone Format.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function ldapCreateAccount($username, $accounttype, array $optArgs = []) {
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($accounttype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'accounttype'), MISSING_ARGUMENT);
        }
        return $this->request('ldapCreateAccount',
            [
                'username' => $username,
                'accounttype' => $accounttype
            ] + $optArgs
        );
    }

    /**
     * Find hosts suitable for migrating a virtual machine.
     *
     * @param string $virtualmachineid find hosts to which this VM can be migrated and flag the hosts with enough CPU/RAM to host the VM
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function findHostsForMigration($virtualmachineid, array $optArgs = []) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('findHostsForMigration',
            [
                'virtualmachineid' => $virtualmachineid
            ] + $optArgs
        );
    }

    /**
     * Dedicates a Pod.
     *
     * @param string $podid the ID of the Pod
     * @param string $domainid the ID of the containing domain
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function dedicatePod($podid, $domainid, array $optArgs = []) {
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'podid'), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        return $this->request('dedicatePod',
            [
                'podid' => $podid,
                'domainid' => $domainid
            ] + $optArgs
        );
    }

    /**
     * Adds a F5 BigIP load balancer device
     *
     * @param string $username Credentials to reach F5 BigIP load balancer device
     * @param string $password Credentials to reach F5 BigIP load balancer device
     * @param string $networkdevicetype supports only F5BigIpLoadBalancer
     * @param string $url URL of the F5 load balancer appliance.
     * @param string $physicalnetworkid the Physical Network ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addF5LoadBalancer($username, $password, $networkdevicetype, $url, $physicalnetworkid) {
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($networkdevicetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'networkdevicetype'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        return $this->request('addF5LoadBalancer',
            [
                'username' => $username,
                'password' => $password,
                'networkdevicetype' => $networkdevicetype,
                'url' => $url,
                'physicalnetworkid' => $physicalnetworkid
            ]
        );
    }

    /**
     * Deletes a autoscale vm group.
     *
     * @param string $id the ID of the autoscale group
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteAutoScaleVmGroup($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteAutoScaleVmGroup',
            [
                'id' => $id
            ]
        );
    }

    /**
     * update global load balancer rules.
     *
     * @param string $id the ID of the global load balancer rule
     * @param array  $optArgs {
     *     @type string $description the description of the load balancer rule
     *     @type string $gslblbmethod load balancer algorithm (roundrobin, leastconn, proximity) that is used to distributed traffic across the zones participating in global server load balancing, if not specified defaults to 'round robin'
     *     @type string $gslbstickysessionmethodname session sticky method (sourceip) if not specified defaults to sourceip
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateGlobalLoadBalancerRule($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateGlobalLoadBalancerRule',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists remote access vpns
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $projectid list objects by project
     *     @type string $id Lists remote access vpn rule with the specified ID
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $publicipid public ip address id of the vpn server
     *     @type string $networkid list remote access VPNs for ceratin network
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listRemoteAccessVpns(array $optArgs = []) {
        return $this->request('listRemoteAccessVpns',
            $optArgs
        );
    }

    /**
     * Registers an existing template into the CloudStack cloud.
     *
     * @param string $hypervisor the target hypervisor for the template
     * @param string $displaytext the display text of the template. This is usually used for display purposes.
     * @param string $zoneid the ID of the zone the template is to be hosted on
     * @param string $format the format for the template. Possible values include QCOW2, RAW, VHD and OVA.
     * @param string $url the URL of where the template is hosted. Possible URL include http:// and https://
     * @param string $ostypeid the ID of the OS Type that best represents the OS of this template.
     * @param string $name the name of the template
     * @param array  $optArgs {
     *     @type string $account an optional accountName. Must be used with domainId.
     *     @type string $bits 32 or 64 bits support. 64 by default
     *     @type string $isfeatured true if this template is a featured template, false otherwise
     *     @type string $sshkeyenabled true if the template supports the sshkey upload feature; default is false
     *     @type string $templatetag the tag for this template.
     *     @type string $isrouting true if the template type is routing i.e., if template is used to deploy router
     *     @type string $requireshvm true if this template requires HVM
     *     @type string $details Template details in key/value pairs using format details[i].keyname=keyvalue. Example: details[0].hypervisortoolsversion=xenserver61
     *     @type string $projectid Register template for the project
     *     @type string $passwordenabled true if the template supports the password reset feature; default is false
     *     @type string $checksum the MD5 checksum value of this template
     *     @type string $domainid an optional domainId. If the account parameter is used, domainId must also be used.
     *     @type string $isdynamicallyscalable true if template contains XS/VMWare tools inorder to support dynamic scaling of VM cpu/memory
     *     @type string $ispublic true if the template is available to all accounts; default is true
     *     @type string $isextractable true if the template or its derivatives are extractable; default is false
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function registerTemplate($hypervisor, $displaytext, $zoneid, $format, $url, $ostypeid, $name, array $optArgs = []) {
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hypervisor'), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($format)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'format'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($ostypeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ostypeid'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('registerTemplate',
            [
                'hypervisor' => $hypervisor,
                'displaytext' => $displaytext,
                'zoneid' => $zoneid,
                'format' => $format,
                'url' => $url,
                'ostypeid' => $ostypeid,
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Lists affinity group types available
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listAffinityGroupTypes(array $optArgs = []) {
        return $this->request('listAffinityGroupTypes',
            $optArgs
        );
    }

    /**
     * Creates a system virtual-machine that implements network services
     *
     * @param string $serviceofferingid The service offering ID that defines the resources consumed by the service appliance
     * @param string $templateid The template ID that specifies the image for the service appliance
     * @param string $zoneid Availability zone for the service instance
     * @param string $rightnetworkid The right (outside) network ID for the service instance
     * @param string $leftnetworkid The left (inside) network for service instance
     * @param string $name The name of the service instance
     * @param array  $optArgs {
     *     @type string $projectid Project ID for the service instance
     *     @type string $domainid An optional domainId for the virtual machine. If the account parameter is used, domainId must also be used.
     *     @type string $account An optional account for the virtual machine. Must be used with domainId.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createServiceInstance($serviceofferingid, $templateid, $zoneid, $rightnetworkid, $leftnetworkid, $name, array $optArgs = []) {
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'serviceofferingid'), MISSING_ARGUMENT);
        }
        if (empty($templateid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'templateid'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($rightnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'rightnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($leftnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'leftnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('createServiceInstance',
            [
                'serviceofferingid' => $serviceofferingid,
                'templateid' => $templateid,
                'zoneid' => $zoneid,
                'rightnetworkid' => $rightnetworkid,
                'leftnetworkid' => $leftnetworkid,
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Deletes a network offering.
     *
     * @param string $id the ID of the network offering
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteNetworkOffering($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteNetworkOffering',
            [
                'id' => $id
            ]
        );
    }

    /**
     * deletes baremetal rack configuration text
     *
     * @param string $id RCT id
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteBaremetalRct($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteBaremetalRct',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Authorizes a particular egress rule for this security group
     *
     * @param array  $optArgs {
     *     @type string $startport start port for this egress rule
     *     @type string $icmpcode error code for this icmp message
     *     @type string $protocol TCP is default. UDP is the other supported protocol
     *     @type string $cidrlist the cidr list associated
     *     @type string $icmptype type of the icmp message being sent
     *     @type string $projectid an optional project of the security group
     *     @type string $usersecuritygrouplist user to security group mapping
     *     @type string $account an optional account for the security group. Must be used with domainId.
     *     @type string $securitygroupid The ID of the security group. Mutually exclusive with securityGroupName parameter
     *     @type string $endport end port for this egress rule
     *     @type string $securitygroupname The name of the security group. Mutually exclusive with securityGroupId parameter
     *     @type string $domainid an optional domainId for the security group. If the account parameter is used, domainId must also be used.
     * }
     * @return \stdClass
     */
    public function authorizeSecurityGroupEgress(array $optArgs = []) {
        return $this->request('authorizeSecurityGroupEgress',
            $optArgs
        );
    }

    /**
     * Disables an AutoScale Vm Group
     *
     * @param string $id the ID of the autoscale group
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function disableAutoScaleVmGroup($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('disableAutoScaleVmGroup',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists site to site vpn customer gateways
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $projectid list objects by project
     *     @type string $pagesize the number of entries per page
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $keyword List by keyword
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $id id of the customer gateway
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     * }
     * @return \stdClass
     */
    public function listVpnCustomerGateways(array $optArgs = []) {
        return $this->request('listVpnCustomerGateways',
            $optArgs
        );
    }

    /**
     * Creates an account
     *
     * @param string $password Clear text password (Default hashed to SHA256SALT). If you wish to use any other hashing algorithm, you would need to write a custom authentication adapter See Docs section.
     * @param string $accounttype Type of the account.  Specify 0 for user, 1 for root admin, and 2 for domain admin
     * @param string $email email
     * @param string $username Unique username.
     * @param string $lastname lastname
     * @param string $firstname firstname
     * @param array  $optArgs {
     *     @type string $domainid Creates the user under the specified domain.
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone parameter, see Time Zone Format.
     *     @type string $networkdomain Network domain for the account's networks
     *     @type string $accountdetails details for account used to store specific parameters
     *     @type string $account Creates the user under the specified account. If no account is specified, the username will be used as the account name.
     *     @type string $accountid Account UUID, required for adding account from external provisioning system
     *     @type string $userid User UUID, required for adding account from external provisioning system
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createAccount($password, $accounttype, $email, $username, $lastname, $firstname, array $optArgs = []) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($accounttype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'accounttype'), MISSING_ARGUMENT);
        }
        if (empty($email)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'email'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($lastname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lastname'), MISSING_ARGUMENT);
        }
        if (empty($firstname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'firstname'), MISSING_ARGUMENT);
        }
        return $this->request('createAccount',
            [
                'password' => $password,
                'accounttype' => $accounttype,
                'email' => $email,
                'username' => $username,
                'lastname' => $lastname,
                'firstname' => $firstname
            ] + $optArgs
        );
    }

    /**
     * Prepares a host for maintenance.
     *
     * @param string $id the host ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function prepareHostForMaintenance($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('prepareHostForMaintenance',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists Nuage VSP devices
     *
     * @param array  $optArgs {
     *     @type string $physicalnetworkid the Physical Network ID
     *     @type string $page the page number of the result set
     *     @type string $vspdeviceid the Nuage VSP device ID
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listNuageVspDevices(array $optArgs = []) {
        return $this->request('listNuageVspDevices',
            $optArgs
        );
    }

    /**
     * Adds an OpenDyalight controler
     *
     * @param string $url Api URL of the OpenDaylight Controller.
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $password Credential to access the OpenDaylight API
     * @param string $username Username to access the OpenDaylight API
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addOpenDaylightController($url, $physicalnetworkid, $password, $username) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        return $this->request('addOpenDaylightController',
            [
                'url' => $url,
                'physicalnetworkid' => $physicalnetworkid,
                'password' => $password,
                'username' => $username
            ]
        );
    }

    /**
     * Updates egress firewall rule
     *
     * @param string $id the ID of the egress firewall rule
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateEgressFirewallRule($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateEgressFirewallRule',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Deletes a Private gateway
     *
     * @param string $id the ID of the private gateway
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deletePrivateGateway($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deletePrivateGateway',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates the information about Guest OS
     *
     * @param string $osdisplayname Unique display name for Guest OS
     * @param string $id UUID of the Guest OS
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateGuestOs($osdisplayname, $id) {
        if (empty($osdisplayname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'osdisplayname'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateGuestOs',
            [
                'osdisplayname' => $osdisplayname,
                'id' => $id
            ]
        );
    }

    /**
     * Stops an Internal LB vm.
     *
     * @param string $id the ID of the internal lb vm
     * @param array  $optArgs {
     *     @type string $forced Force stop the VM. The caller knows the VM is stopped.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function stopInternalLoadBalancerVM($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('stopInternalLoadBalancerVM',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * create secondary staging store.
     *
     * @param string $url the URL for the staging store
     * @param array  $optArgs {
     *     @type string $provider the staging store provider name
     *     @type string $zoneid the Zone ID for the staging store
     *     @type string $scope the scope of the staging store: zone only for now
     *     @type string $details the details for the staging store
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createSecondaryStagingStore($url, array $optArgs = []) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        return $this->request('createSecondaryStagingStore',
            [
                'url' => $url
            ] + $optArgs
        );
    }

    /**
     * Generates usage records. This will generate records only if there any records to be generated, i.e if the scheduled usage job was not run or failed
     *
     * @param string $startdate Start date range for usage record query. Use yyyy-MM-dd as the date format, e.g. startDate=2009-06-01.
     * @param string $enddate End date range for usage record query. Use yyyy-MM-dd as the date format, e.g. startDate=2009-06-03.
     * @param array  $optArgs {
     *     @type string $domainid List events for the specified domain.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function generateUsageRecords($startdate, $enddate, array $optArgs = []) {
        if (empty($startdate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'startdate'), MISSING_ARGUMENT);
        }
        if (empty($enddate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'enddate'), MISSING_ARGUMENT);
        }
        return $this->request('generateUsageRecords',
            [
                'startdate' => $startdate,
                'enddate' => $enddate
            ] + $optArgs
        );
    }

    /**
     * Deletes traffic type of a physical network
     *
     * @param string $id traffic type id
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteTrafficType($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteTrafficType',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes a load balancer rule.
     *
     * @param string $id the ID of the load balancer rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteLoadBalancerRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteLoadBalancerRule',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Get API limit count for the caller
     *
     * @return \stdClass
     */
    public function getApiLimit() {
        return $this->request('getApiLimit');
    }

    /**
     * Attaches an ISO to a virtual machine.
     *
     * @param string $virtualmachineid the ID of the virtual machine
     * @param string $id the ID of the ISO file
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function attachIso($virtualmachineid, $id) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('attachIso',
            [
                'virtualmachineid' => $virtualmachineid,
                'id' => $id
            ]
        );
    }

    /**
     * Deletes a port forwarding rule
     *
     * @param string $id the ID of the port forwarding rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deletePortForwardingRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deletePortForwardingRule',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Find user account by API key
     *
     * @param string $userapikey API key of the user
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function getUser($userapikey) {
        if (empty($userapikey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'userapikey'), MISSING_ARGUMENT);
        }
        return $this->request('getUser',
            [
                'userapikey' => $userapikey
            ]
        );
    }

    /**
     * Lists domains and provides detailed information for listed domains
     *
     * @param array  $optArgs {
     *     @type string $name List domain by domain name.
     *     @type string $keyword List by keyword
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $id List domain by domain ID.
     *     @type string $level List domains by domain level.
     * }
     * @return \stdClass
     */
    public function listDomains(array $optArgs = []) {
        return $this->request('listDomains',
            $optArgs
        );
    }

    /**
     * Lists load balancer rules.
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $publicipid the public IP address ID of the load balancer rule
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $projectid list objects by project
     *     @type string $name the name of the load balancer rule
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $zoneid the availability zone ID
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $virtualmachineid the ID of the virtual machine of the load balancer rule
     *     @type string $keyword List by keyword
     *     @type string $id the ID of the load balancer rule
     *     @type string $networkid list by network ID the rule belongs to
     * }
     * @return \stdClass
     */
    public function listLoadBalancerRules(array $optArgs = []) {
        return $this->request('listLoadBalancerRules',
            $optArgs
        );
    }

    /**
     * lists Palo Alto firewall devices in a physical network
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $fwdeviceid Palo Alto firewall device ID
     *     @type string $page the page number of the result set
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     * @return \stdClass
     */
    public function listPaloAltoFirewalls(array $optArgs = []) {
        return $this->request('listPaloAltoFirewalls',
            $optArgs
        );
    }

    /**
     * Delete one or more events.
     *
     * @param array  $optArgs {
     *     @type string $ids the IDs of the events
     *     @type string $enddate end date range to delete events (including) this date (use format "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $type delete by event type
     *     @type string $startdate start date range to delete events (including) this date (use format "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     * }
     * @return \stdClass
     */
    public function deleteEvents(array $optArgs = []) {
        return $this->request('deleteEvents',
            $optArgs
        );
    }

    /**
     * Removes a certificate from a load balancer rule
     *
     * @param string $lbruleid the ID of the load balancer rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeCertFromLoadBalancer($lbruleid) {
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbruleid'), MISSING_ARGUMENT);
        }
        return $this->request('removeCertFromLoadBalancer',
            [
                'lbruleid' => $lbruleid
            ]
        );
    }

    /**
     * Configures a SRX firewall device
     *
     * @param string $fwdeviceid SRX firewall device ID
     * @param array  $optArgs {
     *     @type string $fwdevicecapacity capacity of the firewall device, Capacity will be interpreted as number of networks device can handle
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function configureSrxFirewall($fwdeviceid, array $optArgs = []) {
        if (empty($fwdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'fwdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('configureSrxFirewall',
            [
                'fwdeviceid' => $fwdeviceid
            ] + $optArgs
        );
    }

    /**
     * Deletes a Zone.
     *
     * @param string $id the ID of the Zone
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteZone($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteZone',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Accepts or declines project invitation
     *
     * @param string $projectid id of the project to join
     * @param array  $optArgs {
     *     @type string $accept if true, accept the invitation, decline if false. True by default
     *     @type string $token list invitations for specified account; this parameter has to be specified with domainId
     *     @type string $account account that is joining the project
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateProjectInvitation($projectid, array $optArgs = []) {
        if (empty($projectid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'projectid'), MISSING_ARGUMENT);
        }
        return $this->request('updateProjectInvitation',
            [
                'projectid' => $projectid
            ] + $optArgs
        );
    }

    /**
     * Deletes a detached disk volume.
     *
     * @param string $id The ID of the disk volume
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteVolume($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteVolume',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Creates resource tag(s)
     *
     * @param string $tags Map of tags (key/value pairs)
     * @param string $resourceids list of resources to create the tags for
     * @param string $resourcetype type of the resource
     * @param array  $optArgs {
     *     @type string $customer identifies client specific tag. When the value is not null, the tag can't be used by cloudStack code internally
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createTags($tags, $resourceids, $resourcetype, array $optArgs = []) {
        if (empty($tags)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'tags'), MISSING_ARGUMENT);
        }
        if (empty($resourceids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourceids'), MISSING_ARGUMENT);
        }
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourcetype'), MISSING_ARGUMENT);
        }
        return $this->request('createTags',
            [
                'tags' => $tags,
                'resourceids' => $resourceids,
                'resourcetype' => $resourcetype
            ] + $optArgs
        );
    }

    /**
     * Enables an AutoScale Vm Group
     *
     * @param string $id the ID of the autoscale group
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function enableAutoScaleVmGroup($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('enableAutoScaleVmGroup',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists OpenDyalight controllers
     *
     * @param array  $optArgs {
     *     @type string $id the ID of a OpenDaylight Controller
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     * @return \stdClass
     */
    public function listOpenDaylightControllers(array $optArgs = []) {
        return $this->request('listOpenDaylightControllers',
            $optArgs
        );
    }

    /**
     * List resource detail(s)
     *
     * @param string $resourcetype list by resource type
     * @param array  $optArgs {
     *     @type string $projectid list objects by project
     *     @type string $resourceid list by resource id
     *     @type string $value list by key, value. Needs to be passed only along with key
     *     @type string $key list by key
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $fordisplay if set to true, only details marked with display=true, are returned. False by default
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listResourceDetails($resourcetype, array $optArgs = []) {
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourcetype'), MISSING_ARGUMENT);
        }
        return $this->request('listResourceDetails',
            [
                'resourcetype' => $resourcetype
            ] + $optArgs
        );
    }

    /**
     * Remove an Ldap Configuration
     *
     * @param string $hostname Hostname
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteLdapConfiguration($hostname) {
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostname'), MISSING_ARGUMENT);
        }
        return $this->request('deleteLdapConfiguration',
            [
                'hostname' => $hostname
            ]
        );
    }

    /**
     * Updates an existing cluster
     *
     * @param string $id the ID of the Cluster
     * @param array  $optArgs {
     *     @type string $clustertype hypervisor type of the cluster
     *     @type string $allocationstate Allocation state of this cluster for allocation of new resources
     *     @type string $clustername the cluster name
     *     @type string $hypervisor hypervisor type of the cluster
     *     @type string $managedstate whether this cluster is managed by cloudstack
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateCluster($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateCluster',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * lists SRX firewall devices in a physical network
     *
     * @param array  $optArgs {
     *     @type string $fwdeviceid SRX firewall device ID
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     * @return \stdClass
     */
    public function listSrxFirewalls(array $optArgs = []) {
        return $this->request('listSrxFirewalls',
            $optArgs
        );
    }

    /**
     * Removes vpn user
     *
     * @param string $username username for the vpn user
     * @param array  $optArgs {
     *     @type string $account an optional account for the vpn user. Must be used with domainId.
     *     @type string $domainid an optional domainId for the vpn user. If the account parameter is used, domainId must also be used.
     *     @type string $projectid remove vpn user from the project
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeVpnUser($username, array $optArgs = []) {
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        return $this->request('removeVpnUser',
            [
                'username' => $username
            ] + $optArgs
        );
    }

    /**
     * Scales the virtual machine to a new service offering.
     *
     * @param string $id The ID of the virtual machine
     * @param string $serviceofferingid the ID of the service offering for the virtual machine
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu,memory and cpunumber. example details[i].name=value
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function scaleVirtualMachine($id, $serviceofferingid, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'serviceofferingid'), MISSING_ARGUMENT);
        }
        return $this->request('scaleVirtualMachine',
            [
                'id' => $id,
                'serviceofferingid' => $serviceofferingid
            ] + $optArgs
        );
    }

    /**
     * lists network that are using Palo Alto firewall device
     *
     * @param string $lbdeviceid palo alto balancer device ID
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listPaloAltoFirewallNetworks($lbdeviceid, array $optArgs = []) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('listPaloAltoFirewallNetworks',
            [
                'lbdeviceid' => $lbdeviceid
            ] + $optArgs
        );
    }

    /**
     * Releases a Public IP range back to the system pool
     *
     * @param string $id the id of the Public IP range
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function releasePublicIpRange($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('releasePublicIpRange',
            [
                'id' => $id
            ]
        );
    }

    /**
     * List all public, private, and privileged templates.
     *
     * @param string $templatefilter possible values are "featured", "self", "selfexecutable","sharedexecutable","executable", and "community". * featured : templates that have been marked as featured and public. * self : templates that have been registered or created by the calling user. * selfexecutable : same as self, but only returns templates that can be used to deploy a new VM. * sharedexecutable : templates ready to be deployed that have been granted to the calling user by another user. * executable : templates that are owned by the calling user, or public templates, that can be used to deploy a VM. * community : templates that have been marked as public but not featured. * all : all templates (only usable by admins).
     * @param array  $optArgs {
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $projectid list objects by project
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $zoneid list templates by zoneId
     *     @type string $page the page number of the result set
     *     @type string $id the template ID
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $hypervisor the hypervisor for which to restrict the search
     *     @type string $keyword List by keyword
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $pagesize the number of entries per page
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $showremoved show removed templates as well
     *     @type string $name the template name
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listTemplates($templatefilter, array $optArgs = []) {
        if (empty($templatefilter)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'templatefilter'), MISSING_ARGUMENT);
        }
        return $this->request('listTemplates',
            [
                'templatefilter' => $templatefilter
            ] + $optArgs
        );
    }

    /**
     * Lists dedicated guest vlan ranges
     *
     * @param array  $optArgs {
     *     @type string $zoneid zone of the guest VLAN range
     *     @type string $domainid the domain ID with which the guest VLAN range is associated.  If used with the account parameter, returns all guest VLAN ranges for that account in the specified domain.
     *     @type string $physicalnetworkid physical network id of the guest VLAN range
     *     @type string $account the account with which the guest VLAN range is associated. Must be used with the domainId parameter.
     *     @type string $pagesize the number of entries per page
     *     @type string $guestvlanrange the dedicated guest vlan range
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $projectid project who will own the guest VLAN range
     *     @type string $id list dedicated guest vlan ranges by id
     * }
     * @return \stdClass
     */
    public function listDedicatedGuestVlanRanges(array $optArgs = []) {
        return $this->request('listDedicatedGuestVlanRanges',
            $optArgs
        );
    }

    /**
     * Update site to site vpn customer gateway
     *
     * @param string $gateway public ip address id of the customer gateway
     * @param string $id id of customer gateway
     * @param string $ipsecpsk IPsec Preshared-Key of the customer gateway
     * @param string $cidrlist guest cidr of the customer gateway
     * @param string $ikepolicy IKE policy of the customer gateway
     * @param string $esppolicy ESP policy of the customer gateway
     * @param array  $optArgs {
     *     @type string $domainid the domain ID associated with the gateway. If used with the account parameter returns the gateway associated with the account for the specified domain.
     *     @type string $forceencap Force encapsulation for Nat Traversal
     *     @type string $ikelifetime Lifetime of phase 1 VPN connection to the customer gateway, in seconds
     *     @type string $name name of this customer gateway
     *     @type string $dpd If DPD is enabled for VPN connection
     *     @type string $account the account associated with the gateway. Must be used with the domainId parameter.
     *     @type string $esplifetime Lifetime of phase 2 VPN connection to the customer gateway, in seconds
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateVpnCustomerGateway($gateway, $id, $ipsecpsk, $cidrlist, $ikepolicy, $esppolicy, array $optArgs = []) {
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'gateway'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($ipsecpsk)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ipsecpsk'), MISSING_ARGUMENT);
        }
        if (empty($cidrlist)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'cidrlist'), MISSING_ARGUMENT);
        }
        if (empty($ikepolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ikepolicy'), MISSING_ARGUMENT);
        }
        if (empty($esppolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'esppolicy'), MISSING_ARGUMENT);
        }
        return $this->request('updateVpnCustomerGateway',
            [
                'gateway' => $gateway,
                'id' => $id,
                'ipsecpsk' => $ipsecpsk,
                'cidrlist' => $cidrlist,
                'ikepolicy' => $ikepolicy,
                'esppolicy' => $esppolicy
            ] + $optArgs
        );
    }

    /**
     * Updates ISO permissions
     *
     * @param string $id the template ID
     * @param array  $optArgs {
     *     @type string $isextractable true if the template/iso is extractable, false other wise. Can be set only by root admin
     *     @type string $accounts a comma delimited list of accounts. If specified, "op" parameter has to be passed in.
     *     @type string $isfeatured true for featured template/iso, false otherwise
     *     @type string $projectids a comma delimited list of projects. If specified, "op" parameter has to be passed in.
     *     @type string $op permission operator (add, remove, reset)
     *     @type string $ispublic true for public template/iso, false for private templates/isos
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateIsoPermissions($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateIsoPermissions',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Logs a user into the CloudStack. A successful login attempt will generate a JSESSIONID cookie value that can be passed in subsequent Query command calls until the "logout" command has been issued or the session has expired.
     *
     * @param string $password Hashed password (Default is MD5). If you wish to use any other hashing algorithm, you would need to write a custom authentication adapter See Docs section.
     * @param string $username Username
     * @param array  $optArgs {
     *     @type string $domainId The id of the domain that the user belongs to. If both domain and domainId are passed in, "domainId" parameter takes precendence
     *     @type string $domain Path of the domain that the user belongs to. Example: domain=/com/cloud/internal. If no domain is passed in, the ROOT (/) domain is assumed.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function login($password, $username, array $optArgs = []) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        return $this->request('login',
            [
                'password' => $password,
                'username' => $username
            ] + $optArgs
        );
    }

    /**
     * Stops a system VM.
     *
     * @param string $id The ID of the system virtual machine
     * @param array  $optArgs {
     *     @type string $forced Force stop the VM.  The caller knows the VM is stopped.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function stopSystemVm($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('stopSystemVm',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Restarts the network; includes 1) restarting network elements - virtual routers, DHCP servers 2) reapplying all public IPs 3) reapplying loadBalancing/portForwarding rules
     *
     * @param string $id The ID of the network to restart.
     * @param array  $optArgs {
     *     @type string $cleanup If cleanup old network elements
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function restartNetwork($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('restartNetwork',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * load template into primary storage
     *
     * @param string $zoneid zone ID of the template to be prepared in primary storage(s).
     * @param string $templateid template ID of the template to be prepared in primary storage(s).
     * @param array  $optArgs {
     *     @type string $storageid storage pool ID of the primary storage pool to which the template should be prepared. If it is not provided the template is prepared on all the available primary storage pools.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function prepareTemplate($zoneid, $templateid, array $optArgs = []) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($templateid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'templateid'), MISSING_ARGUMENT);
        }
        return $this->request('prepareTemplate',
            [
                'zoneid' => $zoneid,
                'templateid' => $templateid
            ] + $optArgs
        );
    }

    /**
     * Removes a Guest OS from listing.
     *
     * @param string $id ID of the guest OS
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeGuestOs($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('removeGuestOs',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Upgrades domain router to a new service offering
     *
     * @param string $id The ID of the router
     * @param string $serviceofferingid the service offering ID to apply to the domain router
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function changeServiceForRouter($id, $serviceofferingid) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'serviceofferingid'), MISSING_ARGUMENT);
        }
        return $this->request('changeServiceForRouter',
            [
                'id' => $id,
                'serviceofferingid' => $serviceofferingid
            ]
        );
    }

    /**
     * Reboots a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function rebootVirtualMachine($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('rebootVirtualMachine',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists load balancer rules.
     *
     * @param array  $optArgs {
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $pagesize the number of entries per page
     *     @type string $projectid list objects by project
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $regionid region ID
     *     @type string $id the ID of the global load balancer rule
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $tags List resources by tags (key/value pairs)
     * }
     * @return \stdClass
     */
    public function listGlobalLoadBalancerRules(array $optArgs = []) {
        return $this->request('listGlobalLoadBalancerRules',
            $optArgs
        );
    }

    /**
     * Safely removes raw records from cloud_usage table
     *
     * @param string $interval Specify the number of days (greater than zero) to remove records that are older than those number of days from today. For example, specifying 10 would result in removing all the records created before 10 days from today
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeRawUsageRecords($interval) {
        if (empty($interval)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'interval'), MISSING_ARGUMENT);
        }
        return $this->request('removeRawUsageRecords',
            [
                'interval' => $interval
            ]
        );
    }

    /**
     * Updates a Zone.
     *
     * @param string $id the ID of the Zone
     * @param array  $optArgs {
     *     @type string $details the details for the Zone
     *     @type string $localstorageenabled true if local storage offering enabled, false otherwise
     *     @type string $dhcpprovider the dhcp Provider for the Zone
     *     @type string $ip6dns1 the first DNS for IPv6 network in the Zone
     *     @type string $guestcidraddress the guest CIDR address for the Zone
     *     @type string $ispublic updates a private zone to public if set, but not vice-versa
     *     @type string $dnssearchorder the dns search order list
     *     @type string $allocationstate Allocation state of this cluster for allocation of new resources
     *     @type string $domain Network domain name for the networks in the zone; empty string will update domain with NULL value
     *     @type string $dns1 the first DNS for the Zone
     *     @type string $name the name of the Zone
     *     @type string $dns2 the second DNS for the Zone
     *     @type string $internaldns2 the second internal DNS for the Zone
     *     @type string $ip6dns2 the second DNS for IPv6 network in the Zone
     *     @type string $internaldns1 the first internal DNS for the Zone
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateZone($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateZone',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists load balancer stickiness policies.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $id the ID of the load balancer stickiness policy
     *     @type string $pagesize the number of entries per page
     *     @type string $lbruleid the ID of the load balancer rule
     * }
     * @return \stdClass
     */
    public function listLBStickinessPolicies(array $optArgs = []) {
        return $this->request('listLBStickinessPolicies',
            $optArgs
        );
    }

    /**
     * Enable a Cisco Nexus VSM device
     *
     * @param string $id Id of the Cisco Nexus 1000v VSM device to be enabled
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function enableCiscoNexusVSM($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('enableCiscoNexusVSM',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists security groups
     *
     * @param array  $optArgs {
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $id list the security group by the id provided
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $pagesize the number of entries per page
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $projectid list objects by project
     *     @type string $securitygroupname lists security groups by name
     *     @type string $virtualmachineid lists security groups by virtual machine id
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listSecurityGroups(array $optArgs = []) {
        return $this->request('listSecurityGroups',
            $optArgs
        );
    }

    /**
     * Dedicates a guest vlan range to an account
     *
     * @param string $account account who will own the VLAN
     * @param string $vlanrange guest vlan range to be dedicated
     * @param string $physicalnetworkid physical network ID of the vlan
     * @param string $domainid domain ID of the account owning a VLAN
     * @param array  $optArgs {
     *     @type string $projectid project who will own the VLAN
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function dedicateGuestVlanRange($account, $vlanrange, $physicalnetworkid, $domainid, array $optArgs = []) {
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'account'), MISSING_ARGUMENT);
        }
        if (empty($vlanrange)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vlanrange'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        return $this->request('dedicateGuestVlanRange',
            [
                'account' => $account,
                'vlanrange' => $vlanrange,
                'physicalnetworkid' => $physicalnetworkid,
                'domainid' => $domainid
            ] + $optArgs
        );
    }

    /**
     * Lists all firewall rules for an IP address.
     *
     * @param array  $optArgs {
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $networkid list firewall rules for certain network
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $projectid list objects by project
     *     @type string $page the page number of the result set
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $ipaddressid the ID of IP address of the firewall services
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $id Lists rule with the specified ID.
     * }
     * @return \stdClass
     */
    public function listFirewallRules(array $optArgs = []) {
        return $this->request('listFirewallRules',
            $optArgs
        );
    }

    /**
     * Configures a Palo Alto firewall device
     *
     * @param string $fwdeviceid Palo Alto firewall device ID
     * @param array  $optArgs {
     *     @type string $fwdevicecapacity capacity of the firewall device, Capacity will be interpreted as number of networks device can handle
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function configurePaloAltoFirewall($fwdeviceid, array $optArgs = []) {
        if (empty($fwdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'fwdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('configurePaloAltoFirewall',
            [
                'fwdeviceid' => $fwdeviceid
            ] + $optArgs
        );
    }

    /**
     * Updates the affinity/anti-affinity group associations of a virtual machine. The VM has to be stopped and restarted for the new properties to take effect.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $affinitygroupnames comma separated list of affinity groups names that are going to be applied to the virtual machine. Should be passed only when vm is created from a zone with Basic Network support. Mutually exclusive with securitygroupids parameter
     *     @type string $affinitygroupids comma separated list of affinity groups id that are going to be applied to the virtual machine. Should be passed only when vm is created from a zone with Basic Network support. Mutually exclusive with securitygroupnames parameter
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateVMAffinityGroup($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateVMAffinityGroup',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists affinity groups
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $type lists affinity groups by type
     *     @type string $projectid list objects by project
     *     @type string $virtualmachineid lists affinity groups by virtual machine ID
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $name lists affinity groups by name
     *     @type string $page the page number of the result set
     *     @type string $id list the affinity group by the ID provided
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     * }
     * @return \stdClass
     */
    public function listAffinityGroups(array $optArgs = []) {
        return $this->request('listAffinityGroups',
            $optArgs
        );
    }

    /**
     * Delete site to site vpn connection
     *
     * @param string $id id of vpn connection
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteVpnConnection($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteVpnConnection',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates a user account
     *
     * @param string $id User uuid
     * @param array  $optArgs {
     *     @type string $lastname last name
     *     @type string $email email
     *     @type string $password Clear text password (default hashed to SHA256SALT). If you wish to use any other hasing algorithm, you would need to write a custom authentication adapter
     *     @type string $usersecretkey The secret key for the user. Must be specified with userSecretKey
     *     @type string $username Unique username
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone parameter, see Time Zone Format.
     *     @type string $firstname first name
     *     @type string $userapikey The API key for the user. Must be specified with userSecretKey
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateUser($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateUser',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Updates site to site vpn connection
     *
     * @param string $id id of vpn connection
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the vpn to the end user or not
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateVpnConnection($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateVpnConnection',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Updates a disk offering.
     *
     * @param string $id ID of the disk offering
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteDiskOffering($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteDiskOffering',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates site to site vpn local gateway
     *
     * @param string $id id of customer gateway
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the vpn to the end user or not
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateVpnGateway($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateVpnGateway',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Starts a system virtual machine.
     *
     * @param string $id The ID of the system virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function startSystemVm($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('startSystemVm',
            [
                'id' => $id
            ]
        );
    }

    /**
     * delete a F5 load balancer device
     *
     * @param string $lbdeviceid netscaler load balancer device ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteF5LoadBalancer($lbdeviceid) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteF5LoadBalancer',
            [
                'lbdeviceid' => $lbdeviceid
            ]
        );
    }

    /**
     * Updates a project
     *
     * @param string $id id of the project to be modified
     * @param array  $optArgs {
     *     @type string $displaytext display text of the project
     *     @type string $account new Admin account for the project
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateProject($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateProject',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Creates a Zone.
     *
     * @param string $internaldns1 the first internal DNS for the Zone
     * @param string $name the name of the Zone
     * @param string $networktype network type of the zone, can be Basic or Advanced
     * @param string $dns1 the first DNS for the Zone
     * @param array  $optArgs {
     *     @type string $securitygroupenabled true if network is security group enabled, false otherwise
     *     @type string $guestcidraddress the guest CIDR address for the Zone
     *     @type string $localstorageenabled true if local storage offering enabled, false otherwise
     *     @type string $ip6dns2 the second DNS for IPv6 network in the Zone
     *     @type string $internaldns2 the second internal DNS for the Zone
     *     @type string $allocationstate Allocation state of this Zone for allocation of new resources
     *     @type string $dns2 the second DNS for the Zone
     *     @type string $ip6dns1 the first DNS for IPv6 network in the Zone
     *     @type string $domainid the ID of the containing domain, null for public zones
     *     @type string $domain Network domain name for the networks in the zone
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createZone($internaldns1, $name, $networktype, $dns1, array $optArgs = []) {
        if (empty($internaldns1)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'internaldns1'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($networktype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'networktype'), MISSING_ARGUMENT);
        }
        if (empty($dns1)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'dns1'), MISSING_ARGUMENT);
        }
        return $this->request('createZone',
            [
                'internaldns1' => $internaldns1,
                'name' => $name,
                'networktype' => $networktype,
                'dns1' => $dns1
            ] + $optArgs
        );
    }

    /**
     * Archive one or more alerts.
     *
     * @param array  $optArgs {
     *     @type string $startdate start date range to archive alerts (including) this date (use format "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $enddate end date range to archive alerts (including) this date (use format "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $ids the IDs of the alerts
     *     @type string $type archive by alert type
     * }
     * @return \stdClass
     */
    public function archiveAlerts(array $optArgs = []) {
        return $this->request('archiveAlerts',
            $optArgs
        );
    }

    /**
     * list baremetal pxe server
     *
     * @param string $physicalnetworkid the Physical Network ID
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $id Pxe server device ID
     *     @type string $page the page number of the result set
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listBaremetalPxeServers($physicalnetworkid, array $optArgs = []) {
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        return $this->request('listBaremetalPxeServers',
            [
                'physicalnetworkid' => $physicalnetworkid
            ] + $optArgs
        );
    }

    /**
     * Deletes a network
     *
     * @param string $id the ID of the network
     * @param array  $optArgs {
     *     @type string $forced Force delete a network. Network will be marked as 'Destroy' even when commands to shutdown and cleanup to the backend fails.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteNetwork($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteNetwork',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists all static routes
     *
     * @param array  $optArgs {
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $vpcid list static routes by vpc id
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $projectid list objects by project
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $gatewayid list static routes by gateway id
     *     @type string $keyword List by keyword
     *     @type string $id list static route by id
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listStaticRoutes(array $optArgs = []) {
        return $this->request('listStaticRoutes',
            $optArgs
        );
    }

    /**
     * delete a netscaler load balancer device
     *
     * @param string $lbdeviceid netscaler load balancer device ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteNetscalerLoadBalancer($lbdeviceid) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteNetscalerLoadBalancer',
            [
                'lbdeviceid' => $lbdeviceid
            ]
        );
    }

    /**
     * list the vm nics  IP to NIC
     *
     * @param string $virtualmachineid the ID of the vm
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $networkid list nic of the specific vm's network
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $nicid the ID of the nic to to list IPs
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listNics($virtualmachineid, array $optArgs = []) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('listNics',
            [
                'virtualmachineid' => $virtualmachineid
            ] + $optArgs
        );
    }

    /**
     * Adds a Cisco Vnmc Controller
     *
     * @param string $password Credentials to access the Cisco VNMC Controller API
     * @param string $hostname Hostname or ip address of the Cisco VNMC Controller.
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $username Credentials to access the Cisco VNMC Controller API
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addCiscoVnmcResource($password, $hostname, $physicalnetworkid, $username) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostname'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        return $this->request('addCiscoVnmcResource',
            [
                'password' => $password,
                'hostname' => $hostname,
                'physicalnetworkid' => $physicalnetworkid,
                'username' => $username
            ]
        );
    }

    /**
     * Changes the service offering for a system vm (console proxy or secondary storage). The system vm must be in a "Stopped" state for this command to take effect.
     *
     * @param string $id The ID of the system vm
     * @param string $serviceofferingid the service offering ID to apply to the system vm
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu, memory and cpunumber. example details[i].name=value
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function changeServiceForSystemVm($id, $serviceofferingid, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'serviceofferingid'), MISSING_ARGUMENT);
        }
        return $this->request('changeServiceForSystemVm',
            [
                'id' => $id,
                'serviceofferingid' => $serviceofferingid
            ] + $optArgs
        );
    }

    /**
     * Creates a storage pool.
     *
     * @param string $name the name for the storage pool
     * @param string $url the URL of the storage pool
     * @param string $zoneid the Zone ID for the storage pool
     * @param array  $optArgs {
     *     @type string $podid the Pod ID for the storage pool
     *     @type string $clusterid the cluster ID for the storage pool
     *     @type string $details the details for the storage pool
     *     @type string $capacitybytes bytes CloudStack can provision from this storage pool
     *     @type string $scope the scope of the storage: cluster or zone
     *     @type string $tags the tags for the storage pool
     *     @type string $hypervisor hypervisor type of the hosts in zone that will be attached to this storage pool. KVM, VMware supported as of now.
     *     @type string $provider the storage provider name
     *     @type string $managed whether the storage should be managed by CloudStack
     *     @type string $capacityiops IOPS CloudStack can provision from this storage pool
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createStoragePool($name, $url, $zoneid, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('createStoragePool',
            [
                'name' => $name,
                'url' => $url,
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * lists network that are using SRX firewall device
     *
     * @param string $lbdeviceid netscaler load balancer device ID
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listSrxFirewallNetworks($lbdeviceid, array $optArgs = []) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('listSrxFirewallNetworks',
            [
                'lbdeviceid' => $lbdeviceid
            ] + $optArgs
        );
    }

    /**
     * Removes specified region
     *
     * @param string $id ID of the region to delete
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeRegion($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('removeRegion',
            [
                'id' => $id
            ]
        );
    }

    /**
     * list baremetal dhcp servers
     *
     * @param string $physicalnetworkid the Physical Network ID
     * @param array  $optArgs {
     *     @type string $dhcpservertype Type of DHCP device
     *     @type string $id DHCP server device ID
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listBaremetalDhcp($physicalnetworkid, array $optArgs = []) {
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        return $this->request('listBaremetalDhcp',
            [
                'physicalnetworkid' => $physicalnetworkid
            ] + $optArgs
        );
    }

    /**
     * Adds traffic type to a physical network
     *
     * @param string $traffictype the trafficType to be added to the physical network
     * @param string $physicalnetworkid the Physical Network ID
     * @param array  $optArgs {
     *     @type string $vlan The VLAN id to be used for Management traffic by VMware host
     *     @type string $hypervnetworklabel The network name label of the physical device dedicated to this traffic on a Hyperv host
     *     @type string $isolationmethod Used if physical network has multiple isolation types and traffic type is public. Choose which isolation method. Valid options currently 'vlan' or 'vxlan', defaults to 'vlan'.
     *     @type string $kvmnetworklabel The network name label of the physical device dedicated to this traffic on a KVM host
     *     @type string $vmwarenetworklabel The network name label of the physical device dedicated to this traffic on a VMware host
     *     @type string $xennetworklabel The network name label of the physical device dedicated to this traffic on a XenServer host
     *     @type string $ovm3networklabel The network name of the physical device dedicated to this traffic on an OVM3 host
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addTrafficType($traffictype, $physicalnetworkid, array $optArgs = []) {
        if (empty($traffictype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'traffictype'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        return $this->request('addTrafficType',
            [
                'traffictype' => $traffictype,
                'physicalnetworkid' => $physicalnetworkid
            ] + $optArgs
        );
    }

    /**
     * List Swift.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $id the id of the swift
     * }
     * @return \stdClass
     */
    public function listSwifts(array $optArgs = []) {
        return $this->request('listSwifts',
            $optArgs
        );
    }

    /**
     * delete a nuage vsp device
     *
     * @param string $vspdeviceid Nuage device ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteNuageVspDevice($vspdeviceid) {
        if (empty($vspdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vspdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteNuageVspDevice',
            [
                'vspdeviceid' => $vspdeviceid
            ]
        );
    }

    /**
     * Updates attributes of a template.
     *
     * @param string $id the ID of the image file
     * @param array  $optArgs {
     *     @type string $isrouting true if the template type is routing i.e., if template is used to deploy router
     *     @type string $bootable true if image is bootable, false otherwise; available only for updateIso API
     *     @type string $isdynamicallyscalable true if template/ISO contains XS/VMWare tools inorder to support dynamic scaling of VM cpu/memory
     *     @type string $sortkey sort key of the template, integer
     *     @type string $displaytext the display text of the image
     *     @type string $details Details in key/value pairs using format details[i].keyname=keyvalue. Example: details[0].hypervisortoolsversion=xenserver61
     *     @type string $passwordenabled true if the image supports the password reset feature; default is false
     *     @type string $format the format for the image
     *     @type string $name the name of the image file
     *     @type string $ostypeid the ID of the OS type that best represents the OS of this image.
     *     @type string $requireshvm true if the template requres HVM, false otherwise; available only for updateTemplate API
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateTemplate($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateTemplate',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Disables a user account
     *
     * @param string $id Disables user by user ID.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function disableUser($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('disableUser',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Configures a virtual router element.
     *
     * @param string $enabled Enabled/Disabled the service provider
     * @param string $id the ID of the virtual router provider
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function configureVirtualRouterElement($enabled, $id) {
        if (empty($enabled)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'enabled'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('configureVirtualRouterElement',
            [
                'enabled' => $enabled,
                'id' => $id
            ]
        );
    }

    /**
     * Creates a snapshot policy for the account.
     *
     * @param string $intervaltype valid values are HOURLY, DAILY, WEEKLY, and MONTHLY
     * @param string $volumeid the ID of the disk volume
     * @param string $maxsnaps maximum number of snapshots to retain
     * @param string $timezone Specifies a timezone for this command. For more information on the timezone parameter, see Time Zone Format.
     * @param string $schedule time the snapshot is scheduled to be taken. Format is:* if HOURLY, MM* if DAILY, MM:HH* if WEEKLY, MM:HH:DD (1-7)* if MONTHLY, MM:HH:DD (1-28)
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the policy to the end user or not
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createSnapshotPolicy($intervaltype, $volumeid, $maxsnaps, $timezone, $schedule, array $optArgs = []) {
        if (empty($intervaltype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'intervaltype'), MISSING_ARGUMENT);
        }
        if (empty($volumeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'volumeid'), MISSING_ARGUMENT);
        }
        if (empty($maxsnaps)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'maxsnaps'), MISSING_ARGUMENT);
        }
        if (empty($timezone)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'timezone'), MISSING_ARGUMENT);
        }
        if (empty($schedule)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'schedule'), MISSING_ARGUMENT);
        }
        return $this->request('createSnapshotPolicy',
            [
                'intervaltype' => $intervaltype,
                'volumeid' => $volumeid,
                'maxsnaps' => $maxsnaps,
                'timezone' => $timezone,
                'schedule' => $schedule
            ] + $optArgs
        );
    }

    /**
     * Deletes project invitation
     *
     * @param string $id id of the invitation
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteProjectInvitation($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteProjectInvitation',
            [
                'id' => $id
            ]
        );
    }

    /**
     * adds baremetal rack configuration text
     *
     * @param string $baremetalrcturl http url to baremetal RCT configuration
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addBaremetalRct($baremetalrcturl) {
        if (empty($baremetalrcturl)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'baremetalrcturl'), MISSING_ARGUMENT);
        }
        return $this->request('addBaremetalRct',
            [
                'baremetalrcturl' => $baremetalrcturl
            ]
        );
    }

    /**
     * Updates a vm group
     *
     * @param string $id Instance group ID
     * @param array  $optArgs {
     *     @type string $name new instance group name
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateInstanceGroup($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateInstanceGroup',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Attempts Migration of a system virtual machine to the host specified.
     *
     * @param string $hostid destination Host ID to migrate VM to
     * @param string $virtualmachineid the ID of the virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function migrateSystemVm($hostid, $virtualmachineid) {
        if (empty($hostid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostid'), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('migrateSystemVm',
            [
                'hostid' => $hostid,
                'virtualmachineid' => $virtualmachineid
            ]
        );
    }

    /**
     * Creates a service offering.
     *
     * @param string $displaytext the display text of the service offering
     * @param string $name the name of the service offering
     * @param array  $optArgs {
     *     @type string $cpunumber the CPU number of the service offering
     *     @type string $hypervisorsnapshotreserve Hypervisor snapshot reserve space as a percent of a volume (for managed storage using Xen or VMware)
     *     @type string $iopswriterate io requests write rate of the disk offering
     *     @type string $offerha the HA for the service offering
     *     @type string $provisioningtype provisioning type used to create volumes. Valid values are thin, sparse, fat.
     *     @type string $hosttags the host tag for this service offering.
     *     @type string $cpuspeed the CPU speed of the service offering in MHz.
     *     @type string $customizediops whether compute offering iops is custom or not
     *     @type string $storagetype the storage type of the service offering. Values are local and shared.
     *     @type string $tags the tags for this service offering.
     *     @type string $isvolatile true if the virtual machine needs to be volatile so that on every reboot of VM, original root disk is dettached then destroyed and a fresh root disk is created and attached to VM
     *     @type string $memory the total memory of the service offering in MB
     *     @type string $issystem is this a system vm offering
     *     @type string $miniops min iops of the compute offering
     *     @type string $byteswriterate bytes write rate of the disk offering
     *     @type string $systemvmtype the system VM type. Possible types are "domainrouter", "consoleproxy" and "secondarystoragevm".
     *     @type string $networkrate data transfer rate in megabits per second allowed. Supported only for non-System offering and system offerings having "domainrouter" systemvmtype
     *     @type string $serviceofferingdetails details for planner, used to store specific parameters
     *     @type string $bytesreadrate bytes read rate of the disk offering
     *     @type string $maxiops max iops of the compute offering
     *     @type string $deploymentplanner The deployment planner heuristics used to deploy a VM of this offering. If null, value of global config vm.deployment.planner is used
     *     @type string $iopsreadrate io requests read rate of the disk offering
     *     @type string $domainid the ID of the containing domain, null for public offerings
     *     @type string $limitcpuuse restrict the CPU usage to committed service offering
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createServiceOffering($displaytext, $name, array $optArgs = []) {
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('createServiceOffering',
            [
                'displaytext' => $displaytext,
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Removes VM from specified network by deleting a NIC
     *
     * @param string $nicid NIC ID
     * @param string $virtualmachineid Virtual Machine ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeNicFromVirtualMachine($nicid, $virtualmachineid) {
        if (empty($nicid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'nicid'), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('removeNicFromVirtualMachine',
            [
                'nicid' => $nicid,
                'virtualmachineid' => $virtualmachineid
            ]
        );
    }

    /**
     * Deletes a Cisco ASA 1000v appliance
     *
     * @param string $resourceid Cisco ASA 1000v resource ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteCiscoAsa1000vResource($resourceid) {
        if (empty($resourceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourceid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteCiscoAsa1000vResource',
            [
                'resourceid' => $resourceid
            ]
        );
    }

    /**
     * Deletes a particular ingress rule from this security group
     *
     * @param string $id The ID of the ingress rule
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function revokeSecurityGroupIngress($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('revokeSecurityGroupIngress',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Changes the default NIC on a VM
     *
     * @param string $nicid NIC ID
     * @param string $virtualmachineid Virtual Machine ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateDefaultNicForVirtualMachine($nicid, $virtualmachineid) {
        if (empty($nicid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'nicid'), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('updateDefaultNicForVirtualMachine',
            [
                'nicid' => $nicid,
                'virtualmachineid' => $virtualmachineid
            ]
        );
    }

    /**
     * List external firewall appliances.
     *
     * @param string $zoneid zone Id
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listExternalFirewalls($zoneid, array $optArgs = []) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('listExternalFirewalls',
            [
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * Disables static rule for given IP address
     *
     * @param string $ipaddressid the public IP address ID for which static NAT feature is being disabled
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function disableStaticNat($ipaddressid) {
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ipaddressid'), MISSING_ARGUMENT);
        }
        return $this->request('disableStaticNat',
            [
                'ipaddressid' => $ipaddressid
            ]
        );
    }

    /**
     * Creates a ACL rule in the given network (the network has to belong to VPC)
     *
     * @param string $protocol the protocol for the ACL rule. Valid values are TCP/UDP/ICMP/ALL or valid protocol number
     * @param array  $optArgs {
     *     @type string $endport the ending port of ACL
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $icmptype type of the ICMP message being sent
     *     @type string $aclid The network of the VM the ACL will be created for
     *     @type string $cidrlist the CIDR list to allow traffic from/to
     *     @type string $startport the starting port of ACL
     *     @type string $action scl entry action, allow or deny
     *     @type string $number The network of the VM the ACL will be created for
     *     @type string $icmpcode error code for this ICMP message
     *     @type string $traffictype the traffic type for the ACL,can be ingress or egress, defaulted to ingress if not specified
     *     @type string $networkid The network of the VM the ACL will be created for
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createNetworkACL($protocol, array $optArgs = []) {
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'protocol'), MISSING_ARGUMENT);
        }
        return $this->request('createNetworkACL',
            [
                'protocol' => $protocol
            ] + $optArgs
        );
    }

    /**
     * Creates a VPC
     *
     * @param string $vpcofferingid the ID of the VPC offering
     * @param string $displaytext the display text of the VPC
     * @param string $zoneid the ID of the availability zone
     * @param string $cidr the cidr of the VPC. All VPC guest networks' cidrs should be within this CIDR
     * @param string $name the name of the VPC
     * @param array  $optArgs {
     *     @type string $start If set to false, the VPC won't start (VPC VR will not get allocated) until its first network gets implemented. True by default.
     *     @type string $networkdomain VPC network domain. All networks inside the VPC will belong to this domain
     *     @type string $account the account associated with the VPC. Must be used with the domainId parameter.
     *     @type string $domainid the domain ID associated with the VPC. If used with the account parameter returns the VPC associated with the account for the specified domain.
     *     @type string $fordisplay an optional field, whether to the display the vpc to the end user or not
     *     @type string $projectid create VPC for the project
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createVPC($vpcofferingid, $displaytext, $zoneid, $cidr, $name, array $optArgs = []) {
        if (empty($vpcofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vpcofferingid'), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($cidr)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'cidr'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('createVPC',
            [
                'vpcofferingid' => $vpcofferingid,
                'displaytext' => $displaytext,
                'zoneid' => $zoneid,
                'cidr' => $cidr,
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Creates a new Pod.
     *
     * @param string $name the name of the Pod
     * @param string $netmask the netmask for the Pod
     * @param string $zoneid the Zone ID in which the Pod will be created
     * @param string $startip the starting IP address for the Pod
     * @param string $gateway the gateway for the Pod
     * @param array  $optArgs {
     *     @type string $endip the ending IP address for the Pod
     *     @type string $allocationstate Allocation state of this Pod for allocation of new resources
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createPod($name, $netmask, $zoneid, $startip, $gateway, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'netmask'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($startip)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'startip'), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'gateway'), MISSING_ARGUMENT);
        }
        return $this->request('createPod',
            [
                'name' => $name,
                'netmask' => $netmask,
                'zoneid' => $zoneid,
                'startip' => $startip,
                'gateway' => $gateway
            ] + $optArgs
        );
    }

    /**
     * Lists all supported OS types for this cloud.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $id list by Os type Id
     *     @type string $description list os by description
     *     @type string $oscategoryid list by Os Category id
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listOsTypes(array $optArgs = []) {
        return $this->request('listOsTypes',
            $optArgs
        );
    }

    /**
     * add a baremetal pxe server
     *
     * @param string $pxeservertype type of pxe device
     * @param string $url URL of the external pxe device
     * @param string $username Credentials to reach external pxe device
     * @param string $tftpdir Tftp root directory of PXE server
     * @param string $password Credentials to reach external pxe device
     * @param string $physicalnetworkid the Physical Network ID
     * @param array  $optArgs {
     *     @type string $podid Pod Id
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addBaremetalPxeKickStartServer($pxeservertype, $url, $username, $tftpdir, $password, $physicalnetworkid, array $optArgs = []) {
        if (empty($pxeservertype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'pxeservertype'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($tftpdir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'tftpdir'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        return $this->request('addBaremetalPxeKickStartServer',
            [
                'pxeservertype' => $pxeservertype,
                'url' => $url,
                'username' => $username,
                'tftpdir' => $tftpdir,
                'password' => $password,
                'physicalnetworkid' => $physicalnetworkid
            ] + $optArgs
        );
    }

    /**
     * Lists SSL certificates
     *
     * @param array  $optArgs {
     *     @type string $certid ID of SSL certificate
     *     @type string $lbruleid Load balancer rule ID
     *     @type string $accountid Account ID
     *     @type string $projectid Project that owns the SSL certificate
     * }
     * @return \stdClass
     */
    public function listSslCerts(array $optArgs = []) {
        return $this->request('listSslCerts',
            $optArgs
        );
    }

    /**
     * Registers an existing ISO into the CloudStack Cloud.
     *
     * @param string $displaytext the display text of the ISO. This is usually used for display purposes.
     * @param string $url the URL to where the ISO is currently being hosted
     * @param string $zoneid the ID of the zone you wish to register the ISO to.
     * @param string $name the name of the ISO
     * @param array  $optArgs {
     *     @type string $domainid an optional domainId. If the account parameter is used, domainId must also be used.
     *     @type string $isextractable true if the ISO or its derivatives are extractable; default is false
     *     @type string $ostypeid the ID of the OS type that best represents the OS of this ISO. If the ISO is bootable this parameter needs to be passed
     *     @type string $checksum the MD5 checksum value of this ISO
     *     @type string $bootable true if this ISO is bootable. If not passed explicitly its assumed to be true
     *     @type string $isdynamicallyscalable true if ISO contains XS/VMWare tools inorder to support dynamic scaling of VM CPU/memory
     *     @type string $ispublic true if you want to register the ISO to be publicly available to all users, false otherwise.
     *     @type string $account an optional account name. Must be used with domainId.
     *     @type string $projectid Register ISO for the project
     *     @type string $isfeatured true if you want this ISO to be featured
     *     @type string $imagestoreuuid Image store UUID
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function registerIso($displaytext, $url, $zoneid, $name, array $optArgs = []) {
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('registerIso',
            [
                'displaytext' => $displaytext,
                'url' => $url,
                'zoneid' => $zoneid,
                'name' => $name
            ] + $optArgs
        );
    }

    /**
     * Adds detail for the Resource.
     *
     * @param string $resourceid resource id to create the details for
     * @param string $resourcetype type of the resource
     * @param string $details Map of (key/value pairs)
     * @param array  $optArgs {
     *     @type string $fordisplay pass false if you want this detail to be disabled for the regular user. True by default
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addResourceDetail($resourceid, $resourcetype, $details, array $optArgs = []) {
        if (empty($resourceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourceid'), MISSING_ARGUMENT);
        }
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourcetype'), MISSING_ARGUMENT);
        }
        if (empty($details)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'details'), MISSING_ARGUMENT);
        }
        return $this->request('addResourceDetail',
            [
                'resourceid' => $resourceid,
                'resourcetype' => $resourcetype,
                'details' => $details
            ] + $optArgs
        );
    }

    /**
     * Disassociates an IP address from the account.
     *
     * @param string $id the ID of the public IP address to disassociate
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function disassociateIpAddress($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('disassociateIpAddress',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists zones
     *
     * @param array  $optArgs {
     *     @type string $name the name of the zone
     *     @type string $keyword List by keyword
     *     @type string $id the ID of the zone
     *     @type string $domainid the ID of the domain associated with the zone
     *     @type string $showcapacities flag to display the capacity of the zones
     *     @type string $networktype the network type of the zone that the virtual machine belongs to
     *     @type string $tags List zones by resource tags (key/value pairs)
     *     @type string $page the page number of the result set
     *     @type string $available true if you want to retrieve all available Zones. False if you only want to return the Zones from which you have at least one VM. Default is false.
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listZones(array $optArgs = []) {
        return $this->request('listZones',
            $optArgs
        );
    }

    /**
     * Lists F5 external load balancer appliances added in a zone.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $zoneid zone Id
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listExternalLoadBalancers(array $optArgs = []) {
        return $this->request('listExternalLoadBalancers',
            $optArgs
        );
    }

    /**
     * Creates a disk volume from a disk offering. This disk volume must still be attached to a virtual machine to make use of it.
     *
     * @param array  $optArgs {
     *     @type string $name the name of the disk volume
     *     @type string $diskofferingid the ID of the disk offering. Either diskOfferingId or snapshotId must be passed in.
     *     @type string $zoneid the ID of the availability zone
     *     @type string $maxiops max iops
     *     @type string $size Arbitrary volume size
     *     @type string $snapshotid the snapshot ID for the disk volume. Either diskOfferingId or snapshotId must be passed in.
     *     @type string $miniops min iops
     *     @type string $projectid the project associated with the volume. Mutually exclusive with account parameter
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $displayvolume an optional field, whether to display the volume to the end user or not.
     *     @type string $virtualmachineid the ID of the virtual machine; to be used with snapshot Id, VM to which the volume gets attached after creation
     *     @type string $domainid the domain ID associated with the disk offering. If used with the account parameter returns the disk volume associated with the account for the specified domain.
     *     @type string $account the account associated with the disk volume. Must be used with the domainId parameter.
     * }
     * @return \stdClass
     */
    public function createVolume(array $optArgs = []) {
        return $this->request('createVolume',
            $optArgs
        );
    }

    /**
     * Resets the password for virtual machine. The virtual machine must be in a "Stopped" state and the template must already support this feature for this command to take effect. [async]
     *
     * @param string $id The ID of the virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function resetPasswordForVirtualMachine($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('resetPasswordForVirtualMachine',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Assigns virtual machine or a list of virtual machines to a load balancer rule.
     *
     * @param string $id the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $virtualmachineids the list of IDs of the virtual machine that are being assigned to the load balancer rule(i.e. virtualMachineIds=1,2,3)
     *     @type string $vmidipmap VM ID and IP map, vmidipmap[0].vmid=1 vmidipmap[0].ip=10.1.1.75
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function assignToLoadBalancerRule($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('assignToLoadBalancerRule',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * List ucs blades
     *
     * @param string $ucsmanagerid ucs manager id
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listUcsBlades($ucsmanagerid, array $optArgs = []) {
        if (empty($ucsmanagerid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ucsmanagerid'), MISSING_ARGUMENT);
        }
        return $this->request('listUcsBlades',
            [
                'ucsmanagerid' => $ucsmanagerid
            ] + $optArgs
        );
    }

    /**
     * Starts a router.
     *
     * @param string $id the ID of the router
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function startRouter($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('startRouter',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates the information about Guest OS to Hypervisor specific name mapping
     *
     * @param string $osnameforhypervisor Hypervisor specific name for this Guest OS
     * @param string $id UUID of the Guest OS to hypervisor name Mapping
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateGuestOsMapping($osnameforhypervisor, $id) {
        if (empty($osnameforhypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'osnameforhypervisor'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateGuestOsMapping',
            [
                'osnameforhypervisor' => $osnameforhypervisor,
                'id' => $id
            ]
        );
    }

    /**
     * Extracts an ISO
     *
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param string $id the ID of the ISO file
     * @param array  $optArgs {
     *     @type string $url the URL to which the ISO would be extracted
     *     @type string $zoneid the ID of the zone where the ISO is originally located
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function extractIso($mode, $id, array $optArgs = []) {
        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'mode'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('extractIso',
            [
                'mode' => $mode,
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Removes detail for the Resource.
     *
     * @param string $resourceid Delete details for resource id
     * @param string $resourcetype Delete detail by resource type
     * @param array  $optArgs {
     *     @type string $key Delete details matching key/value pairs
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeResourceDetail($resourceid, $resourcetype, array $optArgs = []) {
        if (empty($resourceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourceid'), MISSING_ARGUMENT);
        }
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'resourcetype'), MISSING_ARGUMENT);
        }
        return $this->request('removeResourceDetail',
            [
                'resourceid' => $resourceid,
                'resourcetype' => $resourcetype
            ] + $optArgs
        );
    }

    /**
     * Changes the service offering for a virtual machine. The virtual machine must be in a "Stopped" state for this command to take effect.
     *
     * @param string $serviceofferingid the service offering ID to apply to the virtual machine
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu, memory and cpunumber. example details[i].name=value
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function changeServiceForVirtualMachine($serviceofferingid, $id, array $optArgs = []) {
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'serviceofferingid'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('changeServiceForVirtualMachine',
            [
                'serviceofferingid' => $serviceofferingid,
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Destroys a l2tp/ipsec remote access vpn
     *
     * @param string $publicipid public ip address id of the vpn server
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteRemoteAccessVpn($publicipid) {
        if (empty($publicipid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'publicipid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteRemoteAccessVpn',
            [
                'publicipid' => $publicipid
            ]
        );
    }

    /**
     * Adds a VMware datacenter to specified zone
     *
     * @param string $vcenter The name/ip of vCenter. Make sure it is IP address or full qualified domain name for host running vCenter server.
     * @param string $name Name of VMware datacenter to be added to specified zone.
     * @param string $zoneid The Zone ID.
     * @param array  $optArgs {
     *     @type string $username The Username required to connect to resource.
     *     @type string $password The password for specified username.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addVmwareDc($vcenter, $name, $zoneid, array $optArgs = []) {
        if (empty($vcenter)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vcenter'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('addVmwareDc',
            [
                'vcenter' => $vcenter,
                'name' => $name,
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * Deletes an image store or Secondary Storage.
     *
     * @param string $id The image store ID or Secondary Storage ID.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteImageStore($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteImageStore',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Creates a VLAN IP range.
     *
     * @param string $id the id of the VLAN IP range
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteVlanIpRange($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteVlanIpRange',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Reset site to site vpn connection
     *
     * @param string $id id of vpn connection
     * @param array  $optArgs {
     *     @type string $domainid an optional domainId for connection. If the account parameter is used, domainId must also be used.
     *     @type string $account an optional account for connection. Must be used with domainId.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function resetVpnConnection($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('resetVpnConnection',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists storage pools.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $zoneid the Zone ID for the storage pool
     *     @type string $clusterid list storage pools belongig to the specific cluster
     *     @type string $podid the Pod ID for the storage pool
     *     @type string $keyword List by keyword
     *     @type string $path the storage pool path
     *     @type string $page the page number of the result set
     *     @type string $name the name of the storage pool
     *     @type string $ipaddress the IP address for the storage pool
     *     @type string $id the ID of the storage pool
     *     @type string $scope the ID of the storage pool
     * }
     * @return \stdClass
     */
    public function listStoragePools(array $optArgs = []) {
        return $this->request('listStoragePools',
            $optArgs
        );
    }

    /**
     * Lists storage tags
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listStorageTags(array $optArgs = []) {
        return $this->request('listStorageTags',
            $optArgs
        );
    }

    /**
     * Extracts a template
     *
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param string $id the ID of the template
     * @param array  $optArgs {
     *     @type string $zoneid the ID of the zone where the ISO is originally located
     *     @type string $url the url to which the ISO would be extracted
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function extractTemplate($mode, $id, array $optArgs = []) {
        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'mode'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('extractTemplate',
            [
                'mode' => $mode,
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Starts a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $deploymentplanner Deployment planner to use for vm allocation. Available to ROOT admin only
     *     @type string $hostid destination Host ID to deploy the VM to - parameter available for root admin only
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function startVirtualMachine($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('startVirtualMachine',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Creates a l2tp/ipsec remote access vpn
     *
     * @param string $publicipid public ip address id of the vpn server
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the vpn to the end user or not
     *     @type string $iprange the range of ip addresses to allocate to vpn clients. The first ip in the range will be taken by the vpn server
     *     @type string $openfirewall if true, firewall rule for source/end public port is automatically created; if false - firewall rule has to be created explicitely. Has value true by default
     *     @type string $domainid an optional domainId for the VPN. If the account parameter is used, domainId must also be used.
     *     @type string $account an optional account for the VPN. Must be used with domainId.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createRemoteAccessVpn($publicipid, array $optArgs = []) {
        if (empty($publicipid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'publicipid'), MISSING_ARGUMENT);
        }
        return $this->request('createRemoteAccessVpn',
            [
                'publicipid' => $publicipid
            ] + $optArgs
        );
    }

    /**
     * List system virtual machines.
     *
     * @param array  $optArgs {
     *     @type string $zoneid the Zone ID of the system VM
     *     @type string $state the state of the system VM
     *     @type string $keyword List by keyword
     *     @type string $hostid the host ID of the system VM
     *     @type string $name the name of the system VM
     *     @type string $id the ID of the system VM
     *     @type string $systemvmtype the system VM type. Possible types are "consoleproxy" and "secondarystoragevm".
     *     @type string $podid the Pod ID of the system VM
     *     @type string $storageid the storage ID where vm's volumes belong to
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listSystemVms(array $optArgs = []) {
        return $this->request('listSystemVms',
            $optArgs
        );
    }

    /**
     * Detaches any ISO file (if any) currently attached to a virtual machine.
     *
     * @param string $virtualmachineid The ID of the virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function detachIso($virtualmachineid) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('detachIso',
            [
                'virtualmachineid' => $virtualmachineid
            ]
        );
    }

    /**
     * Deletes a service offering.
     *
     * @param string $id the ID of the service offering
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteServiceOffering($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteServiceOffering',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes a account, and all users associated with this account
     *
     * @param string $id Account id
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteAccount($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteAccount',
            [
                'id' => $id
            ]
        );
    }

    /**
     * List network devices
     *
     * @param array  $optArgs {
     *     @type string $networkdeviceparameterlist parameters for network device
     *     @type string $networkdevicetype Network device type, now supports ExternalDhcp, PxeServer, NetscalerMPXLoadBalancer, NetscalerVPXLoadBalancer, NetscalerSDXLoadBalancer, F5BigIpLoadBalancer, JuniperSRXFirewall, PaloAltoFirewall
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listNetworkDevice(array $optArgs = []) {
        return $this->request('listNetworkDevice',
            $optArgs
        );
    }

    /**
     * Acquires and associates a public IP to an account.
     *
     * @param array  $optArgs {
     *     @type string $account the account to associate with this IP address
     *     @type string $regionid region ID from where portable IP is to be associated.
     *     @type string $projectid Deploy VM for the project
     *     @type string $isportable should be set to true if public IP is required to be transferable across zones, if not specified defaults to false
     *     @type string $networkid The network this IP address should be associated to.
     *     @type string $zoneid the ID of the availability zone you want to acquire an public IP address from
     *     @type string $domainid the ID of the domain to associate with this IP address
     *     @type string $fordisplay an optional field, whether to the display the IP to the end user or not
     *     @type string $vpcid the VPC you want the IP address to be associated with
     * }
     * @return \stdClass
     */
    public function associateIpAddress(array $optArgs = []) {
        return $this->request('associateIpAddress',
            $optArgs
        );
    }

    /**
     * delete a BigSwitch BCF Controller device
     *
     * @param string $bcfdeviceid BigSwitch device ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteBigSwitchBcfDevice($bcfdeviceid) {
        if (empty($bcfdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'bcfdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteBigSwitchBcfDevice',
            [
                'bcfdeviceid' => $bcfdeviceid
            ]
        );
    }

    /**
     * Disables an account
     *
     * @param string $lock If true, only lock the account; else disable the account
     * @param array  $optArgs {
     *     @type string $domainid Disables specified account in this domain.
     *     @type string $id Account id
     *     @type string $account Disables specified account.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function disableAccount($lock, array $optArgs = []) {
        if (empty($lock)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lock'), MISSING_ARGUMENT);
        }
        return $this->request('disableAccount',
            [
                'lock' => $lock
            ] + $optArgs
        );
    }

    /**
     * Attempts Migration of a VM to a different host or Root volume of the vm to a different storage pool
     *
     * @param string $virtualmachineid the ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $storageid Destination storage pool ID to migrate VM volumes to. Required for migrating the root disk volume
     *     @type string $hostid Destination Host ID to migrate VM to. Required for live migrating a VM from host to host
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function migrateVirtualMachine($virtualmachineid, array $optArgs = []) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('migrateVirtualMachine',
            [
                'virtualmachineid' => $virtualmachineid
            ] + $optArgs
        );
    }

    /**
     * upload an existing template into the CloudStack cloud.
     *
     * @param string $format the format for the volume/template. Possible values include QCOW2, OVA, and VHD.
     * @param string $displaytext the display text of the template. This is usually used for display purposes.
     * @param string $name the name of the volume/template
     * @param string $hypervisor the target hypervisor for the template
     * @param string $ostypeid the ID of the OS Type that best represents the OS of this template.
     * @param string $zoneid the ID of the zone the volume/template is to be hosted on
     * @param array  $optArgs {
     *     @type string $isfeatured true if this template is a featured template, false otherwise
     *     @type string $bits 32 or 64 bits support. 64 by default
     *     @type string $details Template details in key/value pairs.
     *     @type string $passwordenabled true if the template supports the password reset feature; default is false
     *     @type string $sshkeyenabled true if the template supports the sshkey upload feature; default is false
     *     @type string $checksum the MD5 checksum value of this volume/template
     *     @type string $isextractable true if the template or its derivatives are extractable; default is false
     *     @type string $projectid Upload volume/template for the project
     *     @type string $domainid an optional domainId. If the account parameter is used, domainId must also be used.
     *     @type string $templatetag the tag for this template.
     *     @type string $isrouting true if the template type is routing i.e., if template is used to deploy router
     *     @type string $requireshvm true if this template requires HVM
     *     @type string $account an optional accountName. Must be used with domainId.
     *     @type string $isdynamicallyscalable true if template contains XS/VMWare tools inorder to support dynamic scaling of VM cpu/memory
     *     @type string $ispublic true if the template is available to all accounts; default is true
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function getUploadParamsForTemplate($format, $displaytext, $name, $hypervisor, $ostypeid, $zoneid, array $optArgs = []) {
        if (empty($format)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'format'), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hypervisor'), MISSING_ARGUMENT);
        }
        if (empty($ostypeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ostypeid'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('getUploadParamsForTemplate',
            [
                'format' => $format,
                'displaytext' => $displaytext,
                'name' => $name,
                'hypervisor' => $hypervisor,
                'ostypeid' => $ostypeid,
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * List virtual machine snapshot by conditions
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $name lists snapshot by snapshot name or display name
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $pagesize the number of entries per page
     *     @type string $vmsnapshotid The ID of the VM snapshot
     *     @type string $keyword List by keyword
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $projectid list objects by project
     *     @type string $virtualmachineid the ID of the vm
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $page the page number of the result set
     *     @type string $state state of the virtual machine snapshot
     * }
     * @return \stdClass
     */
    public function listVMSnapshot(array $optArgs = []) {
        return $this->request('listVMSnapshot',
            $optArgs
        );
    }

    /**
     * Updates a domain with a new name
     *
     * @param string $id ID of domain to update
     * @param array  $optArgs {
     *     @type string $networkdomain Network domain for the domain's networks; empty string will update domainName with NULL value
     *     @type string $name updates domain with this name
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateDomain($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateDomain',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * List dedicated zones.
     *
     * @param array  $optArgs {
     *     @type string $affinitygroupid list dedicated zones by affinity group
     *     @type string $zoneid the ID of the Zone
     *     @type string $domainid the ID of the domain associated with the zone
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $account the name of the account associated with the zone. Must be used with domainId.
     * }
     * @return \stdClass
     */
    public function listDedicatedZones(array $optArgs = []) {
        return $this->request('listDedicatedZones',
            $optArgs
        );
    }

    /**
     * Adds S3 Image Store
     *
     * @param string $accesskey S3 access key
     * @param string $endpoint S3 endpoint
     * @param string $secretkey S3 secret key
     * @param string $bucket Name of the storage bucket
     * @param array  $optArgs {
     *     @type string $s3signer Signer Algorithm to use, either S3SignerType or AWSS3V4SignerType
     *     @type string $connectiontimeout Connection timeout (milliseconds)
     *     @type string $maxerrorretry Maximum number of times to retry on error
     *     @type string $usetcpkeepalive Whether TCP keep-alive is used
     *     @type string $connectionttl Connection TTL (milliseconds)
     *     @type string $usehttps Use HTTPS instead of HTTP
     *     @type string $sockettimeout Socket timeout (milliseconds)
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addImageStoreS3($accesskey, $endpoint, $secretkey, $bucket, array $optArgs = []) {
        if (empty($accesskey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'accesskey'), MISSING_ARGUMENT);
        }
        if (empty($endpoint)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'endpoint'), MISSING_ARGUMENT);
        }
        if (empty($secretkey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'secretkey'), MISSING_ARGUMENT);
        }
        if (empty($bucket)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'bucket'), MISSING_ARGUMENT);
        }
        return $this->request('addImageStoreS3',
            [
                'accesskey' => $accesskey,
                'endpoint' => $endpoint,
                'secretkey' => $secretkey,
                'bucket' => $bucket
            ] + $optArgs
        );
    }

    /**
     * Removes a virtual machine or a list of virtual machines from a load balancer rule.
     *
     * @param string $id The ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $vmidipmap VM ID and IP map, vmidipmap[0].vmid=1 vmidipmap[0].ip=10.1.1.75
     *     @type string $virtualmachineids the list of IDs of the virtual machines that are being removed from the load balancer rule (i.e. virtualMachineIds=1,2,3)
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function removeFromLoadBalancerRule($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('removeFromLoadBalancerRule',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Reset api count
     *
     * @param array  $optArgs {
     *     @type string $account the ID of the acount whose limit to be reset
     * }
     * @return \stdClass
     */
    public function resetApiLimit(array $optArgs = []) {
        return $this->request('resetApiLimit',
            $optArgs
        );
    }

    /**
     * This command allows a user to register for the developer API, returning a secret key and an API key. This request is made through the integration API port, so it is a privileged command and must be made on behalf of a user. It is up to the implementer just how the username and password are entered, and then how that translates to an integration API request. Both secret key and API key should be returned to the user
     *
     * @param string $id User id
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function registerUserKeys($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('registerUserKeys',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Adds vpn users
     *
     * @param string $password password for the username
     * @param string $username username for the vpn user
     * @param array  $optArgs {
     *     @type string $projectid add vpn user to the specific project
     *     @type string $account an optional account for the vpn user. Must be used with domainId.
     *     @type string $domainid an optional domainId for the vpn user. If the account parameter is used, domainId must also be used.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addVpnUser($password, $username, array $optArgs = []) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        return $this->request('addVpnUser',
            [
                'password' => $password,
                'username' => $username
            ] + $optArgs
        );
    }

    /**
     * Lists VPCs
     *
     * @param array  $optArgs {
     *     @type string $displaytext List by display text of the VPC
     *     @type string $cidr list by cidr of the VPC. All VPC guest networks' cidrs should be within this CIDR
     *     @type string $vpcofferingid list by ID of the VPC offering
     *     @type string $pagesize the number of entries per page
     *     @type string $zoneid list by zone
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $id list VPC by id
     *     @type string $state list VPCs by state
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $keyword List by keyword
     *     @type string $projectid list objects by project
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $restartrequired list VPCs by restartRequired option
     *     @type string $supportedservices list VPC supporting certain services
     *     @type string $page the page number of the result set
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $name list by name of the VPC
     * }
     * @return \stdClass
     */
    public function listVPCs(array $optArgs = []) {
        return $this->request('listVPCs',
            $optArgs
        );
    }

    /**
     * Change ownership of a VM from one account to another. This API is available for Basic zones with security groups and Advanced zones with guest networks. A root administrator can reassign a VM from any account to any other account in any domain. A domain administrator can reassign a VM to any account in the same domain.
     *
     * @param string $account account name of the new VM owner.
     * @param string $domainid domain id of the new VM owner.
     * @param string $virtualmachineid id of the VM to be moved
     * @param array  $optArgs {
     *     @type string $securitygroupids list of security group ids to be applied on the virtual machine. In case no security groups are provided the VM is part of the default security group.
     *     @type string $networkids list of new network ids in which the moved VM will participate. In case no network ids are provided the VM will be part of the default network for that zone. In case there is no network yet created for the new account the default network will be created.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function assignVirtualMachine($account, $domainid, $virtualmachineid, array $optArgs = []) {
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'account'), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('assignVirtualMachine',
            [
                'account' => $account,
                'domainid' => $domainid,
                'virtualmachineid' => $virtualmachineid
            ] + $optArgs
        );
    }

    /**
     * Updates load balancer health check policy
     *
     * @param string $id ID of load balancer health check policy
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the policy to the end user or not
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateLBHealthCheckPolicy($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateLBHealthCheckPolicy',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Updates firewall rule
     *
     * @param string $id the ID of the firewall rule
     * @param array  $optArgs {
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateFirewallRule($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateFirewallRule',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * List Conditions for the specific user
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $policyid the ID of the policy
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $id ID of the Condition.
     *     @type string $counterid Counter-id of the condition.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     * }
     * @return \stdClass
     */
    public function listConditions(array $optArgs = []) {
        return $this->request('listConditions',
            $optArgs
        );
    }

    /**
     * Creates a private gateway
     *
     * @param string $ipaddress the IP address of the Private gateaway
     * @param string $gateway the gateway of the Private gateway
     * @param string $vlan the network implementation uri for the private gateway
     * @param string $vpcid the VPC network belongs to
     * @param string $netmask the netmask of the Private gateway
     * @param array  $optArgs {
     *     @type string $aclid the ID of the network ACL
     *     @type string $networkofferingid the uuid of the network offering to use for the private gateways network connection
     *     @type string $sourcenatsupported source NAT supported value. Default value false. If 'true' source NAT is enabled on the private gateway 'false': sourcenat is not supported
     *     @type string $physicalnetworkid the Physical Network ID the network belongs to
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createPrivateGateway($ipaddress, $gateway, $vlan, $vpcid, $netmask, array $optArgs = []) {
        if (empty($ipaddress)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ipaddress'), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'gateway'), MISSING_ARGUMENT);
        }
        if (empty($vlan)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vlan'), MISSING_ARGUMENT);
        }
        if (empty($vpcid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vpcid'), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'netmask'), MISSING_ARGUMENT);
        }
        return $this->request('createPrivateGateway',
            [
                'ipaddress' => $ipaddress,
                'gateway' => $gateway,
                'vlan' => $vlan,
                'vpcid' => $vpcid,
                'netmask' => $netmask
            ] + $optArgs
        );
    }

    /**
     * Updates properties of a virtual machine. The VM has to be stopped and restarted for the new properties to take effect. UpdateVirtualMachine does not first check whether the VM is stopped. Therefore, stop the VM manually before issuing this call.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $isdynamicallyscalable true if VM contains XS/VMWare tools inorder to support dynamic scaling of VM cpu/memory
     *     @type string $displayname user generated name
     *     @type string $instancename instance name of the user vm
     *     @type string $details Details in key/value pairs.
     *     @type string $ostypeid the ID of the OS type that best represents this VM.
     *     @type string $haenable true if high-availability is enabled for the virtual machine, false otherwise
     *     @type string $userdata an optional binary data that can be sent to the virtual machine upon a successful deployment. This binary data must be base64 encoded before adding it to the request. Using HTTP GET (via querystring), you can send up to 2KB of data after base64 encoding. Using HTTP POST(via POST body), you can send up to 32K of data after base64 encoding.
     *     @type string $name new host name of the vm. The VM has to be stopped/started for this update to take affect
     *     @type string $displayvm an optional field, whether to the display the vm to the end user or not.
     *     @type string $group group of the virtual machine
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateVirtualMachine($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateVirtualMachine',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Deletes a load balancer stickiness policy.
     *
     * @param string $id the ID of the LB stickiness policy
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteLBStickinessPolicy($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteLBStickinessPolicy',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Get the SF volume size including Hypervisor Snapshot Reserve
     *
     * @param string $storageid Storage Pool UUID
     * @param string $volumeid Volume UUID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function getSolidFireVolumeSize($storageid, $volumeid) {
        if (empty($storageid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'storageid'), MISSING_ARGUMENT);
        }
        if (empty($volumeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'volumeid'), MISSING_ARGUMENT);
        }
        return $this->request('getSolidFireVolumeSize',
            [
                'storageid' => $storageid,
                'volumeid' => $volumeid
            ]
        );
    }

    /**
     * Lists all available service offerings.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $virtualmachineid the ID of the virtual machine. Pass this in if you want to see the available service offering that a virtual machine can be changed to.
     *     @type string $systemvmtype the system VM type. Possible types are "consoleproxy", "secondarystoragevm" or "domainrouter".
     *     @type string $name name of the service offering
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $keyword List by keyword
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $issystem is this a system vm offering
     *     @type string $id ID of the service offering
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     * }
     * @return \stdClass
     */
    public function listServiceOfferings(array $optArgs = []) {
        return $this->request('listServiceOfferings',
            $optArgs
        );
    }

    /**
     * Lists resource limits.
     *
     * @param array  $optArgs {
     *     @type string $id Lists resource limits by ID.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $resourcetype Type of resource. Values are 0, 1, 2, 3, 4, 6, 7, 8, 9, 10 and 11. 0 - Instance. Number of instances a user can create. 1 - IP. Number of public IP addresses an account can own. 2 - Volume. Number of disk volumes an account can own. 3 - Snapshot. Number of snapshots an account can own. 4 - Template. Number of templates an account can register/create. 5 - Project. Number of projects an account can own. 6 - Network. Number of networks an account can own. 7 - VPC. Number of VPC an account can own. 8 - CPU. Number of CPU an account can allocate for his resources. 9 - Memory. Amount of RAM an account can allocate for his resources. 10 - PrimaryStorage. Total primary storage space (in GiB) a user can use. 11 - SecondaryStorage. Total secondary storage space (in GiB) a user can use.
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $pagesize the number of entries per page
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listResourceLimits(array $optArgs = []) {
        return $this->request('listResourceLimits',
            $optArgs
        );
    }

    /**
     * disable a Cisco Nexus VSM device
     *
     * @param string $id Id of the Cisco Nexus 1000v VSM device to be deleted
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function disableCiscoNexusVSM($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('disableCiscoNexusVSM',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Adds a Ucs manager
     *
     * @param string $zoneid the Zone id for the ucs manager
     * @param string $url the name of UCS url
     * @param string $username the username of UCS
     * @param string $password the password of UCS
     * @param array  $optArgs {
     *     @type string $name the name of UCS manager
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addUcsManager($zoneid, $url, $username, $password, array $optArgs = []) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        return $this->request('addUcsManager',
            [
                'zoneid' => $zoneid,
                'url' => $url,
                'username' => $username,
                'password' => $password
            ] + $optArgs
        );
    }

    /**
     * Deletes a vmsnapshot.
     *
     * @param string $vmsnapshotid The ID of the VM snapshot
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteVMSnapshot($vmsnapshotid) {
        if (empty($vmsnapshotid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vmsnapshotid'), MISSING_ARGUMENT);
        }
        return $this->request('deleteVMSnapshot',
            [
                'vmsnapshotid' => $vmsnapshotid
            ]
        );
    }

    /**
     * Deletes a autoscale vm profile.
     *
     * @param string $id the ID of the autoscale profile
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteAutoScaleVmProfile($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteAutoScaleVmProfile',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes a storage pool.
     *
     * @param string $id Storage pool id
     * @param array  $optArgs {
     *     @type string $forced Force destroy storage pool (force expunge volumes in Destroyed state as a part of pool removal)
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteStoragePool($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteStoragePool',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Deletes a snapshot of a disk volume.
     *
     * @param string $id The ID of the snapshot
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteSnapshot($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteSnapshot',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Creates a project
     *
     * @param string $name name of the project
     * @param string $displaytext display text of the project
     * @param array  $optArgs {
     *     @type string $account account who will be Admin for the project
     *     @type string $domainid domain ID of the account owning a project
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createProject($name, $displaytext, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        return $this->request('createProject',
            [
                'name' => $name,
                'displaytext' => $displaytext
            ] + $optArgs
        );
    }

    /**
     * Creates a load balancer rule
     *
     * @param string $privateport the private port of the private IP address/virtual machine where the network traffic will be load balanced to
     * @param string $name name of the load balancer rule
     * @param string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     * @param string $publicport the public port from where the network traffic will be load balanced from
     * @param array  $optArgs {
     *     @type string $zoneid zone where the load balancer is going to be created. This parameter is required when LB service provider is ElasticLoadBalancerVm
     *     @type string $protocol The protocol for the LB
     *     @type string $account the account associated with the load balancer. Must be used with the domainId parameter.
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $domainid the domain ID associated with the load balancer
     *     @type string $networkid The guest network this rule will be created for. Required when public Ip address is not associated with any Guest network yet (VPC case)
     *     @type string $publicipid public IP address ID from where the network traffic will be load balanced from
     *     @type string $cidrlist the CIDR list to forward traffic from
     *     @type string $openfirewall if true, firewall rule for source/end public port is automatically created; if false - firewall rule has to be created explicitely. If not specified 1) defaulted to false when LB rule is being created for VPC guest network 2) in all other cases defaulted to true
     *     @type string $description the description of the load balancer rule
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createLoadBalancerRule($privateport, $name, $algorithm, $publicport, array $optArgs = []) {
        if (empty($privateport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'privateport'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'algorithm'), MISSING_ARGUMENT);
        }
        if (empty($publicport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'publicport'), MISSING_ARGUMENT);
        }
        return $this->request('createLoadBalancerRule',
            [
                'privateport' => $privateport,
                'name' => $name,
                'algorithm' => $algorithm,
                'publicport' => $publicport
            ] + $optArgs
        );
    }

    /**
     * Creates an autoscale policy for a provision or deprovision action, the action is taken when the all the conditions evaluates to true for the specified duration. The policy is in effect once it is attached to a autscale vm group.
     *
     * @param string $conditionids the list of IDs of the conditions that are being evaluated on every interval
     * @param string $duration the duration for which the conditions have to be true before action is taken
     * @param string $action the action to be executed if all the conditions evaluate to true for the specified duration.
     * @param array  $optArgs {
     *     @type string $quiettime the cool down period for which the policy should not be evaluated after the action has been taken
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createAutoScalePolicy($conditionids, $duration, $action, array $optArgs = []) {
        if (empty($conditionids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'conditionids'), MISSING_ARGUMENT);
        }
        if (empty($duration)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'duration'), MISSING_ARGUMENT);
        }
        if (empty($action)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'action'), MISSING_ARGUMENT);
        }
        return $this->request('createAutoScalePolicy',
            [
                'conditionids' => $conditionids,
                'duration' => $duration,
                'action' => $action
            ] + $optArgs
        );
    }

    /**
     * Restore a VM to original template/ISO or new template/ISO
     *
     * @param string $virtualmachineid Virtual Machine ID
     * @param array  $optArgs {
     *     @type string $templateid an optional template Id to restore vm from the new template. This can be an ISO id in case of restore vm deployed using ISO
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function restoreVirtualMachine($virtualmachineid, array $optArgs = []) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('restoreVirtualMachine',
            [
                'virtualmachineid' => $virtualmachineid
            ] + $optArgs
        );
    }

    /**
     * Logs out the user
     *
     * @return \stdClass
     */
    public function logout() {
        return $this->request('logout');
    }

    /**
     * List Event Types
     *
     * @return \stdClass
     */
    public function listEventTypes() {
        return $this->request('listEventTypes');
    }

    /**
     * Creates a network offering.
     *
     * @param string $traffictype the traffic type for the network offering. Supported type in current release is GUEST only
     * @param string $displaytext the display text of the network offering
     * @param string $name the name of the network offering
     * @param string $guestiptype guest type of the network offering: Shared or Isolated
     * @param string $supportedservices services supported by the network offering
     * @param array  $optArgs {
     *     @type string $serviceofferingid the service offering ID used by virtual router provider
     *     @type string $serviceproviderlist provider to service mapping. If not specified, the provider for the service will be mapped to the default provider on the physical network
     *     @type string $specifyipranges true if network offering supports specifying ip ranges; defaulted to false if not specified
     *     @type string $keepaliveenabled if true keepalive will be turned on in the loadbalancer. At the time of writing this has only an effect on haproxy; the mode http and httpclose options are unset in the haproxy conf file.
     *     @type string $conservemode true if the network offering is IP conserve mode enabled
     *     @type string $tags the tags for the network offering.
     *     @type string $maxconnections maximum number of concurrent connections supported by the network offering
     *     @type string $details Network offering details in key/value pairs. Supported keys are internallbprovider/publiclbprovider with service provider as a value
     *     @type string $networkrate data transfer rate in megabits per second allowed
     *     @type string $ispersistent true if network offering supports persistent networks; defaulted to false if not specified
     *     @type string $servicecapabilitylist desired service capabilities as part of network offering
     *     @type string $availability the availability of network offering. Default value is Optional
     *     @type string $specifyvlan true if network offering supports vlans
     *     @type string $egressdefaultpolicy true if guest network default egress policy is allow; false if default egress policy is deny
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createNetworkOffering($traffictype, $displaytext, $name, $guestiptype, $supportedservices, array $optArgs = []) {
        if (empty($traffictype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'traffictype'), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($guestiptype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'guestiptype'), MISSING_ARGUMENT);
        }
        if (empty($supportedservices)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'supportedservices'), MISSING_ARGUMENT);
        }
        return $this->request('createNetworkOffering',
            [
                'traffictype' => $traffictype,
                'displaytext' => $displaytext,
                'name' => $name,
                'guestiptype' => $guestiptype,
                'supportedservices' => $supportedservices
            ] + $optArgs
        );
    }

    /**
     * Deletes affinity group
     *
     * @param array  $optArgs {
     *     @type string $account the account of the affinity group. Must be specified with domain ID
     *     @type string $name The name of the affinity group. Mutually exclusive with ID parameter
     *     @type string $domainid the domain ID of account owning the affinity group
     *     @type string $projectid the project of the affinity group
     *     @type string $id The ID of the affinity group. Mutually exclusive with name parameter
     * }
     * @return \stdClass
     */
    public function deleteAffinityGroup(array $optArgs = []) {
        return $this->request('deleteAffinityGroup',
            $optArgs
        );
    }

    /**
     * Copies an ISO from one zone to another.
     *
     * @param string $id Template ID.
     * @param string $destzoneid ID of the zone the template is being copied to.
     * @param array  $optArgs {
     *     @type string $sourcezoneid ID of the zone the template is currently hosted on. If not specified and template is cross-zone, then we will sync this template to region wide image store.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function copyIso($id, $destzoneid, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($destzoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'destzoneid'), MISSING_ARGUMENT);
        }
        return $this->request('copyIso',
            [
                'id' => $id,
                'destzoneid' => $destzoneid
            ] + $optArgs
        );
    }

    /**
     * Dedicates a Public IP range to an account
     *
     * @param string $id the id of the VLAN IP range
     * @param string $domainid domain ID of the account owning a VLAN
     * @param array  $optArgs {
     *     @type string $projectid project who will own the VLAN
     *     @type string $account account who will own the VLAN
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function dedicatePublicIpRange($id, $domainid, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        return $this->request('dedicatePublicIpRange',
            [
                'id' => $id,
                'domainid' => $domainid
            ] + $optArgs
        );
    }

    /**
     * Adds a guest OS name to hypervisor OS name mapping
     *
     * @param string $hypervisorversion Hypervisor version to create the mapping for. Use 'default' for default versions
     * @param string $osnameforhypervisor OS name specific to the hypervisor
     * @param string $hypervisor Hypervisor type. One of : XenServer, KVM, VMWare
     * @param array  $optArgs {
     *     @type string $ostypeid UUID of Guest OS type. Either the UUID or Display Name must be passed
     *     @type string $osdisplayname Display Name of Guest OS standard type. Either Display Name or UUID must be passed
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addGuestOsMapping($hypervisorversion, $osnameforhypervisor, $hypervisor, array $optArgs = []) {
        if (empty($hypervisorversion)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hypervisorversion'), MISSING_ARGUMENT);
        }
        if (empty($osnameforhypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'osnameforhypervisor'), MISSING_ARGUMENT);
        }
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hypervisor'), MISSING_ARGUMENT);
        }
        return $this->request('addGuestOsMapping',
            [
                'hypervisorversion' => $hypervisorversion,
                'osnameforhypervisor' => $osnameforhypervisor,
                'hypervisor' => $hypervisor
            ] + $optArgs
        );
    }

    /**
     * Lists all children domains belonging to a specified domain
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $id list children domain by parent domain ID.
     *     @type string $name list children domains by name
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $isrecursive to return the entire tree, use the value "true". To return the first level children, use the value "false".
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listDomainChildren(array $optArgs = []) {
        return $this->request('listDomainChildren',
            $optArgs
        );
    }

    /**
     * Uploads a data disk.
     *
     * @param string $name the name of the volume
     * @param string $zoneid the ID of the zone the volume is to be hosted on
     * @param string $format the format for the volume. Possible values include QCOW2, OVA, and VHD.
     * @param string $url the URL of where the volume is hosted. Possible URL include http:// and https://
     * @param array  $optArgs {
     *     @type string $checksum the MD5 checksum value of this volume
     *     @type string $diskofferingid the ID of the disk offering. This must be a custom sized offering since during uploadVolume volume size is unknown.
     *     @type string $projectid Upload volume for the project
     *     @type string $domainid an optional domainId. If the account parameter is used, domainId must also be used.
     *     @type string $imagestoreuuid Image store uuid
     *     @type string $account an optional accountName. Must be used with domainId.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function uploadVolume($name, $zoneid, $format, $url, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($format)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'format'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        return $this->request('uploadVolume',
            [
                'name' => $name,
                'zoneid' => $zoneid,
                'format' => $format,
                'url' => $url
            ] + $optArgs
        );
    }

    /**
     * Lists autoscale vm profiles.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $id the ID of the autoscale vm profile
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $templateid the templateid of the autoscale vm profile
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $zoneid availability zone for the auto deployed virtual machine
     *     @type string $pagesize the number of entries per page
     *     @type string $serviceofferingid list profiles by service offering id
     *     @type string $page the page number of the result set
     *     @type string $projectid list objects by project
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $otherdeployparams the otherdeployparameters of the autoscale vm profile
     * }
     * @return \stdClass
     */
    public function listAutoScaleVmProfiles(array $optArgs = []) {
        return $this->request('listAutoScaleVmProfiles',
            $optArgs
        );
    }

    /**
     * Creates a load balancer stickiness policy
     *
     * @param string $name name of the load balancer stickiness policy
     * @param string $methodname name of the load balancer stickiness policy method, possible values can be obtained from listNetworks API
     * @param string $lbruleid the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $param param list. Example: param[0].name=cookiename&param[0].value=LBCookie
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $description the description of the load balancer stickiness policy
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createLBStickinessPolicy($name, $methodname, $lbruleid, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($methodname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'methodname'), MISSING_ARGUMENT);
        }
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbruleid'), MISSING_ARGUMENT);
        }
        return $this->request('createLBStickinessPolicy',
            [
                'name' => $name,
                'methodname' => $methodname,
                'lbruleid' => $lbruleid
            ] + $optArgs
        );
    }

    /**
     * Attempts Migration of a VM with its volumes to a different host
     *
     * @param string $hostid Destination Host ID to migrate VM to.
     * @param string $virtualmachineid the ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $migrateto Map of pool to which each volume should be migrated (volume/pool pair)
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function migrateVirtualMachineWithVolume($hostid, $virtualmachineid, array $optArgs = []) {
        if (empty($hostid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostid'), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'virtualmachineid'), MISSING_ARGUMENT);
        }
        return $this->request('migrateVirtualMachineWithVolume',
            [
                'hostid' => $hostid,
                'virtualmachineid' => $virtualmachineid
            ] + $optArgs
        );
    }

    /**
     * Stops a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $forced Force stop the VM (vm is marked as Stopped even when command fails to be send to the backend).  The caller knows the VM is stopped.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function stopVirtualMachine($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('stopVirtualMachine',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Adds metric counter
     *
     * @param string $name Name of the counter.
     * @param string $value Value of the counter e.g. oid in case of snmp.
     * @param string $source Source of the counter.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createCounter($name, $value, $source) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($value)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'value'), MISSING_ARGUMENT);
        }
        if (empty($source)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'source'), MISSING_ARGUMENT);
        }
        return $this->request('createCounter',
            [
                'name' => $name,
                'value' => $value,
                'source' => $source
            ]
        );
    }

    /**
     * Creates an instant snapshot of a volume.
     *
     * @param string $volumeid The ID of the disk volume
     * @param array  $optArgs {
     *     @type string $account The account of the snapshot. The account parameter must be used with the domainId parameter.
     *     @type string $policyid policy id of the snapshot, if this is null, then use MANUAL_POLICY.
     *     @type string $name the name of the snapshot
     *     @type string $quiescevm quiesce vm if true
     *     @type string $domainid The domain ID of the snapshot. If used with the account parameter, specifies a domain for the account associated with the disk volume.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createSnapshot($volumeid, array $optArgs = []) {
        if (empty($volumeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'volumeid'), MISSING_ARGUMENT);
        }
        return $this->request('createSnapshot',
            [
                'volumeid' => $volumeid
            ] + $optArgs
        );
    }

    /**
     * Lists accounts and provides detailed account information for listed accounts
     *
     * @param array  $optArgs {
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $pagesize the number of entries per page
     *     @type string $name list account by account name
     *     @type string $iscleanuprequired list accounts by cleanuprequired attribute (values are true or false)
     *     @type string $page the page number of the result set
     *     @type string $id list account by account ID
     *     @type string $accounttype list accounts by account type. Valid account types are 1 (admin), 2 (domain-admin), and 0 (user).
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $state list accounts by state. Valid states are enabled, disabled, and locked.
     *     @type string $domainid list only resources belonging to the domain specified
     * }
     * @return \stdClass
     */
    public function listAccounts(array $optArgs = []) {
        return $this->request('listAccounts',
            $optArgs
        );
    }

    /**
     * Updates an ISO file.
     *
     * @param string $id the ID of the image file
     * @param array  $optArgs {
     *     @type string $bootable true if image is bootable, false otherwise; available only for updateIso API
     *     @type string $isrouting true if the template type is routing i.e., if template is used to deploy router
     *     @type string $requireshvm true if the template requres HVM, false otherwise; available only for updateTemplate API
     *     @type string $sortkey sort key of the template, integer
     *     @type string $details Details in key/value pairs using format details[i].keyname=keyvalue. Example: details[0].hypervisortoolsversion=xenserver61
     *     @type string $ostypeid the ID of the OS type that best represents the OS of this image.
     *     @type string $format the format for the image
     *     @type string $name the name of the image file
     *     @type string $passwordenabled true if the image supports the password reset feature; default is false
     *     @type string $displaytext the display text of the image
     *     @type string $isdynamicallyscalable true if template/ISO contains XS/VMWare tools inorder to support dynamic scaling of VM cpu/memory
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateIso($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateIso',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * list portable IP ranges
     *
     * @param array  $optArgs {
     *     @type string $id Id of the portable ip range
     *     @type string $regionid Id of a Region
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listPortableIpRanges(array $optArgs = []) {
        return $this->request('listPortableIpRanges',
            $optArgs
        );
    }

    /**
     * List the IP forwarding rules
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $ipaddressid list the rule belonging to this public IP address
     *     @type string $projectid list objects by project
     *     @type string $id Lists rule with the specified ID.
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $virtualmachineid Lists all rules applied to the specified VM.
     * }
     * @return \stdClass
     */
    public function listIpForwardingRules(array $optArgs = []) {
        return $this->request('listIpForwardingRules',
            $optArgs
        );
    }

    /**
     * Configures an ovs element.
     *
     * @param string $id the ID of the ovs provider
     * @param string $enabled Enabled/Disabled the service provider
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function configureOvsElement($id, $enabled) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($enabled)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'enabled'), MISSING_ARGUMENT);
        }
        return $this->request('configureOvsElement',
            [
                'id' => $id,
                'enabled' => $enabled
            ]
        );
    }

    /**
     * Updates a network
     *
     * @param string $id the ID of the network
     * @param array  $optArgs {
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $changecidr Force update even if CIDR type is different
     *     @type string $networkdomain network domain
     *     @type string $name the new name for the network
     *     @type string $displaytext the new display text for the network
     *     @type string $guestvmcidr CIDR for guest VMs, CloudStack allocates IPs to guest VMs only from this CIDR
     *     @type string $networkofferingid network offering ID
     *     @type string $displaynetwork an optional field, whether to the display the network to the end user or not.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateNetwork($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateNetwork',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Destroys a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $expunge If true is passed, the vm is expunged immediately. False by default.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function destroyVirtualMachine($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('destroyVirtualMachine',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Dedicates a host.
     *
     * @param string $hostid the ID of the host to update
     * @param string $domainid the ID of the containing domain
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function dedicateHost($hostid, $domainid, array $optArgs = []) {
        if (empty($hostid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostid'), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        return $this->request('dedicateHost',
            [
                'hostid' => $hostid,
                'domainid' => $domainid
            ] + $optArgs
        );
    }

    /**
     * Lists host tags
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listHostTags(array $optArgs = []) {
        return $this->request('listHostTags',
            $optArgs
        );
    }

    /**
     * Adds a Region
     *
     * @param string $endpoint Region service endpoint
     * @param string $id Id of the Region
     * @param string $name Name of the region
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addRegion($endpoint, $id, $name) {
        if (empty($endpoint)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'endpoint'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        return $this->request('addRegion',
            [
                'endpoint' => $endpoint,
                'id' => $id,
                'name' => $name
            ]
        );
    }

    /**
     * Creates a disk offering.
     *
     * @param string $name name of the disk offering
     * @param string $displaytext alternate display text of the disk offering
     * @param array  $optArgs {
     *     @type string $miniops min iops of the disk offering
     *     @type string $iopsreadrate io requests read rate of the disk offering
     *     @type string $storagetype the storage type of the disk offering. Values are local and shared.
     *     @type string $displayoffering an optional field, whether to display the offering to the end user or not.
     *     @type string $iopswriterate io requests write rate of the disk offering
     *     @type string $hypervisorsnapshotreserve Hypervisor snapshot reserve space as a percent of a volume (for managed storage using Xen or VMware)
     *     @type string $customized whether disk offering size is custom or not
     *     @type string $tags tags for the disk offering
     *     @type string $byteswriterate bytes write rate of the disk offering
     *     @type string $disksize size of the disk offering in GB (1GB = 1,073,741,824 bytes)
     *     @type string $provisioningtype provisioning type used to create volumes. Valid values are thin, sparse, fat.
     *     @type string $bytesreadrate bytes read rate of the disk offering
     *     @type string $customizediops whether disk offering iops is custom or not
     *     @type string $maxiops max iops of the disk offering
     *     @type string $domainid the ID of the containing domain, null for public offerings
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createDiskOffering($name, $displaytext, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'displaytext'), MISSING_ARGUMENT);
        }
        return $this->request('createDiskOffering',
            [
                'name' => $name,
                'displaytext' => $displaytext
            ] + $optArgs
        );
    }

    /**
     * lists network that are using a netscaler load balancer device
     *
     * @param string $lbdeviceid netscaler load balancer device ID
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listNetscalerLoadBalancerNetworks($lbdeviceid, array $optArgs = []) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'lbdeviceid'), MISSING_ARGUMENT);
        }
        return $this->request('listNetscalerLoadBalancerNetworks',
            [
                'lbdeviceid' => $lbdeviceid
            ] + $optArgs
        );
    }

    /**
     * Retrieves a cloud identifier.
     *
     * @param string $userid the user ID for the cloud identifier
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function getCloudIdentifier($userid) {
        if (empty($userid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'userid'), MISSING_ARGUMENT);
        }
        return $this->request('getCloudIdentifier',
            [
                'userid' => $userid
            ]
        );
    }

    /**
     * Deletes an external firewall appliance.
     *
     * @param string $id Id of the external firewall appliance.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteExternalFirewall($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteExternalFirewall',
            [
                'id' => $id
            ]
        );
    }

    /**
     * List internal LB VMs.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $name the name of the Internal LB VM
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $podid the Pod ID of the Internal LB VM
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $zoneid the Zone ID of the Internal LB VM
     *     @type string $vpcid List Internal LB VMs by VPC
     *     @type string $state the state of the Internal LB VM
     *     @type string $page the page number of the result set
     *     @type string $networkid list by network id
     *     @type string $id the ID of the Internal LB VM
     *     @type string $projectid list objects by project
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $pagesize the number of entries per page
     *     @type string $forvpc if true is passed for this parameter, list only VPC Internal LB VMs
     *     @type string $hostid the host ID of the Internal LB VM
     * }
     * @return \stdClass
     */
    public function listInternalLoadBalancerVMs(array $optArgs = []) {
        return $this->request('listInternalLoadBalancerVMs',
            $optArgs
        );
    }

    /**
     * Creates a firewall rule for a given IP address
     *
     * @param string $protocol the protocol for the firewall rule. Valid values are TCP/UDP/ICMP.
     * @param string $ipaddressid the IP address id of the port forwarding rule
     * @param array  $optArgs {
     *     @type string $cidrlist the CIDR list to forward traffic from
     *     @type string $type type of firewallrule: system/user
     *     @type string $icmpcode error code for this icmp message
     *     @type string $endport the ending port of firewall rule
     *     @type string $startport the starting port of firewall rule
     *     @type string $fordisplay an optional field, whether to the display the rule to the end user or not
     *     @type string $icmptype type of the ICMP message being sent
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function createFirewallRule($protocol, $ipaddressid, array $optArgs = []) {
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'protocol'), MISSING_ARGUMENT);
        }
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'ipaddressid'), MISSING_ARGUMENT);
        }
        return $this->request('createFirewallRule',
            [
                'protocol' => $protocol,
                'ipaddressid' => $ipaddressid
            ] + $optArgs
        );
    }

    /**
     * Recalculate and update resource count for an account or domain.
     *
     * @param string $domainid If account parameter specified then updates resource counts for a specified account in this domain else update resource counts for all accounts & child domains in specified domain.
     * @param array  $optArgs {
     *     @type string $projectid Update resource limits for project
     *     @type string $resourcetype Type of resource to update. If specifies valid values are 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 and 11. If not specified will update all resource counts0 - Instance. Number of instances a user can create. 1 - IP. Number of public IP addresses a user can own. 2 - Volume. Number of disk volumes a user can create. 3 - Snapshot. Number of snapshots a user can create. 4 - Template. Number of templates that a user can register/create. 5 - Project. Number of projects that a user can create. 6 - Network. Number of guest network a user can create. 7 - VPC. Number of VPC a user can create. 8 - CPU. Total number of CPU cores a user can use. 9 - Memory. Total Memory (in MB) a user can use. 10 - PrimaryStorage. Total primary storage space (in GiB) a user can use. 11 - SecondaryStorage. Total secondary storage space (in GiB) a user can use.
     *     @type string $account Update resource count for a specified account. Must be used with the domainId parameter.
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateResourceCount($domainid, array $optArgs = []) {
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        return $this->request('updateResourceCount',
            [
                'domainid' => $domainid
            ] + $optArgs
        );
    }

    /**
     * Adds a network serviceProvider to a physical network
     *
     * @param string $name the name for the physical network service provider
     * @param string $physicalnetworkid the Physical Network ID to add the provider to
     * @param array  $optArgs {
     *     @type string $servicelist the list of services to be enabled for this physical network service provider
     *     @type string $destinationphysicalnetworkid the destination Physical Network ID to bridge to
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addNetworkServiceProvider($name, $physicalnetworkid, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        return $this->request('addNetworkServiceProvider',
            [
                'name' => $name,
                'physicalnetworkid' => $physicalnetworkid
            ] + $optArgs
        );
    }

    /**
     * Reboots a system VM.
     *
     * @param string $id The ID of the system virtual machine
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function rebootSystemVm($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('rebootSystemVm',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Revert VM from a vmsnapshot.
     *
     * @param string $vmsnapshotid The ID of the vm snapshot
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function revertToVMSnapshot($vmsnapshotid) {
        if (empty($vmsnapshotid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'vmsnapshotid'), MISSING_ARGUMENT);
        }
        return $this->request('revertToVMSnapshot',
            [
                'vmsnapshotid' => $vmsnapshotid
            ]
        );
    }

    /**
     * Locks a user account
     *
     * @param string $id Locks user by user ID.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function lockUser($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('lockUser',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Marks a default zone for this account
     *
     * @param string $domainid Marks the account that belongs to the specified domain.
     * @param string $zoneid The Zone ID with which the account is to be marked.
     * @param string $account Name of the account that is to be marked.
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function markDefaultZoneForAccount($domainid, $zoneid, $account) {
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'domainid'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'account'), MISSING_ARGUMENT);
        }
        return $this->request('markDefaultZoneForAccount',
            [
                'domainid' => $domainid,
                'zoneid' => $zoneid,
                'account' => $account
            ]
        );
    }

    /**
     * Add a new Ldap Configuration
     *
     * @param string $port Port
     * @param string $hostname Hostname
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addLdapConfiguration($port, $hostname) {
        if (empty($port)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'port'), MISSING_ARGUMENT);
        }
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'hostname'), MISSING_ARGUMENT);
        }
        return $this->request('addLdapConfiguration',
            [
                'port' => $port,
                'hostname' => $hostname
            ]
        );
    }

    /**
     * List the virtual machines owned by the account.
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $templateid list vms by template
     *     @type string $id the ID of the virtual machine
     *     @type string $storageid the storage ID where vm's volumes belong to
     *     @type string $keypair list vms by ssh keypair name
     *     @type string $pagesize the number of entries per page
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $hostid the host ID
     *     @type string $hostid the host ID
     *     @type string $networkid list by network id
     *     @type string $displayvm list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $vpcid list vms by vpc
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $forvirtualnetwork list by network type; true if need to list vms using Virtual Network, false otherwise
     *     @type string $keyword List by keyword
     *     @type string $state state of the virtual machine. Possible values are: Running, Stopped, Present, Destroyed, Expunged. Present is used for the state equal not destroyed.
     *     @type string $zoneid the availability zone ID
     *     @type string $isoid list vms by iso
     *     @type string $ids the IDs of the virtual machines, mutually exclusive with id
     *     @type string $projectid list objects by project
     *     @type string $groupid the group ID
     *     @type string $affinitygroupid list vms by affinity group
     *     @type string $podid the pod ID
     *     @type string $podid the pod ID
     *     @type string $page the page number of the result set
     *     @type string $hypervisor the target hypervisor for the template
     *     @type string $details comma separated list of host details requested, value can be a list of [all, group, nics, stats, secgrp, tmpl, servoff, diskoff, iso, volume, min, affgrp]. If no parameter is passed in, the details will be defaulted to all
     *     @type string $serviceofferingid list by the service offering
     *     @type string $userid the user ID that created the VM and is under the account that owns the VM
     *     @type string $storageid the storage ID where vm's volumes belong to
     *     @type string $name name of the virtual machine (a substring match is made against the parameter value, data for all matching VMs will be returned)
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     * }
     * @return \stdClass
     */
    public function listVirtualMachines(array $optArgs = []) {
        return $this->request('listVirtualMachines',
            $optArgs
        );
    }

    /**
     * Restarts a VPC
     *
     * @param string $id the id of the VPC
     * @param array  $optArgs {
     *     @type string $makeredundant Turn a single VPC into a redundant one.
     *     @type string $cleanup If cleanup old network elements
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function restartVPC($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('restartVPC',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Replaces ACL associated with a network or private gateway
     *
     * @param string $aclid the ID of the network ACL
     * @param array  $optArgs {
     *     @type string $networkid the ID of the network
     *     @type string $gatewayid the ID of the private gateway
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function replaceNetworkACLList($aclid, array $optArgs = []) {
        if (empty($aclid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'aclid'), MISSING_ARGUMENT);
        }
        return $this->request('replaceNetworkACLList',
            [
                'aclid' => $aclid
            ] + $optArgs
        );
    }

    /**
     * Generates an alert
     *
     * @param string $name Name of the alert
     * @param string $description Alert description
     * @param string $type Type of the alert
     * @param array  $optArgs {
     *     @type string $podid Pod id for which alert is generated
     *     @type string $zoneid Zone id for which alert is generated
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function generateAlert($name, $description, $type, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($description)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'description'), MISSING_ARGUMENT);
        }
        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'type'), MISSING_ARGUMENT);
        }
        return $this->request('generateAlert',
            [
                'name' => $name,
                'description' => $description,
                'type' => $type
            ] + $optArgs
        );
    }

    /**
     * Lists all egress firewall rules for network ID.
     *
     * @param array  $optArgs {
     *     @type string $projectid list objects by project
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $page the page number of the result set
     *     @type string $id Lists rule with the specified ID.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $networkid the network ID for the egress firewall services
     *     @type string $ipaddressid the ID of IP address of the firewall services
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     * }
     * @return \stdClass
     */
    public function listEgressFirewallRules(array $optArgs = []) {
        return $this->request('listEgressFirewallRules',
            $optArgs
        );
    }

    /**
     * Scale the service offering for a system vm (console proxy or secondary storage). The system vm must be in a "Stopped" state for this command to take effect.
     *
     * @param string $serviceofferingid the service offering ID to apply to the system vm
     * @param string $id The ID of the system vm
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu, memory and cpunumber. example details[i].name=value
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function scaleSystemVm($serviceofferingid, $id, array $optArgs = []) {
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'serviceofferingid'), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('scaleSystemVm',
            [
                'serviceofferingid' => $serviceofferingid,
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists hosts.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $podid the Pod ID for the host
     *     @type string $hahost if true, list only hosts dedicated to HA
     *     @type string $page the page number of the result set
     *     @type string $details comma separated list of host details requested, value can be a list of [ min, all, capacity, events, stats]
     *     @type string $state the state of the host
     *     @type string $resourcestate list hosts by resource state. Resource state represents current state determined by admin of host, valule can be one of [Enabled, Disabled, Unmanaged, PrepareForMaintenance, ErrorInMaintenance, Maintenance, Error]
     *     @type string $id the id of the host
     *     @type string $hypervisor hypervisor type of host: XenServer,KVM,VMware,Hyperv,BareMetal,Simulator
     *     @type string $type the host type
     *     @type string $virtualmachineid lists hosts in the same cluster as this VM and flag hosts with enough CPU/RAm to host this VM
     *     @type string $name the name of the host
     *     @type string $clusterid lists hosts existing in particular cluster
     *     @type string $pagesize the number of entries per page
     *     @type string $zoneid the Zone ID for the host
     * }
     * @return \stdClass
     */
    public function listHosts(array $optArgs = []) {
        return $this->request('listHosts',
            $optArgs
        );
    }

    /**
     * Updates an existing autoscale vm group.
     *
     * @param string $id the ID of the autoscale group
     * @param array  $optArgs {
     *     @type string $interval the frequency at which the conditions have to be evaluated
     *     @type string $maxmembers the maximum number of members in the vmgroup, The number of instances in the vm group will be equal to or less than this number.
     *     @type string $fordisplay an optional field, whether to the display the group to the end user or not
     *     @type string $customid an optional field, in case you want to set a custom id to the resource. Allowed to Root Admins only
     *     @type string $scaleuppolicyids list of scaleup autoscale policies
     *     @type string $minmembers the minimum number of members in the vmgroup, the number of instances in the vm group will be equal to or more than this number.
     *     @type string $scaledownpolicyids list of scaledown autoscale policies
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateAutoScaleVmGroup($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateAutoScaleVmGroup',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Updates a template visibility permissions. A public template is visible to all accounts within the same domain. A private template is visible only to the owner of the template. A priviledged template is a private template with account permissions added. Only accounts specified under the template permissions are visible to them.
     *
     * @param string $id the template ID
     * @param array  $optArgs {
     *     @type string $accounts a comma delimited list of accounts. If specified, "op" parameter has to be passed in.
     *     @type string $ispublic true for public template/iso, false for private templates/isos
     *     @type string $isfeatured true for featured template/iso, false otherwise
     *     @type string $projectids a comma delimited list of projects. If specified, "op" parameter has to be passed in.
     *     @type string $isextractable true if the template/iso is extractable, false other wise. Can be set only by root admin
     *     @type string $op permission operator (add, remove, reset)
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateTemplatePermissions($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateTemplatePermissions',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists all VLAN IP ranges.
     *
     * @param array  $optArgs {
     *     @type string $account the account with which the VLAN IP range is associated. Must be used with the domainId parameter.
     *     @type string $physicalnetworkid physical network id of the VLAN IP range
     *     @type string $networkid network id of the VLAN IP range
     *     @type string $forvirtualnetwork true if VLAN is of Virtual type, false if Direct
     *     @type string $keyword List by keyword
     *     @type string $vlan the ID or VID of the VLAN. Default is an "untagged" VLAN.
     *     @type string $projectid project who will own the VLAN
     *     @type string $zoneid the Zone ID of the VLAN IP range
     *     @type string $pagesize the number of entries per page
     *     @type string $id the ID of the VLAN IP range
     *     @type string $podid the Pod ID of the VLAN IP range
     *     @type string $page the page number of the result set
     *     @type string $domainid the domain ID with which the VLAN IP range is associated.  If used with the account parameter, returns all VLAN IP ranges for that account in the specified domain.
     * }
     * @return \stdClass
     */
    public function listVlanIpRanges(array $optArgs = []) {
        return $this->request('listVlanIpRanges',
            $optArgs
        );
    }

    /**
     * list baremetal rack configuration
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     * }
     * @return \stdClass
     */
    public function listBaremetalRct(array $optArgs = []) {
        return $this->request('listBaremetalRct',
            $optArgs
        );
    }

    /**
     * Lists physical networks
     *
     * @param array  $optArgs {
     *     @type string $id list physical network by id
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $zoneid the Zone ID for the physical network
     *     @type string $name search by name
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listPhysicalNetworks(array $optArgs = []) {
        return $this->request('listPhysicalNetworks',
            $optArgs
        );
    }

    /**
     * List a storage network IP range.
     *
     * @param array  $optArgs {
     *     @type string $zoneid optional parameter. Zone uuid, if specicied and both pod uuid and range uuid are absent, using it to search the range.
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $podid optional parameter. Pod uuid, if specicied and range uuid is absent, using it to search the range.
     *     @type string $id optional parameter. Storaget network IP range uuid, if specicied, using it to search the range.
     * }
     * @return \stdClass
     */
    public function listStorageNetworkIpRange(array $optArgs = []) {
        return $this->request('listStorageNetworkIpRange',
            $optArgs
        );
    }

    /**
     * Lists site to site vpn connection gateways
     *
     * @param array  $optArgs {
     *     @type string $id id of the vpn connection
     *     @type string $vpcid id of vpc
     *     @type string $fordisplay list resources by display flag; only ROOT admin is eligible to pass this parameter
     *     @type string $pagesize the number of entries per page
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $projectid list objects by project
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $keyword List by keyword
     *     @type string $domainid list only resources belonging to the domain specified
     * }
     * @return \stdClass
     */
    public function listVpnConnections(array $optArgs = []) {
        return $this->request('listVpnConnections',
            $optArgs
        );
    }

    /**
     * Deletes a host.
     *
     * @param string $id the host ID
     * @param array  $optArgs {
     *     @type string $forced Force delete the host. All HA enabled vms running on the host will be put to HA; HA disabled ones will be stopped
     *     @type string $forcedestroylocalstorage Force destroy local storage on this host. All VMs created on this local storage will be destroyed
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteHost($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteHost',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists VPC offerings
     *
     * @param array  $optArgs {
     *     @type string $isdefault true if need to list only default VPC offerings. Default value is false
     *     @type string $supportedservices list VPC offerings supporting certain services
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $name list VPC offerings by name
     *     @type string $id list VPC offerings by id
     *     @type string $displaytext list VPC offerings by display text
     *     @type string $state list VPC offerings by state
     *     @type string $page the page number of the result set
     * }
     * @return \stdClass
     */
    public function listVPCOfferings(array $optArgs = []) {
        return $this->request('listVPCOfferings',
            $optArgs
        );
    }

    /**
     * Updates a network offering.
     *
     * @param array  $optArgs {
     *     @type string $availability the availability of network offering. Default value is Required for Guest Virtual network offering; Optional for Guest Direct network offering
     *     @type string $name the name of the network offering
     *     @type string $state update state for the network offering
     *     @type string $displaytext the display text of the network offering
     *     @type string $sortkey sort key of the network offering, integer
     *     @type string $maxconnections maximum number of concurrent connections supported by the network offering
     *     @type string $keepaliveenabled if true keepalive will be turned on in the loadbalancer. At the time of writing this has only an effect on haproxy; the mode http and httpclose options are unset in the haproxy conf file.
     *     @type string $id the id of the network offering
     * }
     * @return \stdClass
     */
    public function updateNetworkOffering(array $optArgs = []) {
        return $this->request('updateNetworkOffering',
            $optArgs
        );
    }

    /**
     * Deletes a Physical Network.
     *
     * @param string $id the ID of the Physical network
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deletePhysicalNetwork($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deletePhysicalNetwork',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Deletes a vm group
     *
     * @param string $id the ID of the instance group
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteInstanceGroup($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteInstanceGroup',
            [
                'id' => $id
            ]
        );
    }

    /**
     * adds a baremetal dhcp server
     *
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $username Credentials to reach external dhcp device
     * @param string $password Credentials to reach external dhcp device
     * @param string $url URL of the external dhcp appliance.
     * @param string $dhcpservertype Type of dhcp device
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addBaremetalDhcp($physicalnetworkid, $username, $password, $url, $dhcpservertype) {
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'physicalnetworkid'), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'username'), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'password'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        if (empty($dhcpservertype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'dhcpservertype'), MISSING_ARGUMENT);
        }
        return $this->request('addBaremetalDhcp',
            [
                'physicalnetworkid' => $physicalnetworkid,
                'username' => $username,
                'password' => $password,
                'url' => $url,
                'dhcpservertype' => $dhcpservertype
            ]
        );
    }

    /**
     * Deletes VPC offering
     *
     * @param string $id the ID of the VPC offering
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteVPCOffering($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteVPCOffering',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Lists vpn users
     *
     * @param array  $optArgs {
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $username the username of the vpn user.
     *     @type string $projectid list objects by project
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $page the page number of the result set
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $id The uuid of the Vpn user
     * }
     * @return \stdClass
     */
    public function listVpnUsers(array $optArgs = []) {
        return $this->request('listVpnUsers',
            $optArgs
        );
    }

    /**
     * Updates a Pod.
     *
     * @param string $id the ID of the Pod
     * @param array  $optArgs {
     *     @type string $name the name of the Pod
     *     @type string $gateway the gateway for the Pod
     *     @type string $startip the starting IP address for the Pod
     *     @type string $allocationstate Allocation state of this cluster for allocation of new resources
     *     @type string $endip the ending IP address for the Pod
     *     @type string $netmask the netmask of the Pod
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updatePod($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updatePod',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Deletes a cluster.
     *
     * @param string $id the cluster ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteCluster($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteCluster',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Retrieves VMware DC(s) associated with a zone.
     *
     * @param string $zoneid Id of the CloudStack zone.
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function listVmwareDcs($zoneid, array $optArgs = []) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        return $this->request('listVmwareDcs',
            [
                'zoneid' => $zoneid
            ] + $optArgs
        );
    }

    /**
     * Removes an OpenDyalight controler
     *
     * @param string $id OpenDaylight Controller ID
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function deleteOpenDaylightController($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('deleteOpenDaylightController',
            [
                'id' => $id
            ]
        );
    }

    /**
     * Updates a network serviceProvider of a physical network
     *
     * @param string $id network service provider id
     * @param array  $optArgs {
     *     @type string $servicelist the list of services to be enabled for this physical network service provider
     *     @type string $state Enabled/Disabled/Shutdown the physical network service provider
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function updateNetworkServiceProvider($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('updateNetworkServiceProvider',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists storage pools available for migration of a volume.
     *
     * @param string $id the ID of the volume
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function findStoragePoolsForMigration($id, array $optArgs = []) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('findStoragePoolsForMigration',
            [
                'id' => $id
            ] + $optArgs
        );
    }

    /**
     * Lists user accounts
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $pagesize the number of entries per page
     *     @type string $state List users by state of the user account.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $username List user by the username
     *     @type string $keyword List by keyword
     *     @type string $accounttype List users by account type. Valid types include admin, domain-admin, read-only-admin, or user.
     *     @type string $page the page number of the result set
     *     @type string $id List user by ID.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     * }
     * @return \stdClass
     */
    public function listUsers(array $optArgs = []) {
        return $this->request('listUsers',
            $optArgs
        );
    }

    /**
     * Upgrades router to use newer template
     *
     * @param array  $optArgs {
     *     @type string $podid upgrades all routers within the specified pod
     *     @type string $id upgrades router with the specified Id
     *     @type string $domainid upgrades all routers owned by the specified domain
     *     @type string $account upgrades all routers owned by the specified account
     *     @type string $clusterid upgrades all routers within the specified cluster
     *     @type string $zoneid upgrades all routers within the specified zone
     * }
     * @return \stdClass
     */
    public function upgradeRouterTemplate(array $optArgs = []) {
        return $this->request('upgradeRouterTemplate',
            $optArgs
        );
    }

    /**
     * Lists all network services provided by CloudStack or for the given Provider.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $provider network service provider name
     *     @type string $pagesize the number of entries per page
     *     @type string $service network service name to list providers and capabilities of
     *     @type string $keyword List by keyword
     * }
     * @return \stdClass
     */
    public function listSupportedNetworkServices(array $optArgs = []) {
        return $this->request('listSupportedNetworkServices',
            $optArgs
        );
    }

    /**
     * Adds stratosphere ssp server
     *
     * @param string $name stratosphere ssp api name
     * @param string $zoneid the zone ID
     * @param string $url stratosphere ssp server url
     * @param array  $optArgs {
     *     @type string $tenantuuid stratosphere ssp tenant uuid
     *     @type string $password stratosphere ssp api password
     *     @type string $username stratosphere ssp api username
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addStratosphereSsp($name, $zoneid, $url, array $optArgs = []) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'name'), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'zoneid'), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'url'), MISSING_ARGUMENT);
        }
        return $this->request('addStratosphereSsp',
            [
                'name' => $name,
                'zoneid' => $zoneid,
                'url' => $url
            ] + $optArgs
        );
    }

    /**
     * Add a new guest OS type
     *
     * @param string $osdisplayname Unique display name for Guest OS
     * @param string $oscategoryid ID of Guest OS category
     * @param array  $optArgs {
     *     @type string $name Optional name for Guest OS
     * }
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function addGuestOs($osdisplayname, $oscategoryid, array $optArgs = []) {
        if (empty($osdisplayname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'osdisplayname'), MISSING_ARGUMENT);
        }
        if (empty($oscategoryid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'oscategoryid'), MISSING_ARGUMENT);
        }
        return $this->request('addGuestOs',
            [
                'osdisplayname' => $osdisplayname,
                'oscategoryid' => $oscategoryid
            ] + $optArgs
        );
    }

    /**
     * Lists all available ISO files.
     *
     * @param array  $optArgs {
     *     @type string $id list ISO by ID
     *     @type string $pagesize the number of entries per page
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $projectid list objects by project
     *     @type string $hypervisor the hypervisor for which to restrict the search
     *     @type string $page the page number of the result set
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $zoneid the ID of the zone
     *     @type string $name list all ISOs by name
     *     @type string $bootable true if the ISO is bootable, false otherwise
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $showremoved show removed ISOs as well
     *     @type string $ispublic true if the ISO is publicly available to all users, false otherwise.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set to true - list resources that the caller is authorized to see. Default value is false
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $isready true if this ISO is ready to be deployed
     *     @type string $isofilter possible values are "featured", "self", "selfexecutable","sharedexecutable","executable", and "community". * featured : templates that have been marked as featured and public. * self : templates that have been registered or created by the calling user. * selfexecutable : same as self, but only returns templates that can be used to deploy a new VM. * sharedexecutable : templates ready to be deployed that have been granted to the calling user by another user. * executable : templates that are owned by the calling user, or public templates, that can be used to deploy a VM. * community : templates that have been marked as public but not featured. * all : all templates (only usable by admins).
     * }
     * @return \stdClass
     */
    public function listIsos(array $optArgs = []) {
        return $this->request('listIsos',
            $optArgs
        );
    }

    /**
     * revert a volume snapshot.
     *
     * @param string $id The ID of the snapshot
     * @throws \CloudStackClientException
     * @return \stdClass
     */
    public function revertSnapshot($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, 'id'), MISSING_ARGUMENT);
        }
        return $this->request('revertSnapshot',
            [
                'id' => $id
            ]
        );
    }

}
