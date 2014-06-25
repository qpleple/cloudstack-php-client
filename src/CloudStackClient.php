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
 * Pull in base client and exceptoion classes
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
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $networkid list network ACL Items by network Id
     *     @type string $id Lists network ACL Item with the specified ID
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $action list network ACL Items by Action
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $traffictype list network ACL Items by traffic type - Ingress or Egress
     *     @type string $protocol list network ACL Items by Protocol
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $aclid list network ACL Items by ACL Id
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $projectid list objects by project
     * }
     */
    public function listNetworkACLs(array $optArgs = array()) {
        return $this->request("listNetworkACLs",
            $optArgs
        );
    }

    /**
     * Creates a condition
     *
     * @param string $counterid ID of the Counter.
     * @param string $threshold Threshold value.
     * @param string $relationaloperator Relational Operator to be used with threshold.
     * @param array  $optArgs {
     *     @type string $domainid the domain ID of the account.
     *     @type string $account the account of the condition. Must be used with the domainId parameter.
     * }
     */
    public function createCondition($counterid, $threshold, $relationaloperator, array $optArgs = array()) {
        if (empty($counterid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "counterid"), MISSING_ARGUMENT);
        }
        if (empty($threshold)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "threshold"), MISSING_ARGUMENT);
        }
        if (empty($relationaloperator)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "relationaloperator"), MISSING_ARGUMENT);
        }
        return $this->request("createCondition",
            array_merge(array(
                'counterid' => $counterid,
                'threshold' => $threshold,
                'relationaloperator' => $relationaloperator
            ), $optArgs)
        );
    }

    /**
     * Reconnects a host.
     *
     * @param string $id the host ID
     */
    public function reconnectHost($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("reconnectHost",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Copies a template from one zone to another.
     *
     * @param string $id Template ID.
     * @param string $destzoneid ID of the zone the template is being copied to.
     * @param array  $optArgs {
     *     @type string $sourcezoneid ID of the zone the template is currently hosted on. If not specified and
     *     template is cross-zone, then we will sync this template to region wide image
     *     store
     * }
     */
    public function copyTemplate($id, $destzoneid, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($destzoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "destzoneid"), MISSING_ARGUMENT);
        }
        return $this->request("copyTemplate",
            array_merge(array(
                'id' => $id,
                'destzoneid' => $destzoneid
            ), $optArgs)
        );
    }

    /**
     * List routers.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $vpcid List networks by VPC
     *     @type string $projectid list objects by project
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $zoneid the Zone ID of the router
     *     @type string $forvpc if true is passed for this parameter, list only VPC routers
     *     @type string $hostid the host ID of the router
     *     @type string $version list virtual router elements by version
     *     @type string $state the state of the router
     *     @type string $name the name of the router
     *     @type string $pagesize the number of entries per page
     *     @type string $clusterid the cluster ID of the router
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $id the ID of the disk router
     *     @type string $podid the Pod ID of the router
     *     @type string $networkid list by network id
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     * }
     */
    public function listRouters(array $optArgs = array()) {
        return $this->request("listRouters",
            $optArgs
        );
    }

    /**
     * lists network that are using a nicira nvp device
     *
     * @param string $nvpdeviceid nicira nvp device ID
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     */
    public function listNiciraNvpDeviceNetworks($nvpdeviceid, array $optArgs = array()) {
        if (empty($nvpdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nvpdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("listNiciraNvpDeviceNetworks",
            array_merge(array(
                'nvpdeviceid' => $nvpdeviceid
            ), $optArgs)
        );
    }

    /**
     * Adds VM to specified network by creating a NIC
     *
     * @param string $networkid Network ID
     * @param string $virtualmachineid Virtual Machine ID
     * @param array  $optArgs {
     *     @type string $ipaddress IP Address for the new network
     * }
     */
    public function addNicToVirtualMachine($networkid, $virtualmachineid, array $optArgs = array()) {
        if (empty($networkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkid"), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("addNicToVirtualMachine",
            array_merge(array(
                'networkid' => $networkid,
                'virtualmachineid' => $virtualmachineid
            ), $optArgs)
        );
    }

    /**
     * Extracts volume
     *
     * @param string $zoneid the ID of the zone where the volume is located
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param string $id the ID of the volume
     * @param array  $optArgs {
     *     @type string $url the url to which the volume would be extracted
     * }
     */
    public function extractVolume($zoneid, $mode, $id, array $optArgs = array()) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "mode"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("extractVolume",
            array_merge(array(
                'zoneid' => $zoneid,
                'mode' => $mode,
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists Cisco ASA 1000v appliances
     *
     * @param array  $optArgs {
     *     @type string $physicalnetworkid the Physical Network ID
     *     @type string $keyword List by keyword
     *     @type string $resourceid Cisco ASA 1000v resource ID
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $hostname Hostname or ip address of the Cisco ASA 1000v appliance.
     * }
     */
    public function listCiscoAsa1000vResources(array $optArgs = array()) {
        return $this->request("listCiscoAsa1000vResources",
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
     */
    public function listNetworkServiceProviders(array $optArgs = array()) {
        return $this->request("listNetworkServiceProviders",
            $optArgs
        );
    }

    /**
     * Adds acoount to a project
     *
     * @param string $projectid id of the project to add the account to
     * @param array  $optArgs {
     *     @type string $email email to which invitation to the project is going to be sent
     *     @type string $account name of the account to be added to the project
     * }
     */
    public function addAccountToProject($projectid, array $optArgs = array()) {
        if (empty($projectid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectid"), MISSING_ARGUMENT);
        }
        return $this->request("addAccountToProject",
            array_merge(array(
                'projectid' => $projectid
            ), $optArgs)
        );
    }

    /**
     * delete a Cisco Nexus VSM device
     *
     * @param string $id Id of the Cisco Nexus 1000v VSM device to be deleted
     */
    public function deleteCiscoNexusVSM($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteCiscoNexusVSM",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes an ggress firewall rule
     *
     * @param string $id the ID of the firewall rule
     */
    public function deleteEgressFirewallRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteEgressFirewallRule",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists all available Internal Load Balancer elements.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $id list internal load balancer elements by id
     *     @type string $nspid list internal load balancer elements by network service provider id
     *     @type string $pagesize the number of entries per page
     *     @type string $enabled list internal load balancer elements by enabled state
     * }
     */
    public function listInternalLoadBalancerElements(array $optArgs = array()) {
        return $this->request("listInternalLoadBalancerElements",
            $optArgs
        );
    }

    /**
     * Lists all available network offerings.
     *
     * @param array  $optArgs {
     *     @type string $specifyipranges true if need to list only network offerings which support specifying ip ranges
     *     @type string $zoneid list netowrk offerings available for network creation in specific zone
     *     @type string $keyword List by keyword
     *     @type string $availability the availability of network offering. Default value is Required
     *     @type string $istagged true if offering has tags specified
     *     @type string $displaytext list network offerings by display text
     *     @type string $pagesize the number of entries per page
     *     @type string $guestiptype list network offerings by guest type: Shared or Isolated
     *     @type string $forvpc the network offering can be used only for network creation inside the VPC
     *     @type string $state list network offerings by state
     *     @type string $name list network offerings by name
     *     @type string $page the page number of the result set
     *     @type string $tags list network offerings by tags
     *     @type string $networkid the ID of the network. Pass this in if you want to see the available network
     *     offering that a network can be changed to.
     *     @type string $supportedservices list network offerings supporting certain services
     *     @type string $sourcenatsupported true if need to list only netwok offerings where source nat is supported, false
     *     otherwise
     *     @type string $isdefault true if need to list only default network offerings. Default value is false
     *     @type string $specifyvlan the tags for the network offering.
     *     @type string $id list network offerings by id
     *     @type string $traffictype list by traffic type
     * }
     */
    public function listNetworkOfferings(array $optArgs = array()) {
        return $this->request("listNetworkOfferings",
            $optArgs
        );
    }

    /**
     * Adds a new cluster
     *
     * @param string $podid the Pod ID for the host
     * @param string $hypervisor hypervisor type of the cluster: XenServer,KVM,VMware,Hyperv,BareMetal,Simulator
     * @param string $clustername the cluster name
     * @param string $zoneid the Zone ID for the cluster
     * @param string $clustertype type of the cluster: CloudManaged, ExternalManaged
     * @param array  $optArgs {
     *     @type string $allocationstate Allocation state of this cluster for allocation of new resources
     *     @type string $publicvswitchname Name of virtual switch used for public traffic in the cluster.  This would
     *     override zone wide traffic label setting.
     *     @type string $url the URL
     *     @type string $vsmusername the username for the VSM associated with this cluster
     *     @type string $username the username for the cluster
     *     @type string $password the password for the host
     *     @type string $publicvswitchtype Type of virtual switch used for public traffic in the cluster. Allowed values
     *     are, vmwaresvs (for VMware standard vSwitch) and vmwaredvs (for VMware
     *     distributed vSwitch)
     *     @type string $guestvswitchname Name of virtual switch used for guest traffic in the cluster. This would
     *     override zone wide traffic label setting.
     *     @type string $vsmpassword the password for the VSM associated with this cluster
     *     @type string $guestvswitchtype Type of virtual switch used for guest traffic in the cluster. Allowed values
     *     are, vmwaresvs (for VMware standard vSwitch) and vmwaredvs (for VMware
     *     distributed vSwitch)
     *     @type string $vsmipaddress the ipaddress of the VSM associated with this cluster
     * }
     */
    public function addCluster($podid, $hypervisor, $clustername, $zoneid, $clustertype, array $optArgs = array()) {
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podid"), MISSING_ARGUMENT);
        }
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }
        if (empty($clustername)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clustername"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($clustertype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clustertype"), MISSING_ARGUMENT);
        }
        return $this->request("addCluster",
            array_merge(array(
                'podid' => $podid,
                'hypervisor' => $hypervisor,
                'clustername' => $clustername,
                'zoneid' => $zoneid,
                'clustertype' => $clustertype
            ), $optArgs)
        );
    }

    /**
     * Lists Cisco VNMC controllers
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $resourceid Cisco VNMC resource ID
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     */
    public function listCiscoVnmcResources(array $optArgs = array()) {
        return $this->request("listCiscoVnmcResources",
            $optArgs
        );
    }

    /**
     * List hypervisors
     *
     * @param array  $optArgs {
     *     @type string $zoneid the zone id for listing hypervisors.
     * }
     */
    public function listHypervisors(array $optArgs = array()) {
        return $this->request("listHypervisors",
            $optArgs
        );
    }

    /**
     * Updates a configuration.
     *
     * @param string $name the name of the configuration
     * @param array  $optArgs {
     *     @type string $storageid the ID of the Storage pool to update the parameter value for corresponding
     *     storage pool
     *     @type string $value the value of the configuration
     *     @type string $clusterid the ID of the Cluster to update the parameter value for corresponding cluster
     *     @type string $accountid the ID of the Account to update the parameter value for corresponding account
     *     @type string $zoneid the ID of the Zone to update the parameter value for corresponding zone
     * }
     */
    public function updateConfiguration($name, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("updateConfiguration",
            array_merge(array(
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Create site to site vpn connection
     *
     * @param string $s2svpngatewayid id of the vpn gateway
     * @param string $s2scustomergatewayid id of the customer gateway
     * @param array  $optArgs {
     *     @type string $passive connection is passive or not
     * }
     */
    public function createVpnConnection($s2svpngatewayid, $s2scustomergatewayid, array $optArgs = array()) {
        if (empty($s2svpngatewayid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "s2svpngatewayid"), MISSING_ARGUMENT);
        }
        if (empty($s2scustomergatewayid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "s2scustomergatewayid"), MISSING_ARGUMENT);
        }
        return $this->request("createVpnConnection",
            array_merge(array(
                's2svpngatewayid' => $s2svpngatewayid,
                's2scustomergatewayid' => $s2scustomergatewayid
            ), $optArgs)
        );
    }

    /**
     * Lists all volumes.
     *
     * @param array  $optArgs {
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $virtualmachineid the ID of the virtual machine
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $projectid list objects by project
     *     @type string $id the ID of the disk volume
     *     @type string $type the type of disk volume
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $storageid the ID of the storage pool, available to ROOT admin only
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $podid the pod id the disk volume belongs to
     *     @type string $zoneid the ID of the availability zone
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $name the name of the disk volume
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $hostid list volumes on specified host
     * }
     */
    public function listVolumes(array $optArgs = array()) {
        return $this->request("listVolumes",
            $optArgs
        );
    }

    /**
     * Suspends a project
     *
     * @param string $id id of the project to be suspended
     */
    public function suspendProject($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("suspendProject",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a load balancer
     *
     * @param string $id the ID of the Load Balancer
     */
    public function deleteLoadBalancer($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteLoadBalancer",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Authorizes a particular ingress rule for this security group
     *
     * @param array  $optArgs {
     *     @type string $usersecuritygrouplist user to security group mapping
     *     @type string $domainid an optional domainId for the security group. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $icmptype type of the icmp message being sent
     *     @type string $account an optional account for the security group. Must be used with domainId.
     *     @type string $securitygroupid The ID of the security group. Mutually exclusive with securityGroupName
     *     parameter
     *     @type string $icmpcode error code for this icmp message
     *     @type string $projectid an optional project of the security group
     *     @type string $endport end port for this ingress rule
     *     @type string $securitygroupname The name of the security group. Mutually exclusive with securityGroupName
     *     parameter
     *     @type string $startport start port for this ingress rule
     *     @type string $protocol TCP is default. UDP is the other supported protocol
     *     @type string $cidrlist the cidr list associated
     * }
     */
    public function authorizeSecurityGroupIngress(array $optArgs = array()) {
        return $this->request("authorizeSecurityGroupIngress",
            $optArgs
        );
    }

    /**
     * Lists Load Balancers
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $sourceipaddress the source ip address of the Load Balancer
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $name the name of the Load Balancer
     *     @type string $projectid list objects by project
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $scheme the scheme of the Load Balancer. Supported value is Internal in the current
     *     release
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $sourceipaddressnetworkid the network id of the source ip address
     *     @type string $page the page number of the result set
     *     @type string $id the ID of the Load Balancer
     *     @type string $pagesize the number of entries per page
     *     @type string $networkid the network id of the Load Balancer
     * }
     */
    public function listLoadBalancers(array $optArgs = array()) {
        return $this->request("listLoadBalancers",
            $optArgs
        );
    }

    /**
     * Lists implementors of implementor of a network traffic type or implementors of
     * all network traffic types
     *
     * @param array  $optArgs {
     *     @type string $traffictype Optional. The network traffic type, if specified, return its implementor.
     *     Otherwise, return all traffic types with their implementor
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listTrafficTypeImplementors(array $optArgs = array()) {
        return $this->request("listTrafficTypeImplementors",
            $optArgs
        );
    }

    /**
     * Adds a netscaler load balancer device
     *
     * @param string $url URL of the netscaler load balancer appliance.
     * @param string $networkdevicetype Netscaler device type supports NetscalerMPXLoadBalancer,
     * NetscalerVPXLoadBalancer, NetscalerSDXLoadBalancer
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $username Credentials to reach netscaler load balancer device
     * @param string $password Credentials to reach netscaler load balancer device
     * @param array  $optArgs {
     *     @type string $gslbproviderprivateip public IP of the site
     *     @type string $gslbprovider true if NetScaler device being added is for providing GSLB service
     *     @type string $gslbproviderpublicip public IP of the site
     *     @type string $isexclusivegslbprovider true if NetScaler device being added is for providing GSLB service exclusively
     *     and can not be used for LB
     * }
     */
    public function addNetscalerLoadBalancer($url, $networkdevicetype, $physicalnetworkid, $username, $password, array $optArgs = array()) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($networkdevicetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkdevicetype"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        return $this->request("addNetscalerLoadBalancer",
            array_merge(array(
                'url' => $url,
                'networkdevicetype' => $networkdevicetype,
                'physicalnetworkid' => $physicalnetworkid,
                'username' => $username,
                'password' => $password
            ), $optArgs)
        );
    }

    /**
     * Import LDAP users
     *
     * @param string $accounttype Type of the account.  Specify 0 for user, 1 for root admin, and 2 for domain
     * admin
     * @param array  $optArgs {
     *     @type string $group Specifies the group name from which the ldap users are to be imported. If no
     *     group is specified, all the users will be imported.
     *     @type string $page the page number of the result set
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone
     *     parameter, see Time Zone Format.
     *     @type string $pagesize the number of entries per page
     *     @type string $domainid Specifies the domain to which the ldap users are to be imported. If no domain is
     *     specified, a domain will created using group parameter. If the group is also not
     *     specified, a domain name based on the OU information will be created. If no OU
     *     hierarchy exists, will be defaulted to ROOT domain
     *     @type string $accountdetails details for account used to store specific parameters
     *     @type string $keyword List by keyword
     * }
     */
    public function importLdapUsers($accounttype, array $optArgs = array()) {
        if (empty($accounttype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accounttype"), MISSING_ARGUMENT);
        }
        return $this->request("importLdapUsers",
            array_merge(array(
                'accounttype' => $accounttype
            ), $optArgs)
        );
    }

    /**
     * Deletes a specified domain
     *
     * @param string $id ID of domain to delete
     * @param array  $optArgs {
     *     @type string $cleanup true if all domain resources (child domains, accounts) have to be cleaned up,
     *     false otherwise
     * }
     */
    public function deleteDomain($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteDomain",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * lists F5 load balancer devices
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $lbdeviceid f5 load balancer device ID
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     */
    public function listF5LoadBalancers(array $optArgs = array()) {
        return $this->request("listF5LoadBalancers",
            $optArgs
        );
    }

    /**
     * adds a range of portable public IP's to a region
     *
     * @param string $endip the ending IP address in the portable IP range
     * @param string $regionid Id of the Region
     * @param string $startip the beginning IP address in the portable IP range
     * @param string $gateway the gateway for the portable IP range
     * @param string $netmask the netmask of the portable IP range
     * @param array  $optArgs {
     *     @type string $vlan VLAN id, if not specified defaulted to untagged
     * }
     */
    public function createPortableIpRange($endip, $regionid, $startip, $gateway, $netmask, array $optArgs = array()) {
        if (empty($endip)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "endip"), MISSING_ARGUMENT);
        }
        if (empty($regionid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "regionid"), MISSING_ARGUMENT);
        }
        if (empty($startip)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startip"), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }
        return $this->request("createPortableIpRange",
            array_merge(array(
                'endip' => $endip,
                'regionid' => $regionid,
                'startip' => $startip,
                'gateway' => $gateway,
                'netmask' => $netmask
            ), $optArgs)
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
     */
    public function addTrafficMonitor($url, $zoneid, array $optArgs = array()) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        return $this->request("addTrafficMonitor",
            array_merge(array(
                'url' => $url,
                'zoneid' => $zoneid
            ), $optArgs)
        );
    }

    /**
     * configures a netscaler load balancer device
     *
     * @param string $lbdeviceid Netscaler load balancer device ID
     * @param array  $optArgs {
     *     @type string $podids Used when NetScaler device is provider of EIP service. This parameter represents
     *     the list of pod's, for which there exists a policy based route on datacenter L3
     *     router to route pod's subnet IP to a NetScaler device.
     *     @type string $lbdevicecapacity capacity of the device, Capacity will be interpreted as number of networks
     *     device can handle
     *     @type string $inline true if netscaler load balancer is intended to be used in in-line with firewall,
     *     false if netscaler load balancer will side-by-side with firewall
     *     @type string $lbdevicededicated true if this netscaler device to dedicated for a account, false if the netscaler
     *     device will be shared by multiple accounts
     * }
     */
    public function configureNetscalerLoadBalancer($lbdeviceid, array $optArgs = array()) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("configureNetscalerLoadBalancer",
            array_merge(array(
                'lbdeviceid' => $lbdeviceid
            ), $optArgs)
        );
    }

    /**
     * Creates a template of a virtual machine. The virtual machine must be in a
     * STOPPED state. A template created from this command is automatically designated
     * as a private template visible to the account that created it.
     *
     * @param string $name the name of the template
     * @param string $displaytext the display text of the template. This is usually used for display purposes.
     * @param string $ostypeid the ID of the OS Type that best represents the OS of this template.
     * @param array  $optArgs {
     *     @type string $requireshvm true if the template requres HVM, false otherwise
     *     @type string $bits 32 or 64 bit
     *     @type string $templatetag the tag for this template.
     *     @type string $url Optional, only for baremetal hypervisor. The directory name where template
     *     stored on CIFS server
     *     @type string $passwordenabled true if the template supports the password reset feature; default is false
     *     @type string $details Template details in key/value pairs.
     *     @type string $snapshotid the ID of the snapshot the template is being created from. Either this
     *     parameter, or volumeId has to be passed in
     *     @type string $volumeid the ID of the disk volume the template is being created from. Either this
     *     parameter, or snapshotId has to be passed in
     *     @type string $ispublic true if this template is a public template, false otherwise
     *     @type string $isfeatured true if this template is a featured template, false otherwise
     *     @type string $virtualmachineid Optional, VM ID. If this presents, it is going to create a baremetal template
     *     for VM this ID refers to. This is only for VM whose hypervisor type is
     *     BareMetal
     *     @type string $isdynamicallyscalable true if template contains XS/VMWare tools inorder to support dynamic scaling of
     *     VM cpu/memory
     * }
     */
    public function createTemplate($name, $displaytext, $ostypeid, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displaytext"), MISSING_ARGUMENT);
        }
        if (empty($ostypeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ostypeid"), MISSING_ARGUMENT);
        }
        return $this->request("createTemplate",
            array_merge(array(
                'name' => $name,
                'displaytext' => $displaytext,
                'ostypeid' => $ostypeid
            ), $optArgs)
        );
    }

    /**
     * List all virtual machine instances that are assigned to a load balancer rule.
     *
     * @param string $id the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $applied true if listing all virtual machines currently applied to the load balancer
     *     rule; default is true
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     */
    public function listLoadBalancerRuleInstances($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("listLoadBalancerRuleInstances",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Migrate volume
     *
     * @param string $volumeid the ID of the volume
     * @param string $storageid destination storage pool ID to migrate the volume to
     * @param array  $optArgs {
     *     @type string $livemigrate if the volume should be live migrated when it is attached to a running vm
     * }
     */
    public function migrateVolume($volumeid, $storageid, array $optArgs = array()) {
        if (empty($volumeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeid"), MISSING_ARGUMENT);
        }
        if (empty($storageid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "storageid"), MISSING_ARGUMENT);
        }
        return $this->request("migrateVolume",
            array_merge(array(
                'volumeid' => $volumeid,
                'storageid' => $storageid
            ), $optArgs)
        );
    }

    /**
     * Deletes a load balancer HealthCheck policy.
     *
     * @param string $id the ID of the load balancer HealthCheck policy
     */
    public function deleteLBHealthCheckPolicy($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteLBHealthCheckPolicy",
            array(
                'id' => $id
            )
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
     */
    public function updatePhysicalNetwork($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updatePhysicalNetwork",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Deletes a static route
     *
     * @param string $id the ID of the static route
     */
    public function deleteStaticRoute($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteStaticRoute",
            array(
                'id' => $id
            )
        );
    }

    /**
     * delete a Palo Alto firewall device
     *
     * @param string $fwdeviceid Palo Alto firewall device ID
     */
    public function deletePaloAltoFirewall($fwdeviceid) {
        if (empty($fwdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("deletePaloAltoFirewall",
            array(
                'fwdeviceid' => $fwdeviceid
            )
        );
    }

    /**
     * List traffic monitor Hosts.
     *
     * @param string $zoneid zone Id
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listTrafficMonitors($zoneid, array $optArgs = array()) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        return $this->request("listTrafficMonitors",
            array_merge(array(
                'zoneid' => $zoneid
            ), $optArgs)
        );
    }

    /**
     * Register a public key in a keypair under a certain name
     *
     * @param string $publickey Public key material of the keypair
     * @param string $name Name of the keypair
     * @param array  $optArgs {
     *     @type string $domainid an optional domainId for the ssh key. If the account parameter is used, domainId
     *     must also be used.
     *     @type string $projectid an optional project for the ssh key
     *     @type string $account an optional account for the ssh key. Must be used with domainId.
     * }
     */
    public function registerSSHKeyPair($publickey, $name, array $optArgs = array()) {
        if (empty($publickey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publickey"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("registerSSHKeyPair",
            array_merge(array(
                'publickey' => $publickey,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Migrate current NFS secondary storages to use object store.
     *
     * @param string $provider the image store provider name
     * @param array  $optArgs {
     *     @type string $name the name for the image store
     *     @type string $details the details for the image store. Example:
     *     details[0].key=accesskey&details[0].value=s389ddssaa&details[1].key=secretkey&details[1].value=8dshfsss
     *     @type string $url the URL for the image store
     * }
     */
    public function updateCloudToUseObjectStore($provider, array $optArgs = array()) {
        if (empty($provider)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "provider"), MISSING_ARGUMENT);
        }
        return $this->request("updateCloudToUseObjectStore",
            array_merge(array(
                'provider' => $provider
            ), $optArgs)
        );
    }

    /**
     * Lists autoscale vm groups.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $page the page number of the result set
     *     @type string $lbruleid the ID of the loadbalancer
     *     @type string $pagesize the number of entries per page
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $id the ID of the autoscale vm group
     *     @type string $zoneid the availability zone ID
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $vmprofileid the ID of the profile
     *     @type string $policyid the ID of the policy
     *     @type string $projectid list objects by project
     * }
     */
    public function listAutoScaleVmGroups(array $optArgs = array()) {
        return $this->request("listAutoScaleVmGroups",
            $optArgs
        );
    }

    /**
     * Returns an encrypted password for the VM
     *
     * @param string $id The ID of the virtual machine
     */
    public function getVMPassword($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("getVMPassword",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists vm groups
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $id list instance groups by ID
     *     @type string $name list instance groups by name
     * }
     */
    public function listInstanceGroups(array $optArgs = array()) {
        return $this->request("listInstanceGroups",
            $optArgs
        );
    }

    /**
     * Adds secondary storage.
     *
     * @param string $url the URL for the secondary storage
     * @param array  $optArgs {
     *     @type string $zoneid the Zone ID for the secondary storage
     * }
     */
    public function addSecondaryStorage($url, array $optArgs = array()) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        return $this->request("addSecondaryStorage",
            array_merge(array(
                'url' => $url
            ), $optArgs)
        );
    }

    /**
     * Creates a network
     *
     * @param string $name the name of the network
     * @param string $displaytext the display text of the network
     * @param string $networkofferingid the network offering id
     * @param string $zoneid the Zone ID for the network
     * @param array  $optArgs {
     *     @type string $gateway the gateway of the network. Required for Shared networks and Isolated networks
     *     when it belongs to VPC
     *     @type string $vlan the ID or VID of the network
     *     @type string $ip6cidr the CIDR of IPv6 network, must be at least /64
     *     @type string $domainid domain ID of the account owning a network
     *     @type string $startip the beginning IP address in the network IP range
     *     @type string $aclid Network ACL Id associated for the network
     *     @type string $startipv6 the beginning IPv6 address in the IPv6 network range
     *     @type string $networkdomain network domain
     *     @type string $endipv6 the ending IPv6 address in the IPv6 network range
     *     @type string $acltype Access control type; supported values are account and domain. In 3.0 all shared
     *     networks should have aclType=Domain, and all Isolated networks - Account.
     *     Account means that only the account owner can use the network, domain - all
     *     accouns in the domain can use the network
     *     @type string $physicalnetworkid the Physical Network ID the network belongs to
     *     @type string $netmask the netmask of the network. Required for Shared networks and Isolated networks
     *     when it belongs to VPC
     *     @type string $subdomainaccess Defines whether to allow subdomains to use networks dedicated to their parent
     *     domain(s). Should be used with aclType=Domain, defaulted to
     *     allow.subdomain.network.access global config if not specified
     *     @type string $endip the ending IP address in the network IP range. If not specified, will be
     *     defaulted to startIP
     *     @type string $isolatedpvlan the isolated private vlan for this network
     *     @type string $displaynetwork an optional field, whether to the display the network to the end user or not.
     *     @type string $vpcid the VPC network belongs to
     *     @type string $projectid an optional project for the ssh key
     *     @type string $account account who will own the network
     *     @type string $ip6gateway the gateway of the IPv6 network. Required for Shared networks and Isolated
     *     networks when it belongs to VPC
     * }
     */
    public function createNetwork($name, $displaytext, $networkofferingid, $zoneid, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displaytext"), MISSING_ARGUMENT);
        }
        if (empty($networkofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkofferingid"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        return $this->request("createNetwork",
            array_merge(array(
                'name' => $name,
                'displaytext' => $displaytext,
                'networkofferingid' => $networkofferingid,
                'zoneid' => $zoneid
            ), $optArgs)
        );
    }

    /**
     * Lists projects and provides detailed information for listed projects
     *
     * @param array  $optArgs {
     *     @type string $name list projects by name
     *     @type string $state list projects by state
     *     @type string $keyword List by keyword
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $id list projects by project ID
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $displaytext list projects by display text
     *     @type string $pagesize the number of entries per page
     *     @type string $tags List projects by tags (key/value pairs)
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     * }
     */
    public function listProjects(array $optArgs = array()) {
        return $this->request("listProjects",
            $optArgs
        );
    }

    /**
     * Enables an account
     *
     * @param array  $optArgs {
     *     @type string $domainid Enables specified account in this domain.
     *     @type string $account Enables specified account.
     *     @type string $id Account id
     * }
     */
    public function enableAccount(array $optArgs = array()) {
        return $this->request("enableAccount",
            $optArgs
        );
    }

    /**
     * Destroyes a system virtual machine.
     *
     * @param string $id The ID of the system virtual machine
     */
    public function destroySystemVm($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("destroySystemVm",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists all public ip addresses
     *
     * @param array  $optArgs {
     *     @type string $ipaddress lists the specified IP address
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $forvirtualnetwork the virtual network for the IP address
     *     @type string $allocatedonly limits search results to allocated public IP addresses
     *     @type string $physicalnetworkid lists all public IP addresses by physical network id
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $vpcid List ips belonging to the VPC
     *     @type string $pagesize the number of entries per page
     *     @type string $associatednetworkid lists all public IP addresses associated to the network specified
     *     @type string $forloadbalancing list only ips used for load balancing
     *     @type string $issourcenat list only source nat ip addresses
     *     @type string $vlanid lists all public IP addresses by VLAN ID
     *     @type string $keyword List by keyword
     *     @type string $zoneid lists all public IP addresses by Zone ID
     *     @type string $isstaticnat list only static nat ip addresses
     *     @type string $id lists ip address by id
     *     @type string $projectid list objects by project
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     * }
     */
    public function listPublicIpAddresses(array $optArgs = array()) {
        return $this->request("listPublicIpAddresses",
            $optArgs
        );
    }

    /**
     * Puts storage pool into maintenance state
     *
     * @param string $id Primary storage ID
     */
    public function enableStorageMaintenance($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("enableStorageMaintenance",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Removes a load balancer rule association with global load balancer rule
     *
     * @param string $id The ID of the load balancer rule
     * @param string $loadbalancerrulelist the list load balancer rules that will be assigned to gloabal load balacner
     * rule
     */
    public function removeFromGlobalLoadBalancerRule($id, $loadbalancerrulelist) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($loadbalancerrulelist)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "loadbalancerrulelist"), MISSING_ARGUMENT);
        }
        return $this->request("removeFromGlobalLoadBalancerRule",
            array(
                'id' => $id,
                'loadbalancerrulelist' => $loadbalancerrulelist
            )
        );
    }

    /**
     * Lists site 2 site vpn gateways
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $id id of the vpn gateway
     *     @type string $page the page number of the result set
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $projectid list objects by project
     *     @type string $vpcid id of vpc
     * }
     */
    public function listVpnGateways(array $optArgs = array()) {
        return $this->request("listVpnGateways",
            $optArgs
        );
    }

    /**
     * Lists dedicated pods.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $affinitygroupid list dedicated pods by affinity group
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $domainid the ID of the domain associated with the pod
     *     @type string $podid the ID of the pod
     *     @type string $account the name of the account associated with the pod. Must be used with domainId.
     * }
     */
    public function listDedicatedPods(array $optArgs = array()) {
        return $this->request("listDedicatedPods",
            $optArgs
        );
    }

    /**
     * Lists clusters.
     *
     * @param array  $optArgs {
     *     @type string $allocationstate lists clusters by allocation state
     *     @type string $clustertype lists clusters by cluster type
     *     @type string $zoneid lists clusters by Zone ID
     *     @type string $showcapacities flag to display the capacity of the clusters
     *     @type string $podid lists clusters by Pod ID
     *     @type string $managedstate whether this cluster is managed by cloudstack
     *     @type string $hypervisor lists clusters by hypervisor type
     *     @type string $id lists clusters by the cluster ID
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $name lists clusters by the cluster name
     * }
     */
    public function listClusters(array $optArgs = array()) {
        return $this->request("listClusters",
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
     */
    public function stopRouter($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("stopRouter",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Attaches a disk volume to a virtual machine.
     *
     * @param string $id the ID of the disk volume
     * @param string $virtualmachineid the ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $deviceid the ID of the device to map the volume to within the guest OS. If no deviceId is
     *     passed in, the next available deviceId will be chosen. Possible values for a
     *     Linux OS are:* 1 - /dev/xvdb* 2 - /dev/xvdc* 4 - /dev/xvde* 5 - /dev/xvdf* 6 -
     *     /dev/xvdg* 7 - /dev/xvdh* 8 - /dev/xvdi* 9 - /dev/xvdj
     * }
     */
    public function attachVolume($id, $virtualmachineid, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("attachVolume",
            array_merge(array(
                'id' => $id,
                'virtualmachineid' => $virtualmachineid
            ), $optArgs)
        );
    }

    /**
     * Updates VPC offering
     *
     * @param string $id the id of the VPC offering
     * @param array  $optArgs {
     *     @type string $displaytext the display text of the VPC offering
     *     @type string $state update state for the VPC offering; supported states - Enabled/Disabled
     *     @type string $name the name of the VPC offering
     * }
     */
    public function updateVPCOffering($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateVPCOffering",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Resets the SSH Key for virtual machine. The virtual machine must be in a
     * "Stopped" state. [async]
     *
     * @param string $id The ID of the virtual machine
     * @param string $keypair name of the ssh key pair used to login to the virtual machine
     * @param array  $optArgs {
     *     @type string $domainid an optional domainId for the virtual machine. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $projectid an optional project for the ssh key
     *     @type string $account an optional account for the ssh key. Must be used with domainId.
     * }
     */
    public function resetSSHKeyForVirtualMachine($id, $keypair, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($keypair)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "keypair"), MISSING_ARGUMENT);
        }
        return $this->request("resetSSHKeyForVirtualMachine",
            array_merge(array(
                'id' => $id,
                'keypair' => $keypair
            ), $optArgs)
        );
    }

    /**
     * Adds a Cisco Asa 1000v appliance
     *
     * @param string $hostname Hostname or ip address of the Cisco ASA 1000v appliance.
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $insideportprofile Nexus port profile associated with inside interface of ASA 1000v
     * @param string $clusterid the Cluster ID
     */
    public function addCiscoAsa1000vResource($hostname, $physicalnetworkid, $insideportprofile, $clusterid) {
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        if (empty($insideportprofile)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "insideportprofile"), MISSING_ARGUMENT);
        }
        if (empty($clusterid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterid"), MISSING_ARGUMENT);
        }
        return $this->request("addCiscoAsa1000vResource",
            array(
                'hostname' => $hostname,
                'physicalnetworkid' => $physicalnetworkid,
                'insideportprofile' => $insideportprofile,
                'clusterid' => $clusterid
            )
        );
    }

    /**
     * Lists autoscale policies.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $action the action to be executed if all the conditions evaluate to true for the
     *     specified duration.
     *     @type string $vmgroupid the ID of the autoscale vm group
     *     @type string $id the ID of the autoscale policy
     *     @type string $pagesize the number of entries per page
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $page the page number of the result set
     *     @type string $conditionid the ID of the condition of the policy
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     * }
     */
    public function listAutoScalePolicies(array $optArgs = array()) {
        return $this->request("listAutoScalePolicies",
            $optArgs
        );
    }

    /**
     * Cleanups VM reservations in the database.
     *
     */
    public function cleanVMReservations() {
        return $this->request("cleanVMReservations",
            $optArgs
        );
    }

    /**
     * Creates an affinity/anti-affinity group
     *
     * @param string $type Type of the affinity group from the available affinity/anti-affinity group
     * types
     * @param string $name name of the affinity group
     * @param array  $optArgs {
     *     @type string $account an account for the affinity group. Must be used with domainId.
     *     @type string $description optional description of the affinity group
     *     @type string $domainid domainId of the account owning the affinity group
     * }
     */
    public function createAffinityGroup($type, $name, array $optArgs = array()) {
        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "type"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createAffinityGroup",
            array_merge(array(
                'type' => $type,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Adds F5 external load balancer appliance.
     *
     * @param string $password Password of the external load balancer appliance.
     * @param string $url URL of the external load balancer appliance.
     * @param string $zoneid Zone in which to add the external load balancer appliance.
     * @param string $username Username of the external load balancer appliance.
     */
    public function addExternalLoadBalancer($password, $url, $zoneid, $username) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        return $this->request("addExternalLoadBalancer",
            array(
                'password' => $password,
                'url' => $url,
                'zoneid' => $zoneid,
                'username' => $username
            )
        );
    }

    /**
     * Lists all DeploymentPlanners available.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     * }
     */
    public function listDeploymentPlanners(array $optArgs = array()) {
        return $this->request("listDeploymentPlanners",
            $optArgs
        );
    }

    /**
     * Lists all alerts.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $type list by alert type
     *     @type string $name list by alert name
     *     @type string $pagesize the number of entries per page
     *     @type string $id the ID of the alert
     * }
     */
    public function listAlerts(array $optArgs = array()) {
        return $this->request("listAlerts",
            $optArgs
        );
    }

    /**
     * Deletes a F5 external load balancer appliance added in a zone.
     *
     * @param string $id Id of the external loadbalancer appliance.
     */
    public function deleteExternalLoadBalancer($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteExternalLoadBalancer",
            array(
                'id' => $id
            )
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
     */
    public function deleteTags($resourceids, $resourcetype, array $optArgs = array()) {
        if (empty($resourceids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceids"), MISSING_ARGUMENT);
        }
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourcetype"), MISSING_ARGUMENT);
        }
        return $this->request("deleteTags",
            array_merge(array(
                'resourceids' => $resourceids,
                'resourcetype' => $resourcetype
            ), $optArgs)
        );
    }

    /**
     * Deletes account from the project
     *
     * @param string $projectid id of the project to remove the account from
     * @param string $account name of the account to be removed from the project
     */
    public function deleteAccountFromProject($projectid, $account) {
        if (empty($projectid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectid"), MISSING_ARGUMENT);
        }
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        return $this->request("deleteAccountFromProject",
            array(
                'projectid' => $projectid,
                'account' => $account
            )
        );
    }

    /**
     * Retrieves a Cisco Nexus 1000v Virtual Switch Manager device associated with a
     * Cluster
     *
     * @param array  $optArgs {
     *     @type string $zoneid Id of the CloudStack cluster in which the Cisco Nexus 1000v VSM appliance.
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $clusterid Id of the CloudStack cluster in which the Cisco Nexus 1000v VSM appliance.
     *     @type string $keyword List by keyword
     * }
     */
    public function listCiscoNexusVSMs(array $optArgs = array()) {
        return $this->request("listCiscoNexusVSMs",
            $optArgs
        );
    }

    /**
     * add a baremetal ping pxe server
     *
     * @param string $pingdir Root directory on PING storage server
     * @param string $username Credentials to reach external pxe device
     * @param string $pxeservertype type of pxe device
     * @param string $tftpdir Tftp root directory of PXE server
     * @param string $url URL of the external pxe device
     * @param string $pingstorageserverip PING storage server ip
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $password Credentials to reach external pxe device
     * @param array  $optArgs {
     *     @type string $podid Pod Id
     *     @type string $pingcifspassword Password of PING storage server
     *     @type string $pingcifsusername Username of PING storage server
     * }
     */
    public function addBaremetalPxePingServer($pingdir, $username, $pxeservertype, $tftpdir, $url, $pingstorageserverip, $physicalnetworkid, $password, array $optArgs = array()) {
        if (empty($pingdir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pingdir"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($pxeservertype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pxeservertype"), MISSING_ARGUMENT);
        }
        if (empty($tftpdir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "tftpdir"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($pingstorageserverip)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pingstorageserverip"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        return $this->request("addBaremetalPxePingServer",
            array_merge(array(
                'pingdir' => $pingdir,
                'username' => $username,
                'pxeservertype' => $pxeservertype,
                'tftpdir' => $tftpdir,
                'url' => $url,
                'pingstorageserverip' => $pingstorageserverip,
                'physicalnetworkid' => $physicalnetworkid,
                'password' => $password
            ), $optArgs)
        );
    }

    /**
     * List private gateways
     *
     * @param array  $optArgs {
     *     @type string $projectid list objects by project
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $vlan list gateways by vlan
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $ipaddress list gateways by ip address
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $state list gateways by state
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $id list private gateway by id
     *     @type string $vpcid list gateways by vpc
     * }
     */
    public function listPrivateGateways(array $optArgs = array()) {
        return $this->request("listPrivateGateways",
            $optArgs
        );
    }

    /**
     * deletes a range of portable public IP's associated with a region
     *
     * @param string $id Id of the portable ip range
     */
    public function deletePortableIpRange($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deletePortableIpRange",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Updates a region
     *
     * @param string $id Id of region to update
     * @param array  $optArgs {
     *     @type string $endpoint updates region with this end point
     *     @type string $name updates region with this name
     * }
     */
    public function updateRegion($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateRegion",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Updates the volume.
     *
     * @param array  $optArgs {
     *     @type string $displayvolume an optional field, whether to the display the volume to the end user or not.
     *     @type string $id the ID of the disk volume
     *     @type string $storageid Destination storage pool UUID for the volume
     *     @type string $state The state of the volume
     *     @type string $path The path of the volume
     * }
     */
    public function updateVolume(array $optArgs = array()) {
        return $this->request("updateVolume",
            $optArgs
        );
    }

    /**
     * List ucs manager
     *
     * @param array  $optArgs {
     *     @type string $zoneid the zone id
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $id the ID of the ucs manager
     *     @type string $page the page number of the result set
     * }
     */
    public function listUcsManagers(array $optArgs = array()) {
        return $this->request("listUcsManagers",
            $optArgs
        );
    }

    /**
     * Lists all available networks.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $zoneid the Zone ID of the network
     *     @type string $supportedservices list networks supporting certain services
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $page the page number of the result set
     *     @type string $projectid list objects by project
     *     @type string $canusefordeploy list networks available for vm deployment
     *     @type string $id list networks by id
     *     @type string $issystem true if network is system, false otherwise
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $acltype list networks by ACL (access control list) type. Supported values are Account
     *     and Domain
     *     @type string $physicalnetworkid list networks by physical network id
     *     @type string $type the type of the network. Supported values are: Isolated and Shared
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $forvpc the network belongs to vpc
     *     @type string $traffictype type of the traffic
     *     @type string $vpcid List networks by VPC
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $pagesize the number of entries per page
     *     @type string $specifyipranges true if need to list only networks which support specifying ip ranges
     *     @type string $restartrequired list networks by restartRequired
     * }
     */
    public function listNetworks(array $optArgs = array()) {
        return $this->request("listNetworks",
            $optArgs
        );
    }

    /**
     * Uploads a custom certificate for the console proxy VMs to use for SSL. Can be
     * used to upload a single certificate signed by a known CA. Can also be used,
     * through multiple calls, to upload a chain of certificates from CA to the custom
     * certificate itself.
     *
     * @param string $certificate The certificate to be uploaded.
     * @param string $domainsuffix DNS domain suffix that the certificate is granted for.
     * @param array  $optArgs {
     *     @type string $id An integer providing the location in a chain that the certificate will hold.
     *     Usually, this can be left empty. When creating a chain, the top level
     *     certificate should have an ID of 1, with each step in the chain incrementing by
     *     one. Example, CA with id = 1, Intermediate CA with id = 2, Site certificate with
     *     ID = 3
     *     @type string $privatekey The private key for the attached certificate.
     *     @type string $name A name / alias for the certificate.
     * }
     */
    public function uploadCustomCertificate($certificate, $domainsuffix, array $optArgs = array()) {
        if (empty($certificate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "certificate"), MISSING_ARGUMENT);
        }
        if (empty($domainsuffix)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainsuffix"), MISSING_ARGUMENT);
        }
        return $this->request("uploadCustomCertificate",
            array_merge(array(
                'certificate' => $certificate,
                'domainsuffix' => $domainsuffix
            ), $optArgs)
        );
    }

    /**
     * Lists image stores.
     *
     * @param array  $optArgs {
     *     @type string $name the name of the image store
     *     @type string $protocol the image store protocol
     *     @type string $page the page number of the result set
     *     @type string $id the ID of the storage pool
     *     @type string $pagesize the number of entries per page
     *     @type string $zoneid the Zone ID for the image store
     *     @type string $keyword List by keyword
     *     @type string $provider the image store provider
     * }
     */
    public function listImageStores(array $optArgs = array()) {
        return $this->request("listImageStores",
            $optArgs
        );
    }

    /**
     * Lists all the system wide capacities.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $fetchlatest recalculate capacities and fetch the latest
     *     @type string $clusterid lists capacity by the Cluster ID
     *     @type string $podid lists capacity by the Pod ID
     *     @type string $sortby Sort the results. Available values: Usage
     *     @type string $zoneid lists capacity by the Zone ID
     *     @type string $type lists capacity by type* CAPACITY_TYPE_MEMORY = 0* CAPACITY_TYPE_CPU = 1*
     *     CAPACITY_TYPE_STORAGE = 2* CAPACITY_TYPE_STORAGE_ALLOCATED = 3*
     *     CAPACITY_TYPE_VIRTUAL_NETWORK_PUBLIC_IP = 4* CAPACITY_TYPE_PRIVATE_IP = 5*
     *     CAPACITY_TYPE_SECONDARY_STORAGE = 6* CAPACITY_TYPE_VLAN = 7*
     *     CAPACITY_TYPE_DIRECT_ATTACHED_PUBLIC_IP = 8* CAPACITY_TYPE_LOCAL_STORAGE = 9.
     * }
     */
    public function listCapacity(array $optArgs = array()) {
        return $this->request("listCapacity",
            $optArgs
        );
    }

    /**
     * Creates a profile that contains information about the virtual machine which will
     * be provisioned automatically by autoscale feature.
     *
     * @param string $serviceofferingid the service offering of the auto deployed virtual machine
     * @param string $zoneid availability zone for the auto deployed virtual machine
     * @param string $templateid the template of the auto deployed virtual machine
     * @param array  $optArgs {
     *     @type string $autoscaleuserid the ID of the user used to launch and destroy the VMs
     *     @type string $otherdeployparams parameters other than zoneId/serviceOfferringId/templateId of the auto deployed
     *     virtual machine
     *     @type string $counterparam counterparam list. Example:
     *     counterparam[0].name=snmpcommunity&counterparam[0].value=public&counterparam[1].name=snmpport&counterparam[1].value=161
     *     @type string $destroyvmgraceperiod the time allowed for existing connections to get closed before a vm is
     *     destroyed
     * }
     */
    public function createAutoScaleVmProfile($serviceofferingid, $zoneid, $templateid, array $optArgs = array()) {
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceofferingid"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($templateid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateid"), MISSING_ARGUMENT);
        }
        return $this->request("createAutoScaleVmProfile",
            array_merge(array(
                'serviceofferingid' => $serviceofferingid,
                'zoneid' => $zoneid,
                'templateid' => $templateid
            ), $optArgs)
        );
    }

    /**
     * Creates a security group
     *
     * @param string $name name of the security group
     * @param array  $optArgs {
     *     @type string $projectid Create security group for project
     *     @type string $description the description of the security group
     *     @type string $domainid an optional domainId for the security group. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $account an optional account for the security group. Must be used with domainId.
     * }
     */
    public function createSecurityGroup($name, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createSecurityGroup",
            array_merge(array(
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Releases a dedicated guest vlan range to the system
     *
     * @param string $id the ID of the dedicated guest vlan range
     */
    public function releaseDedicatedGuestVlanRange($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("releaseDedicatedGuestVlanRange",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Create a new keypair and returns the private key
     *
     * @param string $name Name of the keypair
     * @param array  $optArgs {
     *     @type string $domainid an optional domainId for the ssh key. If the account parameter is used, domainId
     *     must also be used.
     *     @type string $projectid an optional project for the ssh key
     *     @type string $account an optional account for the ssh key. Must be used with domainId.
     * }
     */
    public function createSSHKeyPair($name, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createSSHKeyPair",
            array_merge(array(
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Cancels host maintenance.
     *
     * @param string $id the host ID
     */
    public function cancelHostMaintenance($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("cancelHostMaintenance",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Updates a service offering.
     *
     * @param string $id the ID of the service offering to be updated
     * @param array  $optArgs {
     *     @type string $name the name of the service offering to be updated
     *     @type string $displaytext the display text of the service offering to be updated
     *     @type string $sortkey sort key of the service offering, integer
     * }
     */
    public function updateServiceOffering($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateServiceOffering",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists all LDAP Users
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $listtype Determines whether all ldap users are returned or just non-cloudstack users
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     */
    public function listLdapUsers(array $optArgs = array()) {
        return $this->request("listLdapUsers",
            $optArgs
        );
    }

    /**
     * Release the dedication for host
     *
     * @param string $hostid the ID of the host
     */
    public function releaseDedicatedHost($hostid) {
        if (empty($hostid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostid"), MISSING_ARGUMENT);
        }
        return $this->request("releaseDedicatedHost",
            array(
                'hostid' => $hostid
            )
        );
    }

    /**
     * Updates a storage pool.
     *
     * @param string $id the Id of the storage pool
     * @param array  $optArgs {
     *     @type string $tags comma-separated list of tags for the storage pool
     *     @type string $capacitybytes bytes CloudStack can provision from this storage pool
     *     @type string $capacityiops IOPS CloudStack can provision from this storage pool
     * }
     */
    public function updateStoragePool($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateStoragePool",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Deletes a storage network IP Range.
     *
     * @param string $id the uuid of the storage network ip range
     */
    public function deleteStorageNetworkIpRange($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteStorageNetworkIpRange",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists S3s
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listS3s(array $optArgs = array()) {
        return $this->request("listS3s",
            $optArgs
        );
    }

    /**
     * Lists all available virtual router elements.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $enabled list network offerings by enabled state
     *     @type string $page the page number of the result set
     *     @type string $id list virtual router elements by id
     *     @type string $nspid list virtual router elements by network service provider id
     *     @type string $keyword List by keyword
     * }
     */
    public function listVirtualRouterElements(array $optArgs = array()) {
        return $this->request("listVirtualRouterElements",
            $optArgs
        );
    }

    /**
     * Create an Internal Load Balancer element.
     *
     * @param string $nspid the network service provider ID of the internal load balancer element
     */
    public function createInternalLoadBalancerElement($nspid) {
        if (empty($nspid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nspid"), MISSING_ARGUMENT);
        }
        return $this->request("createInternalLoadBalancerElement",
            array(
                'nspid' => $nspid
            )
        );
    }

    /**
     * Deletes a firewall rule
     *
     * @param string $id the ID of the firewall rule
     */
    public function deleteFirewallRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteFirewallRule",
            array(
                'id' => $id
            )
        );
    }

    /**
     * add a baremetal host
     *
     * @param string $zoneid the Zone ID for the host
     * @param string $podid the Pod ID for the host
     * @param string $hypervisor hypervisor type of the host
     * @param string $username the username for the host
     * @param string $password the password for the host
     * @param string $url the host URL
     * @param array  $optArgs {
     *     @type string $ipaddress ip address intentionally allocated to this host after provisioning
     *     @type string $clusterid the cluster ID for the host
     *     @type string $clustername the cluster name for the host
     *     @type string $allocationstate Allocation state of this Host for allocation of new resources
     *     @type string $hosttags list of tags to be added to the host
     * }
     */
    public function addBaremetalHost($zoneid, $podid, $hypervisor, $username, $password, $url, array $optArgs = array()) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podid"), MISSING_ARGUMENT);
        }
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        return $this->request("addBaremetalHost",
            array_merge(array(
                'zoneid' => $zoneid,
                'podid' => $podid,
                'hypervisor' => $hypervisor,
                'username' => $username,
                'password' => $password,
                'url' => $url
            ), $optArgs)
        );
    }

    /**
     * delete a nicira nvp device
     *
     * @param string $nvpdeviceid Nicira device ID
     */
    public function deleteNiciraNvpDevice($nvpdeviceid) {
        if (empty($nvpdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nvpdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("deleteNiciraNvpDevice",
            array(
                'nvpdeviceid' => $nvpdeviceid
            )
        );
    }

    /**
     * lists all available apis on the server, provided by the Api Discovery plugin
     *
     * @param array  $optArgs {
     *     @type string $name API name
     * }
     */
    public function listApis(array $optArgs = array()) {
        return $this->request("listApis",
            $optArgs
        );
    }

    /**
     * Deletes a project
     *
     * @param string $id id of the project to be deleted
     */
    public function deleteProject($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteProject",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Removes secondary IP from the NIC.
     *
     * @param string $id the ID of the secondary ip address to nic
     */
    public function removeIpFromNic($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("removeIpFromNic",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Update password of a host/pool on management server.
     *
     * @param string $username the username for the host/cluster
     * @param string $password the new password for the host/cluster
     * @param array  $optArgs {
     *     @type string $clusterid the cluster ID
     *     @type string $hostid the host ID
     * }
     */
    public function updateHostPassword($username, $password, array $optArgs = array()) {
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        return $this->request("updateHostPassword",
            array_merge(array(
                'username' => $username,
                'password' => $password
            ), $optArgs)
        );
    }

    /**
     * Deletes an ip forwarding rule
     *
     * @param string $id the id of the forwarding rule
     */
    public function deleteIpForwardingRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteIpForwardingRule",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Adds Swift.
     *
     * @param string $url the URL for swift
     * @param array  $optArgs {
     *     @type string $key key for the user for swift
     *     @type string $username the username for swift
     *     @type string $account the account for swift
     * }
     */
    public function addSwift($url, array $optArgs = array()) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        return $this->request("addSwift",
            array_merge(array(
                'url' => $url
            ), $optArgs)
        );
    }

    /**
     * Creates a global load balancer rule
     *
     * @param string $gslbdomainname domain name for the GSLB service.
     * @param string $name name of the load balancer rule
     * @param string $gslbservicetype GSLB service type (tcp, udp, http)
     * @param string $regionid region where the global load balancer is going to be created.
     * @param array  $optArgs {
     *     @type string $gslbstickysessionmethodname session sticky method (sourceip) if not specified defaults to sourceip
     *     @type string $account the account associated with the global load balancer. Must be used with the
     *     domainId parameter.
     *     @type string $domainid the domain ID associated with the load balancer
     *     @type string $gslblbmethod load balancer algorithm (roundrobin, leastconn, proximity) that method is used
     *     to distribute traffic across the zones participating in global server load
     *     balancing, if not specified defaults to 'round robin'
     *     @type string $description the description of the load balancer rule
     * }
     */
    public function createGlobalLoadBalancerRule($gslbdomainname, $name, $gslbservicetype, $regionid, array $optArgs = array()) {
        if (empty($gslbdomainname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gslbdomainname"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($gslbservicetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gslbservicetype"), MISSING_ARGUMENT);
        }
        if (empty($regionid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "regionid"), MISSING_ARGUMENT);
        }
        return $this->request("createGlobalLoadBalancerRule",
            array_merge(array(
                'gslbdomainname' => $gslbdomainname,
                'name' => $name,
                'gslbservicetype' => $gslbservicetype,
                'regionid' => $regionid
            ), $optArgs)
        );
    }

    /**
     * Resizes a volume
     *
     * @param array  $optArgs {
     *     @type string $size New volume size in G
     *     @type string $diskofferingid new disk offering id
     *     @type string $id the ID of the disk volume
     *     @type string $shrinkok Verify OK to Shrink
     * }
     */
    public function resizeVolume(array $optArgs = array()) {
        return $this->request("resizeVolume",
            $optArgs
        );
    }

    /**
     * List registered keypairs
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $name A key pair name to look for
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $fingerprint A public key fingerprint to look for
     *     @type string $pagesize the number of entries per page
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $page the page number of the result set
     * }
     */
    public function listSSHKeyPairs(array $optArgs = array()) {
        return $this->request("listSSHKeyPairs",
            $optArgs
        );
    }

    /**
     * Creates a static route
     *
     * @param string $cidr static route cidr
     * @param string $gatewayid the gateway id we are creating static route for
     */
    public function createStaticRoute($cidr, $gatewayid) {
        if (empty($cidr)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidr"), MISSING_ARGUMENT);
        }
        if (empty($gatewayid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gatewayid"), MISSING_ARGUMENT);
        }
        return $this->request("createStaticRoute",
            array(
                'cidr' => $cidr,
                'gatewayid' => $gatewayid
            )
        );
    }

    /**
     * Lists Nicira NVP devices
     *
     * @param array  $optArgs {
     *     @type string $nvpdeviceid nicira nvp device ID
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     */
    public function listNiciraNvpDevices(array $optArgs = array()) {
        return $this->request("listNiciraNvpDevices",
            $optArgs
        );
    }

    /**
     * Deletes a global load balancer rule.
     *
     * @param string $id the ID of the global load balancer rule
     */
    public function deleteGlobalLoadBalancerRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteGlobalLoadBalancerRule",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Activates a project
     *
     * @param string $id id of the project to be modified
     */
    public function activateProject($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("activateProject",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Release dedication of zone
     *
     * @param string $zoneid the ID of the Zone
     */
    public function releaseDedicatedZone($zoneid) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        return $this->request("releaseDedicatedZone",
            array(
                'zoneid' => $zoneid
            )
        );
    }

    /**
     * Creates snapshot for a vm.
     *
     * @param string $virtualmachineid The ID of the vm
     * @param array  $optArgs {
     *     @type string $quiescevm quiesce vm if true
     *     @type string $name The display name of the snapshot
     *     @type string $snapshotmemory snapshot memory if true
     *     @type string $description The discription of the snapshot
     * }
     */
    public function createVMSnapshot($virtualmachineid, array $optArgs = array()) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("createVMSnapshot",
            array_merge(array(
                'virtualmachineid' => $virtualmachineid
            ), $optArgs)
        );
    }

    /**
     * configures a F5 load balancer device
     *
     * @param string $lbdeviceid F5 load balancer device ID
     * @param array  $optArgs {
     *     @type string $lbdevicecapacity capacity of the device, Capacity will be interpreted as number of networks
     *     device can handle
     * }
     */
    public function configureF5LoadBalancer($lbdeviceid, array $optArgs = array()) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("configureF5LoadBalancer",
            array_merge(array(
                'lbdeviceid' => $lbdeviceid
            ), $optArgs)
        );
    }

    /**
     * Enables static nat for given ip address
     *
     * @param string $ipaddressid the public IP address id for which static nat feature is being enabled
     * @param string $virtualmachineid the ID of the virtual machine for enabling static nat feature
     * @param array  $optArgs {
     *     @type string $vmguestip VM guest nic Secondary ip address for the port forwarding rule
     *     @type string $networkid The network of the vm the static nat will be enabled for. Required when public
     *     Ip address is not associated with any Guest network yet (VPC case)
     * }
     */
    public function enableStaticNat($ipaddressid, $virtualmachineid, array $optArgs = array()) {
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipaddressid"), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("enableStaticNat",
            array_merge(array(
                'ipaddressid' => $ipaddressid,
                'virtualmachineid' => $virtualmachineid
            ), $optArgs)
        );
    }

    /**
     * Creates an ip forwarding rule
     *
     * @param string $protocol the protocol for the rule. Valid values are TCP or UDP.
     * @param string $ipaddressid the public IP address id of the forwarding rule, already associated via
     * associateIp
     * @param string $startport the start port for the rule
     * @param array  $optArgs {
     *     @type string $openfirewall if true, firewall rule for source/end pubic port is automatically created; if
     *     false - firewall rule has to be created explicitely. Has value true by default
     *     @type string $endport the end port for the rule
     *     @type string $cidrlist the cidr list to forward traffic from
     * }
     */
    public function createIpForwardingRule($protocol, $ipaddressid, $startport, array $optArgs = array()) {
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipaddressid"), MISSING_ARGUMENT);
        }
        if (empty($startport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startport"), MISSING_ARGUMENT);
        }
        return $this->request("createIpForwardingRule",
            array_merge(array(
                'protocol' => $protocol,
                'ipaddressid' => $ipaddressid,
                'startport' => $startport
            ), $optArgs)
        );
    }

    /**
     * Lists storage providers.
     *
     * @param string $type the type of storage provider: either primary or image
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     */
    public function listStorageProviders($type, array $optArgs = array()) {
        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "type"), MISSING_ARGUMENT);
        }
        return $this->request("listStorageProviders",
            array_merge(array(
                'type' => $type
            ), $optArgs)
        );
    }

    /**
     * Lists Regions
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $id List Region by region ID.
     *     @type string $name List Region by region name.
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     */
    public function listRegions(array $optArgs = array()) {
        return $this->request("listRegions",
            $optArgs
        );
    }

    /**
     * Lists all network ACLs
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $vpcid list network ACLs by Vpc Id
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $projectid list objects by project
     *     @type string $networkid list network ACLs by network Id
     *     @type string $pagesize the number of entries per page
     *     @type string $id Lists network ACL with the specified ID.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name list network ACLs by specified name
     * }
     */
    public function listNetworkACLLists(array $optArgs = array()) {
        return $this->request("listNetworkACLLists",
            $optArgs
        );
    }

    /**
     * Updates a disk offering.
     *
     * @param string $id ID of the disk offering
     * @param array  $optArgs {
     *     @type string $displaytext updates alternate display text of the disk offering with this value
     *     @type string $sortkey sort key of the disk offering, integer
     *     @type string $displayoffering an optional field, whether to display the offering to the end user or not.
     *     @type string $name updates name of the disk offering with this value
     * }
     */
    public function updateDiskOffering($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateDiskOffering",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Adds a Palo Alto firewall device
     *
     * @param string $url URL of the Palo Alto appliance.
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $username Credentials to reach Palo Alto firewall device
     * @param string $networkdevicetype supports only PaloAltoFirewall
     * @param string $password Credentials to reach Palo Alto firewall device
     */
    public function addPaloAltoFirewall($url, $physicalnetworkid, $username, $networkdevicetype, $password) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($networkdevicetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkdevicetype"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        return $this->request("addPaloAltoFirewall",
            array(
                'url' => $url,
                'physicalnetworkid' => $physicalnetworkid,
                'username' => $username,
                'networkdevicetype' => $networkdevicetype,
                'password' => $password
            )
        );
    }

    /**
     * List profile in ucs manager
     *
     * @param string $ucsmanagerid the id for the ucs manager
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     * }
     */
    public function listUcsProfiles($ucsmanagerid, array $optArgs = array()) {
        if (empty($ucsmanagerid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsmanagerid"), MISSING_ARGUMENT);
        }
        return $this->request("listUcsProfiles",
            array_merge(array(
                'ucsmanagerid' => $ucsmanagerid
            ), $optArgs)
        );
    }

    /**
     * Recovers a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     */
    public function recoverVirtualMachine($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("recoverVirtualMachine",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists capabilities
     *
     */
    public function listCapabilities() {
        return $this->request("listCapabilities",
            $optArgs
        );
    }

    /**
     * Release the dedication for cluster
     *
     * @param string $clusterid the ID of the Cluster
     */
    public function releaseDedicatedCluster($clusterid) {
        if (empty($clusterid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterid"), MISSING_ARGUMENT);
        }
        return $this->request("releaseDedicatedCluster",
            array(
                'clusterid' => $clusterid
            )
        );
    }

    /**
     * Updates a VPC
     *
     * @param string $name the name of the VPC
     * @param string $id the id of the VPC
     * @param array  $optArgs {
     *     @type string $displaytext the display text of the VPC
     * }
     */
    public function updateVPC($name, $id, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateVPC",
            array_merge(array(
                'name' => $name,
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Starts an existing internal lb vm.
     *
     * @param string $id the ID of the internal lb vm
     */
    public function startInternalLoadBalancerVM($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("startInternalLoadBalancerVM",
            array(
                'id' => $id
            )
        );
    }

    /**
     * associate a profile to a blade
     *
     * @param string $ucsmanagerid ucs manager id
     * @param string $profiledn profile dn
     * @param string $bladeid blade id
     */
    public function associateUcsProfileToBlade($ucsmanagerid, $profiledn, $bladeid) {
        if (empty($ucsmanagerid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsmanagerid"), MISSING_ARGUMENT);
        }
        if (empty($profiledn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "profiledn"), MISSING_ARGUMENT);
        }
        if (empty($bladeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bladeid"), MISSING_ARGUMENT);
        }
        return $this->request("associateUcsProfileToBlade",
            array(
                'ucsmanagerid' => $ucsmanagerid,
                'profiledn' => $profiledn,
                'bladeid' => $bladeid
            )
        );
    }

    /**
     * Lists project's accounts
     *
     * @param string $projectid id of the project
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $role list accounts of the project by role
     *     @type string $keyword List by keyword
     *     @type string $account list accounts of the project by account name
     * }
     */
    public function listProjectAccounts($projectid, array $optArgs = array()) {
        if (empty($projectid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectid"), MISSING_ARGUMENT);
        }
        return $this->request("listProjectAccounts",
            array_merge(array(
                'projectid' => $projectid
            ), $optArgs)
        );
    }

    /**
     * Updates an existing autoscale vm profile.
     *
     * @param string $id the ID of the autoscale vm profile
     * @param array  $optArgs {
     *     @type string $counterparam counterparam list. Example:
     *     counterparam[0].name=snmpcommunity&counterparam[0].value=public&counterparam[1].name=snmpport&counterparam[1].value=161
     *     @type string $templateid the template of the auto deployed virtual machine
     *     @type string $autoscaleuserid the ID of the user used to launch and destroy the VMs
     *     @type string $destroyvmgraceperiod the time allowed for existing connections to get closed before a vm is
     *     destroyed
     * }
     */
    public function updateAutoScaleVmProfile($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateAutoScaleVmProfile",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Updates a port forwarding rule.  Only the private port and the virtual machine
     * can be updated.
     *
     * @param string $publicport the public port of the port forwarding rule
     * @param string $protocol the protocol for the port fowarding rule. Valid values are TCP or UDP.
     * @param string $ipaddressid the IP address id of the port forwarding rule
     * @param string $privateport the private port of the port forwarding rule
     * @param array  $optArgs {
     *     @type string $virtualmachineid the ID of the virtual machine for the port forwarding rule
     *     @type string $privateip the private IP address of the port forwarding rule
     * }
     */
    public function updatePortForwardingRule($publicport, $protocol, $ipaddressid, $privateport, array $optArgs = array()) {
        if (empty($publicport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicport"), MISSING_ARGUMENT);
        }
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipaddressid"), MISSING_ARGUMENT);
        }
        if (empty($privateport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privateport"), MISSING_ARGUMENT);
        }
        return $this->request("updatePortForwardingRule",
            array_merge(array(
                'publicport' => $publicport,
                'protocol' => $protocol,
                'ipaddressid' => $ipaddressid,
                'privateport' => $privateport
            ), $optArgs)
        );
    }

    /**
     * Lists dedicated hosts.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $account the name of the account associated with the host. Must be used with domainId.
     *     @type string $affinitygroupid list dedicated hosts by affinity group
     *     @type string $keyword List by keyword
     *     @type string $domainid the ID of the domain associated with the host
     *     @type string $hostid the ID of the host
     * }
     */
    public function listDedicatedHosts(array $optArgs = array()) {
        return $this->request("listDedicatedHosts",
            $optArgs
        );
    }

    /**
     * Lists all port forwarding rules for an IP address.
     *
     * @param array  $optArgs {
     *     @type string $id Lists rule with the specified ID.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $page the page number of the result set
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $pagesize the number of entries per page
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $ipaddressid the id of IP address of the port forwarding services
     *     @type string $networkid list port forwarding rules for ceratin network
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     * }
     */
    public function listPortForwardingRules(array $optArgs = array()) {
        return $this->request("listPortForwardingRules",
            $optArgs
        );
    }

    /**
     * List template visibility and all accounts that have permissions to view this
     * template.
     *
     * @param string $id the template ID
     */
    public function listTemplatePermissions($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("listTemplatePermissions",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates a Storage network IP range.
     *
     * @param string $startip the beginning IP address
     * @param string $podid UUID of pod where the ip range belongs to
     * @param string $netmask the netmask for storage network
     * @param string $gateway the gateway for storage network
     * @param array  $optArgs {
     *     @type string $endip the ending IP address
     *     @type string $vlan Optional. The vlan the ip range sits on, default to Null when it is not
     *     specificed which means you network is not on any Vlan. This is mainly for Vmware
     *     as other hypervisors can directly reterive bridge from pyhsical network traffic
     *     type table
     * }
     */
    public function createStorageNetworkIpRange($startip, $podid, $netmask, $gateway, array $optArgs = array()) {
        if (empty($startip)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startip"), MISSING_ARGUMENT);
        }
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podid"), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        return $this->request("createStorageNetworkIpRange",
            array_merge(array(
                'startip' => $startip,
                'podid' => $podid,
                'netmask' => $netmask,
                'gateway' => $gateway
            ), $optArgs)
        );
    }

    /**
     * Upload a certificate to cloudstack
     *
     * @param string $privatekey Private key
     * @param string $certificate SSL certificate
     * @param array  $optArgs {
     *     @type string $password Password for the private key
     *     @type string $certchain Certificate chain of trust
     * }
     */
    public function uploadSslCert($privatekey, $certificate, array $optArgs = array()) {
        if (empty($privatekey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privatekey"), MISSING_ARGUMENT);
        }
        if (empty($certificate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "certificate"), MISSING_ARGUMENT);
        }
        return $this->request("uploadSslCert",
            array_merge(array(
                'privatekey' => $privatekey,
                'certificate' => $certificate
            ), $optArgs)
        );
    }

    /**
     * Retrieves the current status of asynchronous job.
     *
     * @param string $jobid the ID of the asychronous job
     */
    public function queryAsyncJobResult($jobid) {
        if (empty($jobid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "jobid"), MISSING_ARGUMENT);
        }
        return $this->request("queryAsyncJobResult",
            array(
                'jobid' => $jobid
            )
        );
    }

    /**
     * Creates a Load Balancer
     *
     * @param string $sourceipaddressnetworkid the network id of the source ip address
     * @param string $scheme the load balancer scheme. Supported value in this release is Internal
     * @param string $sourceport the source port the network traffic will be load balanced from
     * @param string $networkid The guest network the Load Balancer will be created for
     * @param string $instanceport the TCP port of the virtual machine where the network traffic will be load
     * balanced to
     * @param string $name name of the Load Balancer
     * @param string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     * @param array  $optArgs {
     *     @type string $description the description of the Load Balancer
     *     @type string $sourceipaddress the source ip address the network traffic will be load balanced from
     * }
     */
    public function createLoadBalancer($sourceipaddressnetworkid, $scheme, $sourceport, $networkid, $instanceport, $name, $algorithm, array $optArgs = array()) {
        if (empty($sourceipaddressnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "sourceipaddressnetworkid"), MISSING_ARGUMENT);
        }
        if (empty($scheme)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "scheme"), MISSING_ARGUMENT);
        }
        if (empty($sourceport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "sourceport"), MISSING_ARGUMENT);
        }
        if (empty($networkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkid"), MISSING_ARGUMENT);
        }
        if (empty($instanceport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "instanceport"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "algorithm"), MISSING_ARGUMENT);
        }
        return $this->request("createLoadBalancer",
            array_merge(array(
                'sourceipaddressnetworkid' => $sourceipaddressnetworkid,
                'scheme' => $scheme,
                'sourceport' => $sourceport,
                'networkid' => $networkid,
                'instanceport' => $instanceport,
                'name' => $name,
                'algorithm' => $algorithm
            ), $optArgs)
        );
    }

    /**
     * Remove a VMware datacenter from a zone.
     *
     * @param string $zoneid The id of Zone from which VMware datacenter has to be removed.
     */
    public function removeVmwareDc($zoneid) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        return $this->request("removeVmwareDc",
            array(
                'zoneid' => $zoneid
            )
        );
    }

    /**
     * Cancels maintenance for primary storage
     *
     * @param string $id the primary storage ID
     */
    public function cancelStorageMaintenance($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("cancelStorageMaintenance",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates and automatically starts a virtual machine based on a service offering,
     * disk offering, and template.
     *
     * @param string $zoneid availability zone for the virtual machine
     * @param string $serviceofferingid the ID of the service offering for the virtual machine
     * @param string $templateid the ID of the template for the virtual machine
     * @param array  $optArgs {
     *     @type string $displayvm an optional field, whether to the display the vm to the end user or not.
     *     @type string $userdata an optional binary data that can be sent to the virtual machine upon a
     *     successful deployment. This binary data must be base64 encoded before adding it
     *     to the request. Using HTTP GET (via querystring), you can send up to 2KB of data
     *     after base64 encoding. Using HTTP POST(via POST body), you can send up to 32K of
     *     data after base64 encoding.
     *     @type string $displayname an optional user generated name for the virtual machine
     *     @type string $iptonetworklist ip to network mapping. Can't be specified with networkIds parameter. Example:
     *     iptonetworklist[0].ip=10.10.10.11&iptonetworklist[0].ipv6=fc00:1234:5678::abcd&iptonetworklist[0].networkid=uuid
     *     - requests to use ip 10.10.10.11 in network id=uuid
     *     @type string $name host name for the virtual machine
     *     @type string $keyboard an optional keyboard device type for the virtual machine. valid value can be one
     *     of de,de-ch,es,fi,fr,fr-be,fr-ch,is,it,jp,nl-be,no,pt,uk,us
     *     @type string $ipaddress the ip address for default vm's network
     *     @type string $affinitygroupnames comma separated list of affinity groups names that are going to be applied to
     *     the virtual machine.Mutually exclusive with affinitygroupids parameter
     *     @type string $ip6address the ipv6 address for default vm's network
     *     @type string $startvm true if network offering supports specifying ip ranges; defaulted to true if not
     *     specified
     *     @type string $hostid destination Host ID to deploy the VM to - parameter available for root admin
     *     only
     *     @type string $group an optional group for the virtual machine
     *     @type string $hypervisor the hypervisor on which to deploy the virtual machine
     *     @type string $securitygroupids comma separated list of security groups id that going to be applied to the
     *     virtual machine. Should be passed only when vm is created from a zone with Basic
     *     Network support. Mutually exclusive with securitygroupnames parameter
     *     @type string $details used to specify the custom parameters.
     *     @type string $size the arbitrary size for the DATADISK volume. Mutually exclusive with
     *     diskOfferingId
     *     @type string $diskofferingid the ID of the disk offering for the virtual machine. If the template is of ISO
     *     format, the diskOfferingId is for the root disk volume. Otherwise this parameter
     *     is used to indicate the offering for the data disk volume. If the templateId
     *     parameter passed is from a Template object, the diskOfferingId refers to a DATA
     *     Disk Volume created. If the templateId parameter passed is from an ISO object,
     *     the diskOfferingId refers to a ROOT Disk Volume created.
     *     @type string $projectid Deploy vm for the project
     *     @type string $keypair name of the ssh key pair used to login to the virtual machine
     *     @type string $account an optional account for the virtual machine. Must be used with domainId.
     *     @type string $networkids list of network ids used by virtual machine. Can't be specified with
     *     ipToNetworkList parameter
     *     @type string $affinitygroupids comma separated list of affinity groups id that are going to be applied to the
     *     virtual machine. Mutually exclusive with affinitygroupnames parameter
     *     @type string $domainid an optional domainId for the virtual machine. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $securitygroupnames comma separated list of security groups names that going to be applied to the
     *     virtual machine. Should be passed only when vm is created from a zone with Basic
     *     Network support. Mutually exclusive with securitygroupids parameter
     * }
     */
    public function deployVirtualMachine($zoneid, $serviceofferingid, $templateid, array $optArgs = array()) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceofferingid"), MISSING_ARGUMENT);
        }
        if (empty($templateid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateid"), MISSING_ARGUMENT);
        }
        return $this->request("deployVirtualMachine",
            array_merge(array(
                'zoneid' => $zoneid,
                'serviceofferingid' => $serviceofferingid,
                'templateid' => $templateid
            ), $optArgs)
        );
    }

    /**
     * Deletes a Pod.
     *
     * @param string $id the ID of the Pod
     */
    public function deletePod($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deletePod",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a particular egress rule from this security group
     *
     * @param string $id The ID of the egress rule
     */
    public function revokeSecurityGroupEgress($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("revokeSecurityGroupEgress",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Removes a condition
     *
     * @param string $id the ID of the condition.
     */
    public function deleteCondition($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteCondition",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates a Network ACL for the given VPC
     *
     * @param string $vpcid Id of the VPC associated with this network ACL List
     * @param string $name Name of the network ACL List
     * @param array  $optArgs {
     *     @type string $description Description of the network ACL List
     * }
     */
    public function createNetworkACLList($vpcid, $name, array $optArgs = array()) {
        if (empty($vpcid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcid"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createNetworkACLList",
            array_merge(array(
                'vpcid' => $vpcid,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Deletes a secondary staging store .
     *
     * @param string $id the staging store ID
     */
    public function deleteSecondaryStagingStore($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteSecondaryStagingStore",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates a port forwarding rule
     *
     * @param string $protocol the protocol for the port fowarding rule. Valid values are TCP or UDP.
     * @param string $privateport the starting port of port forwarding rule's private port range
     * @param string $virtualmachineid the ID of the virtual machine for the port forwarding rule
     * @param string $ipaddressid the IP address id of the port forwarding rule
     * @param string $publicport the starting port of port forwarding rule's public port range
     * @param array  $optArgs {
     *     @type string $publicendport the ending port of port forwarding rule's private port range
     *     @type string $networkid The network of the vm the Port Forwarding rule will be created for. Required
     *     when public Ip address is not associated with any Guest network yet (VPC case)
     *     @type string $cidrlist the cidr list to forward traffic from
     *     @type string $openfirewall if true, firewall rule for source/end pubic port is automatically created; if
     *     false - firewall rule has to be created explicitely. If not specified 1)
     *     defaulted to false when PF rule is being created for VPC guest network 2) in all
     *     other cases defaulted to true
     *     @type string $vmguestip VM guest nic Secondary ip address for the port forwarding rule
     *     @type string $privateendport the ending port of port forwarding rule's private port range
     * }
     */
    public function createPortForwardingRule($protocol, $privateport, $virtualmachineid, $ipaddressid, $publicport, array $optArgs = array()) {
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        if (empty($privateport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privateport"), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipaddressid"), MISSING_ARGUMENT);
        }
        if (empty($publicport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicport"), MISSING_ARGUMENT);
        }
        return $this->request("createPortForwardingRule",
            array_merge(array(
                'protocol' => $protocol,
                'privateport' => $privateport,
                'virtualmachineid' => $virtualmachineid,
                'ipaddressid' => $ipaddressid,
                'publicport' => $publicport
            ), $optArgs)
        );
    }

    /**
     * lists netscaler load balancer devices
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $physicalnetworkid the Physical Network ID
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $lbdeviceid netscaler load balancer device ID
     * }
     */
    public function listNetscalerLoadBalancers(array $optArgs = array()) {
        return $this->request("listNetscalerLoadBalancers",
            $optArgs
        );
    }

    /**
     * Creates VPC offering
     *
     * @param string $name the name of the vpc offering
     * @param string $supportedservices services supported by the vpc offering
     * @param string $displaytext the display text of the vpc offering
     * @param array  $optArgs {
     *     @type string $serviceofferingid the ID of the service offering for the VPC router appliance
     *     @type string $serviceproviderlist provider to service mapping. If not specified, the provider for the service will
     *     be mapped to the default provider on the physical network
     * }
     */
    public function createVPCOffering($name, $supportedservices, $displaytext, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($supportedservices)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "supportedservices"), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displaytext"), MISSING_ARGUMENT);
        }
        return $this->request("createVPCOffering",
            array_merge(array(
                'name' => $name,
                'supportedservices' => $supportedservices,
                'displaytext' => $displaytext
            ), $optArgs)
        );
    }

    /**
     * Creates a egress firewall rule for a given network
     *
     * @param string $networkid the network id of the port forwarding rule
     * @param string $protocol the protocol for the firewall rule. Valid values are TCP/UDP/ICMP.
     * @param array  $optArgs {
     *     @type string $endport the ending port of firewall rule
     *     @type string $type type of firewallrule: system/user
     *     @type string $cidrlist the cidr list to forward traffic from
     *     @type string $startport the starting port of firewall rule
     *     @type string $icmpcode error code for this icmp message
     *     @type string $icmptype type of the icmp message being sent
     * }
     */
    public function createEgressFirewallRule($networkid, $protocol, array $optArgs = array()) {
        if (empty($networkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkid"), MISSING_ARGUMENT);
        }
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        return $this->request("createEgressFirewallRule",
            array_merge(array(
                'networkid' => $networkid,
                'protocol' => $protocol
            ), $optArgs)
        );
    }

    /**
     * Destroys a router.
     *
     * @param string $id the ID of the router
     */
    public function destroyRouter($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("destroyRouter",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Delete one or more alerts.
     *
     * @param array  $optArgs {
     *     @type string $ids the IDs of the alerts
     *     @type string $enddate end date range to delete alerts (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $startdate start date range to delete alerts (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $type delete by alert type
     * }
     */
    public function deleteAlerts(array $optArgs = array()) {
        return $this->request("deleteAlerts",
            $optArgs
        );
    }

    /**
     * Lists usage records for accounts
     *
     * @param string $enddate End date range for usage record query. Use yyyy-MM-dd as the date format, e.g.
     * startDate=2009-06-03.
     * @param string $startdate Start date range for usage record query. Use yyyy-MM-dd as the date format, e.g.
     * startDate=2009-06-01.
     * @param array  $optArgs {
     *     @type string $projectid List usage records for specified project
     *     @type string $pagesize the number of entries per page
     *     @type string $type List usage records for the specified usage type
     *     @type string $accountid List usage records for the specified account
     *     @type string $page the page number of the result set
     *     @type string $account List usage records for the specified user.
     *     @type string $keyword List by keyword
     *     @type string $domainid List usage records for the specified domain.
     * }
     */
    public function listUsageRecords($enddate, $startdate, array $optArgs = array()) {
        if (empty($enddate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "enddate"), MISSING_ARGUMENT);
        }
        if (empty($startdate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startdate"), MISSING_ARGUMENT);
        }
        return $this->request("listUsageRecords",
            array_merge(array(
                'enddate' => $enddate,
                'startdate' => $startdate
            ), $optArgs)
        );
    }

    /**
     * Assign load balancer rule or list of load balancer rules to a global load
     * balancer rules.
     *
     * @param string $id the ID of the global load balancer rule
     * @param string $loadbalancerrulelist the list load balancer rules that will be assigned to gloabal load balacner
     * rule
     * @param array  $optArgs {
     *     @type string $gslblbruleweightsmap Map of LB rule id's and corresponding weights (between 1-100) in the GSLB rule,
     *     if not specified weight of a LB rule is defaulted to 1. Specified as
     *     'gslblbruleweightsmap[0].loadbalancerid=UUID&gslblbruleweightsmap[0].weight=10'
     * }
     */
    public function assignToGlobalLoadBalancerRule($id, $loadbalancerrulelist, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($loadbalancerrulelist)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "loadbalancerrulelist"), MISSING_ARGUMENT);
        }
        return $this->request("assignToGlobalLoadBalancerRule",
            array_merge(array(
                'id' => $id,
                'loadbalancerrulelist' => $loadbalancerrulelist
            ), $optArgs)
        );
    }

    /**
     * Updates traffic type of a physical network
     *
     * @param string $id traffic type id
     * @param array  $optArgs {
     *     @type string $xennetworklabel The network name label of the physical device dedicated to this traffic on a
     *     XenServer host
     *     @type string $kvmnetworklabel The network name label of the physical device dedicated to this traffic on a KVM
     *     host
     *     @type string $vmwarenetworklabel The network name label of the physical device dedicated to this traffic on a
     *     VMware host
     *     @type string $hypervnetworklabel The network name label of the physical device dedicated to this traffic on a
     *     Hyperv host
     * }
     */
    public function updateTrafficType($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateTrafficType",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists all Pods.
     *
     * @param array  $optArgs {
     *     @type string $id list Pods by ID
     *     @type string $allocationstate list pods by allocation state
     *     @type string $name list Pods by name
     *     @type string $keyword List by keyword
     *     @type string $zoneid list Pods by Zone ID
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $showcapacities flag to display the capacity of the pods
     * }
     */
    public function listPods(array $optArgs = array()) {
        return $this->request("listPods",
            $optArgs
        );
    }

    /**
     * Lists all LDAP configurations
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $hostname Hostname
     *     @type string $port Port
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     */
    public function listLdapConfigurations(array $optArgs = array()) {
        return $this->request("listLdapConfigurations",
            $optArgs
        );
    }

    /**
     * Enables a user account
     *
     * @param string $id Enables user by user ID.
     */
    public function enableUser($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("enableUser",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists all supported OS categories for this cloud.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $id list Os category by id
     *     @type string $name list os category by name
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     * }
     */
    public function listOsCategories(array $optArgs = array()) {
        return $this->request("listOsCategories",
            $optArgs
        );
    }

    /**
     * Adds a SRX firewall device
     *
     * @param string $username Credentials to reach SRX firewall device
     * @param string $password Credentials to reach SRX firewall device
     * @param string $url URL of the SRX appliance.
     * @param string $networkdevicetype supports only JuniperSRXFirewall
     * @param string $physicalnetworkid the Physical Network ID
     */
    public function addSrxFirewall($username, $password, $url, $networkdevicetype, $physicalnetworkid) {
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($networkdevicetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkdevicetype"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        return $this->request("addSrxFirewall",
            array(
                'username' => $username,
                'password' => $password,
                'url' => $url,
                'networkdevicetype' => $networkdevicetype,
                'physicalnetworkid' => $physicalnetworkid
            )
        );
    }

    /**
     * Adds a Nicira NVP device
     *
     * @param string $transportzoneuuid The Transportzone UUID configured on the Nicira Controller
     * @param string $hostname Hostname of ip address of the Nicira NVP Controller.
     * @param string $username Credentials to access the Nicira Controller API
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $password Credentials to access the Nicira Controller API
     * @param array  $optArgs {
     *     @type string $l3gatewayserviceuuid The L3 Gateway Service UUID configured on the Nicira Controller
     * }
     */
    public function addNiciraNvpDevice($transportzoneuuid, $hostname, $username, $physicalnetworkid, $password, array $optArgs = array()) {
        if (empty($transportzoneuuid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "transportzoneuuid"), MISSING_ARGUMENT);
        }
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        return $this->request("addNiciraNvpDevice",
            array_merge(array(
                'transportzoneuuid' => $transportzoneuuid,
                'hostname' => $hostname,
                'username' => $username,
                'physicalnetworkid' => $physicalnetworkid,
                'password' => $password
            ), $optArgs)
        );
    }

    /**
     * Assigns secondary IP to NIC
     *
     * @param string $nicid the ID of the nic to which you want to assign private IP
     * @param array  $optArgs {
     *     @type string $ipaddress Secondary IP Address
     * }
     */
    public function addIpToNic($nicid, array $optArgs = array()) {
        if (empty($nicid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nicid"), MISSING_ARGUMENT);
        }
        return $this->request("addIpToNic",
            array_merge(array(
                'nicid' => $nicid
            ), $optArgs)
        );
    }

    /**
     * Updates ACL Item with specified Id
     *
     * @param string $id the ID of the network ACL Item
     * @param array  $optArgs {
     *     @type string $cidrlist the cidr list to allow traffic from/to
     *     @type string $traffictype the traffic type for the ACL,can be Ingress or Egress, defaulted to Ingress if
     *     not specified
     *     @type string $action scl entry action, allow or deny
     *     @type string $protocol the protocol for the ACL rule. Valid values are TCP/UDP/ICMP/ALL or valid
     *     protocol number
     *     @type string $endport the ending port of ACL
     *     @type string $number The network of the vm the ACL will be created for
     *     @type string $icmptype type of the icmp message being sent
     *     @type string $icmpcode error code for this icmp message
     *     @type string $startport the starting port of ACL
     * }
     */
    public function updateNetworkACLItem($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateNetworkACLItem",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Creates a vm group
     *
     * @param string $name the name of the instance group
     * @param array  $optArgs {
     *     @type string $projectid The project of the instance group
     *     @type string $domainid the domain ID of account owning the instance group
     *     @type string $account the account of the instance group. The account parameter must be used with the
     *     domainId parameter.
     * }
     */
    public function createInstanceGroup($name, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createInstanceGroup",
            array_merge(array(
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Deletes a Network ACL
     *
     * @param string $id the ID of the network ACL
     */
    public function deleteNetworkACLList($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteNetworkACLList",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Updates account information for the authenticated user
     *
     * @param string $newname new name for the account
     * @param array  $optArgs {
     *     @type string $networkdomain Network domain for the account's networks; empty string will update domainName
     *     with NULL value
     *     @type string $domainid the ID of the domain where the account exists
     *     @type string $account the current account name
     *     @type string $id Account id
     *     @type string $accountdetails details for account used to store specific parameters
     * }
     */
    public function updateAccount($newname, array $optArgs = array()) {
        if (empty($newname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "newname"), MISSING_ARGUMENT);
        }
        return $this->request("updateAccount",
            array_merge(array(
                'newname' => $newname
            ), $optArgs)
        );
    }

    /**
     * Deletes network device.
     *
     * @param string $id Id of network device to delete
     */
    public function deleteNetworkDevice($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteNetworkDevice",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists snapshot policies.
     *
     * @param string $volumeid the ID of the disk volume
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     */
    public function listSnapshotPolicies($volumeid, array $optArgs = array()) {
        if (empty($volumeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeid"), MISSING_ARGUMENT);
        }
        return $this->request("listSnapshotPolicies",
            array_merge(array(
                'volumeid' => $volumeid
            ), $optArgs)
        );
    }

    /**
     * Configures an Internal Load Balancer element.
     *
     * @param string $enabled Enables/Disables the Internal Load Balancer element
     * @param string $id the ID of the internal lb provider
     */
    public function configureInternalLoadBalancerElement($enabled, $id) {
        if (empty($enabled)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "enabled"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("configureInternalLoadBalancerElement",
            array(
                'enabled' => $enabled,
                'id' => $id
            )
        );
    }

    /**
     * Releases host reservation.
     *
     * @param string $id the host ID
     */
    public function releaseHostReservation($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("releaseHostReservation",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates a domain
     *
     * @param string $name creates domain with this name
     * @param array  $optArgs {
     *     @type string $parentdomainid assigns new domain a parent domain by domain ID of the parent.  If no parent
     *     domain is specied, the ROOT domain is assumed.
     *     @type string $domainid Domain UUID, required for adding domain from another Region
     *     @type string $networkdomain Network domain for networks in the domain
     * }
     */
    public function createDomain($name, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createDomain",
            array_merge(array(
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Deletes a keypair by name
     *
     * @param string $name Name of the keypair
     * @param array  $optArgs {
     *     @type string $projectid the project associated with keypair
     *     @type string $account the account associated with the keypair. Must be used with the domainId
     *     parameter.
     *     @type string $domainid the domain ID associated with the keypair
     * }
     */
    public function deleteSSHKeyPair($name, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("deleteSSHKeyPair",
            array_merge(array(
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Deletes snapshot policies for the account.
     *
     * @param array  $optArgs {
     *     @type string $id the Id of the snapshot policy
     *     @type string $ids list of snapshots policy IDs separated by comma
     * }
     */
    public function deleteSnapshotPolicies(array $optArgs = array()) {
        return $this->request("deleteSnapshotPolicies",
            $optArgs
        );
    }

    /**
     * Lists load balancer HealthCheck policies.
     *
     * @param string $lbruleid the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     */
    public function listLBHealthCheckPolicies($lbruleid, array $optArgs = array()) {
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleid"), MISSING_ARGUMENT);
        }
        return $this->request("listLBHealthCheckPolicies",
            array_merge(array(
                'lbruleid' => $lbruleid
            ), $optArgs)
        );
    }

    /**
     * A command to list events.
     *
     * @param array  $optArgs {
     *     @type string $projectid list objects by project
     *     @type string $startdate the start date range of the list you want to retrieve (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-dd HH:mm:ss")
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $type the event type (see event types)
     *     @type string $pagesize the number of entries per page
     *     @type string $entrytime the time the event was entered
     *     @type string $duration the duration of the event
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $id the ID of the event
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $level the event level (INFO, WARN, ERROR)
     *     @type string $enddate the end date range of the list you want to retrieve (use format "yyyy-MM-dd" or
     *     the new format "yyyy-MM-dd HH:mm:ss")
     *     @type string $page the page number of the result set
     * }
     */
    public function listEvents(array $optArgs = array()) {
        return $this->request("listEvents",
            $optArgs
        );
    }

    /**
     * Assigns a certificate to a Load Balancer Rule
     *
     * @param string $certid the ID of the certificate
     * @param string $lbruleid the ID of the load balancer rule
     */
    public function assignCertToLoadBalancer($certid, $lbruleid) {
        if (empty($certid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "certid"), MISSING_ARGUMENT);
        }
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleid"), MISSING_ARGUMENT);
        }
        return $this->request("assignCertToLoadBalancer",
            array(
                'certid' => $certid,
                'lbruleid' => $lbruleid
            )
        );
    }

    /**
     * Adds a new host.
     *
     * @param string $url the host URL
     * @param string $podid the Pod ID for the host
     * @param string $zoneid the Zone ID for the host
     * @param string $hypervisor hypervisor type of the host
     * @param string $password the password for the host
     * @param string $username the username for the host
     * @param array  $optArgs {
     *     @type string $clusterid the cluster ID for the host
     *     @type string $hosttags list of tags to be added to the host
     *     @type string $allocationstate Allocation state of this Host for allocation of new resources
     *     @type string $clustername the cluster name for the host
     * }
     */
    public function addHost($url, $podid, $zoneid, $hypervisor, $password, $username, array $optArgs = array()) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podid"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        return $this->request("addHost",
            array_merge(array(
                'url' => $url,
                'podid' => $podid,
                'zoneid' => $zoneid,
                'hypervisor' => $hypervisor,
                'password' => $password,
                'username' => $username
            ), $optArgs)
        );
    }

    /**
     * Lists dedicated clusters.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $account the name of the account associated with the cluster. Must be used with
     *     domainId.
     *     @type string $domainid the ID of the domain associated with the cluster
     *     @type string $affinitygroupid list dedicated clusters by affinity group
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $clusterid the ID of the cluster
     * }
     */
    public function listDedicatedClusters(array $optArgs = array()) {
        return $this->request("listDedicatedClusters",
            $optArgs
        );
    }

    /**
     * Delete site to site vpn gateway
     *
     * @param string $id id of customer gateway
     */
    public function deleteVpnGateway($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteVpnGateway",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Expunge a virtual machine. Once expunged, it cannot be recoverd.
     *
     * @param string $id The ID of the virtual machine
     */
    public function expungeVirtualMachine($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("expungeVirtualMachine",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Adds a network device of one of the following types: ExternalDhcp,
     * ExternalFirewall, ExternalLoadBalancer, PxeServer
     *
     * @param array  $optArgs {
     *     @type string $networkdevicetype Network device type, now supports ExternalDhcp, PxeServer,
     *     NetscalerMPXLoadBalancer, NetscalerVPXLoadBalancer, NetscalerSDXLoadBalancer,
     *     F5BigIpLoadBalancer, JuniperSRXFirewall, PaloAltoFirewall
     *     @type string $networkdeviceparameterlist parameters for network device
     * }
     */
    public function addNetworkDevice(array $optArgs = array()) {
        return $this->request("addNetworkDevice",
            $optArgs
        );
    }

    /**
     * Creates and automatically starts a virtual machine based on a service offering,
     * disk offering, and template.
     *
     * @param string $minmembers the minimum number of members in the vmgroup, the number of instances in the vm
     * group will be equal to or more than this number.
     * @param string $maxmembers the maximum number of members in the vmgroup, The number of instances in the vm
     * group will be equal to or less than this number.
     * @param string $scaleuppolicyids list of scaleup autoscale policies
     * @param string $lbruleid the ID of the load balancer rule
     * @param string $scaledownpolicyids list of scaledown autoscale policies
     * @param string $vmprofileid the autoscale profile that contains information about the vms in the vm group.
     * @param array  $optArgs {
     *     @type string $interval the frequency at which the conditions have to be evaluated
     * }
     */
    public function createAutoScaleVmGroup($minmembers, $maxmembers, $scaleuppolicyids, $lbruleid, $scaledownpolicyids, $vmprofileid, array $optArgs = array()) {
        if (empty($minmembers)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "minmembers"), MISSING_ARGUMENT);
        }
        if (empty($maxmembers)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "maxmembers"), MISSING_ARGUMENT);
        }
        if (empty($scaleuppolicyids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "scaleuppolicyids"), MISSING_ARGUMENT);
        }
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleid"), MISSING_ARGUMENT);
        }
        if (empty($scaledownpolicyids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "scaledownpolicyids"), MISSING_ARGUMENT);
        }
        if (empty($vmprofileid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vmprofileid"), MISSING_ARGUMENT);
        }
        return $this->request("createAutoScaleVmGroup",
            array_merge(array(
                'minmembers' => $minmembers,
                'maxmembers' => $maxmembers,
                'scaleuppolicyids' => $scaleuppolicyids,
                'lbruleid' => $lbruleid,
                'scaledownpolicyids' => $scaledownpolicyids,
                'vmprofileid' => $vmprofileid
            ), $optArgs)
        );
    }

    /**
     * Starts a router.
     *
     * @param string $id the ID of the router
     */
    public function rebootRouter($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("rebootRouter",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a Network Service Provider.
     *
     * @param string $id the ID of the network service provider
     */
    public function deleteNetworkServiceProvider($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteNetworkServiceProvider",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates a Load Balancer healthcheck policy
     *
     * @param string $lbruleid the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $healthythreshold Number of consecutive health check success before declaring an instance healthy
     *     @type string $description the description of the load balancer HealthCheck policy
     *     @type string $intervaltime Amount of time between health checks (1 sec - 20940 sec)
     *     @type string $unhealthythreshold Number of consecutive health check failures before declaring an instance
     *     unhealthy
     *     @type string $pingpath HTTP Ping Path
     *     @type string $responsetimeout Time to wait when receiving a response from the health check (2sec - 60 sec)
     * }
     */
    public function createLBHealthCheckPolicy($lbruleid, array $optArgs = array()) {
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleid"), MISSING_ARGUMENT);
        }
        return $this->request("createLBHealthCheckPolicy",
            array_merge(array(
                'lbruleid' => $lbruleid
            ), $optArgs)
        );
    }

    /**
     * Archive one or more events.
     *
     * @param array  $optArgs {
     *     @type string $startdate start date range to archive events (including) this date (use format
     *     "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $type archive by event type
     *     @type string $enddate end date range to archive events (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $ids the IDs of the events
     * }
     */
    public function archiveEvents(array $optArgs = array()) {
        return $this->request("archiveEvents",
            $optArgs
        );
    }

    /**
     * Lists all configurations.
     *
     * @param array  $optArgs {
     *     @type string $zoneid the ID of the Zone to update the parameter value for corresponding zone
     *     @type string $keyword List by keyword
     *     @type string $category lists configurations by category
     *     @type string $pagesize the number of entries per page
     *     @type string $name lists configuration by name
     *     @type string $page the page number of the result set
     *     @type string $storageid the ID of the Storage pool to update the parameter value for corresponding
     *     storage pool
     *     @type string $clusterid the ID of the Cluster to update the parameter value for corresponding cluster
     *     @type string $accountid the ID of the Account to update the parameter value for corresponding account
     * }
     */
    public function listConfigurations(array $optArgs = array()) {
        return $this->request("listConfigurations",
            $optArgs
        );
    }

    /**
     * Updates a host.
     *
     * @param string $id the ID of the host to update
     * @param array  $optArgs {
     *     @type string $hosttags list of tags to be added to the host
     *     @type string $allocationstate Change resource state of host, valid values are [Enable, Disable]. Operation may
     *     failed if host in states not allowing Enable/Disable
     *     @type string $url the new uri for the secondary storage: nfs://host/path
     *     @type string $oscategoryid the id of Os category to update the host with
     * }
     */
    public function updateHost($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateHost",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists projects and provides detailed information for listed projects
     *
     * @param array  $optArgs {
     *     @type string $state list invitations by state
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $projectid list by project id
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $activeonly if true, list only active invitations - having Pending state and ones that are
     *     not timed out yet
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $id list invitations by id
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     */
    public function listProjectInvitations(array $optArgs = array()) {
        return $this->request("listProjectInvitations",
            $optArgs
        );
    }

    /**
     * Deletes an ISO file.
     *
     * @param string $id the ID of the ISO file
     * @param array  $optArgs {
     *     @type string $zoneid the ID of the zone of the ISO file. If not specified, the ISO will be deleted
     *     from all the zones
     * }
     */
    public function deleteIso($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteIso",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Creates site to site vpn customer gateway
     *
     * @param string $gateway public ip address id of the customer gateway
     * @param string $ikepolicy IKE policy of the customer gateway
     * @param string $cidrlist guest cidr list of the customer gateway
     * @param string $esppolicy ESP policy of the customer gateway
     * @param string $ipsecpsk IPsec Preshared-Key of the customer gateway
     * @param array  $optArgs {
     *     @type string $esplifetime Lifetime of phase 2 VPN connection to the customer gateway, in seconds
     *     @type string $domainid the domain ID associated with the gateway. If used with the account parameter
     *     returns the gateway associated with the account for the specified domain.
     *     @type string $account the account associated with the gateway. Must be used with the domainId
     *     parameter.
     *     @type string $ikelifetime Lifetime of phase 1 VPN connection to the customer gateway, in seconds
     *     @type string $dpd If DPD is enabled for VPN connection
     *     @type string $name name of this customer gateway
     * }
     */
    public function createVpnCustomerGateway($gateway, $ikepolicy, $cidrlist, $esppolicy, $ipsecpsk, array $optArgs = array()) {
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        if (empty($ikepolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ikepolicy"), MISSING_ARGUMENT);
        }
        if (empty($cidrlist)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidrlist"), MISSING_ARGUMENT);
        }
        if (empty($esppolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "esppolicy"), MISSING_ARGUMENT);
        }
        if (empty($ipsecpsk)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipsecpsk"), MISSING_ARGUMENT);
        }
        return $this->request("createVpnCustomerGateway",
            array_merge(array(
                'gateway' => $gateway,
                'ikepolicy' => $ikepolicy,
                'cidrlist' => $cidrlist,
                'esppolicy' => $esppolicy,
                'ipsecpsk' => $ipsecpsk
            ), $optArgs)
        );
    }

    /**
     * Lists traffic types of a given physical network.
     *
     * @param string $physicalnetworkid the Physical Network ID
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listTrafficTypes($physicalnetworkid, array $optArgs = array()) {
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        return $this->request("listTrafficTypes",
            array_merge(array(
                'physicalnetworkid' => $physicalnetworkid
            ), $optArgs)
        );
    }

    /**
     * Updates resource limits for an account or domain.
     *
     * @param string $resourcetype Type of resource to update. Values are 0, 1, 2, 3, 4, 6, 7, 8, 9, 10 and 11. 0 -
     * Instance. Number of instances a user can create. 1 - IP. Number of public IP
     * addresses a user can own. 2 - Volume. Number of disk volumes a user can create.3
     * - Snapshot. Number of snapshots a user can create.4 - Template. Number of
     * templates that a user can register/create.6 - Network. Number of guest network a
     * user can create.7 - VPC. Number of VPC a user can create.8 - CPU. Total number
     * of CPU cores a user can use.9 - Memory. Total Memory (in MB) a user can use.10 -
     * PrimaryStorage. Total primary storage space (in GiB) a user can use.11 -
     * SecondaryStorage. Total secondary storage space (in GiB) a user can use.
     * @param array  $optArgs {
     *     @type string $max Maximum resource limit.
     *     @type string $domainid Update resource limits for all accounts in specified domain. If used with the
     *     account parameter, updates resource limits for a specified account in specified
     *     domain.
     *     @type string $projectid Update resource limits for project
     *     @type string $account Update resource for a specified account. Must be used with the domainId
     *     parameter.
     * }
     */
    public function updateResourceLimit($resourcetype, array $optArgs = array()) {
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourcetype"), MISSING_ARGUMENT);
        }
        return $this->request("updateResourceLimit",
            array_merge(array(
                'resourcetype' => $resourcetype
            ), $optArgs)
        );
    }

    /**
     * Locks an account
     *
     * @param string $domainid Locks the specified account on this domain.
     * @param string $account Locks the specified account.
     */
    public function lockAccount($domainid, $account) {
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainid"), MISSING_ARGUMENT);
        }
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        return $this->request("lockAccount",
            array(
                'domainid' => $domainid,
                'account' => $account
            )
        );
    }

    /**
     * Deletes an traffic monitor host.
     *
     * @param string $id Id of the Traffic Monitor Host.
     */
    public function deleteTrafficMonitor($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteTrafficMonitor",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates a user for an account that already exists
     *
     * @param string $password Clear text password (Default hashed to SHA256SALT). If you wish to use any other
     * hashing algorithm, you would need to write a custom authentication adapter See
     * Docs section.
     * @param string $account Creates the user under the specified account. If no account is specified, the
     * username will be used as the account name.
     * @param string $username Unique username.
     * @param string $firstname firstname
     * @param string $lastname lastname
     * @param string $email email
     * @param array  $optArgs {
     *     @type string $domainid Creates the user under the specified domain. Has to be accompanied with the
     *     account parameter
     *     @type string $userid User UUID, required for adding account from external provisioning system
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone
     *     parameter, see Time Zone Format.
     * }
     */
    public function createUser($password, $account, $username, $firstname, $lastname, $email, array $optArgs = array()) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($firstname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "firstname"), MISSING_ARGUMENT);
        }
        if (empty($lastname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lastname"), MISSING_ARGUMENT);
        }
        if (empty($email)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "email"), MISSING_ARGUMENT);
        }
        return $this->request("createUser",
            array_merge(array(
                'password' => $password,
                'account' => $account,
                'username' => $username,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email
            ), $optArgs)
        );
    }

    /**
     * Deletes a autoscale policy.
     *
     * @param string $id the ID of the autoscale policy
     */
    public function deleteAutoScalePolicy($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteAutoScalePolicy",
            array(
                'id' => $id
            )
        );
    }

    /**
     * delete a SRX firewall device
     *
     * @param string $fwdeviceid srx firewall device ID
     */
    public function deleteSrxFirewall($fwdeviceid) {
        if (empty($fwdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("deleteSrxFirewall",
            array(
                'fwdeviceid' => $fwdeviceid
            )
        );
    }

    /**
     * Lists supported methods of network isolation
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     */
    public function listNetworkIsolationMethods(array $optArgs = array()) {
        return $this->request("listNetworkIsolationMethods",
            $optArgs
        );
    }

    /**
     * Lists all available disk offerings.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $name name of the disk offering
     *     @type string $keyword List by keyword
     *     @type string $domainid the ID of the domain of the disk offering.
     *     @type string $id ID of the disk offering
     * }
     */
    public function listDiskOfferings(array $optArgs = array()) {
        return $this->request("listDiskOfferings",
            $optArgs
        );
    }

    /**
     * Detaches a disk volume from a virtual machine.
     *
     * @param array  $optArgs {
     *     @type string $deviceid the device ID on the virtual machine where volume is detached from
     *     @type string $virtualmachineid the ID of the virtual machine where the volume is detached from
     *     @type string $id the ID of the disk volume
     * }
     */
    public function detachVolume(array $optArgs = array()) {
        return $this->request("detachVolume",
            $optArgs
        );
    }

    /**
     * Deletes a user for an account
     *
     * @param string $id id of the user to be deleted
     */
    public function deleteUser($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteUser",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a Network ACL
     *
     * @param string $id the ID of the network ACL
     */
    public function deleteNetworkACL($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteNetworkACL",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists all available snapshots for the account.
     *
     * @param array  $optArgs {
     *     @type string $snapshottype valid values are MANUAL or RECURRING.
     *     @type string $zoneid list snapshots by zone id
     *     @type string $projectid list objects by project
     *     @type string $volumeid the ID of the disk volume
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $id lists snapshot by snapshot ID
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $keyword List by keyword
     *     @type string $name lists snapshot by snapshot name
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $page the page number of the result set
     *     @type string $intervaltype valid values are HOURLY, DAILY, WEEKLY, and MONTHLY.
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listSnapshots(array $optArgs = array()) {
        return $this->request("listSnapshots",
            $optArgs
        );
    }

    /**
     * Deletes a VPC
     *
     * @param string $id the ID of the VPC
     */
    public function deleteVPC($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteVPC",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes security group
     *
     * @param array  $optArgs {
     *     @type string $domainid the domain ID of account owning the security group
     *     @type string $id The ID of the security group. Mutually exclusive with name parameter
     *     @type string $projectid the project of the security group
     *     @type string $name The ID of the security group. Mutually exclusive with id parameter
     *     @type string $account the account of the security group. Must be specified with domain ID
     * }
     */
    public function deleteSecurityGroup(array $optArgs = array()) {
        return $this->request("deleteSecurityGroup",
            $optArgs
        );
    }

    /**
     * Adds S3
     *
     * @param string $secretkey S3 secret key
     * @param string $accesskey S3 access key
     * @param string $bucket name of the template storage bucket
     * @param array  $optArgs {
     *     @type string $maxerrorretry maximum number of times to retry on error
     *     @type string $sockettimeout socket timeout (milliseconds)
     *     @type string $connectiontimeout connection timeout (milliseconds)
     *     @type string $usehttps connect to the S3 endpoint via HTTPS?
     *     @type string $endpoint S3 host name
     * }
     */
    public function addS3($secretkey, $accesskey, $bucket, array $optArgs = array()) {
        if (empty($secretkey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "secretkey"), MISSING_ARGUMENT);
        }
        if (empty($accesskey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accesskey"), MISSING_ARGUMENT);
        }
        if (empty($bucket)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bucket"), MISSING_ARGUMENT);
        }
        return $this->request("addS3",
            array_merge(array(
                'secretkey' => $secretkey,
                'accesskey' => $accesskey,
                'bucket' => $bucket
            ), $optArgs)
        );
    }

    /**
     * List the counters
     *
     * @param array  $optArgs {
     *     @type string $source Source of the counter.
     *     @type string $pagesize the number of entries per page
     *     @type string $name Name of the counter.
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $id ID of the Counter.
     * }
     */
    public function listCounters(array $optArgs = array()) {
        return $this->request("listCounters",
            $optArgs
        );
    }

    /**
     * Delete a certificate to cloudstack
     *
     * @param string $id Id of SSL certificate
     */
    public function deleteSslCert($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteSslCert",
            array(
                'id' => $id
            )
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
     */
    public function updateHypervisorCapabilities(array $optArgs = array()) {
        return $this->request("updateHypervisorCapabilities",
            $optArgs
        );
    }

    /**
     * Updates load balancer
     *
     * @param string $id the id of the load balancer rule to update
     * @param array  $optArgs {
     *     @type string $description the description of the load balancer rule
     *     @type string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     *     @type string $name the name of the load balancer rule
     * }
     */
    public function updateLoadBalancerRule($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateLoadBalancerRule",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Creates a physical network
     *
     * @param string $zoneid the Zone ID for the physical network
     * @param string $name the name of the physical network
     * @param array  $optArgs {
     *     @type string $networkspeed the speed for the physical network[1G/10G]
     *     @type string $tags Tag the physical network
     *     @type string $isolationmethods the isolation method for the physical network[VLAN/L3/GRE]
     *     @type string $vlan the VLAN for the physical network
     *     @type string $domainid domain ID of the account owning a physical network
     *     @type string $broadcastdomainrange the broadcast domain range for the physical network[Pod or Zone]. In Acton
     *     release it can be Zone only in Advance zone, and Pod in Basic
     * }
     */
    public function createPhysicalNetwork($zoneid, $name, array $optArgs = array()) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createPhysicalNetwork",
            array_merge(array(
                'zoneid' => $zoneid,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Deletes a template from the system. All virtual machines using the deleted
     * template will not be affected.
     *
     * @param string $id the ID of the template
     * @param array  $optArgs {
     *     @type string $zoneid the ID of zone of the template
     * }
     */
    public function deleteTemplate($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteTemplate",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists all hypervisor capabilities.
     *
     * @param array  $optArgs {
     *     @type string $id ID of the hypervisor capability
     *     @type string $keyword List by keyword
     *     @type string $hypervisor the hypervisor for which to restrict the search
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listHypervisorCapabilities(array $optArgs = array()) {
        return $this->request("listHypervisorCapabilities",
            $optArgs
        );
    }

    /**
     * List resource tag(s)
     *
     * @param array  $optArgs {
     *     @type string $customer list by customer name
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $value list by value
     *     @type string $page the page number of the result set
     *     @type string $key list by key
     *     @type string $resourcetype list by resource type
     *     @type string $pagesize the number of entries per page
     *     @type string $resourceid list by resource id
     * }
     */
    public function listTags(array $optArgs = array()) {
        return $this->request("listTags",
            $optArgs
        );
    }

    /**
     * Delete site to site vpn customer gateway
     *
     * @param string $id id of customer gateway
     */
    public function deleteVpnCustomerGateway($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteVpnCustomerGateway",
            array(
                'id' => $id
            )
        );
    }

    /**
     * List iso visibility and all accounts that have permissions to view this iso.
     *
     * @param string $id the template ID
     */
    public function listIsoPermissions($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("listIsoPermissions",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a Cisco Vnmc controller
     *
     * @param string $resourceid Cisco Vnmc resource ID
     */
    public function deleteCiscoVnmcResource($resourceid) {
        if (empty($resourceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceid"), MISSING_ARGUMENT);
        }
        return $this->request("deleteCiscoVnmcResource",
            array(
                'resourceid' => $resourceid
            )
        );
    }

    /**
     * Create a virtual router element.
     *
     * @param string $nspid the network service provider ID of the virtual router element
     * @param array  $optArgs {
     *     @type string $providertype The provider type. Supported types are VirtualRouter (default) and
     *     VPCVirtualRouter
     * }
     */
    public function createVirtualRouterElement($nspid, array $optArgs = array()) {
        if (empty($nspid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nspid"), MISSING_ARGUMENT);
        }
        return $this->request("createVirtualRouterElement",
            array_merge(array(
                'nspid' => $nspid
            ), $optArgs)
        );
    }

    /**
     * Updates an existing autoscale policy.
     *
     * @param string $id the ID of the autoscale policy
     * @param array  $optArgs {
     *     @type string $duration the duration for which the conditions have to be true before action is taken
     *     @type string $quiettime the cool down period for which the policy should not be evaluated after the
     *     action has been taken
     *     @type string $conditionids the list of IDs of the conditions that are being evaluated on every interval
     * }
     */
    public function updateAutoScalePolicy($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateAutoScalePolicy",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Adds a BigSwitch VNS device
     *
     * @param string $hostname Hostname of ip address of the BigSwitch VNS Controller.
     * @param string $physicalnetworkid the Physical Network ID
     */
    public function addBigSwitchVnsDevice($hostname, $physicalnetworkid) {
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        return $this->request("addBigSwitchVnsDevice",
            array(
                'hostname' => $hostname,
                'physicalnetworkid' => $physicalnetworkid
            )
        );
    }

    /**
     * Release the dedication for the pod
     *
     * @param string $podid the ID of the Pod
     */
    public function releaseDedicatedPod($podid) {
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podid"), MISSING_ARGUMENT);
        }
        return $this->request("releaseDedicatedPod",
            array(
                'podid' => $podid
            )
        );
    }

    /**
     * Dedicates a zones.
     *
     * @param string $domainid the ID of the containing domain
     * @param string $zoneid the ID of the zone
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     */
    public function dedicateZone($domainid, $zoneid, array $optArgs = array()) {
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainid"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        return $this->request("dedicateZone",
            array_merge(array(
                'domainid' => $domainid,
                'zoneid' => $zoneid
            ), $optArgs)
        );
    }

    /**
     * Creates site to site vpn local gateway
     *
     * @param string $vpcid public ip address id of the vpn gateway
     */
    public function createVpnGateway($vpcid) {
        if (empty($vpcid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcid"), MISSING_ARGUMENT);
        }
        return $this->request("createVpnGateway",
            array(
                'vpcid' => $vpcid
            )
        );
    }

    /**
     * Dedicate an existing cluster
     *
     * @param string $domainid the ID of the containing domain
     * @param string $clusterid the ID of the Cluster
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     */
    public function dedicateCluster($domainid, $clusterid, array $optArgs = array()) {
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainid"), MISSING_ARGUMENT);
        }
        if (empty($clusterid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterid"), MISSING_ARGUMENT);
        }
        return $this->request("dedicateCluster",
            array_merge(array(
                'domainid' => $domainid,
                'clusterid' => $clusterid
            ), $optArgs)
        );
    }

    /**
     * Deletes a counter
     *
     * @param string $id the ID of the counter
     */
    public function deleteCounter($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteCounter",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Adds an external firewall appliance
     *
     * @param string $url URL of the external firewall appliance.
     * @param string $zoneid Zone in which to add the external firewall appliance.
     * @param string $password Password of the external firewall appliance.
     * @param string $username Username of the external firewall appliance.
     */
    public function addExternalFirewall($url, $zoneid, $password, $username) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        return $this->request("addExternalFirewall",
            array(
                'url' => $url,
                'zoneid' => $zoneid,
                'password' => $password,
                'username' => $username
            )
        );
    }

    /**
     * Update a Storage network IP range, only allowed when no IPs in this range have
     * been allocated.
     *
     * @param string $id UUID of storage network ip range
     * @param array  $optArgs {
     *     @type string $netmask the netmask for storage network
     *     @type string $endip the ending IP address
     *     @type string $startip the beginning IP address
     *     @type string $vlan Optional. the vlan the ip range sits on
     * }
     */
    public function updateStorageNetworkIpRange($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateStorageNetworkIpRange",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists all pending asynchronous jobs for the account.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $page the page number of the result set
     *     @type string $startdate the start date of the async job
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainid list only resources belonging to the domain specified
     * }
     */
    public function listAsyncJobs(array $optArgs = array()) {
        return $this->request("listAsyncJobs",
            $optArgs
        );
    }

    /**
     * List Usage Types
     *
     */
    public function listUsageTypes() {
        return $this->request("listUsageTypes",
            $optArgs
        );
    }

    /**
     * delete a bigswitch vns device
     *
     * @param string $vnsdeviceid BigSwitch device ID
     */
    public function deleteBigSwitchVnsDevice($vnsdeviceid) {
        if (empty($vnsdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vnsdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("deleteBigSwitchVnsDevice",
            array(
                'vnsdeviceid' => $vnsdeviceid
            )
        );
    }

    /**
     * Lists secondary staging stores.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $protocol the staging store protocol
     *     @type string $id the ID of the staging store
     *     @type string $provider the staging store provider
     *     @type string $zoneid the Zone ID for the staging store
     *     @type string $name the name of the staging store
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     */
    public function listSecondaryStagingStores(array $optArgs = array()) {
        return $this->request("listSecondaryStagingStores",
            $optArgs
        );
    }

    /**
     * lists network that are using a F5 load balancer device
     *
     * @param string $lbdeviceid f5 load balancer device ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listF5LoadBalancerNetworks($lbdeviceid, array $optArgs = array()) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("listF5LoadBalancerNetworks",
            array_merge(array(
                'lbdeviceid' => $lbdeviceid
            ), $optArgs)
        );
    }

    /**
     * Creates a VLAN IP range.
     *
     * @param array  $optArgs {
     *     @type string $gateway the gateway of the VLAN IP range
     *     @type string $vlan the ID or VID of the VLAN. If not specified, will be defaulted to the vlan of
     *     the network or if vlan of the network is null - to Untagged
     *     @type string $startip the beginning IP address in the VLAN IP range
     *     @type string $physicalnetworkid the physical network id
     *     @type string $networkid the network id
     *     @type string $netmask the netmask of the VLAN IP range
     *     @type string $startipv6 the beginning IPv6 address in the IPv6 network range
     *     @type string $podid optional parameter. Have to be specified for Direct Untagged vlan only.
     *     @type string $projectid project who will own the VLAN. If VLAN is Zone wide, this parameter should be
     *     ommited
     *     @type string $domainid domain ID of the account owning a VLAN
     *     @type string $zoneid the Zone ID of the VLAN IP range
     *     @type string $ip6cidr the CIDR of IPv6 network, must be at least /64
     *     @type string $forvirtualnetwork true if VLAN is of Virtual type, false if Direct
     *     @type string $endip the ending IP address in the VLAN IP range
     *     @type string $ip6gateway the gateway of the IPv6 network. Required for Shared networks and Isolated
     *     networks when it belongs to VPC
     *     @type string $account account who will own the VLAN. If VLAN is Zone wide, this parameter should be
     *     ommited
     *     @type string $endipv6 the ending IPv6 address in the IPv6 network range
     * }
     */
    public function createVlanIpRange(array $optArgs = array()) {
        return $this->request("createVlanIpRange",
            $optArgs
        );
    }

    /**
     * Adds backup image store.
     *
     * @param string $provider the image store provider name
     * @param array  $optArgs {
     *     @type string $zoneid the Zone ID for the image store
     *     @type string $name the name for the image store
     *     @type string $url the URL for the image store
     *     @type string $details the details for the image store. Example:
     *     details[0].key=accesskey&details[0].value=s389ddssaa&details[1].key=secretkey&details[1].value=8dshfsss
     * }
     */
    public function addImageStore($provider, array $optArgs = array()) {
        if (empty($provider)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "provider"), MISSING_ARGUMENT);
        }
        return $this->request("addImageStore",
            array_merge(array(
                'provider' => $provider
            ), $optArgs)
        );
    }

    /**
     * Creates an account from an LDAP user
     *
     * @param string $accounttype Type of the account.  Specify 0 for user, 1 for root admin, and 2 for domain
     * admin
     * @param string $username Unique username.
     * @param array  $optArgs {
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone
     *     parameter, see Time Zone Format.
     *     @type string $accountdetails details for account used to store specific parameters
     *     @type string $domainid Creates the user under the specified domain.
     *     @type string $accountid Account UUID, required for adding account from external provisioning system
     *     @type string $account Creates the user under the specified account. If no account is specified, the
     *     username will be used as the account name.
     *     @type string $userid User UUID, required for adding account from external provisioning system
     *     @type string $networkdomain Network domain for the account's networks
     * }
     */
    public function ldapCreateAccount($accounttype, $username, array $optArgs = array()) {
        if (empty($accounttype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accounttype"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        return $this->request("ldapCreateAccount",
            array_merge(array(
                'accounttype' => $accounttype,
                'username' => $username
            ), $optArgs)
        );
    }

    /**
     * Find hosts suitable for migrating a virtual machine.
     *
     * @param string $virtualmachineid find hosts to which this VM can be migrated and flag the hosts with enough
     * CPU/RAM to host the VM
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     */
    public function findHostsForMigration($virtualmachineid, array $optArgs = array()) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("findHostsForMigration",
            array_merge(array(
                'virtualmachineid' => $virtualmachineid
            ), $optArgs)
        );
    }

    /**
     * Dedicates a Pod.
     *
     * @param string $domainid the ID of the containing domain
     * @param string $podid the ID of the Pod
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     */
    public function dedicatePod($domainid, $podid, array $optArgs = array()) {
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainid"), MISSING_ARGUMENT);
        }
        if (empty($podid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podid"), MISSING_ARGUMENT);
        }
        return $this->request("dedicatePod",
            array_merge(array(
                'domainid' => $domainid,
                'podid' => $podid
            ), $optArgs)
        );
    }

    /**
     * Adds a F5 BigIP load balancer device
     *
     * @param string $networkdevicetype supports only F5BigIpLoadBalancer
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $url URL of the F5 load balancer appliance.
     * @param string $username Credentials to reach F5 BigIP load balancer device
     * @param string $password Credentials to reach F5 BigIP load balancer device
     */
    public function addF5LoadBalancer($networkdevicetype, $physicalnetworkid, $url, $username, $password) {
        if (empty($networkdevicetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkdevicetype"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        return $this->request("addF5LoadBalancer",
            array(
                'networkdevicetype' => $networkdevicetype,
                'physicalnetworkid' => $physicalnetworkid,
                'url' => $url,
                'username' => $username,
                'password' => $password
            )
        );
    }

    /**
     * Deletes a autoscale vm group.
     *
     * @param string $id the ID of the autoscale group
     */
    public function deleteAutoScaleVmGroup($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteAutoScaleVmGroup",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists remote access vpns
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $publicipid public ip address id of the vpn server
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $id Lists remote access vpn rule with the specified ID
     *     @type string $projectid list objects by project
     *     @type string $pagesize the number of entries per page
     *     @type string $networkid list remote access VPNs for ceratin network
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $domainid list only resources belonging to the domain specified
     * }
     */
    public function listRemoteAccessVpns(array $optArgs = array()) {
        return $this->request("listRemoteAccessVpns",
            $optArgs
        );
    }

    /**
     * update global load balancer rules.
     *
     * @param string $id the ID of the global load balancer rule
     * @param array  $optArgs {
     *     @type string $description the description of the load balancer rule
     *     @type string $gslbstickysessionmethodname session sticky method (sourceip) if not specified defaults to sourceip
     *     @type string $gslblbmethod load balancer algorithm (roundrobin, leastconn, proximity) that is used to
     *     distributed traffic across the zones participating in global server load
     *     balancing, if not specified defaults to 'round robin'
     * }
     */
    public function updateGlobalLoadBalancerRule($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateGlobalLoadBalancerRule",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Registers an existing template into the CloudStack cloud.
     *
     * @param string $name the name of the template
     * @param string $zoneid the ID of the zone the template is to be hosted on
     * @param string $displaytext the display text of the template. This is usually used for display purposes.
     * @param string $ostypeid the ID of the OS Type that best represents the OS of this template.
     * @param string $hypervisor the target hypervisor for the template
     * @param string $url the URL of where the template is hosted. Possible URL include http:// and
     * https://
     * @param string $format the format for the template. Possible values include QCOW2, RAW, and VHD.
     * @param array  $optArgs {
     *     @type string $isextractable true if the template or its derivatives are extractable; default is false
     *     @type string $sshkeyenabled true if the template supports the sshkey upload feature; default is false
     *     @type string $isdynamicallyscalable true if template contains XS/VMWare tools inorder to support dynamic scaling of
     *     VM cpu/memory
     *     @type string $isrouting true if the template type is routing i.e., if template is used to deploy router
     *     @type string $templatetag the tag for this template.
     *     @type string $checksum the MD5 checksum value of this template
     *     @type string $passwordenabled true if the template supports the password reset feature; default is false
     *     @type string $isfeatured true if this template is a featured template, false otherwise
     *     @type string $account an optional accountName. Must be used with domainId.
     *     @type string $bits 32 or 64 bits support. 64 by default
     *     @type string $domainid an optional domainId. If the account parameter is used, domainId must also be
     *     used.
     *     @type string $requireshvm true if this template requires HVM
     *     @type string $projectid Register template for the project
     *     @type string $ispublic true if the template is available to all accounts; default is true
     *     @type string $details Template details in key/value pairs.
     * }
     */
    public function registerTemplate($name, $zoneid, $displaytext, $ostypeid, $hypervisor, $url, $format, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displaytext"), MISSING_ARGUMENT);
        }
        if (empty($ostypeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ostypeid"), MISSING_ARGUMENT);
        }
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($format)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "format"), MISSING_ARGUMENT);
        }
        return $this->request("registerTemplate",
            array_merge(array(
                'name' => $name,
                'zoneid' => $zoneid,
                'displaytext' => $displaytext,
                'ostypeid' => $ostypeid,
                'hypervisor' => $hypervisor,
                'url' => $url,
                'format' => $format
            ), $optArgs)
        );
    }

    /**
     * Lists affinity group types available
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     * }
     */
    public function listAffinityGroupTypes(array $optArgs = array()) {
        return $this->request("listAffinityGroupTypes",
            $optArgs
        );
    }

    /**
     * Deletes a network offering.
     *
     * @param string $id the ID of the network offering
     */
    public function deleteNetworkOffering($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteNetworkOffering",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Disables an AutoScale Vm Group
     *
     * @param string $id the ID of the autoscale group
     */
    public function disableAutoScaleVmGroup($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("disableAutoScaleVmGroup",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Authorizes a particular egress rule for this security group
     *
     * @param array  $optArgs {
     *     @type string $usersecuritygrouplist user to security group mapping
     *     @type string $cidrlist the cidr list associated
     *     @type string $securitygroupid The ID of the security group. Mutually exclusive with securityGroupName
     *     parameter
     *     @type string $startport start port for this egress rule
     *     @type string $icmptype type of the icmp message being sent
     *     @type string $projectid an optional project of the security group
     *     @type string $account an optional account for the security group. Must be used with domainId.
     *     @type string $securitygroupname The name of the security group. Mutually exclusive with securityGroupName
     *     parameter
     *     @type string $endport end port for this egress rule
     *     @type string $protocol TCP is default. UDP is the other supported protocol
     *     @type string $icmpcode error code for this icmp message
     *     @type string $domainid an optional domainId for the security group. If the account parameter is used,
     *     domainId must also be used.
     * }
     */
    public function authorizeSecurityGroupEgress(array $optArgs = array()) {
        return $this->request("authorizeSecurityGroupEgress",
            $optArgs
        );
    }

    /**
     * Lists site to site vpn customer gateways
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $projectid list objects by project
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $id id of the customer gateway
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listVpnCustomerGateways(array $optArgs = array()) {
        return $this->request("listVpnCustomerGateways",
            $optArgs
        );
    }

    /**
     * disassociate a profile from a blade
     *
     * @param string $bladeid blade id
     * @param array  $optArgs {
     *     @type string $deleteprofile is deleting profile after disassociating
     * }
     */
    public function disassociateUcsProfileFromBlade($bladeid, array $optArgs = array()) {
        if (empty($bladeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bladeid"), MISSING_ARGUMENT);
        }
        return $this->request("disassociateUcsProfileFromBlade",
            array_merge(array(
                'bladeid' => $bladeid
            ), $optArgs)
        );
    }

    /**
     * Creates an account
     *
     * @param string $firstname firstname
     * @param string $accounttype Type of the account.  Specify 0 for user, 1 for root admin, and 2 for domain
     * admin
     * @param string $username Unique username.
     * @param string $email email
     * @param string $lastname lastname
     * @param string $password Clear text password (Default hashed to SHA256SALT). If you wish to use any other
     * hashing algorithm, you would need to write a custom authentication adapter See
     * Docs section.
     * @param array  $optArgs {
     *     @type string $networkdomain Network domain for the account's networks
     *     @type string $domainid Creates the user under the specified domain.
     *     @type string $account Creates the user under the specified account. If no account is specified, the
     *     username will be used as the account name.
     *     @type string $accountdetails details for account used to store specific parameters
     *     @type string $accountid Account UUID, required for adding account from external provisioning system
     *     @type string $userid User UUID, required for adding account from external provisioning system
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone
     *     parameter, see Time Zone Format.
     * }
     */
    public function createAccount($firstname, $accounttype, $username, $email, $lastname, $password, array $optArgs = array()) {
        if (empty($firstname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "firstname"), MISSING_ARGUMENT);
        }
        if (empty($accounttype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accounttype"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($email)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "email"), MISSING_ARGUMENT);
        }
        if (empty($lastname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lastname"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        return $this->request("createAccount",
            array_merge(array(
                'firstname' => $firstname,
                'accounttype' => $accounttype,
                'username' => $username,
                'email' => $email,
                'lastname' => $lastname,
                'password' => $password
            ), $optArgs)
        );
    }

    /**
     * Prepares a host for maintenance.
     *
     * @param string $id the host ID
     */
    public function prepareHostForMaintenance($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("prepareHostForMaintenance",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a Private gateway
     *
     * @param string $id the ID of the private gateway
     */
    public function deletePrivateGateway($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deletePrivateGateway",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Stops an Internal LB vm.
     *
     * @param string $id the ID of the internal lb vm
     * @param array  $optArgs {
     *     @type string $forced Force stop the VM. The caller knows the VM is stopped.
     * }
     */
    public function stopInternalLoadBalancerVM($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("stopInternalLoadBalancerVM",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * create secondary staging store.
     *
     * @param string $url the URL for the staging store
     * @param array  $optArgs {
     *     @type string $provider the staging store provider name
     *     @type string $details the details for the staging store
     *     @type string $scope the scope of the staging store: zone only for now
     *     @type string $zoneid the Zone ID for the staging store
     * }
     */
    public function createSecondaryStagingStore($url, array $optArgs = array()) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        return $this->request("createSecondaryStagingStore",
            array_merge(array(
                'url' => $url
            ), $optArgs)
        );
    }

    /**
     * Generates usage records. This will generate records only if there any records to
     * be generated, i.e if the scheduled usage job was not run or failed
     *
     * @param string $enddate End date range for usage record query. Use yyyy-MM-dd as the date format, e.g.
     * startDate=2009-06-03.
     * @param string $startdate Start date range for usage record query. Use yyyy-MM-dd as the date format, e.g.
     * startDate=2009-06-01.
     * @param array  $optArgs {
     *     @type string $domainid List events for the specified domain.
     * }
     */
    public function generateUsageRecords($enddate, $startdate, array $optArgs = array()) {
        if (empty($enddate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "enddate"), MISSING_ARGUMENT);
        }
        if (empty($startdate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startdate"), MISSING_ARGUMENT);
        }
        return $this->request("generateUsageRecords",
            array_merge(array(
                'enddate' => $enddate,
                'startdate' => $startdate
            ), $optArgs)
        );
    }

    /**
     * Deletes traffic type of a physical network
     *
     * @param string $id traffic type id
     */
    public function deleteTrafficType($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteTrafficType",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a load balancer rule.
     *
     * @param string $id the ID of the load balancer rule
     */
    public function deleteLoadBalancerRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteLoadBalancerRule",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Get API limit count for the caller
     *
     */
    public function getApiLimit() {
        return $this->request("getApiLimit",
            $optArgs
        );
    }

    /**
     * Attaches an ISO to a virtual machine.
     *
     * @param string $virtualmachineid the ID of the virtual machine
     * @param string $id the ID of the ISO file
     */
    public function attachIso($virtualmachineid, $id) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("attachIso",
            array(
                'virtualmachineid' => $virtualmachineid,
                'id' => $id
            )
        );
    }

    /**
     * Deletes a port forwarding rule
     *
     * @param string $id the ID of the port forwarding rule
     */
    public function deletePortForwardingRule($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deletePortForwardingRule",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists domains and provides detailed information for listed domains
     *
     * @param array  $optArgs {
     *     @type string $name List domain by domain name.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page the page number of the result set
     *     @type string $level List domains by domain level.
     *     @type string $pagesize the number of entries per page
     *     @type string $id List domain by domain ID.
     *     @type string $keyword List by keyword
     * }
     */
    public function listDomains(array $optArgs = array()) {
        return $this->request("listDomains",
            $optArgs
        );
    }

    /**
     * Find user account by API key
     *
     * @param string $userapikey API key of the user
     */
    public function getUser($userapikey) {
        if (empty($userapikey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userapikey"), MISSING_ARGUMENT);
        }
        return $this->request("getUser",
            array(
                'userapikey' => $userapikey
            )
        );
    }

    /**
     * List templates in ucs manager
     *
     * @param string $ucsmanagerid the id for the ucs manager
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     */
    public function listUcsTemplates($ucsmanagerid, array $optArgs = array()) {
        if (empty($ucsmanagerid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsmanagerid"), MISSING_ARGUMENT);
        }
        return $this->request("listUcsTemplates",
            array_merge(array(
                'ucsmanagerid' => $ucsmanagerid
            ), $optArgs)
        );
    }

    /**
     * Lists load balancer rules.
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $networkid list by network id the rule belongs to
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $publicipid the public IP address id of the load balancer rule
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $id the ID of the load balancer rule
     *     @type string $zoneid the availability zone ID
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $name the name of the load balancer rule
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $pagesize the number of entries per page
     *     @type string $virtualmachineid the ID of the virtual machine of the load balancer rule
     *     @type string $projectid list objects by project
     * }
     */
    public function listLoadBalancerRules(array $optArgs = array()) {
        return $this->request("listLoadBalancerRules",
            $optArgs
        );
    }

    /**
     * lists Palo Alto firewall devices in a physical network
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $fwdeviceid Palo Alto firewall device ID
     *     @type string $keyword List by keyword
     *     @type string $physicalnetworkid the Physical Network ID
     * }
     */
    public function listPaloAltoFirewalls(array $optArgs = array()) {
        return $this->request("listPaloAltoFirewalls",
            $optArgs
        );
    }

    /**
     * Delete one or more events.
     *
     * @param array  $optArgs {
     *     @type string $type delete by event type
     *     @type string $startdate start date range to delete events (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $ids the IDs of the events
     *     @type string $enddate end date range to delete events (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     * }
     */
    public function deleteEvents(array $optArgs = array()) {
        return $this->request("deleteEvents",
            $optArgs
        );
    }

    /**
     * Removes a certificate from a Load Balancer Rule
     *
     * @param string $lbruleid the ID of the load balancer rule
     */
    public function removeCertFromLoadBalancer($lbruleid) {
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleid"), MISSING_ARGUMENT);
        }
        return $this->request("removeCertFromLoadBalancer",
            array(
                'lbruleid' => $lbruleid
            )
        );
    }

    /**
     * Configures a SRX firewall device
     *
     * @param string $fwdeviceid SRX firewall device ID
     * @param array  $optArgs {
     *     @type string $fwdevicecapacity capacity of the firewall device, Capacity will be interpreted as number of
     *     networks device can handle
     * }
     */
    public function configureSrxFirewall($fwdeviceid, array $optArgs = array()) {
        if (empty($fwdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("configureSrxFirewall",
            array_merge(array(
                'fwdeviceid' => $fwdeviceid
            ), $optArgs)
        );
    }

    /**
     * Deletes a Zone.
     *
     * @param string $id the ID of the Zone
     */
    public function deleteZone($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteZone",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Accepts or declines project invitation
     *
     * @param string $projectid id of the project to join
     * @param array  $optArgs {
     *     @type string $token list invitations for specified account; this parameter has to be specified with
     *     domainId
     *     @type string $accept if true, accept the invitation, decline if false. True by default
     *     @type string $account account that is joining the project
     * }
     */
    public function updateProjectInvitation($projectid, array $optArgs = array()) {
        if (empty($projectid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectid"), MISSING_ARGUMENT);
        }
        return $this->request("updateProjectInvitation",
            array_merge(array(
                'projectid' => $projectid
            ), $optArgs)
        );
    }

    /**
     * Deletes a detached disk volume.
     *
     * @param string $id The ID of the disk volume
     */
    public function deleteVolume($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteVolume",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates resource tag(s)
     *
     * @param string $tags Map of tags (key/value pairs)
     * @param string $resourceids list of resources to create the tags for
     * @param string $resourcetype type of the resource
     * @param array  $optArgs {
     *     @type string $customer identifies client specific tag. When the value is not null, the tag can't be
     *     used by cloudStack code internally
     * }
     */
    public function createTags($tags, $resourceids, $resourcetype, array $optArgs = array()) {
        if (empty($tags)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "tags"), MISSING_ARGUMENT);
        }
        if (empty($resourceids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceids"), MISSING_ARGUMENT);
        }
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourcetype"), MISSING_ARGUMENT);
        }
        return $this->request("createTags",
            array_merge(array(
                'tags' => $tags,
                'resourceids' => $resourceids,
                'resourcetype' => $resourcetype
            ), $optArgs)
        );
    }

    /**
     * Enables an AutoScale Vm Group
     *
     * @param string $id the ID of the autoscale group
     */
    public function enableAutoScaleVmGroup($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("enableAutoScaleVmGroup",
            array(
                'id' => $id
            )
        );
    }

    /**
     * List resource detail(s)
     *
     * @param string $resourcetype list by resource type
     * @param string $resourceid list by resource id
     * @param array  $optArgs {
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page the page number of the result set
     *     @type string $key list by key
     *     @type string $pagesize the number of entries per page
     *     @type string $fordisplay if set to true, only details marked with display=true, are returned. Always
     *     false is the call is made by the regular user
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainid list only resources belonging to the domain specified
     * }
     */
    public function listResourceDetails($resourcetype, $resourceid, array $optArgs = array()) {
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourcetype"), MISSING_ARGUMENT);
        }
        if (empty($resourceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceid"), MISSING_ARGUMENT);
        }
        return $this->request("listResourceDetails",
            array_merge(array(
                'resourcetype' => $resourcetype,
                'resourceid' => $resourceid
            ), $optArgs)
        );
    }

    /**
     * Remove an Ldap Configuration
     *
     * @param string $hostname Hostname
     */
    public function deleteLdapConfiguration($hostname) {
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }
        return $this->request("deleteLdapConfiguration",
            array(
                'hostname' => $hostname
            )
        );
    }

    /**
     * Updates an existing cluster
     *
     * @param string $id the ID of the Cluster
     * @param array  $optArgs {
     *     @type string $clustername the cluster name
     *     @type string $managedstate whether this cluster is managed by cloudstack
     *     @type string $clustertype hypervisor type of the cluster
     *     @type string $allocationstate Allocation state of this cluster for allocation of new resources
     *     @type string $hypervisor hypervisor type of the cluster
     * }
     */
    public function updateCluster($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateCluster",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Scales the virtual machine to a new service offering.
     *
     * @param string $id The ID of the virtual machine
     * @param string $serviceofferingid the ID of the service offering for the virtual machine
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu,memory and cpunumber. example
     *     details[i].name=value
     * }
     */
    public function scaleVirtualMachine($id, $serviceofferingid, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceofferingid"), MISSING_ARGUMENT);
        }
        return $this->request("scaleVirtualMachine",
            array_merge(array(
                'id' => $id,
                'serviceofferingid' => $serviceofferingid
            ), $optArgs)
        );
    }

    /**
     * lists SRX firewall devices in a physical network
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $physicalnetworkid the Physical Network ID
     *     @type string $pagesize the number of entries per page
     *     @type string $fwdeviceid SRX firewall device ID
     *     @type string $keyword List by keyword
     * }
     */
    public function listSrxFirewalls(array $optArgs = array()) {
        return $this->request("listSrxFirewalls",
            $optArgs
        );
    }

    /**
     * Removes vpn user
     *
     * @param string $username username for the vpn user
     * @param array  $optArgs {
     *     @type string $domainid an optional domainId for the vpn user. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $projectid remove vpn user from the project
     *     @type string $account an optional account for the vpn user. Must be used with domainId.
     * }
     */
    public function removeVpnUser($username, array $optArgs = array()) {
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        return $this->request("removeVpnUser",
            array_merge(array(
                'username' => $username
            ), $optArgs)
        );
    }

    /**
     * lists network that are using Palo Alto firewall device
     *
     * @param string $lbdeviceid palo alto balancer device ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     */
    public function listPaloAltoFirewallNetworks($lbdeviceid, array $optArgs = array()) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("listPaloAltoFirewallNetworks",
            array_merge(array(
                'lbdeviceid' => $lbdeviceid
            ), $optArgs)
        );
    }

    /**
     * Releases a Public IP range back to the system pool
     *
     * @param string $id the id of the Public IP range
     */
    public function releasePublicIpRange($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("releasePublicIpRange",
            array(
                'id' => $id
            )
        );
    }

    /**
     * List all public, private, and privileged templates.
     *
     * @param string $templatefilter possible values are "featured", "self",
     * "selfexecutable","sharedexecutable","executable", and "community". * featured :
     * templates that have been marked as featured and public. * self : templates that
     * have been registered or created by the calling user. * selfexecutable : same as
     * self, but only returns templates that can be used to deploy a new VM. *
     * sharedexecutable : templates ready to be deployed that have been granted to the
     * calling user by another user. * executable : templates that are owned by the
     * calling user, or public templates, that can be used to deploy a VM. * community
     * : templates that have been marked as public but not featured. * all : all
     * templates (only usable by admins).
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $zoneid list templates by zoneId
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $projectid list objects by project
     *     @type string $name the template name
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $id the template ID
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $showremoved show removed templates as well
     *     @type string $hypervisor the hypervisor for which to restrict the search
     *     @type string $tags List resources by tags (key/value pairs)
     * }
     */
    public function listTemplates($templatefilter, array $optArgs = array()) {
        if (empty($templatefilter)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templatefilter"), MISSING_ARGUMENT);
        }
        return $this->request("listTemplates",
            array_merge(array(
                'templatefilter' => $templatefilter
            ), $optArgs)
        );
    }

    /**
     * Lists dedicated guest vlan ranges
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $zoneid zone of the guest VLAN range
     *     @type string $projectid project who will own the guest VLAN range
     *     @type string $account the account with which the guest VLAN range is associated. Must be used with the
     *     domainId parameter.
     *     @type string $id list dedicated guest vlan ranges by id
     *     @type string $physicalnetworkid physical network id of the guest VLAN range
     *     @type string $guestvlanrange the dedicated guest vlan range
     *     @type string $domainid the domain ID with which the guest VLAN range is associated.  If used with the
     *     account parameter, returns all guest VLAN ranges for that account in the
     *     specified domain.
     *     @type string $page the page number of the result set
     * }
     */
    public function listDedicatedGuestVlanRanges(array $optArgs = array()) {
        return $this->request("listDedicatedGuestVlanRanges",
            $optArgs
        );
    }

    /**
     * Update site to site vpn customer gateway
     *
     * @param string $ikepolicy IKE policy of the customer gateway
     * @param string $gateway public ip address id of the customer gateway
     * @param string $id id of customer gateway
     * @param string $ipsecpsk IPsec Preshared-Key of the customer gateway
     * @param string $cidrlist guest cidr of the customer gateway
     * @param string $esppolicy ESP policy of the customer gateway
     * @param array  $optArgs {
     *     @type string $account the account associated with the gateway. Must be used with the domainId
     *     parameter.
     *     @type string $dpd If DPD is enabled for VPN connection
     *     @type string $ikelifetime Lifetime of phase 1 VPN connection to the customer gateway, in seconds
     *     @type string $domainid the domain ID associated with the gateway. If used with the account parameter
     *     returns the gateway associated with the account for the specified domain.
     *     @type string $esplifetime Lifetime of phase 2 VPN connection to the customer gateway, in seconds
     *     @type string $name name of this customer gateway
     * }
     */
    public function updateVpnCustomerGateway($ikepolicy, $gateway, $id, $ipsecpsk, $cidrlist, $esppolicy, array $optArgs = array()) {
        if (empty($ikepolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ikepolicy"), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($ipsecpsk)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipsecpsk"), MISSING_ARGUMENT);
        }
        if (empty($cidrlist)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidrlist"), MISSING_ARGUMENT);
        }
        if (empty($esppolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "esppolicy"), MISSING_ARGUMENT);
        }
        return $this->request("updateVpnCustomerGateway",
            array_merge(array(
                'ikepolicy' => $ikepolicy,
                'gateway' => $gateway,
                'id' => $id,
                'ipsecpsk' => $ipsecpsk,
                'cidrlist' => $cidrlist,
                'esppolicy' => $esppolicy
            ), $optArgs)
        );
    }

    /**
     * Updates iso permissions
     *
     * @param string $id the template ID
     * @param array  $optArgs {
     *     @type string $projectids a comma delimited list of projects. If specified, "op" parameter has to be
     *     passed in.
     *     @type string $ispublic true for public template/iso, false for private templates/isos
     *     @type string $isextractable true if the template/iso is extractable, false other wise. Can be set only by
     *     root admin
     *     @type string $isfeatured true for featured template/iso, false otherwise
     *     @type string $op permission operator (add, remove, reset)
     *     @type string $accounts a comma delimited list of accounts. If specified, "op" parameter has to be
     *     passed in.
     * }
     */
    public function updateIsoPermissions($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateIsoPermissions",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Stops a system VM.
     *
     * @param string $id The ID of the system virtual machine
     * @param array  $optArgs {
     *     @type string $forced Force stop the VM.  The caller knows the VM is stopped.
     * }
     */
    public function stopSystemVm($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("stopSystemVm",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Restarts the network; includes 1) restarting network elements - virtual routers,
     * dhcp servers 2) reapplying all public ips 3) reapplying
     * loadBalancing/portForwarding rules
     *
     * @param string $id The id of the network to restart.
     * @param array  $optArgs {
     *     @type string $cleanup If cleanup old network elements
     * }
     */
    public function restartNetwork($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("restartNetwork",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * load template into primary storage
     *
     * @param string $templateid template ID of the template to be prepared in primary storage(s).
     * @param string $zoneid zone ID of the template to be prepared in primary storage(s).
     */
    public function prepareTemplate($templateid, $zoneid) {
        if (empty($templateid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateid"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        return $this->request("prepareTemplate",
            array(
                'templateid' => $templateid,
                'zoneid' => $zoneid
            )
        );
    }

    /**
     * Reboots a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     */
    public function rebootVirtualMachine($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("rebootVirtualMachine",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Upgrades domain router to a new service offering
     *
     * @param string $id The ID of the router
     * @param string $serviceofferingid the service offering ID to apply to the domain router
     */
    public function changeServiceForRouter($id, $serviceofferingid) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceofferingid"), MISSING_ARGUMENT);
        }
        return $this->request("changeServiceForRouter",
            array(
                'id' => $id,
                'serviceofferingid' => $serviceofferingid
            )
        );
    }

    /**
     * Lists load balancer rules.
     *
     * @param array  $optArgs {
     *     @type string $id the ID of the global load balancer rule
     *     @type string $regionid region ID
     *     @type string $pagesize the number of entries per page
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $projectid list objects by project
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     * }
     */
    public function listGlobalLoadBalancerRules(array $optArgs = array()) {
        return $this->request("listGlobalLoadBalancerRules",
            $optArgs
        );
    }

    /**
     * Lists LBStickiness policies.
     *
     * @param string $lbruleid the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listLBStickinessPolicies($lbruleid, array $optArgs = array()) {
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleid"), MISSING_ARGUMENT);
        }
        return $this->request("listLBStickinessPolicies",
            array_merge(array(
                'lbruleid' => $lbruleid
            ), $optArgs)
        );
    }

    /**
     * Updates a Zone.
     *
     * @param string $id the ID of the Zone
     * @param array  $optArgs {
     *     @type string $domain Network domain name for the networks in the zone; empty string will update
     *     domain with NULL value
     *     @type string $localstorageenabled true if local storage offering enabled, false otherwise
     *     @type string $details the details for the Zone
     *     @type string $guestcidraddress the guest CIDR address for the Zone
     *     @type string $name the name of the Zone
     *     @type string $internaldns1 the first internal DNS for the Zone
     *     @type string $internaldns2 the second internal DNS for the Zone
     *     @type string $dhcpprovider the dhcp Provider for the Zone
     *     @type string $dnssearchorder the dns search order list
     *     @type string $ip6dns1 the first DNS for IPv6 network in the Zone
     *     @type string $dns2 the second DNS for the Zone
     *     @type string $allocationstate Allocation state of this cluster for allocation of new resources
     *     @type string $dns1 the first DNS for the Zone
     *     @type string $ip6dns2 the second DNS for IPv6 network in the Zone
     *     @type string $ispublic updates a private zone to public if set, but not vice-versa
     * }
     */
    public function updateZone($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateZone",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Enable a Cisco Nexus VSM device
     *
     * @param string $id Id of the Cisco Nexus 1000v VSM device to be enabled
     */
    public function enableCiscoNexusVSM($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("enableCiscoNexusVSM",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists security groups
     *
     * @param array  $optArgs {
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $projectid list objects by project
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $virtualmachineid lists security groups by virtual machine id
     *     @type string $pagesize the number of entries per page
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $page the page number of the result set
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $securitygroupname lists security groups by name
     *     @type string $keyword List by keyword
     *     @type string $id list the security group by the id provided
     * }
     */
    public function listSecurityGroups(array $optArgs = array()) {
        return $this->request("listSecurityGroups",
            $optArgs
        );
    }

    /**
     * Dedicates a guest vlan range to an account
     *
     * @param string $physicalnetworkid physical network ID of the vlan
     * @param string $account account who will own the VLAN
     * @param string $vlanrange guest vlan range to be dedicated
     * @param string $domainid domain ID of the account owning a VLAN
     * @param array  $optArgs {
     *     @type string $projectid project who will own the VLAN
     * }
     */
    public function dedicateGuestVlanRange($physicalnetworkid, $account, $vlanrange, $domainid, array $optArgs = array()) {
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($vlanrange)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vlanrange"), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainid"), MISSING_ARGUMENT);
        }
        return $this->request("dedicateGuestVlanRange",
            array_merge(array(
                'physicalnetworkid' => $physicalnetworkid,
                'account' => $account,
                'vlanrange' => $vlanrange,
                'domainid' => $domainid
            ), $optArgs)
        );
    }

    /**
     * Lists all firewall rules for an IP address.
     *
     * @param array  $optArgs {
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $networkid list firewall rules for ceratin network
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $page the page number of the result set
     *     @type string $id Lists rule with the specified ID.
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $ipaddressid the id of IP address of the firwall services
     * }
     */
    public function listFirewallRules(array $optArgs = array()) {
        return $this->request("listFirewallRules",
            $optArgs
        );
    }

    /**
     * Updates the affinity/anti-affinity group associations of a virtual machine. The
     * VM has to be stopped and restarted for the new properties to take effect.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $affinitygroupids comma separated list of affinity groups id that are going to be applied to the
     *     virtual machine. Should be passed only when vm is created from a zone with Basic
     *     Network support. Mutually exclusive with securitygroupnames parameter
     *     @type string $affinitygroupnames comma separated list of affinity groups names that are going to be applied to
     *     the virtual machine. Should be passed only when vm is created from a zone with
     *     Basic Network support. Mutually exclusive with securitygroupids parameter
     * }
     */
    public function updateVMAffinityGroup($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateVMAffinityGroup",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Configures a Palo Alto firewall device
     *
     * @param string $fwdeviceid Palo Alto firewall device ID
     * @param array  $optArgs {
     *     @type string $fwdevicecapacity capacity of the firewall device, Capacity will be interpreted as number of
     *     networks device can handle
     * }
     */
    public function configurePaloAltoFirewall($fwdeviceid, array $optArgs = array()) {
        if (empty($fwdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("configurePaloAltoFirewall",
            array_merge(array(
                'fwdeviceid' => $fwdeviceid
            ), $optArgs)
        );
    }

    /**
     * Lists affinity groups
     *
     * @param array  $optArgs {
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $virtualmachineid lists affinity groups by virtual machine id
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $id list the affinity group by the id provided
     *     @type string $type lists affinity groups by type
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $keyword List by keyword
     *     @type string $name lists affinity groups by name
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listAffinityGroups(array $optArgs = array()) {
        return $this->request("listAffinityGroups",
            $optArgs
        );
    }

    /**
     * Delete site to site vpn connection
     *
     * @param string $id id of vpn connection
     */
    public function deleteVpnConnection($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteVpnConnection",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Updates a user account
     *
     * @param string $id User uuid
     * @param array  $optArgs {
     *     @type string $username Unique username
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone
     *     parameter, see Time Zone Format.
     *     @type string $lastname last name
     *     @type string $usersecretkey The secret key for the user. Must be specified with userApiKey
     *     @type string $userapikey The API key for the user. Must be specified with userSecretKey
     *     @type string $password Clear text password (default hashed to SHA256SALT). If you wish to use any other
     *     hasing algorithm, you would need to write a custom authentication adapter
     *     @type string $firstname first name
     *     @type string $email email
     * }
     */
    public function updateUser($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateUser",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Updates a disk offering.
     *
     * @param string $id ID of the disk offering
     */
    public function deleteDiskOffering($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteDiskOffering",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Starts a system virtual machine.
     *
     * @param string $id The ID of the system virtual machine
     */
    public function startSystemVm($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("startSystemVm",
            array(
                'id' => $id
            )
        );
    }

    /**
     * delete a F5 load balancer device
     *
     * @param string $lbdeviceid netscaler load balancer device ID
     */
    public function deleteF5LoadBalancer($lbdeviceid) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("deleteF5LoadBalancer",
            array(
                'lbdeviceid' => $lbdeviceid
            )
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
     */
    public function updateProject($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateProject",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Creates a Zone.
     *
     * @param string $dns1 the first DNS for the Zone
     * @param string $name the name of the Zone
     * @param string $internaldns1 the first internal DNS for the Zone
     * @param string $networktype network type of the zone, can be Basic or Advanced
     * @param array  $optArgs {
     *     @type string $allocationstate Allocation state of this Zone for allocation of new resources
     *     @type string $guestcidraddress the guest CIDR address for the Zone
     *     @type string $securitygroupenabled true if network is security group enabled, false otherwise
     *     @type string $ip6dns1 the first DNS for IPv6 network in the Zone
     *     @type string $domainid the ID of the containing domain, null for public zones
     *     @type string $dns2 the second DNS for the Zone
     *     @type string $ip6dns2 the second DNS for IPv6 network in the Zone
     *     @type string $localstorageenabled true if local storage offering enabled, false otherwise
     *     @type string $domain Network domain name for the networks in the zone
     *     @type string $internaldns2 the second internal DNS for the Zone
     * }
     */
    public function createZone($dns1, $name, $internaldns1, $networktype, array $optArgs = array()) {
        if (empty($dns1)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "dns1"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($internaldns1)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "internaldns1"), MISSING_ARGUMENT);
        }
        if (empty($networktype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networktype"), MISSING_ARGUMENT);
        }
        return $this->request("createZone",
            array_merge(array(
                'dns1' => $dns1,
                'name' => $name,
                'internaldns1' => $internaldns1,
                'networktype' => $networktype
            ), $optArgs)
        );
    }

    /**
     * Archive one or more alerts.
     *
     * @param array  $optArgs {
     *     @type string $enddate end date range to archive alerts (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $type archive by alert type
     *     @type string $ids the IDs of the alerts
     *     @type string $startdate start date range to archive alerts (including) this date (use format
     *     "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     * }
     */
    public function archiveAlerts(array $optArgs = array()) {
        return $this->request("archiveAlerts",
            $optArgs
        );
    }

    /**
     * list baremetal pxe server
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $id Pxe server device ID
     *     @type string $page the page number of the result set
     * }
     */
    public function listBaremetalPxeServers(array $optArgs = array()) {
        return $this->request("listBaremetalPxeServers",
            $optArgs
        );
    }

    /**
     * Deletes a network
     *
     * @param string $id the ID of the network
     * @param array  $optArgs {
     *     @type string $forced Force delete a network. Network will be marked as 'Destroy' even when commands
     *     to shutdown and cleanup to the backend fails.
     * }
     */
    public function deleteNetwork($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteNetwork",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists all static routes
     *
     * @param array  $optArgs {
     *     @type string $vpcid list static routes by vpc id
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $gatewayid list static routes by gateway id
     *     @type string $keyword List by keyword
     *     @type string $projectid list objects by project
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $id list static route by id
     * }
     */
    public function listStaticRoutes(array $optArgs = array()) {
        return $this->request("listStaticRoutes",
            $optArgs
        );
    }

    /**
     * Changes the service offering for a system vm (console proxy or secondary
     * storage). The system vm must be in a "Stopped" state for this command to take
     * effect.
     *
     * @param string $serviceofferingid the service offering ID to apply to the system vm
     * @param string $id The ID of the system vm
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu, memory and cpunumber. example
     *     details[i].name=value
     * }
     */
    public function changeServiceForSystemVm($serviceofferingid, $id, array $optArgs = array()) {
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceofferingid"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("changeServiceForSystemVm",
            array_merge(array(
                'serviceofferingid' => $serviceofferingid,
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * delete a netscaler load balancer device
     *
     * @param string $lbdeviceid netscaler load balancer device ID
     */
    public function deleteNetscalerLoadBalancer($lbdeviceid) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("deleteNetscalerLoadBalancer",
            array(
                'lbdeviceid' => $lbdeviceid
            )
        );
    }

    /**
     * list the vm nics  IP to NIC
     *
     * @param string $virtualmachineid the ID of the vm
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $nicid the ID of the nic to to list IPs
     *     @type string $page the page number of the result set
     * }
     */
    public function listNics($virtualmachineid, array $optArgs = array()) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("listNics",
            array_merge(array(
                'virtualmachineid' => $virtualmachineid
            ), $optArgs)
        );
    }

    /**
     * Adds a Cisco Vnmc Controller
     *
     * @param string $password Credentials to access the Cisco VNMC Controller API
     * @param string $hostname Hostname or ip address of the Cisco VNMC Controller.
     * @param string $username Credentials to access the Cisco VNMC Controller API
     * @param string $physicalnetworkid the Physical Network ID
     */
    public function addCiscoVnmcResource($password, $hostname, $username, $physicalnetworkid) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        return $this->request("addCiscoVnmcResource",
            array(
                'password' => $password,
                'hostname' => $hostname,
                'username' => $username,
                'physicalnetworkid' => $physicalnetworkid
            )
        );
    }

    /**
     * lists network that are using SRX firewall device
     *
     * @param string $lbdeviceid netscaler load balancer device ID
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     * }
     */
    public function listSrxFirewallNetworks($lbdeviceid, array $optArgs = array()) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("listSrxFirewallNetworks",
            array_merge(array(
                'lbdeviceid' => $lbdeviceid
            ), $optArgs)
        );
    }

    /**
     * Creates a storage pool.
     *
     * @param string $zoneid the Zone ID for the storage pool
     * @param string $url the URL of the storage pool
     * @param string $name the name for the storage pool
     * @param array  $optArgs {
     *     @type string $scope the scope of the storage: cluster or zone
     *     @type string $capacityiops IOPS CloudStack can provision from this storage pool
     *     @type string $managed whether the storage should be managed by CloudStack
     *     @type string $details the details for the storage pool
     *     @type string $hypervisor hypervisor type of the hosts in zone that will be attached to this storage pool.
     *     KVM, VMware supported as of now.
     *     @type string $tags the tags for the storage pool
     *     @type string $podid the Pod ID for the storage pool
     *     @type string $capacitybytes bytes CloudStack can provision from this storage pool
     *     @type string $clusterid the cluster ID for the storage pool
     *     @type string $provider the storage provider name
     * }
     */
    public function createStoragePool($zoneid, $url, $name, array $optArgs = array()) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createStoragePool",
            array_merge(array(
                'zoneid' => $zoneid,
                'url' => $url,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Removes specified region
     *
     * @param string $id ID of the region to delete
     */
    public function removeRegion($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("removeRegion",
            array(
                'id' => $id
            )
        );
    }

    /**
     * list baremetal dhcp servers
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $id DHCP server device ID
     *     @type string $page the page number of the result set
     *     @type string $dhcpservertype Type of DHCP device
     * }
     */
    public function listBaremetalDhcp(array $optArgs = array()) {
        return $this->request("listBaremetalDhcp",
            $optArgs
        );
    }

    /**
     * Delete a Ucs manager
     *
     * @param string $ucsmanagerid ucs manager id
     */
    public function deleteUcsManager($ucsmanagerid) {
        if (empty($ucsmanagerid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsmanagerid"), MISSING_ARGUMENT);
        }
        return $this->request("deleteUcsManager",
            array(
                'ucsmanagerid' => $ucsmanagerid
            )
        );
    }

    /**
     * Adds traffic type to a physical network
     *
     * @param string $traffictype the trafficType to be added to the physical network
     * @param string $physicalnetworkid the Physical Network ID
     * @param array  $optArgs {
     *     @type string $xennetworklabel The network name label of the physical device dedicated to this traffic on a
     *     XenServer host
     *     @type string $hypervnetworklabel The network name label of the physical device dedicated to this traffic on a
     *     Hyperv host
     *     @type string $kvmnetworklabel The network name label of the physical device dedicated to this traffic on a KVM
     *     host
     *     @type string $vlan The VLAN id to be used for Management traffic by VMware host
     *     @type string $vmwarenetworklabel The network name label of the physical device dedicated to this traffic on a
     *     VMware host
     *     @type string $isolationmethod Used if physical network has multiple isolation types and traffic type is
     *     public. Choose which isolation method. Valid options currently 'vlan' or
     *     'vxlan', defaults to 'vlan'.
     * }
     */
    public function addTrafficType($traffictype, $physicalnetworkid, array $optArgs = array()) {
        if (empty($traffictype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "traffictype"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        return $this->request("addTrafficType",
            array_merge(array(
                'traffictype' => $traffictype,
                'physicalnetworkid' => $physicalnetworkid
            ), $optArgs)
        );
    }

    /**
     * List Swift.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $id the id of the swift
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     */
    public function listSwifts(array $optArgs = array()) {
        return $this->request("listSwifts",
            $optArgs
        );
    }

    /**
     * Updates attributes of a template.
     *
     * @param string $id the ID of the image file
     * @param array  $optArgs {
     *     @type string $format the format for the image
     *     @type string $isdynamicallyscalable true if template/ISO contains XS/VMWare tools inorder to support dynamic scaling
     *     of VM cpu/memory
     *     @type string $name the name of the image file
     *     @type string $bootable true if image is bootable, false otherwise
     *     @type string $displaytext the display text of the image
     *     @type string $passwordenabled true if the image supports the password reset feature; default is false
     *     @type string $isrouting true if the template type is routing i.e., if template is used to deploy router
     *     @type string $ostypeid the ID of the OS type that best represents the OS of this image.
     *     @type string $sortkey sort key of the template, integer
     * }
     */
    public function updateTemplate($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateTemplate",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Disables a user account
     *
     * @param string $id Disables user by user ID.
     */
    public function disableUser($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("disableUser",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Configures a virtual router element.
     *
     * @param string $id the ID of the virtual router provider
     * @param string $enabled Enabled/Disabled the service provider
     */
    public function configureVirtualRouterElement($id, $enabled) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($enabled)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "enabled"), MISSING_ARGUMENT);
        }
        return $this->request("configureVirtualRouterElement",
            array(
                'id' => $id,
                'enabled' => $enabled
            )
        );
    }

    /**
     * Accepts or declines project invitation
     *
     * @param string $id id of the invitation
     */
    public function deleteProjectInvitation($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteProjectInvitation",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates a snapshot policy for the account.
     *
     * @param string $intervaltype valid values are HOURLY, DAILY, WEEKLY, and MONTHLY
     * @param string $volumeid the ID of the disk volume
     * @param string $schedule time the snapshot is scheduled to be taken. Format is:* if HOURLY, MM* if DAILY,
     * MM:HH* if WEEKLY, MM:HH:DD (1-7)* if MONTHLY, MM:HH:DD (1-28)
     * @param string $maxsnaps maximum number of snapshots to retain
     * @param string $timezone Specifies a timezone for this command. For more information on the timezone
     * parameter, see Time Zone Format.
     */
    public function createSnapshotPolicy($intervaltype, $volumeid, $schedule, $maxsnaps, $timezone) {
        if (empty($intervaltype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "intervaltype"), MISSING_ARGUMENT);
        }
        if (empty($volumeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeid"), MISSING_ARGUMENT);
        }
        if (empty($schedule)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "schedule"), MISSING_ARGUMENT);
        }
        if (empty($maxsnaps)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "maxsnaps"), MISSING_ARGUMENT);
        }
        if (empty($timezone)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "timezone"), MISSING_ARGUMENT);
        }
        return $this->request("createSnapshotPolicy",
            array(
                'intervaltype' => $intervaltype,
                'volumeid' => $volumeid,
                'schedule' => $schedule,
                'maxsnaps' => $maxsnaps,
                'timezone' => $timezone
            )
        );
    }

    /**
     * Updates a vm group
     *
     * @param string $id Instance group ID
     * @param array  $optArgs {
     *     @type string $name new instance group name
     * }
     */
    public function updateInstanceGroup($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateInstanceGroup",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Attempts Migration of a system virtual machine to the host specified.
     *
     * @param string $virtualmachineid the ID of the virtual machine
     * @param string $hostid destination Host ID to migrate VM to
     */
    public function migrateSystemVm($virtualmachineid, $hostid) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        if (empty($hostid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostid"), MISSING_ARGUMENT);
        }
        return $this->request("migrateSystemVm",
            array(
                'virtualmachineid' => $virtualmachineid,
                'hostid' => $hostid
            )
        );
    }

    /**
     * Creates a service offering.
     *
     * @param string $displaytext the display text of the service offering
     * @param string $name the name of the service offering
     * @param array  $optArgs {
     *     @type string $systemvmtype the system VM type. Possible types are "domainrouter", "consoleproxy" and
     *     "secondarystoragevm".
     *     @type string $offerha the HA for the service offering
     *     @type string $bytesreadrate bytes read rate of the disk offering
     *     @type string $limitcpuuse restrict the CPU usage to committed service offering
     *     @type string $iopsreadrate io requests read rate of the disk offering
     *     @type string $memory the total memory of the service offering in MB
     *     @type string $isvolatile true if the virtual machine needs to be volatile so that on every reboot of VM,
     *     original root disk is dettached then destroyed and a fresh root disk is created
     *     and attached to VM
     *     @type string $cpunumber the CPU number of the service offering
     *     @type string $tags the tags for this service offering.
     *     @type string $cpuspeed the CPU speed of the service offering in MHz.
     *     @type string $iopswriterate io requests write rate of the disk offering
     *     @type string $domainid the ID of the containing domain, null for public offerings
     *     @type string $hosttags the host tag for this service offering.
     *     @type string $networkrate data transfer rate in megabits per second allowed. Supported only for non-System
     *     offering and system offerings having "domainrouter" systemvmtype
     *     @type string $storagetype the storage type of the service offering. Values are local and shared.
     *     @type string $issystem is this a system vm offering
     *     @type string $byteswriterate bytes write rate of the disk offering
     *     @type string $deploymentplanner The deployment planner heuristics used to deploy a VM of this offering. If null,
     *     value of global config vm.deployment.planner is used
     *     @type string $serviceofferingdetails details for planner, used to store specific parameters
     * }
     */
    public function createServiceOffering($displaytext, $name, array $optArgs = array()) {
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displaytext"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createServiceOffering",
            array_merge(array(
                'displaytext' => $displaytext,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Removes VM from specified network by deleting a NIC
     *
     * @param string $nicid NIC ID
     * @param string $virtualmachineid Virtual Machine ID
     */
    public function removeNicFromVirtualMachine($nicid, $virtualmachineid) {
        if (empty($nicid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nicid"), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("removeNicFromVirtualMachine",
            array(
                'nicid' => $nicid,
                'virtualmachineid' => $virtualmachineid
            )
        );
    }

    /**
     * Deletes a Cisco ASA 1000v appliance
     *
     * @param string $resourceid Cisco ASA 1000v resource ID
     */
    public function deleteCiscoAsa1000vResource($resourceid) {
        if (empty($resourceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceid"), MISSING_ARGUMENT);
        }
        return $this->request("deleteCiscoAsa1000vResource",
            array(
                'resourceid' => $resourceid
            )
        );
    }

    /**
     * Deletes a particular ingress rule from this security group
     *
     * @param string $id The ID of the ingress rule
     */
    public function revokeSecurityGroupIngress($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("revokeSecurityGroupIngress",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Changes the default NIC on a VM
     *
     * @param string $virtualmachineid Virtual Machine ID
     * @param string $nicid NIC ID
     */
    public function updateDefaultNicForVirtualMachine($virtualmachineid, $nicid) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        if (empty($nicid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nicid"), MISSING_ARGUMENT);
        }
        return $this->request("updateDefaultNicForVirtualMachine",
            array(
                'virtualmachineid' => $virtualmachineid,
                'nicid' => $nicid
            )
        );
    }

    /**
     * Disables static rule for given ip address
     *
     * @param string $ipaddressid the public IP address id for which static nat feature is being disableed
     */
    public function disableStaticNat($ipaddressid) {
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipaddressid"), MISSING_ARGUMENT);
        }
        return $this->request("disableStaticNat",
            array(
                'ipaddressid' => $ipaddressid
            )
        );
    }

    /**
     * List external firewall appliances.
     *
     * @param string $zoneid zone Id
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listExternalFirewalls($zoneid, array $optArgs = array()) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        return $this->request("listExternalFirewalls",
            array_merge(array(
                'zoneid' => $zoneid
            ), $optArgs)
        );
    }

    /**
     * Creates a ACL rule in the given network (the network has to belong to VPC)
     *
     * @param string $protocol the protocol for the ACL rule. Valid values are TCP/UDP/ICMP/ALL or valid
     * protocol number
     * @param array  $optArgs {
     *     @type string $cidrlist the cidr list to allow traffic from/to
     *     @type string $action scl entry action, allow or deny
     *     @type string $icmpcode error code for this icmp message
     *     @type string $traffictype the traffic type for the ACL,can be Ingress or Egress, defaulted to Ingress if
     *     not specified
     *     @type string $networkid The network of the vm the ACL will be created for
     *     @type string $number The network of the vm the ACL will be created for
     *     @type string $endport the ending port of ACL
     *     @type string $startport the starting port of ACL
     *     @type string $icmptype type of the icmp message being sent
     *     @type string $aclid The network of the vm the ACL will be created for
     * }
     */
    public function createNetworkACL($protocol, array $optArgs = array()) {
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        return $this->request("createNetworkACL",
            array_merge(array(
                'protocol' => $protocol
            ), $optArgs)
        );
    }

    /**
     * Creates a new Pod.
     *
     * @param string $startip the starting IP address for the Pod
     * @param string $zoneid the Zone ID in which the Pod will be created
     * @param string $netmask the netmask for the Pod
     * @param string $name the name of the Pod
     * @param string $gateway the gateway for the Pod
     * @param array  $optArgs {
     *     @type string $endip the ending IP address for the Pod
     *     @type string $allocationstate Allocation state of this Pod for allocation of new resources
     * }
     */
    public function createPod($startip, $zoneid, $netmask, $name, $gateway, array $optArgs = array()) {
        if (empty($startip)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startip"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        return $this->request("createPod",
            array_merge(array(
                'startip' => $startip,
                'zoneid' => $zoneid,
                'netmask' => $netmask,
                'name' => $name,
                'gateway' => $gateway
            ), $optArgs)
        );
    }

    /**
     * Creates a VPC
     *
     * @param string $vpcofferingid the ID of the VPC offering
     * @param string $zoneid the ID of the availability zone
     * @param string $cidr the cidr of the VPC. All VPC guest networks' cidrs should be within this CIDR
     * @param string $name the name of the VPC
     * @param string $displaytext the display text of the VPC
     * @param array  $optArgs {
     *     @type string $projectid create VPC for the project
     *     @type string $start If set to false, the VPC won't start (VPC VR will not get allocated) until its
     *     first network gets implemented. True by default.
     *     @type string $domainid the domain ID associated with the VPC. If used with the account parameter
     *     returns the VPC associated with the account for the specified domain.
     *     @type string $networkdomain VPC network domain. All networks inside the VPC will belong to this domain
     *     @type string $account the account associated with the VPC. Must be used with the domainId parameter.
     * }
     */
    public function createVPC($vpcofferingid, $zoneid, $cidr, $name, $displaytext, array $optArgs = array()) {
        if (empty($vpcofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcofferingid"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($cidr)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidr"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displaytext"), MISSING_ARGUMENT);
        }
        return $this->request("createVPC",
            array_merge(array(
                'vpcofferingid' => $vpcofferingid,
                'zoneid' => $zoneid,
                'cidr' => $cidr,
                'name' => $name,
                'displaytext' => $displaytext
            ), $optArgs)
        );
    }

    /**
     * Lists all supported OS types for this cloud.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $oscategoryid list by Os Category id
     *     @type string $id list by Os type Id
     *     @type string $description list os by description
     *     @type string $keyword List by keyword
     * }
     */
    public function listOsTypes(array $optArgs = array()) {
        return $this->request("listOsTypes",
            $optArgs
        );
    }

    /**
     * add a baremetal pxe server
     *
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $username Credentials to reach external pxe device
     * @param string $url URL of the external pxe device
     * @param string $password Credentials to reach external pxe device
     * @param string $tftpdir Tftp root directory of PXE server
     * @param string $pxeservertype type of pxe device
     * @param array  $optArgs {
     *     @type string $podid Pod Id
     * }
     */
    public function addBaremetalPxeKickStartServer($physicalnetworkid, $username, $url, $password, $tftpdir, $pxeservertype, array $optArgs = array()) {
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($tftpdir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "tftpdir"), MISSING_ARGUMENT);
        }
        if (empty($pxeservertype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pxeservertype"), MISSING_ARGUMENT);
        }
        return $this->request("addBaremetalPxeKickStartServer",
            array_merge(array(
                'physicalnetworkid' => $physicalnetworkid,
                'username' => $username,
                'url' => $url,
                'password' => $password,
                'tftpdir' => $tftpdir,
                'pxeservertype' => $pxeservertype
            ), $optArgs)
        );
    }

    /**
     * Registers an existing ISO into the CloudStack Cloud.
     *
     * @param string $name the name of the ISO
     * @param string $displaytext the display text of the ISO. This is usually used for display purposes.
     * @param string $zoneid the ID of the zone you wish to register the ISO to.
     * @param string $url the URL to where the ISO is currently being hosted
     * @param array  $optArgs {
     *     @type string $projectid Register iso for the project
     *     @type string $ispublic true if you want to register the ISO to be publicly available to all users,
     *     false otherwise.
     *     @type string $isextractable true if the iso or its derivatives are extractable; default is false
     *     @type string $account an optional account name. Must be used with domainId.
     *     @type string $domainid an optional domainId. If the account parameter is used, domainId must also be
     *     used.
     *     @type string $checksum the MD5 checksum value of this ISO
     *     @type string $imagestoreuuid Image store uuid
     *     @type string $ostypeid the ID of the OS Type that best represents the OS of this ISO. If the iso is
     *     bootable this parameter needs to be passed
     *     @type string $isfeatured true if you want this ISO to be featured
     *     @type string $bootable true if this ISO is bootable. If not passed explicitly its assumed to be true
     *     @type string $isdynamicallyscalable true if iso contains XS/VMWare tools inorder to support dynamic scaling of VM
     *     cpu/memory
     * }
     */
    public function registerIso($name, $displaytext, $zoneid, $url, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displaytext"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        return $this->request("registerIso",
            array_merge(array(
                'name' => $name,
                'displaytext' => $displaytext,
                'zoneid' => $zoneid,
                'url' => $url
            ), $optArgs)
        );
    }

    /**
     * Adds detail for the Resource.
     *
     * @param string $details Map of (key/value pairs)
     * @param string $resourcetype type of the resource
     * @param string $resourceid resource id to create the details for
     */
    public function addResourceDetail($details, $resourcetype, $resourceid) {
        if (empty($details)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "details"), MISSING_ARGUMENT);
        }
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourcetype"), MISSING_ARGUMENT);
        }
        if (empty($resourceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceid"), MISSING_ARGUMENT);
        }
        return $this->request("addResourceDetail",
            array(
                'details' => $details,
                'resourcetype' => $resourcetype,
                'resourceid' => $resourceid
            )
        );
    }

    /**
     * Lists SSL certificates
     *
     * @param array  $optArgs {
     *     @type string $accountid Account Id
     *     @type string $lbruleid Loadbalancer Rule Id
     *     @type string $certid Id of SSL certificate
     * }
     */
    public function listSslCerts(array $optArgs = array()) {
        return $this->request("listSslCerts",
            $optArgs
        );
    }

    /**
     * Disassociates an ip address from the account.
     *
     * @param string $id the id of the public ip address to disassociate
     */
    public function disassociateIpAddress($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("disassociateIpAddress",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists zones
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $available true if you want to retrieve all available Zones. False if you only want to
     *     return the Zones from which you have at least one VM. Default is false.
     *     @type string $pagesize the number of entries per page
     *     @type string $name the name of the zone
     *     @type string $showcapacities flag to display the capacity of the zones
     *     @type string $id the ID of the zone
     *     @type string $tags List zones by resource tags (key/value pairs)
     *     @type string $domainid the ID of the domain associated with the zone
     *     @type string $networktype the network type of the zone that the virtual machine belongs to
     * }
     */
    public function listZones(array $optArgs = array()) {
        return $this->request("listZones",
            $optArgs
        );
    }

    /**
     * Lists F5 external load balancer appliances added in a zone.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $zoneid zone Id
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     */
    public function listExternalLoadBalancers(array $optArgs = array()) {
        return $this->request("listExternalLoadBalancers",
            $optArgs
        );
    }

    /**
     * Resets the password for virtual machine. The virtual machine must be in a
     * "Stopped" state and the template must already support this feature for this
     * command to take effect. [async]
     *
     * @param string $id The ID of the virtual machine
     */
    public function resetPasswordForVirtualMachine($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("resetPasswordForVirtualMachine",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates a disk volume from a disk offering. This disk volume must still be
     * attached to a virtual machine to make use of it.
     *
     * @param string $name the name of the disk volume
     * @param array  $optArgs {
     *     @type string $snapshotid the snapshot ID for the disk volume. Either diskOfferingId or snapshotId must be
     *     passed in.
     *     @type string $virtualmachineid the ID of the virtual machine; to be used with snapshot Id, VM to which the
     *     volume gets attached after creation
     *     @type string $account the account associated with the disk volume. Must be used with the domainId
     *     parameter.
     *     @type string $diskofferingid the ID of the disk offering. Either diskOfferingId or snapshotId must be passed
     *     in.
     *     @type string $size Arbitrary volume size
     *     @type string $maxiops max iops
     *     @type string $domainid the domain ID associated with the disk offering. If used with the account
     *     parameter returns the disk volume associated with the account for the specified
     *     domain.
     *     @type string $miniops min iops
     *     @type string $projectid the project associated with the volume. Mutually exclusive with account
     *     parameter
     *     @type string $zoneid the ID of the availability zone
     *     @type string $displayvolume an optional field, whether to display the volume to the end user or not.
     * }
     */
    public function createVolume($name, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createVolume",
            array_merge(array(
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Assigns virtual machine or a list of virtual machines to a load balancer rule.
     *
     * @param string $virtualmachineids the list of IDs of the virtual machine that are being assigned to the load
     * balancer rule(i.e. virtualMachineIds=1,2,3)
     * @param string $id the ID of the load balancer rule
     */
    public function assignToLoadBalancerRule($virtualmachineids, $id) {
        if (empty($virtualmachineids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineids"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("assignToLoadBalancerRule",
            array(
                'virtualmachineids' => $virtualmachineids,
                'id' => $id
            )
        );
    }

    /**
     * Starts a router.
     *
     * @param string $id the ID of the router
     */
    public function startRouter($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("startRouter",
            array(
                'id' => $id
            )
        );
    }

    /**
     * List ucs blades
     *
     * @param string $ucsmanagerid ucs manager id
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     */
    public function listUcsBlades($ucsmanagerid, array $optArgs = array()) {
        if (empty($ucsmanagerid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsmanagerid"), MISSING_ARGUMENT);
        }
        return $this->request("listUcsBlades",
            array_merge(array(
                'ucsmanagerid' => $ucsmanagerid
            ), $optArgs)
        );
    }

    /**
     * Extracts an ISO
     *
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param string $id the ID of the ISO file
     * @param array  $optArgs {
     *     @type string $url the url to which the ISO would be extracted
     *     @type string $zoneid the ID of the zone where the ISO is originally located
     * }
     */
    public function extractIso($mode, $id, array $optArgs = array()) {
        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "mode"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("extractIso",
            array_merge(array(
                'mode' => $mode,
                'id' => $id
            ), $optArgs)
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
     */
    public function removeResourceDetail($resourceid, $resourcetype, array $optArgs = array()) {
        if (empty($resourceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceid"), MISSING_ARGUMENT);
        }
        if (empty($resourcetype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourcetype"), MISSING_ARGUMENT);
        }
        return $this->request("removeResourceDetail",
            array_merge(array(
                'resourceid' => $resourceid,
                'resourcetype' => $resourcetype
            ), $optArgs)
        );
    }

    /**
     * Changes the service offering for a virtual machine. The virtual machine must be
     * in a "Stopped" state for this command to take effect.
     *
     * @param string $serviceofferingid the service offering ID to apply to the virtual machine
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu, memory and cpunumber. example
     *     details[i].name=value
     * }
     */
    public function changeServiceForVirtualMachine($serviceofferingid, $id, array $optArgs = array()) {
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceofferingid"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("changeServiceForVirtualMachine",
            array_merge(array(
                'serviceofferingid' => $serviceofferingid,
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Adds a VMware datacenter to specified zone
     *
     * @param string $vcenter The name/ip of vCenter. Make sure it is IP address or full qualified domain name
     * for host running vCenter server.
     * @param string $name Name of VMware datacenter to be added to specified zone.
     * @param string $zoneid The Zone ID.
     * @param array  $optArgs {
     *     @type string $password The password for specified username.
     *     @type string $username The Username required to connect to resource.
     * }
     */
    public function addVmwareDc($vcenter, $name, $zoneid, array $optArgs = array()) {
        if (empty($vcenter)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vcenter"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        return $this->request("addVmwareDc",
            array_merge(array(
                'vcenter' => $vcenter,
                'name' => $name,
                'zoneid' => $zoneid
            ), $optArgs)
        );
    }

    /**
     * Destroys a l2tp/ipsec remote access vpn
     *
     * @param string $publicipid public ip address id of the vpn server
     */
    public function deleteRemoteAccessVpn($publicipid) {
        if (empty($publicipid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicipid"), MISSING_ARGUMENT);
        }
        return $this->request("deleteRemoteAccessVpn",
            array(
                'publicipid' => $publicipid
            )
        );
    }

    /**
     * Deletes an image store .
     *
     * @param string $id the image store ID
     */
    public function deleteImageStore($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteImageStore",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates a VLAN IP range.
     *
     * @param string $id the id of the VLAN IP range
     */
    public function deleteVlanIpRange($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteVlanIpRange",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Reset site to site vpn connection
     *
     * @param string $id id of vpn connection
     * @param array  $optArgs {
     *     @type string $domainid an optional domainId for connection. If the account parameter is used, domainId
     *     must also be used.
     *     @type string $account an optional account for connection. Must be used with domainId.
     * }
     */
    public function resetVpnConnection($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("resetVpnConnection",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists storage pools.
     *
     * @param array  $optArgs {
     *     @type string $clusterid list storage pools belongig to the specific cluster
     *     @type string $page the page number of the result set
     *     @type string $zoneid the Zone ID for the storage pool
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $name the name of the storage pool
     *     @type string $scope the ID of the storage pool
     *     @type string $path the storage pool path
     *     @type string $podid the Pod ID for the storage pool
     *     @type string $id the ID of the storage pool
     *     @type string $ipaddress the IP address for the storage pool
     * }
     */
    public function listStoragePools(array $optArgs = array()) {
        return $this->request("listStoragePools",
            $optArgs
        );
    }

    /**
     * Starts a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $hostid destination Host ID to deploy the VM to - parameter available for root admin
     *     only
     * }
     */
    public function startVirtualMachine($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("startVirtualMachine",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Creates a l2tp/ipsec remote access vpn
     *
     * @param string $publicipid public ip address id of the vpn server
     * @param array  $optArgs {
     *     @type string $openfirewall if true, firewall rule for source/end pubic port is automatically created; if
     *     false - firewall rule has to be created explicitely. Has value true by default
     *     @type string $domainid an optional domainId for the VPN. If the account parameter is used, domainId
     *     must also be used.
     *     @type string $account an optional account for the VPN. Must be used with domainId.
     *     @type string $iprange the range of ip addresses to allocate to vpn clients. The first ip in the range
     *     will be taken by the vpn server
     * }
     */
    public function createRemoteAccessVpn($publicipid, array $optArgs = array()) {
        if (empty($publicipid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicipid"), MISSING_ARGUMENT);
        }
        return $this->request("createRemoteAccessVpn",
            array_merge(array(
                'publicipid' => $publicipid
            ), $optArgs)
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
     */
    public function extractTemplate($mode, $id, array $optArgs = array()) {
        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "mode"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("extractTemplate",
            array_merge(array(
                'mode' => $mode,
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * List system virtual machines.
     *
     * @param array  $optArgs {
     *     @type string $id the ID of the system VM
     *     @type string $state the state of the system VM
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $systemvmtype the system VM type. Possible types are "consoleproxy" and "secondarystoragevm".
     *     @type string $podid the Pod ID of the system VM
     *     @type string $zoneid the Zone ID of the system VM
     *     @type string $name the name of the system VM
     *     @type string $storageid the storage ID where vm's volumes belong to
     *     @type string $keyword List by keyword
     *     @type string $hostid the host ID of the system VM
     * }
     */
    public function listSystemVms(array $optArgs = array()) {
        return $this->request("listSystemVms",
            $optArgs
        );
    }

    /**
     * Detaches any ISO file (if any) currently attached to a virtual machine.
     *
     * @param string $virtualmachineid The ID of the virtual machine
     */
    public function detachIso($virtualmachineid) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("detachIso",
            array(
                'virtualmachineid' => $virtualmachineid
            )
        );
    }

    /**
     * Deletes a service offering.
     *
     * @param string $id the ID of the service offering
     */
    public function deleteServiceOffering($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteServiceOffering",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a account, and all users associated with this account
     *
     * @param string $id Account id
     */
    public function deleteAccount($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteAccount",
            array(
                'id' => $id
            )
        );
    }

    /**
     * List network devices
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $networkdevicetype Network device type, now supports ExternalDhcp, PxeServer,
     *     NetscalerMPXLoadBalancer, NetscalerVPXLoadBalancer, NetscalerSDXLoadBalancer,
     *     F5BigIpLoadBalancer, JuniperSRXFirewall, PaloAltoFirewall
     *     @type string $networkdeviceparameterlist parameters for network device
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listNetworkDevice(array $optArgs = array()) {
        return $this->request("listNetworkDevice",
            $optArgs
        );
    }

    /**
     * Acquires and associates a public IP to an account.
     *
     * @param array  $optArgs {
     *     @type string $isportable should be set to true if public IP is required to be transferable across zones,
     *     if not specified defaults to false
     *     @type string $regionid region ID from where portable ip is to be associated.
     *     @type string $domainid the ID of the domain to associate with this IP address
     *     @type string $projectid Deploy vm for the project
     *     @type string $vpcid the VPC you want the ip address to be associated with
     *     @type string $networkid The network this ip address should be associated to.
     *     @type string $zoneid the ID of the availability zone you want to acquire an public IP address from
     *     @type string $account the account to associate with this IP address
     * }
     */
    public function associateIpAddress(array $optArgs = array()) {
        return $this->request("associateIpAddress",
            $optArgs
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
     */
    public function disableAccount($lock, array $optArgs = array()) {
        if (empty($lock)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lock"), MISSING_ARGUMENT);
        }
        return $this->request("disableAccount",
            array_merge(array(
                'lock' => $lock
            ), $optArgs)
        );
    }

    /**
     * Attempts Migration of a VM to a different host or Root volume of the vm to a
     * different storage pool
     *
     * @param string $virtualmachineid the ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $storageid Destination storage pool ID to migrate VM volumes to. Required for migrating the
     *     root disk volume
     *     @type string $hostid Destination Host ID to migrate VM to. Required for live migrating a VM from host
     *     to host
     * }
     */
    public function migrateVirtualMachine($virtualmachineid, array $optArgs = array()) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("migrateVirtualMachine",
            array_merge(array(
                'virtualmachineid' => $virtualmachineid
            ), $optArgs)
        );
    }

    /**
     * Updates a domain with a new name
     *
     * @param string $id ID of domain to update
     * @param array  $optArgs {
     *     @type string $networkdomain Network domain for the domain's networks; empty string will update domainName
     *     with NULL value
     *     @type string $name updates domain with this name
     * }
     */
    public function updateDomain($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateDomain",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * List virtual machine snapshot by conditions
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $projectid list objects by project
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $state state of the virtual machine snapshot
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $virtualmachineid the ID of the vm
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $vmsnapshotid The ID of the VM snapshot
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name lists snapshot by snapshot name or display name
     * }
     */
    public function listVMSnapshot(array $optArgs = array()) {
        return $this->request("listVMSnapshot",
            $optArgs
        );
    }

    /**
     * List dedicated zones.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $domainid the ID of the domain associated with the zone
     *     @type string $account the name of the account associated with the zone. Must be used with domainId.
     *     @type string $affinitygroupid list dedicated zones by affinity group
     *     @type string $keyword List by keyword
     *     @type string $zoneid the ID of the Zone
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listDedicatedZones(array $optArgs = array()) {
        return $this->request("listDedicatedZones",
            $optArgs
        );
    }

    /**
     * Removes a virtual machine or a list of virtual machines from a load balancer
     * rule.
     *
     * @param string $id The ID of the load balancer rule
     * @param string $virtualmachineids the list of IDs of the virtual machines that are being removed from the load
     * balancer rule (i.e. virtualMachineIds=1,2,3)
     */
    public function removeFromLoadBalancerRule($id, $virtualmachineids) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineids"), MISSING_ARGUMENT);
        }
        return $this->request("removeFromLoadBalancerRule",
            array(
                'id' => $id,
                'virtualmachineids' => $virtualmachineids
            )
        );
    }

    /**
     * Reset api count
     *
     * @param array  $optArgs {
     *     @type string $account the ID of the acount whose limit to be reset
     * }
     */
    public function resetApiLimit(array $optArgs = array()) {
        return $this->request("resetApiLimit",
            $optArgs
        );
    }

    /**
     * This command allows a user to register for the developer API, returning a secret
     * key and an API key. This request is made through the integration API port, so it
     * is a privileged command and must be made on behalf of a user. It is up to the
     * implementer just how the username and password are entered, and then how that
     * translates to an integration API request. Both secret key and API key should be
     * returned to the user
     *
     * @param string $id User id
     */
    public function registerUserKeys($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("registerUserKeys",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Adds vpn users
     *
     * @param string $username username for the vpn user
     * @param string $password password for the username
     * @param array  $optArgs {
     *     @type string $domainid an optional domainId for the vpn user. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $projectid add vpn user to the specific project
     *     @type string $account an optional account for the vpn user. Must be used with domainId.
     * }
     */
    public function addVpnUser($username, $password, array $optArgs = array()) {
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        return $this->request("addVpnUser",
            array_merge(array(
                'username' => $username,
                'password' => $password
            ), $optArgs)
        );
    }

    /**
     * Lists VPCs
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $projectid list objects by project
     *     @type string $id list VPC by id
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $vpcofferingid list by ID of the VPC offering
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $displaytext List by display text of the VPC
     *     @type string $name list by name of the VPC
     *     @type string $cidr list by cidr of the VPC. All VPC guest networks' cidrs should be within this
     *     CIDR
     *     @type string $supportedservices list VPC supporting certain services
     *     @type string $state list VPCs by state
     *     @type string $restartrequired list VPCs by restartRequired option
     *     @type string $zoneid list by zone
     *     @type string $page the page number of the result set
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function listVPCs(array $optArgs = array()) {
        return $this->request("listVPCs",
            $optArgs
        );
    }

    /**
     * Change ownership of a VM from one account to another. This API is available for
     * Basic zones with security groups and Advanced zones with guest networks. A root
     * administrator can reassign a VM from any account to any other account in any
     * domain. A domain administrator can reassign a VM to any account in the same
     * domain.
     *
     * @param string $account account name of the new VM owner.
     * @param string $domainid domain id of the new VM owner.
     * @param string $virtualmachineid id of the VM to be moved
     * @param array  $optArgs {
     *     @type string $securitygroupids list of security group ids to be applied on the virtual machine. In case no
     *     security groups are provided the VM is part of the default security group.
     *     @type string $networkids list of new network ids in which the moved VM will participate. In case no
     *     network ids are provided the VM will be part of the default network for that
     *     zone. In case there is no network yet created for the new account the default
     *     network will be created.
     * }
     */
    public function assignVirtualMachine($account, $domainid, $virtualmachineid, array $optArgs = array()) {
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainid"), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("assignVirtualMachine",
            array_merge(array(
                'account' => $account,
                'domainid' => $domainid,
                'virtualmachineid' => $virtualmachineid
            ), $optArgs)
        );
    }

    /**
     * List Conditions for the specific user
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $page the page number of the result set
     *     @type string $id ID of the Condition.
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $counterid Counter-id of the condition.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $policyid the ID of the policy
     *     @type string $domainid list only resources belonging to the domain specified
     * }
     */
    public function listConditions(array $optArgs = array()) {
        return $this->request("listConditions",
            $optArgs
        );
    }

    /**
     * Deletes a LB stickiness policy.
     *
     * @param string $id the ID of the LB stickiness policy
     */
    public function deleteLBStickinessPolicy($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteLBStickinessPolicy",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Updates properties of a virtual machine. The VM has to be stopped and restarted
     * for the new properties to take effect. UpdateVirtualMachine does not first check
     * whether the VM is stopped. Therefore, stop the VM manually before issuing this
     * call.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $ostypeid the ID of the OS type that best represents this VM.
     *     @type string $haenable true if high-availability is enabled for the virtual machine, false otherwise
     *     @type string $group group of the virtual machine
     *     @type string $displayname user generated name
     *     @type string $isdynamicallyscalable true if VM contains XS/VMWare tools inorder to support dynamic scaling of VM
     *     cpu/memory
     *     @type string $displayvm an optional field, whether to the display the vm to the end user or not.
     *     @type string $userdata an optional binary data that can be sent to the virtual machine upon a
     *     successful deployment. This binary data must be base64 encoded before adding it
     *     to the request. Using HTTP GET (via querystring), you can send up to 2KB of data
     *     after base64 encoding. Using HTTP POST(via POST body), you can send up to 32K of
     *     data after base64 encoding.
     * }
     */
    public function updateVirtualMachine($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateVirtualMachine",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Creates a private gateway
     *
     * @param string $vpcid the VPC network belongs to
     * @param string $netmask the netmask of the Private gateway
     * @param string $ipaddress the IP address of the Private gateaway
     * @param string $gateway the gateway of the Private gateway
     * @param string $vlan the network implementation uri for the private gateway
     * @param array  $optArgs {
     *     @type string $physicalnetworkid the Physical Network ID the network belongs to
     *     @type string $networkofferingid the uuid of the network offering to use for the private gateways network
     *     connection
     *     @type string $aclid the ID of the network ACL
     *     @type string $sourcenatsupported source NAT supported value. Default value false. If 'true' source NAT is enabled
     *     on the private gateway 'false': sourcenat is not supported
     * }
     */
    public function createPrivateGateway($vpcid, $netmask, $ipaddress, $gateway, $vlan, array $optArgs = array()) {
        if (empty($vpcid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcid"), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }
        if (empty($ipaddress)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipaddress"), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        if (empty($vlan)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vlan"), MISSING_ARGUMENT);
        }
        return $this->request("createPrivateGateway",
            array_merge(array(
                'vpcid' => $vpcid,
                'netmask' => $netmask,
                'ipaddress' => $ipaddress,
                'gateway' => $gateway,
                'vlan' => $vlan
            ), $optArgs)
        );
    }

    /**
     * Lists all available service offerings.
     *
     * @param array  $optArgs {
     *     @type string $virtualmachineid the ID of the virtual machine. Pass this in if you want to see the available
     *     service offering that a virtual machine can be changed to.
     *     @type string $keyword List by keyword
     *     @type string $domainid the ID of the domain associated with the service offering
     *     @type string $issystem is this a system vm offering
     *     @type string $name name of the service offering
     *     @type string $systemvmtype the system VM type. Possible types are "consoleproxy", "secondarystoragevm" or
     *     "domainrouter".
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $id ID of the service offering
     * }
     */
    public function listServiceOfferings(array $optArgs = array()) {
        return $this->request("listServiceOfferings",
            $optArgs
        );
    }

    /**
     * Lists resource limits.
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $id Lists resource limits by ID.
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $resourcetype Type of resource to update. Values are 0, 1, 2, 3, and 4.0 - Instance. Number of
     *     instances a user can create. 1 - IP. Number of public IP addresses an account
     *     can own. 2 - Volume. Number of disk volumes an account can own.3 - Snapshot.
     *     Number of snapshots an account can own.4 - Template. Number of templates an
     *     account can register/create.5 - Project. Number of projects an account can own.6
     *     - Network. Number of networks an account can own.7 - VPC. Number of VPC an
     *     account can own.8 - CPU. Number of CPU an account can allocate for his
     *     resources.9 - Memory. Amount of RAM an account can allocate for his resources.10
     *     - Primary Storage. Amount of Primary storage an account can allocate for his
     *     resoruces.11 - Secondary Storage. Amount of Secondary storage an account can
     *     allocate for his resources.
     * }
     */
    public function listResourceLimits(array $optArgs = array()) {
        return $this->request("listResourceLimits",
            $optArgs
        );
    }

    /**
     * Adds a Ucs manager
     *
     * @param string $url the name of UCS url
     * @param string $password the password of UCS
     * @param string $zoneid the Zone id for the ucs manager
     * @param string $username the username of UCS
     * @param array  $optArgs {
     *     @type string $name the name of UCS manager
     * }
     */
    public function addUcsManager($url, $password, $zoneid, $username, array $optArgs = array()) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        return $this->request("addUcsManager",
            array_merge(array(
                'url' => $url,
                'password' => $password,
                'zoneid' => $zoneid,
                'username' => $username
            ), $optArgs)
        );
    }

    /**
     * disable a Cisco Nexus VSM device
     *
     * @param string $id Id of the Cisco Nexus 1000v VSM device to be deleted
     */
    public function disableCiscoNexusVSM($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("disableCiscoNexusVSM",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a vmsnapshot.
     *
     * @param string $vmsnapshotid The ID of the VM snapshot
     */
    public function deleteVMSnapshot($vmsnapshotid) {
        if (empty($vmsnapshotid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vmsnapshotid"), MISSING_ARGUMENT);
        }
        return $this->request("deleteVMSnapshot",
            array(
                'vmsnapshotid' => $vmsnapshotid
            )
        );
    }

    /**
     * Deletes a autoscale vm profile.
     *
     * @param string $id the ID of the autoscale profile
     */
    public function deleteAutoScaleVmProfile($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteAutoScaleVmProfile",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a storage pool.
     *
     * @param string $id Storage pool id
     * @param array  $optArgs {
     *     @type string $forced Force destroy storage pool (force expunge volumes in Destroyed state as a part
     *     of pool removal)
     * }
     */
    public function deleteStoragePool($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteStoragePool",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Deletes a snapshot of a disk volume.
     *
     * @param string $id The ID of the snapshot
     */
    public function deleteSnapshot($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteSnapshot",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Creates a project
     *
     * @param string $displaytext display text of the project
     * @param string $name name of the project
     * @param array  $optArgs {
     *     @type string $account account who will be Admin for the project
     *     @type string $domainid domain ID of the account owning a project
     * }
     */
    public function createProject($displaytext, $name, array $optArgs = array()) {
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displaytext"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createProject",
            array_merge(array(
                'displaytext' => $displaytext,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Creates a load balancer rule
     *
     * @param string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     * @param string $privateport the private port of the private ip address/virtual machine where the network
     * traffic will be load balanced to
     * @param string $publicport the public port from where the network traffic will be load balanced from
     * @param string $name name of the load balancer rule
     * @param array  $optArgs {
     *     @type string $openfirewall if true, firewall rule for source/end pubic port is automatically created; if
     *     false - firewall rule has to be created explicitely. If not specified 1)
     *     defaulted to false when LB rule is being created for VPC guest network 2) in all
     *     other cases defaulted to true
     *     @type string $account the account associated with the load balancer. Must be used with the domainId
     *     parameter.
     *     @type string $cidrlist the cidr list to forward traffic from
     *     @type string $publicipid public ip address id from where the network traffic will be load balanced from
     *     @type string $description the description of the load balancer rule
     *     @type string $networkid The guest network this rule will be created for. Required when public Ip address
     *     is not associated with any Guest network yet (VPC case)
     *     @type string $domainid the domain ID associated with the load balancer
     *     @type string $zoneid zone where the load balancer is going to be created. This parameter is required
     *     when LB service provider is ElasticLoadBalancerVm
     *     @type string $protocol The protocol for the LB
     * }
     */
    public function createLoadBalancerRule($algorithm, $privateport, $publicport, $name, array $optArgs = array()) {
        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "algorithm"), MISSING_ARGUMENT);
        }
        if (empty($privateport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privateport"), MISSING_ARGUMENT);
        }
        if (empty($publicport)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicport"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createLoadBalancerRule",
            array_merge(array(
                'algorithm' => $algorithm,
                'privateport' => $privateport,
                'publicport' => $publicport,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Creates an autoscale policy for a provision or deprovision action, the action is
     * taken when the all the conditions evaluates to true for the specified duration.
     * The policy is in effect once it is attached to a autscale vm group.
     *
     * @param string $action the action to be executed if all the conditions evaluate to true for the
     * specified duration.
     * @param string $duration the duration for which the conditions have to be true before action is taken
     * @param string $conditionids the list of IDs of the conditions that are being evaluated on every interval
     * @param array  $optArgs {
     *     @type string $quiettime the cool down period for which the policy should not be evaluated after the
     *     action has been taken
     * }
     */
    public function createAutoScalePolicy($action, $duration, $conditionids, array $optArgs = array()) {
        if (empty($action)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "action"), MISSING_ARGUMENT);
        }
        if (empty($duration)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "duration"), MISSING_ARGUMENT);
        }
        if (empty($conditionids)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "conditionids"), MISSING_ARGUMENT);
        }
        return $this->request("createAutoScalePolicy",
            array_merge(array(
                'action' => $action,
                'duration' => $duration,
                'conditionids' => $conditionids
            ), $optArgs)
        );
    }

    /**
     * Restore a VM to original template/ISO or new template/ISO
     *
     * @param string $virtualmachineid Virtual Machine ID
     * @param array  $optArgs {
     *     @type string $templateid an optional template Id to restore vm from the new template. This can be an ISO
     *     id in case of restore vm deployed using ISO
     * }
     */
    public function restoreVirtualMachine($virtualmachineid, array $optArgs = array()) {
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("restoreVirtualMachine",
            array_merge(array(
                'virtualmachineid' => $virtualmachineid
            ), $optArgs)
        );
    }

    /**
     * List Event Types
     *
     */
    public function listEventTypes() {
        return $this->request("listEventTypes",
            $optArgs
        );
    }

    /**
     * Deletes affinity group
     *
     * @param array  $optArgs {
     *     @type string $account the account of the affinity group. Must be specified with domain ID
     *     @type string $name The name of the affinity group. Mutually exclusive with id parameter
     *     @type string $domainid the domain ID of account owning the affinity group
     *     @type string $id The ID of the affinity group. Mutually exclusive with name parameter
     * }
     */
    public function deleteAffinityGroup(array $optArgs = array()) {
        return $this->request("deleteAffinityGroup",
            $optArgs
        );
    }

    /**
     * Lists BigSwitch Vns devices
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $physicalnetworkid the Physical Network ID
     *     @type string $page the page number of the result set
     *     @type string $vnsdeviceid bigswitch vns device ID
     *     @type string $keyword List by keyword
     * }
     */
    public function listBigSwitchVnsDevices(array $optArgs = array()) {
        return $this->request("listBigSwitchVnsDevices",
            $optArgs
        );
    }

    /**
     * Creates a network offering.
     *
     * @param string $guestiptype guest type of the network offering: Shared or Isolated
     * @param string $traffictype the traffic type for the network offering. Supported type in current release is
     * GUEST only
     * @param string $supportedservices services supported by the network offering
     * @param string $name the name of the network offering
     * @param string $displaytext the display text of the network offering
     * @param array  $optArgs {
     *     @type string $conservemode true if the network offering is IP conserve mode enabled
     *     @type string $keepaliveenabled if true keepalive will be turned on in the loadbalancer. At the time of writing
     *     this has only an effect on haproxy; the mode http and httpclose options are
     *     unset in the haproxy conf file.
     *     @type string $specifyvlan true if network offering supports vlans
     *     @type string $serviceproviderlist provider to service mapping. If not specified, the provider for the service will
     *     be mapped to the default provider on the physical network
     *     @type string $ispersistent true if network offering supports persistent networks; defaulted to false if not
     *     specified
     *     @type string $egressdefaultpolicy true if default guest network egress policy is allow; false if default egress
     *     policy is deny
     *     @type string $servicecapabilitylist desired service capabilities as part of network offering
     *     @type string $tags the tags for the network offering.
     *     @type string $availability the availability of network offering. Default value is Optional
     *     @type string $networkrate data transfer rate in megabits per second allowed
     *     @type string $specifyipranges true if network offering supports specifying ip ranges; defaulted to false if
     *     not specified
     *     @type string $serviceofferingid the service offering ID used by virtual router provider
     *     @type string $maxconnections maximum number of concurrent connections supported by the network offering
     *     @type string $details Network offering details in key/value pairs. Supported keys are
     *     internallbprovider/publiclbprovider with service provider as a value
     * }
     */
    public function createNetworkOffering($guestiptype, $traffictype, $supportedservices, $name, $displaytext, array $optArgs = array()) {
        if (empty($guestiptype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "guestiptype"), MISSING_ARGUMENT);
        }
        if (empty($traffictype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "traffictype"), MISSING_ARGUMENT);
        }
        if (empty($supportedservices)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "supportedservices"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displaytext"), MISSING_ARGUMENT);
        }
        return $this->request("createNetworkOffering",
            array_merge(array(
                'guestiptype' => $guestiptype,
                'traffictype' => $traffictype,
                'supportedservices' => $supportedservices,
                'name' => $name,
                'displaytext' => $displaytext
            ), $optArgs)
        );
    }

    /**
     * Copies an iso from one zone to another.
     *
     * @param string $id Template ID.
     * @param string $destzoneid ID of the zone the template is being copied to.
     * @param array  $optArgs {
     *     @type string $sourcezoneid ID of the zone the template is currently hosted on. If not specified and
     *     template is cross-zone, then we will sync this template to region wide image
     *     store
     * }
     */
    public function copyIso($id, $destzoneid, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($destzoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "destzoneid"), MISSING_ARGUMENT);
        }
        return $this->request("copyIso",
            array_merge(array(
                'id' => $id,
                'destzoneid' => $destzoneid
            ), $optArgs)
        );
    }

    /**
     * Dedicates a Public IP range to an account
     *
     * @param string $domainid domain ID of the account owning a VLAN
     * @param string $account account who will own the VLAN
     * @param string $id the id of the VLAN IP range
     * @param array  $optArgs {
     *     @type string $projectid project who will own the VLAN
     * }
     */
    public function dedicatePublicIpRange($domainid, $account, $id, array $optArgs = array()) {
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainid"), MISSING_ARGUMENT);
        }
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("dedicatePublicIpRange",
            array_merge(array(
                'domainid' => $domainid,
                'account' => $account,
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists all children domains belonging to a specified domain
     *
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $id list children domain by parent domain ID.
     *     @type string $name list children domains by name
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $isrecursive to return the entire tree, use the value "true". To return the first level
     *     children, use the value "false".
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     * }
     */
    public function listDomainChildren(array $optArgs = array()) {
        return $this->request("listDomainChildren",
            $optArgs
        );
    }

    /**
     * Uploads a data disk.
     *
     * @param string $name the name of the volume
     * @param string $zoneid the ID of the zone the volume is to be hosted on
     * @param string $format the format for the volume. Possible values include QCOW2, OVA, and VHD.
     * @param string $url the URL of where the volume is hosted. Possible URL include http:// and
     * https://
     * @param array  $optArgs {
     *     @type string $account an optional accountName. Must be used with domainId.
     *     @type string $imagestoreuuid Image store uuid
     *     @type string $projectid Upload volume for the project
     *     @type string $domainid an optional domainId. If the account parameter is used, domainId must also be
     *     used.
     *     @type string $checksum the MD5 checksum value of this volume
     * }
     */
    public function uploadVolume($name, $zoneid, $format, $url, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($format)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "format"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        return $this->request("uploadVolume",
            array_merge(array(
                'name' => $name,
                'zoneid' => $zoneid,
                'format' => $format,
                'url' => $url
            ), $optArgs)
        );
    }

    /**
     * Lists autoscale vm profiles.
     *
     * @param array  $optArgs {
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $id the ID of the autoscale vm profile
     *     @type string $templateid the templateid of the autoscale vm profile
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page the page number of the result set
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $otherdeployparams the otherdeployparameters of the autoscale vm profile
     *     @type string $pagesize the number of entries per page
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     * }
     */
    public function listAutoScaleVmProfiles(array $optArgs = array()) {
        return $this->request("listAutoScaleVmProfiles",
            $optArgs
        );
    }

    /**
     * Creates a Load Balancer stickiness policy
     *
     * @param string $lbruleid the ID of the load balancer rule
     * @param string $methodname name of the LB Stickiness policy method, possible values can be obtained from
     * ListNetworks API
     * @param string $name name of the LB Stickiness policy
     * @param array  $optArgs {
     *     @type string $description the description of the LB Stickiness policy
     *     @type string $param param list. Example: param[0].name=cookiename&param[0].value=LBCookie
     * }
     */
    public function createLBStickinessPolicy($lbruleid, $methodname, $name, array $optArgs = array()) {
        if (empty($lbruleid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleid"), MISSING_ARGUMENT);
        }
        if (empty($methodname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "methodname"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createLBStickinessPolicy",
            array_merge(array(
                'lbruleid' => $lbruleid,
                'methodname' => $methodname,
                'name' => $name
            ), $optArgs)
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
     */
    public function migrateVirtualMachineWithVolume($hostid, $virtualmachineid, array $optArgs = array()) {
        if (empty($hostid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostid"), MISSING_ARGUMENT);
        }
        if (empty($virtualmachineid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualmachineid"), MISSING_ARGUMENT);
        }
        return $this->request("migrateVirtualMachineWithVolume",
            array_merge(array(
                'hostid' => $hostid,
                'virtualmachineid' => $virtualmachineid
            ), $optArgs)
        );
    }

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

    /**
     * Adds metric counter
     *
     * @param string $source Source of the counter.
     * @param string $name Name of the counter.
     * @param string $value Value of the counter e.g. oid in case of snmp.
     */
    public function createCounter($source, $name, $value) {
        if (empty($source)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "source"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($value)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "value"), MISSING_ARGUMENT);
        }
        return $this->request("createCounter",
            array(
                'source' => $source,
                'name' => $name,
                'value' => $value
            )
        );
    }

    /**
     * Lists accounts and provides detailed account information for listed accounts
     *
     * @param array  $optArgs {
     *     @type string $accounttype list accounts by account type. Valid account types are 1 (admin), 2
     *     (domain-admin), and 0 (user).
     *     @type string $name list account by account name
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     *     @type string $state list accounts by state. Valid states are enabled, disabled, and locked.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $pagesize the number of entries per page
     *     @type string $iscleanuprequired list accounts by cleanuprequred attribute (values are true or false)
     *     @type string $id list account by account ID
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $domainid list only resources belonging to the domain specified
     * }
     */
    public function listAccounts(array $optArgs = array()) {
        return $this->request("listAccounts",
            $optArgs
        );
    }

    /**
     * Creates an instant snapshot of a volume.
     *
     * @param string $volumeid The ID of the disk volume
     * @param array  $optArgs {
     *     @type string $quiescevm quiesce vm if true
     *     @type string $account The account of the snapshot. The account parameter must be used with the
     *     domainId parameter.
     *     @type string $domainid The domain ID of the snapshot. If used with the account parameter, specifies a
     *     domain for the account associated with the disk volume.
     *     @type string $policyid policy id of the snapshot, if this is null, then use MANUAL_POLICY.
     * }
     */
    public function createSnapshot($volumeid, array $optArgs = array()) {
        if (empty($volumeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeid"), MISSING_ARGUMENT);
        }
        return $this->request("createSnapshot",
            array_merge(array(
                'volumeid' => $volumeid
            ), $optArgs)
        );
    }

    /**
     * Updates an ISO file.
     *
     * @param string $id the ID of the image file
     * @param array  $optArgs {
     *     @type string $bootable true if image is bootable, false otherwise
     *     @type string $ostypeid the ID of the OS type that best represents the OS of this image.
     *     @type string $name the name of the image file
     *     @type string $isrouting true if the template type is routing i.e., if template is used to deploy router
     *     @type string $isdynamicallyscalable true if template/ISO contains XS/VMWare tools inorder to support dynamic scaling
     *     of VM cpu/memory
     *     @type string $passwordenabled true if the image supports the password reset feature; default is false
     *     @type string $sortkey sort key of the template, integer
     *     @type string $displaytext the display text of the image
     *     @type string $format the format for the image
     * }
     */
    public function updateIso($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateIso",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * list portable IP ranges
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $id Id of the portable ip range
     *     @type string $regionid Id of a Region
     * }
     */
    public function listPortableIpRanges(array $optArgs = array()) {
        return $this->request("listPortableIpRanges",
            $optArgs
        );
    }

    /**
     * List the ip forwarding rules
     *
     * @param array  $optArgs {
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $id Lists rule with the specified ID.
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $page the page number of the result set
     *     @type string $ipaddressid list the rule belonging to this public ip address
     *     @type string $projectid list objects by project
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $virtualmachineid Lists all rules applied to the specified Vm.
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     * }
     */
    public function listIpForwardingRules(array $optArgs = array()) {
        return $this->request("listIpForwardingRules",
            $optArgs
        );
    }

    /**
     * Destroys a virtual machine. Once destroyed, only the administrator can recover
     * it.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $expunge If true is passed, the vm is expunged immediately. False by default. Parameter
     *     can be passed to the call by ROOT/Domain admin only
     * }
     */
    public function destroyVirtualMachine($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("destroyVirtualMachine",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Updates a network
     *
     * @param string $id the ID of the network
     * @param array  $optArgs {
     *     @type string $displaynetwork an optional field, whether to the display the network to the end user or not.
     *     @type string $name the new name for the network
     *     @type string $changecidr Force update even if cidr type is different
     *     @type string $networkofferingid network offering ID
     *     @type string $displaytext the new display text for the network
     *     @type string $guestvmcidr CIDR for Guest VMs,Cloudstack allocates IPs to Guest VMs only from this CIDR
     *     @type string $networkdomain network domain
     * }
     */
    public function updateNetwork($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateNetwork",
            array_merge(array(
                'id' => $id
            ), $optArgs)
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
     */
    public function dedicateHost($hostid, $domainid, array $optArgs = array()) {
        if (empty($hostid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostid"), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainid"), MISSING_ARGUMENT);
        }
        return $this->request("dedicateHost",
            array_merge(array(
                'hostid' => $hostid,
                'domainid' => $domainid
            ), $optArgs)
        );
    }

    /**
     * Adds a Region
     *
     * @param string $id Id of the Region
     * @param string $endpoint Region service endpoint
     * @param string $name Name of the region
     */
    public function addRegion($id, $endpoint, $name) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($endpoint)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "endpoint"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("addRegion",
            array(
                'id' => $id,
                'endpoint' => $endpoint,
                'name' => $name
            )
        );
    }

    /**
     * Creates a disk offering.
     *
     * @param string $displaytext alternate display text of the disk offering
     * @param string $name name of the disk offering
     * @param array  $optArgs {
     *     @type string $disksize size of the disk offering in GB
     *     @type string $storagetype the storage type of the disk offering. Values are local and shared.
     *     @type string $byteswriterate bytes write rate of the disk offering
     *     @type string $hypervisorsnapshotreserve Hypervisor snapshot reserve space as a percent of a volume (for managed storage
     *     using Xen or VMware)
     *     @type string $domainid the ID of the containing domain, null for public offerings
     *     @type string $maxiops max iops of the disk offering
     *     @type string $bytesreadrate bytes read rate of the disk offering
     *     @type string $customized whether disk offering size is custom or not
     *     @type string $iopswriterate io requests write rate of the disk offering
     *     @type string $miniops min iops of the disk offering
     *     @type string $displayoffering an optional field, whether to display the offering to the end user or not.
     *     @type string $customizediops whether disk offering iops is custom or not
     *     @type string $iopsreadrate io requests read rate of the disk offering
     *     @type string $tags tags for the disk offering
     * }
     */
    public function createDiskOffering($displaytext, $name, array $optArgs = array()) {
        if (empty($displaytext)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displaytext"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createDiskOffering",
            array_merge(array(
                'displaytext' => $displaytext,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Retrieves a cloud identifier.
     *
     * @param string $userid the user ID for the cloud identifier
     */
    public function getCloudIdentifier($userid) {
        if (empty($userid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userid"), MISSING_ARGUMENT);
        }
        return $this->request("getCloudIdentifier",
            array(
                'userid' => $userid
            )
        );
    }

    /**
     * lists network that are using a netscaler load balancer device
     *
     * @param string $lbdeviceid netscaler load balancer device ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     * }
     */
    public function listNetscalerLoadBalancerNetworks($lbdeviceid, array $optArgs = array()) {
        if (empty($lbdeviceid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbdeviceid"), MISSING_ARGUMENT);
        }
        return $this->request("listNetscalerLoadBalancerNetworks",
            array_merge(array(
                'lbdeviceid' => $lbdeviceid
            ), $optArgs)
        );
    }

    /**
     * Deletes an external firewall appliance.
     *
     * @param string $id Id of the external firewall appliance.
     */
    public function deleteExternalFirewall($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteExternalFirewall",
            array(
                'id' => $id
            )
        );
    }

    /**
     * List internal LB VMs.
     *
     * @param array  $optArgs {
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $hostid the host ID of the Internal LB VM
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $podid the Pod ID of the Internal LB VM
     *     @type string $forvpc if true is passed for this parameter, list only VPC Internal LB VMs
     *     @type string $keyword List by keyword
     *     @type string $networkid list by network id
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $projectid list objects by project
     *     @type string $zoneid the Zone ID of the Internal LB VM
     *     @type string $state the state of the Internal LB VM
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $name the name of the Internal LB VM
     *     @type string $id the ID of the Internal LB VM
     *     @type string $vpcid List Internal LB VMs by VPC
     * }
     */
    public function listInternalLoadBalancerVMs(array $optArgs = array()) {
        return $this->request("listInternalLoadBalancerVMs",
            $optArgs
        );
    }

    /**
     * Creates a firewall rule for a given ip address
     *
     * @param string $protocol the protocol for the firewall rule. Valid values are TCP/UDP/ICMP.
     * @param string $ipaddressid the IP address id of the port forwarding rule
     * @param array  $optArgs {
     *     @type string $cidrlist the cidr list to forward traffic from
     *     @type string $icmpcode error code for this icmp message
     *     @type string $endport the ending port of firewall rule
     *     @type string $type type of firewallrule: system/user
     *     @type string $startport the starting port of firewall rule
     *     @type string $icmptype type of the icmp message being sent
     * }
     */
    public function createFirewallRule($protocol, $ipaddressid, array $optArgs = array()) {
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        if (empty($ipaddressid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipaddressid"), MISSING_ARGUMENT);
        }
        return $this->request("createFirewallRule",
            array_merge(array(
                'protocol' => $protocol,
                'ipaddressid' => $ipaddressid
            ), $optArgs)
        );
    }

    /**
     * Recalculate and update resource count for an account or domain.
     *
     * @param string $domainid If account parameter specified then updates resource counts for a specified
     * account in this domain else update resource counts for all accounts & child
     * domains in specified domain.
     * @param array  $optArgs {
     *     @type string $account Update resource count for a specified account. Must be used with the domainId
     *     parameter.
     *     @type string $projectid Update resource limits for project
     *     @type string $resourcetype Type of resource to update. If specifies valid values are 0, 1, 2, 3, 4, 5, 6,
     *     7, 8, 9, 10 and 11. If not specified will update all resource counts0 -
     *     Instance. Number of instances a user can create. 1 - IP. Number of public IP
     *     addresses a user can own. 2 - Volume. Number of disk volumes a user can create.3
     *     - Snapshot. Number of snapshots a user can create.4 - Template. Number of
     *     templates that a user can register/create.5 - Project. Number of projects that a
     *     user can create.6 - Network. Number of guest network a user can create.7 - VPC.
     *     Number of VPC a user can create.8 - CPU. Total number of CPU cores a user can
     *     use.9 - Memory. Total Memory (in MB) a user can use.10 - PrimaryStorage. Total
     *     primary storage space (in GiB) a user can use.11 - SecondaryStorage. Total
     *     secondary storage space (in GiB) a user can use.
     * }
     */
    public function updateResourceCount($domainid, array $optArgs = array()) {
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainid"), MISSING_ARGUMENT);
        }
        return $this->request("updateResourceCount",
            array_merge(array(
                'domainid' => $domainid
            ), $optArgs)
        );
    }

    /**
     * create a profile of template and associate to a blade
     *
     * @param string $ucsmanagerid ucs manager id
     * @param string $templatedn template dn
     * @param string $bladeid blade id
     * @param array  $optArgs {
     *     @type string $profilename profile name
     * }
     */
    public function instantiateUcsTemplateAndAssocaciateToBlade($ucsmanagerid, $templatedn, $bladeid, array $optArgs = array()) {
        if (empty($ucsmanagerid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsmanagerid"), MISSING_ARGUMENT);
        }
        if (empty($templatedn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templatedn"), MISSING_ARGUMENT);
        }
        if (empty($bladeid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bladeid"), MISSING_ARGUMENT);
        }
        return $this->request("instantiateUcsTemplateAndAssocaciateToBlade",
            array_merge(array(
                'ucsmanagerid' => $ucsmanagerid,
                'templatedn' => $templatedn,
                'bladeid' => $bladeid
            ), $optArgs)
        );
    }

    /**
     * Adds a network serviceProvider to a physical network
     *
     * @param string $name the name for the physical network service provider
     * @param string $physicalnetworkid the Physical Network ID to add the provider to
     * @param array  $optArgs {
     *     @type string $destinationphysicalnetworkid the destination Physical Network ID to bridge to
     *     @type string $servicelist the list of services to be enabled for this physical network service provider
     * }
     */
    public function addNetworkServiceProvider($name, $physicalnetworkid, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        return $this->request("addNetworkServiceProvider",
            array_merge(array(
                'name' => $name,
                'physicalnetworkid' => $physicalnetworkid
            ), $optArgs)
        );
    }

    /**
     * Reboots a system VM.
     *
     * @param string $id The ID of the system virtual machine
     */
    public function rebootSystemVm($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("rebootSystemVm",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Revert VM from a vmsnapshot.
     *
     * @param string $vmsnapshotid The ID of the vm snapshot
     */
    public function revertToVMSnapshot($vmsnapshotid) {
        if (empty($vmsnapshotid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vmsnapshotid"), MISSING_ARGUMENT);
        }
        return $this->request("revertToVMSnapshot",
            array(
                'vmsnapshotid' => $vmsnapshotid
            )
        );
    }

    /**
     * Marks a default zone for this account
     *
     * @param string $zoneid The Zone ID with which the account is to be marked.
     * @param string $account Name of the account that is to be marked.
     * @param string $domainid Marks the account that belongs to the specified domain.
     */
    public function markDefaultZoneForAccount($zoneid, $account, $domainid) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($domainid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainid"), MISSING_ARGUMENT);
        }
        return $this->request("markDefaultZoneForAccount",
            array(
                'zoneid' => $zoneid,
                'account' => $account,
                'domainid' => $domainid
            )
        );
    }

    /**
     * Locks a user account
     *
     * @param string $id Locks user by user ID.
     */
    public function lockUser($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("lockUser",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Add a new Ldap Configuration
     *
     * @param string $hostname Hostname
     * @param string $port Port
     */
    public function addLdapConfiguration($hostname, $port) {
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }
        if (empty($port)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "port"), MISSING_ARGUMENT);
        }
        return $this->request("addLdapConfiguration",
            array(
                'hostname' => $hostname,
                'port' => $port
            )
        );
    }

    /**
     * List the virtual machines owned by the account.
     *
     * @param array  $optArgs {
     *     @type string $state state of the virtual machine
     *     @type string $forvirtualnetwork list by network type; true if need to list vms using Virtual Network, false
     *     otherwise
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $podid the pod ID
     *     @type string $details comma separated list of host details requested, value can be a list of [all,
     *     group, nics, stats, secgrp, tmpl, servoff, iso, volume, min, affgrp]. If no
     *     parameter is passed in, the details will be defaulted to all
     *     @type string $zoneid the availability zone ID
     *     @type string $id the ID of the virtual machine
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $projectid list objects by project
     *     @type string $isoid list vms by iso
     *     @type string $name name of the virtual machine
     *     @type string $hypervisor the target hypervisor for the template
     *     @type string $networkid list by network id
     *     @type string $affinitygroupid list vms by affinity group
     *     @type string $templateid list vms by template
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $groupid the group ID
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page the page number of the result set
     *     @type string $storageid the storage ID where vm's volumes belong to
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $hostid the host ID
     *     @type string $vpcid list vms by vpc
     * }
     */
    public function listVirtualMachines(array $optArgs = array()) {
        return $this->request("listVirtualMachines",
            $optArgs
        );
    }

    /**
     * Restarts a VPC
     *
     * @param string $id the id of the VPC
     */
    public function restartVPC($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("restartVPC",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Replaces ACL associated with a Network or private gateway
     *
     * @param string $aclid the ID of the network ACL
     * @param array  $optArgs {
     *     @type string $gatewayid the ID of the private gateway
     *     @type string $networkid the ID of the network
     * }
     */
    public function replaceNetworkACLList($aclid, array $optArgs = array()) {
        if (empty($aclid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "aclid"), MISSING_ARGUMENT);
        }
        return $this->request("replaceNetworkACLList",
            array_merge(array(
                'aclid' => $aclid
            ), $optArgs)
        );
    }

    /**
     * Generates an alert
     *
     * @param string $type Type of the alert
     * @param string $name Name of the alert
     * @param string $description Alert description
     * @param array  $optArgs {
     *     @type string $podid Pod id for which alert is generated
     *     @type string $zoneid Zone id for which alert is generated
     * }
     */
    public function generateAlert($type, $name, $description, array $optArgs = array()) {
        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "type"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($description)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "description"), MISSING_ARGUMENT);
        }
        return $this->request("generateAlert",
            array_merge(array(
                'type' => $type,
                'name' => $name,
                'description' => $description
            ), $optArgs)
        );
    }

    /**
     * Scale the service offering for a system vm (console proxy or secondary storage).
     * The system vm must be in a "Stopped" state for this command to take effect.
     *
     * @param string $serviceofferingid the service offering ID to apply to the system vm
     * @param string $id The ID of the system vm
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu, memory and cpunumber. example
     *     details[i].name=value
     * }
     */
    public function scaleSystemVm($serviceofferingid, $id, array $optArgs = array()) {
        if (empty($serviceofferingid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceofferingid"), MISSING_ARGUMENT);
        }
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("scaleSystemVm",
            array_merge(array(
                'serviceofferingid' => $serviceofferingid,
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists all egress firewall rules for network id.
     *
     * @param array  $optArgs {
     *     @type string $ipaddressid the id of IP address of the firwall services
     *     @type string $id Lists rule with the specified ID.
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $page the page number of the result set
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $networkid list firewall rules for ceratin network
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $keyword List by keyword
     *     @type string $networkid the id network network for the egress firwall services
     *     @type string $projectid list objects by project
     *     @type string $pagesize the number of entries per page
     *     @type string $id Lists rule with the specified ID.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     * }
     */
    public function listEgressFirewallRules(array $optArgs = array()) {
        return $this->request("listEgressFirewallRules",
            $optArgs
        );
    }

    /**
     * Lists hosts.
     *
     * @param array  $optArgs {
     *     @type string $hypervisor hypervisor type of host: XenServer,KVM,VMware,Hyperv,BareMetal,Simulator
     *     @type string $type the host type
     *     @type string $hahost if true, list only hosts dedicated to HA
     *     @type string $virtualmachineid lists hosts in the same cluster as this VM and flag hosts with enough CPU/RAm to
     *     host this VM
     *     @type string $clusterid lists hosts existing in particular cluster
     *     @type string $state the state of the host
     *     @type string $name the name of the host
     *     @type string $details comma separated list of host details requested, value can be a list of [ min,
     *     all, capacity, events, stats]
     *     @type string $pagesize the number of entries per page
     *     @type string $podid the Pod ID for the host
     *     @type string $id the id of the host
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $resourcestate list hosts by resource state. Resource state represents current state determined
     *     by admin of host, valule can be one of [Enabled, Disabled, Unmanaged,
     *     PrepareForMaintenance, ErrorInMaintenance, Maintenance, Error]
     *     @type string $zoneid the Zone ID for the host
     * }
     */
    public function listHosts(array $optArgs = array()) {
        return $this->request("listHosts",
            $optArgs
        );
    }

    /**
     * Updates an existing autoscale vm group.
     *
     * @param string $id the ID of the autoscale group
     * @param array  $optArgs {
     *     @type string $minmembers the minimum number of members in the vmgroup, the number of instances in the vm
     *     group will be equal to or more than this number.
     *     @type string $maxmembers the maximum number of members in the vmgroup, The number of instances in the vm
     *     group will be equal to or less than this number.
     *     @type string $scaleuppolicyids list of scaleup autoscale policies
     *     @type string $scaledownpolicyids list of scaledown autoscale policies
     *     @type string $interval the frequency at which the conditions have to be evaluated
     * }
     */
    public function updateAutoScaleVmGroup($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateAutoScaleVmGroup",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Updates a template visibility permissions. A public template is visible to all
     * accounts within the same domain. A private template is visible only to the owner
     * of the template. A priviledged template is a private template with account
     * permissions added. Only accounts specified under the template permissions are
     * visible to them.
     *
     * @param string $id the template ID
     * @param array  $optArgs {
     *     @type string $isextractable true if the template/iso is extractable, false other wise. Can be set only by
     *     root admin
     *     @type string $projectids a comma delimited list of projects. If specified, "op" parameter has to be
     *     passed in.
     *     @type string $op permission operator (add, remove, reset)
     *     @type string $ispublic true for public template/iso, false for private templates/isos
     *     @type string $accounts a comma delimited list of accounts. If specified, "op" parameter has to be
     *     passed in.
     *     @type string $isfeatured true for featured template/iso, false otherwise
     * }
     */
    public function updateTemplatePermissions($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateTemplatePermissions",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists all VLAN IP ranges.
     *
     * @param array  $optArgs {
     *     @type string $podid the Pod ID of the VLAN IP range
     *     @type string $account the account with which the VLAN IP range is associated. Must be used with the
     *     domainId parameter.
     *     @type string $id the ID of the VLAN IP range
     *     @type string $domainid the domain ID with which the VLAN IP range is associated.  If used with the
     *     account parameter, returns all VLAN IP ranges for that account in the specified
     *     domain.
     *     @type string $zoneid the Zone ID of the VLAN IP range
     *     @type string $page the page number of the result set
     *     @type string $projectid project who will own the VLAN
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $vlan the ID or VID of the VLAN. Default is an "untagged" VLAN.
     *     @type string $networkid network id of the VLAN IP range
     *     @type string $forvirtualnetwork true if VLAN is of Virtual type, false if Direct
     *     @type string $physicalnetworkid physical network id of the VLAN IP range
     * }
     */
    public function listVlanIpRanges(array $optArgs = array()) {
        return $this->request("listVlanIpRanges",
            $optArgs
        );
    }

    /**
     * refresh ucs blades to sync with UCS manager
     *
     * @param string $ucsmanagerid ucs manager id
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     * }
     */
    public function refreshUcsBlades($ucsmanagerid, array $optArgs = array()) {
        if (empty($ucsmanagerid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsmanagerid"), MISSING_ARGUMENT);
        }
        return $this->request("refreshUcsBlades",
            array_merge(array(
                'ucsmanagerid' => $ucsmanagerid
            ), $optArgs)
        );
    }

    /**
     * Lists physical networks
     *
     * @param array  $optArgs {
     *     @type string $id list physical network by id
     *     @type string $pagesize the number of entries per page
     *     @type string $zoneid the Zone ID for the physical network
     *     @type string $name search by name
     *     @type string $page the page number of the result set
     *     @type string $keyword List by keyword
     * }
     */
    public function listPhysicalNetworks(array $optArgs = array()) {
        return $this->request("listPhysicalNetworks",
            $optArgs
        );
    }

    /**
     * List a storage network IP range.
     *
     * @param array  $optArgs {
     *     @type string $podid optional parameter. Pod uuid, if specicied and range uuid is absent, using it to
     *     search the range.
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $zoneid optional parameter. Zone uuid, if specicied and both pod uuid and range uuid are
     *     absent, using it to search the range.
     *     @type string $id optional parameter. Storaget network IP range uuid, if specicied, using it to
     *     search the range.
     *     @type string $keyword List by keyword
     * }
     */
    public function listStorageNetworkIpRange(array $optArgs = array()) {
        return $this->request("listStorageNetworkIpRange",
            $optArgs
        );
    }

    /**
     * Lists site to site vpn connection gateways
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $id id of the vpn connection
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $projectid list objects by project
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $vpcid id of vpc
     * }
     */
    public function listVpnConnections(array $optArgs = array()) {
        return $this->request("listVpnConnections",
            $optArgs
        );
    }

    /**
     * Deletes a host.
     *
     * @param string $id the host ID
     * @param array  $optArgs {
     *     @type string $forcedestroylocalstorage Force destroy local storage on this host. All VMs created on this local storage
     *     will be destroyed
     *     @type string $forced Force delete the host. All HA enabled vms running on the host will be put to HA;
     *     HA disabled ones will be stopped
     * }
     */
    public function deleteHost($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteHost",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists VPC offerings
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $id list VPC offerings by id
     *     @type string $isdefault true if need to list only default VPC offerings. Default value is false
     *     @type string $page the page number of the result set
     *     @type string $displaytext list VPC offerings by display text
     *     @type string $state list VPC offerings by state
     *     @type string $name list VPC offerings by name
     *     @type string $keyword List by keyword
     *     @type string $supportedservices list VPC offerings supporting certain services
     * }
     */
    public function listVPCOfferings(array $optArgs = array()) {
        return $this->request("listVPCOfferings",
            $optArgs
        );
    }

    /**
     * Updates a network offering.
     *
     * @param array  $optArgs {
     *     @type string $displaytext the display text of the network offering
     *     @type string $keepaliveenabled if true keepalive will be turned on in the loadbalancer. At the time of writing
     *     this has only an effect on haproxy; the mode http and httpclose options are
     *     unset in the haproxy conf file.
     *     @type string $maxconnections maximum number of concurrent connections supported by the network offering
     *     @type string $state update state for the network offering
     *     @type string $availability the availability of network offering. Default value is Required for Guest
     *     Virtual network offering; Optional for Guest Direct network offering
     *     @type string $sortkey sort key of the network offering, integer
     *     @type string $id the id of the network offering
     *     @type string $name the name of the network offering
     * }
     */
    public function updateNetworkOffering(array $optArgs = array()) {
        return $this->request("updateNetworkOffering",
            $optArgs
        );
    }

    /**
     * Deletes a Physical Network.
     *
     * @param string $id the ID of the Physical network
     */
    public function deletePhysicalNetwork($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deletePhysicalNetwork",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Deletes a vm group
     *
     * @param string $id the ID of the instance group
     */
    public function deleteInstanceGroup($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteInstanceGroup",
            array(
                'id' => $id
            )
        );
    }

    /**
     * adds a baremetal dhcp server
     *
     * @param string $password Credentials to reach external dhcp device
     * @param string $physicalnetworkid the Physical Network ID
     * @param string $username Credentials to reach external dhcp device
     * @param string $url URL of the external dhcp appliance.
     * @param string $dhcpservertype Type of dhcp device
     */
    public function addBaremetalDhcp($password, $physicalnetworkid, $username, $url, $dhcpservertype) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($physicalnetworkid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalnetworkid"), MISSING_ARGUMENT);
        }
        if (empty($username)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "username"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($dhcpservertype)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "dhcpservertype"), MISSING_ARGUMENT);
        }
        return $this->request("addBaremetalDhcp",
            array(
                'password' => $password,
                'physicalnetworkid' => $physicalnetworkid,
                'username' => $username,
                'url' => $url,
                'dhcpservertype' => $dhcpservertype
            )
        );
    }

    /**
     * Deletes VPC offering
     *
     * @param string $id the ID of the VPC offering
     */
    public function deleteVPCOffering($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteVPCOffering",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Lists vpn users
     *
     * @param array  $optArgs {
     *     @type string $id The uuid of the Vpn user
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $pagesize the number of entries per page
     *     @type string $page the page number of the result set
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $username the username of the vpn user.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     * }
     */
    public function listVpnUsers(array $optArgs = array()) {
        return $this->request("listVpnUsers",
            $optArgs
        );
    }

    /**
     * Updates a Pod.
     *
     * @param string $id the ID of the Pod
     * @param array  $optArgs {
     *     @type string $netmask the netmask of the Pod
     *     @type string $endip the ending IP address for the Pod
     *     @type string $name the name of the Pod
     *     @type string $allocationstate Allocation state of this cluster for allocation of new resources
     *     @type string $gateway the gateway for the Pod
     *     @type string $startip the starting IP address for the Pod
     * }
     */
    public function updatePod($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updatePod",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Retrieves VMware DC(s) associated with a zone.
     *
     * @param string $zoneid Id of the CloudStack zone.
     * @param array  $optArgs {
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     *     @type string $keyword List by keyword
     * }
     */
    public function listVmwareDcs($zoneid, array $optArgs = array()) {
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        return $this->request("listVmwareDcs",
            array_merge(array(
                'zoneid' => $zoneid
            ), $optArgs)
        );
    }

    /**
     * Deletes a cluster.
     *
     * @param string $id the cluster ID
     */
    public function deleteCluster($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("deleteCluster",
            array(
                'id' => $id
            )
        );
    }

    /**
     * Updates a network serviceProvider of a physical network
     *
     * @param string $id network service provider id
     * @param array  $optArgs {
     *     @type string $state Enabled/Disabled/Shutdown the physical network service provider
     *     @type string $servicelist the list of services to be enabled for this physical network service provider
     * }
     */
    public function updateNetworkServiceProvider($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("updateNetworkServiceProvider",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists storage pools available for migration of a volume.
     *
     * @param string $id the ID of the volume
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $pagesize the number of entries per page
     * }
     */
    public function findStoragePoolsForMigration($id, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("findStoragePoolsForMigration",
            array_merge(array(
                'id' => $id
            ), $optArgs)
        );
    }

    /**
     * Lists user accounts
     *
     * @param array  $optArgs {
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $username List user by the username
     *     @type string $keyword List by keyword
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $pagesize the number of entries per page
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $accounttype List users by account type. Valid types include admin, domain-admin,
     *     read-only-admin, or user.
     *     @type string $id List user by ID.
     *     @type string $state List users by state of the user account.
     *     @type string $page the page number of the result set
     * }
     */
    public function listUsers(array $optArgs = array()) {
        return $this->request("listUsers",
            $optArgs
        );
    }

    /**
     * Upgrades router to use newer template
     *
     * @param array  $optArgs {
     *     @type string $podid upgrades all routers within the specified pod
     *     @type string $clusterid upgrades all routers within the specified cluster
     *     @type string $id upgrades router with the specified Id
     *     @type string $domainid upgrades all routers owned by the specified domain
     *     @type string $account upgrades all routers owned by the specified account
     *     @type string $zoneid upgrades all routers within the specified zone
     * }
     */
    public function upgradeRouterTemplate(array $optArgs = array()) {
        return $this->request("upgradeRouterTemplate",
            $optArgs
        );
    }

    /**
     * Lists all network services provided by CloudStack or for the given Provider.
     *
     * @param array  $optArgs {
     *     @type string $pagesize the number of entries per page
     *     @type string $service network service name to list providers and capabilities of
     *     @type string $keyword List by keyword
     *     @type string $page the page number of the result set
     *     @type string $provider network service provider name
     * }
     */
    public function listSupportedNetworkServices(array $optArgs = array()) {
        return $this->request("listSupportedNetworkServices",
            $optArgs
        );
    }

    /**
     * Adds stratosphere ssp server
     *
     * @param string $url stratosphere ssp server url
     * @param string $zoneid the zone ID
     * @param string $name stratosphere ssp api name
     * @param array  $optArgs {
     *     @type string $password stratosphere ssp api password
     *     @type string $username stratosphere ssp api username
     *     @type string $tenantuuid stratosphere ssp tenant uuid
     * }
     */
    public function addStratosphereSsp($url, $zoneid, $name, array $optArgs = array()) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($zoneid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneid"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("addStratosphereSsp",
            array_merge(array(
                'url' => $url,
                'zoneid' => $zoneid,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Lists all available ISO files.
     *
     * @param array  $optArgs {
     *     @type string $listall If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $isready true if this ISO is ready to be deployed
     *     @type string $isrecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $isofilter possible values are "featured", "self",
     *     "selfexecutable","sharedexecutable","executable", and "community". * featured :
     *     templates that have been marked as featured and public. * self : templates that
     *     have been registered or created by the calling user. * selfexecutable : same as
     *     self, but only returns templates that can be used to deploy a new VM. *
     *     sharedexecutable : templates ready to be deployed that have been granted to the
     *     calling user by another user. * executable : templates that are owned by the
     *     calling user, or public templates, that can be used to deploy a VM. * community
     *     : templates that have been marked as public but not featured. * all : all
     *     templates (only usable by admins).
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainid list only resources belonging to the domain specified
     *     @type string $showremoved show removed ISOs as well
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $ispublic true if the ISO is publicly available to all users, false otherwise.
     *     @type string $bootable true if the ISO is bootable, false otherwise
     *     @type string $hypervisor the hypervisor for which to restrict the search
     *     @type string $zoneid the ID of the zone
     *     @type string $page the page number of the result set
     *     @type string $projectid list objects by project
     *     @type string $keyword List by keyword
     *     @type string $pagesize the number of entries per page
     *     @type string $name list all isos by name
     *     @type string $id list ISO by id
     * }
     */
    public function listIsos(array $optArgs = array()) {
        return $this->request("listIsos",
            $optArgs
        );
    }

    /**
     * revert a volume snapshot.
     *
     * @param string $id The ID of the snapshot
     */
    public function revertSnapshot($id) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        return $this->request("revertSnapshot",
            array(
                'id' => $id
            )
        );
    }

}
