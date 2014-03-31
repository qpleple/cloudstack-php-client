<?php
/**
 * This file is part of the CloudStack PHP Client.
 *
 * (c) Quentin Pleplé <quentin.pleple@gmail.com>
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
     * Creates a load balancer rule
     *
     * @param string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     * @param string $name name of the load balancer rule
     * @param string $privatePort the private port of the private ip address/virtual machine where the network
     * traffic will be load balanced to
     * @param string $publicPort the public port from where the network traffic will be load balanced from
     * @param array  $optArgs {
     *     @type string $account the account associated with the load balancer. Must be used with the domainId
     *     parameter.
     *     @type string $cidrList the cidr list to forward traffic from
     *     @type string $description the description of the load balancer rule
     *     @type string $domainId the domain ID associated with the load balancer
     *     @type string $networkId The guest network this rule will be created for. Required when public Ip address
     *     is not associated with any Guest network yet (VPC case)
     *     @type string $openFirewall if true, firewall rule for source/end pubic port is automatically created; if
     *     false - firewall rule has to be created explicitely. If not specified 1)
     *     defaulted to false when LB rule is being created for VPC guest network 2) in all
     *     other cases defaulted to true
     *     @type string $protocol The protocol for the LB
     *     @type string $publicIpId public ip address id from where the network traffic will be load balanced from
     *     @type string $zoneId zone where the load balancer is going to be created. This parameter is required
     *     when LB service provider is ElasticLoadBalancerVm
     * }
     */
    public function createLoadBalancerRule($algorithm, $name, $privatePort, $publicPort, array $optArgs = array()) {
        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "algorithm"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($privatePort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privatePort"), MISSING_ARGUMENT);
        }
        if (empty($publicPort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicPort"), MISSING_ARGUMENT);
        }
        return $this->request("createLoadBalancerRule",
            array_merge(array(
                'algorithm' => $algorithm,
                'name' => $name,
                'privateport' => $privatePort,
                'publicport' => $publicPort
            ), $optArgs)
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
     * Removes a virtual machine or a list of virtual machines from a load balancer
     * rule.
     *
     * @param string $id The ID of the load balancer rule
     * @param string $virtualMachineIds the list of IDs of the virtual machines that are being removed from the load
     * balancer rule (i.e. virtualMachineIds=1,2,3)
     */
    public function removeFromLoadBalancerRule($id, $virtualMachineIds) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineIds"), MISSING_ARGUMENT);
        }
        return $this->request("removeFromLoadBalancerRule",
            array(
                'id' => $id,
                'virtualmachineids' => $virtualMachineIds
            )
        );
    }

    /**
     * Assigns virtual machine or a list of virtual machines to a load balancer rule.
     *
     * @param string $id the ID of the load balancer rule
     * @param string $virtualMachineIds the list of IDs of the virtual machine that are being assigned to the load
     * balancer rule(i.e. virtualMachineIds=1,2,3)
     */
    public function assignToLoadBalancerRule($id, $virtualMachineIds) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineIds"), MISSING_ARGUMENT);
        }
        return $this->request("assignToLoadBalancerRule",
            array(
                'id' => $id,
                'virtualmachineids' => $virtualMachineIds
            )
        );
    }

    /**
     * Creates a Load Balancer stickiness policy
     *
     * @param string $lbruleId the ID of the load balancer rule
     * @param string $methodName name of the LB Stickiness policy method, possible values can be obtained from
     * ListNetworks API
     * @param string $name name of the LB Stickiness policy
     * @param array  $optArgs {
     *     @type string $description the description of the LB Stickiness policy
     *     @type string $param param list. Example: param[0].name=cookiename&param[0].value=LBCookie
     * }
     */
    public function createLBStickinessPolicy($lbruleId, $methodName, $name, array $optArgs = array()) {
        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }
        if (empty($methodName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "methodName"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createLBStickinessPolicy",
            array_merge(array(
                'lbruleid' => $lbruleId,
                'methodname' => $methodName,
                'name' => $name
            ), $optArgs)
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
     * Lists load balancer rules.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id the ID of the load balancer rule
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name the name of the load balancer rule
     *     @type string $networkId list by network id the rule belongs to
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $publicIpId the public IP address id of the load balancer rule
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $virtualMachineId the ID of the virtual machine of the load balancer rule
     *     @type string $zoneId the availability zone ID
     * }
     */
    public function listLoadBalancerRules(array $optArgs = array()) {
        return $this->request("listLoadBalancerRules",
            $optArgs
        );
    }

    /**
     * Lists LBStickiness policies.
     *
     * @param string $lbruleId the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listLBStickinessPolicies($lbruleId, array $optArgs = array()) {
        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }
        return $this->request("listLBStickinessPolicies",
            array_merge(array(
                'lbruleid' => $lbruleId
            ), $optArgs)
        );
    }

    /**
     * Lists load balancer HealthCheck policies.
     *
     * @param string $lbruleId the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listLBHealthCheckPolicies($lbruleId, array $optArgs = array()) {
        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }
        return $this->request("listLBHealthCheckPolicies",
            array_merge(array(
                'lbruleid' => $lbruleId
            ), $optArgs)
        );
    }

    /**
     * Creates a Load Balancer healthcheck policy
     *
     * @param string $lbruleId the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $description the description of the load balancer HealthCheck policy
     *     @type string $healthyThreshold Number of consecutive health check success before declaring an instance healthy
     *     @type string $intervalTime Amount of time between health checks (1 sec - 20940 sec)
     *     @type string $pingPath HTTP Ping Path
     *     @type string $responseTimeout Time to wait when receiving a response from the health check (2sec - 60 sec)
     *     @type string $unhealthyThreshold Number of consecutive health check failures before declaring an instance
     *     unhealthy
     * }
     */
    public function createLBHealthCheckPolicy($lbruleId, array $optArgs = array()) {
        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }
        return $this->request("createLBHealthCheckPolicy",
            array_merge(array(
                'lbruleid' => $lbruleId
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
     * List all virtual machine instances that are assigned to a load balancer rule.
     *
     * @param string $id the ID of the load balancer rule
     * @param array  $optArgs {
     *     @type string $applied true if listing all virtual machines currently applied to the load balancer
     *     rule; default is true
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
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
     * Updates load balancer
     *
     * @param string $id the id of the load balancer rule to update
     * @param array  $optArgs {
     *     @type string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     *     @type string $description the description of the load balancer rule
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
     * Upload a certificate to cloudstack
     *
     * @param string $certificate SSL certificate
     * @param string $privateKey Private key
     * @param array  $optArgs {
     *     @type string $certChain Certificate chain of trust
     *     @type string $password Password for the private key
     * }
     */
    public function uploadSslCert($certificate, $privateKey, array $optArgs = array()) {
        if (empty($certificate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "certificate"), MISSING_ARGUMENT);
        }
        if (empty($privateKey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privateKey"), MISSING_ARGUMENT);
        }
        return $this->request("uploadSslCert",
            array_merge(array(
                'certificate' => $certificate,
                'privatekey' => $privateKey
            ), $optArgs)
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
     * Lists SSL certificates
     *
     * @param array  $optArgs {
     *     @type string $accountId Account Id
     *     @type string $certId Id of SSL certificate
     *     @type string $lbruleId Loadbalancer Rule Id
     * }
     */
    public function listSslCerts(array $optArgs = array()) {
        return $this->request("listSslCerts",
            $optArgs
        );
    }

    /**
     * Assigns a certificate to a Load Balancer Rule
     *
     * @param string $certId the ID of the certificate
     * @param string $lbruleId the ID of the load balancer rule
     */
    public function assignCertToLoadBalancer($certId, $lbruleId) {
        if (empty($certId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "certId"), MISSING_ARGUMENT);
        }
        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }
        return $this->request("assignCertToLoadBalancer",
            array(
                'certid' => $certId,
                'lbruleid' => $lbruleId
            )
        );
    }

    /**
     * Removes a certificate from a Load Balancer Rule
     *
     * @param string $lbruleId the ID of the load balancer rule
     */
    public function removeCertFromLoadBalancer($lbruleId) {
        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }
        return $this->request("removeCertFromLoadBalancer",
            array(
                'lbruleid' => $lbruleId
            )
        );
    }

    /**
     * Adds a F5 BigIP load balancer device
     *
     * @param string $networkDeviceType supports only F5BigIpLoadBalancer
     * @param string $password Credentials to reach F5 BigIP load balancer device
     * @param string $physicalNetworkId the Physical Network ID
     * @param string $url URL of the F5 load balancer appliance.
     * @param string $userName Credentials to reach F5 BigIP load balancer device
     */
    public function addF5LoadBalancer($networkDeviceType, $password, $physicalNetworkId, $url, $userName) {
        if (empty($networkDeviceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkDeviceType"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("addF5LoadBalancer",
            array(
                'networkdevicetype' => $networkDeviceType,
                'password' => $password,
                'physicalnetworkid' => $physicalNetworkId,
                'url' => $url,
                'username' => $userName
            )
        );
    }

    /**
     * configures a F5 load balancer device
     *
     * @param string $lbDeviceId F5 load balancer device ID
     * @param array  $optArgs {
     *     @type string $lbDeviceCapacity capacity of the device, Capacity will be interpreted as number of networks
     *     device can handle
     * }
     */
    public function configureF5LoadBalancer($lbDeviceId, array $optArgs = array()) {
        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("configureF5LoadBalancer",
            array_merge(array(
                'lbdeviceid' => $lbDeviceId
            ), $optArgs)
        );
    }

    /**
     * delete a F5 load balancer device
     *
     * @param string $lbDeviceId netscaler load balancer device ID
     */
    public function deleteF5LoadBalancer($lbDeviceId) {
        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteF5LoadBalancer",
            array(
                'lbdeviceid' => $lbDeviceId
            )
        );
    }

    /**
     * lists F5 load balancer devices
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $lbDeviceId f5 load balancer device ID
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId the Physical Network ID
     * }
     */
    public function listF5LoadBalancers(array $optArgs = array()) {
        return $this->request("listF5LoadBalancers",
            $optArgs
        );
    }

    /**
     * Adds a netscaler load balancer device
     *
     * @param string $networkDeviceType Netscaler device type supports NetscalerMPXLoadBalancer,
     * NetscalerVPXLoadBalancer, NetscalerSDXLoadBalancer
     * @param string $password Credentials to reach netscaler load balancer device
     * @param string $physicalNetworkId the Physical Network ID
     * @param string $url URL of the netscaler load balancer appliance.
     * @param string $userName Credentials to reach netscaler load balancer device
     * @param array  $optArgs {
     *     @type string $gslbProvider true if NetScaler device being added is for providing GSLB service
     *     @type string $gslbProviderPrivateIp public IP of the site
     *     @type string $gslbProviderPublicIp public IP of the site
     *     @type string $isExclusiveGslbProvider true if NetScaler device being added is for providing GSLB service exclusively
     *     and can not be used for LB
     * }
     */
    public function addNetscalerLoadBalancer($networkDeviceType, $password, $physicalNetworkId, $url, $userName, array $optArgs = array()) {
        if (empty($networkDeviceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkDeviceType"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("addNetscalerLoadBalancer",
            array_merge(array(
                'networkdevicetype' => $networkDeviceType,
                'password' => $password,
                'physicalnetworkid' => $physicalNetworkId,
                'url' => $url,
                'username' => $userName
            ), $optArgs)
        );
    }

    /**
     * delete a netscaler load balancer device
     *
     * @param string $lbDeviceId netscaler load balancer device ID
     */
    public function deleteNetscalerLoadBalancer($lbDeviceId) {
        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteNetscalerLoadBalancer",
            array(
                'lbdeviceid' => $lbDeviceId
            )
        );
    }

    /**
     * configures a netscaler load balancer device
     *
     * @param string $lbDeviceId Netscaler load balancer device ID
     * @param array  $optArgs {
     *     @type string $inline true if netscaler load balancer is intended to be used in in-line with firewall,
     *     false if netscaler load balancer will side-by-side with firewall
     *     @type string $lbDeviceCapacity capacity of the device, Capacity will be interpreted as number of networks
     *     device can handle
     *     @type string $lbDeviceDedicated true if this netscaler device to dedicated for a account, false if the netscaler
     *     device will be shared by multiple accounts
     *     @type string $podIds Used when NetScaler device is provider of EIP service. This parameter represents
     *     the list of pod's, for which there exists a policy based route on datacenter L3
     *     router to route pod's subnet IP to a NetScaler device.
     * }
     */
    public function configureNetscalerLoadBalancer($lbDeviceId, array $optArgs = array()) {
        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("configureNetscalerLoadBalancer",
            array_merge(array(
                'lbdeviceid' => $lbDeviceId
            ), $optArgs)
        );
    }

    /**
     * lists netscaler load balancer devices
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $lbDeviceId netscaler load balancer device ID
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId the Physical Network ID
     * }
     */
    public function listNetscalerLoadBalancers(array $optArgs = array()) {
        return $this->request("listNetscalerLoadBalancers",
            $optArgs
        );
    }

    /**
     * Creates a global load balancer rule
     *
     * @param string $gslbDomainName domain name for the GSLB service.
     * @param string $gslbServiceType GSLB service type (tcp, udp, http)
     * @param string $name name of the load balancer rule
     * @param string $regionId region where the global load balancer is going to be created.
     * @param array  $optArgs {
     *     @type string $account the account associated with the global load balancer. Must be used with the
     *     domainId parameter.
     *     @type string $description the description of the load balancer rule
     *     @type string $domainId the domain ID associated with the load balancer
     *     @type string $gslblbMethod load balancer algorithm (roundrobin, leastconn, proximity) that method is used
     *     to distribute traffic across the zones participating in global server load
     *     balancing, if not specified defaults to 'round robin'
     *     @type string $gslbStickySessionMethodName session sticky method (sourceip) if not specified defaults to sourceip
     * }
     */
    public function createGlobalLoadBalancerRule($gslbDomainName, $gslbServiceType, $name, $regionId, array $optArgs = array()) {
        if (empty($gslbDomainName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gslbDomainName"), MISSING_ARGUMENT);
        }
        if (empty($gslbServiceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gslbServiceType"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($regionId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "regionId"), MISSING_ARGUMENT);
        }
        return $this->request("createGlobalLoadBalancerRule",
            array_merge(array(
                'gslbdomainname' => $gslbDomainName,
                'gslbservicetype' => $gslbServiceType,
                'name' => $name,
                'regionid' => $regionId
            ), $optArgs)
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
     * update global load balancer rules.
     *
     * @param string $id the ID of the global load balancer rule
     * @param array  $optArgs {
     *     @type string $description the description of the load balancer rule
     *     @type string $gslblbMethod load balancer algorithm (roundrobin, leastconn, proximity) that is used to
     *     distributed traffic across the zones participating in global server load
     *     balancing, if not specified defaults to 'round robin'
     *     @type string $gslbStickySessionMethodName session sticky method (sourceip) if not specified defaults to sourceip
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
     * Lists load balancer rules.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id the ID of the global load balancer rule
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $regionId region ID
     *     @type string $tags List resources by tags (key/value pairs)
     * }
     */
    public function listGlobalLoadBalancerRules(array $optArgs = array()) {
        return $this->request("listGlobalLoadBalancerRules",
            $optArgs
        );
    }

    /**
     * Assign load balancer rule or list of load balancer rules to a global load
     * balancer rules.
     *
     * @param string $id the ID of the global load balancer rule
     * @param string $loadBalancerRuleList the list load balancer rules that will be assigned to gloabal load balacner
     * rule
     * @param array  $optArgs {
     *     @type string $gslbLbRuleWeightsMap Map of LB rule id's and corresponding weights (between 1-100) in the GSLB rule,
     *     if not specified weight of a LB rule is defaulted to 1. Specified as
     *     'gslblbruleweightsmap[0].loadbalancerid=UUID&gslblbruleweightsmap[0].weight=10'
     * }
     */
    public function assignToGlobalLoadBalancerRule($id, $loadBalancerRuleList, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($loadBalancerRuleList)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "loadBalancerRuleList"), MISSING_ARGUMENT);
        }
        return $this->request("assignToGlobalLoadBalancerRule",
            array_merge(array(
                'id' => $id,
                'loadbalancerrulelist' => $loadBalancerRuleList
            ), $optArgs)
        );
    }

    /**
     * Removes a load balancer rule association with global load balancer rule
     *
     * @param string $id The ID of the load balancer rule
     * @param string $loadBalancerRuleList the list load balancer rules that will be assigned to gloabal load balacner
     * rule
     */
    public function removeFromGlobalLoadBalancerRule($id, $loadBalancerRuleList) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($loadBalancerRuleList)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "loadBalancerRuleList"), MISSING_ARGUMENT);
        }
        return $this->request("removeFromGlobalLoadBalancerRule",
            array(
                'id' => $id,
                'loadbalancerrulelist' => $loadBalancerRuleList
            )
        );
    }

    /**
     * Creates a Load Balancer
     *
     * @param string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     * @param string $instancePort the TCP port of the virtual machine where the network traffic will be load
     * balanced to
     * @param string $name name of the Load Balancer
     * @param string $networkId The guest network the Load Balancer will be created for
     * @param string $scheme the load balancer scheme. Supported value in this release is Internal
     * @param string $sourceIpAddressNetworkId the network id of the source ip address
     * @param string $sourcePort the source port the network traffic will be load balanced from
     * @param array  $optArgs {
     *     @type string $description the description of the Load Balancer
     *     @type string $sourceIpAddress the source ip address the network traffic will be load balanced from
     * }
     */
    public function createLoadBalancer($algorithm, $instancePort, $name, $networkId, $scheme, $sourceIpAddressNetworkId, $sourcePort, array $optArgs = array()) {
        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "algorithm"), MISSING_ARGUMENT);
        }
        if (empty($instancePort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "instancePort"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($networkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkId"), MISSING_ARGUMENT);
        }
        if (empty($scheme)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "scheme"), MISSING_ARGUMENT);
        }
        if (empty($sourceIpAddressNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "sourceIpAddressNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($sourcePort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "sourcePort"), MISSING_ARGUMENT);
        }
        return $this->request("createLoadBalancer",
            array_merge(array(
                'algorithm' => $algorithm,
                'instanceport' => $instancePort,
                'name' => $name,
                'networkid' => $networkId,
                'scheme' => $scheme,
                'sourceipaddressnetworkid' => $sourceIpAddressNetworkId,
                'sourceport' => $sourcePort
            ), $optArgs)
        );
    }

    /**
     * Lists Load Balancers
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id the ID of the Load Balancer
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name the name of the Load Balancer
     *     @type string $networkId the network id of the Load Balancer
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $scheme the scheme of the Load Balancer. Supported value is Internal in the current
     *     release
     *     @type string $sourceIpAddress the source ip address of the Load Balancer
     *     @type string $sourceIpAddressNetworkId the network id of the source ip address
     *     @type string $tags List resources by tags (key/value pairs)
     * }
     */
    public function listLoadBalancers(array $optArgs = array()) {
        return $this->request("listLoadBalancers",
            $optArgs
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
     * Dedicates a Public IP range to an account
     *
     * @param string $id the id of the VLAN IP range
     * @param string $account account who will own the VLAN
     * @param string $domainId domain ID of the account owning a VLAN
     * @param array  $optArgs {
     *     @type string $projectId project who will own the VLAN
     * }
     */
    public function dedicatePublicIpRange($id, $account, $domainId, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }
        return $this->request("dedicatePublicIpRange",
            array_merge(array(
                'id' => $id,
                'account' => $account,
                'domainid' => $domainId
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
     * Creates a network
     *
     * @param string $displayText the display text of the network
     * @param string $name the name of the network
     * @param string $networkOfferingId the network offering id
     * @param string $zoneId the Zone ID for the network
     * @param array  $optArgs {
     *     @type string $account account who will own the network
     *     @type string $aclId Network ACL Id associated for the network
     *     @type string $aclType Access control type; supported values are account and domain. In 3.0 all shared
     *     networks should have aclType=Domain, and all Isolated networks - Account.
     *     Account means that only the account owner can use the network, domain - all
     *     accouns in the domain can use the network
     *     @type string $displayNetwork an optional field, whether to the display the network to the end user or not.
     *     @type string $domainId domain ID of the account owning a network
     *     @type string $endIp the ending IP address in the network IP range. If not specified, will be
     *     defaulted to startIP
     *     @type string $endIpv6 the ending IPv6 address in the IPv6 network range
     *     @type string $gateway the gateway of the network. Required for Shared networks and Isolated networks
     *     when it belongs to VPC
     *     @type string $ip6Cidr the CIDR of IPv6 network, must be at least /64
     *     @type string $ip6Gateway the gateway of the IPv6 network. Required for Shared networks and Isolated
     *     networks when it belongs to VPC
     *     @type string $isolatedPvlan the isolated private vlan for this network
     *     @type string $netmask the netmask of the network. Required for Shared networks and Isolated networks
     *     when it belongs to VPC
     *     @type string $networkDomain network domain
     *     @type string $physicalNetworkId the Physical Network ID the network belongs to
     *     @type string $projectId an optional project for the ssh key
     *     @type string $startIp the beginning IP address in the network IP range
     *     @type string $startIpv6 the beginning IPv6 address in the IPv6 network range
     *     @type string $subDomainAccess Defines whether to allow subdomains to use networks dedicated to their parent
     *     domain(s). Should be used with aclType=Domain, defaulted to
     *     allow.subdomain.network.access global config if not specified
     *     @type string $vlan the ID or VID of the network
     *     @type string $vpcId the VPC network belongs to
     * }
     */
    public function createNetwork($displayText, $name, $networkOfferingId, $zoneId, array $optArgs = array()) {
        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($networkOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkOfferingId"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("createNetwork",
            array_merge(array(
                'displaytext' => $displayText,
                'name' => $name,
                'networkofferingid' => $networkOfferingId,
                'zoneid' => $zoneId
            ), $optArgs)
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
     * Lists all available networks.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $aclType list networks by ACL (access control list) type. Supported values are Account
     *     and Domain
     *     @type string $canUseForDeploy list networks available for vm deployment
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $forVpc the network belongs to vpc
     *     @type string $id list networks by id
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $isSystem true if network is system, false otherwise
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId list networks by physical network id
     *     @type string $projectId list objects by project
     *     @type string $restartRequired list networks by restartRequired
     *     @type string $specifyIpRanges true if need to list only networks which support specifying ip ranges
     *     @type string $supportedServices list networks supporting certain services
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $trafficType type of the traffic
     *     @type string $type the type of the network. Supported values are: Isolated and Shared
     *     @type string $vpcId List networks by VPC
     *     @type string $zoneId the Zone ID of the network
     * }
     */
    public function listNetworks(array $optArgs = array()) {
        return $this->request("listNetworks",
            $optArgs
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
     * Updates a network
     *
     * @param string $id the ID of the network
     * @param array  $optArgs {
     *     @type string $changeCidr Force update even if cidr type is different
     *     @type string $displayNetwork an optional field, whether to the display the network to the end user or not.
     *     @type string $displayText the new display text for the network
     *     @type string $guestVmCidr CIDR for Guest VMs,Cloudstack allocates IPs to Guest VMs only from this CIDR
     *     @type string $name the new name for the network
     *     @type string $networkDomain network domain
     *     @type string $networkOfferingId network offering ID
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
     * Creates a physical network
     *
     * @param string $name the name of the physical network
     * @param string $zoneId the Zone ID for the physical network
     * @param array  $optArgs {
     *     @type string $broadcastDomainRange the broadcast domain range for the physical network[Pod or Zone]. In Acton
     *     release it can be Zone only in Advance zone, and Pod in Basic
     *     @type string $domainId domain ID of the account owning a physical network
     *     @type string $isolationMethods the isolation method for the physical network[VLAN/L3/GRE]
     *     @type string $networkSpeed the speed for the physical network[1G/10G]
     *     @type string $tags Tag the physical network
     *     @type string $vlan the VLAN for the physical network
     * }
     */
    public function createPhysicalNetwork($name, $zoneId, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("createPhysicalNetwork",
            array_merge(array(
                'name' => $name,
                'zoneid' => $zoneId
            ), $optArgs)
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
     * Lists physical networks
     *
     * @param array  $optArgs {
     *     @type string $id list physical network by id
     *     @type string $keyword List by keyword
     *     @type string $name search by name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $zoneId the Zone ID for the physical network
     * }
     */
    public function listPhysicalNetworks(array $optArgs = array()) {
        return $this->request("listPhysicalNetworks",
            $optArgs
        );
    }

    /**
     * Updates a physical network
     *
     * @param string $id physical network id
     * @param array  $optArgs {
     *     @type string $networkSpeed the speed for the physical network[1G/10G]
     *     @type string $state Enabled/Disabled
     *     @type string $tags Tag the physical network
     *     @type string $vlan the VLAN for the physical network
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
     * Lists all network services provided by CloudStack or for the given Provider.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $provider network service provider name
     *     @type string $service network service name to list providers and capabilities of
     * }
     */
    public function listSupportedNetworkServices(array $optArgs = array()) {
        return $this->request("listSupportedNetworkServices",
            $optArgs
        );
    }

    /**
     * Adds a network serviceProvider to a physical network
     *
     * @param string $name the name for the physical network service provider
     * @param string $physicalNetworkId the Physical Network ID to add the provider to
     * @param array  $optArgs {
     *     @type string $destinationPhysicalNetworkId the destination Physical Network ID to bridge to
     *     @type string $serviceList the list of services to be enabled for this physical network service provider
     * }
     */
    public function addNetworkServiceProvider($name, $physicalNetworkId, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        return $this->request("addNetworkServiceProvider",
            array_merge(array(
                'name' => $name,
                'physicalnetworkid' => $physicalNetworkId
            ), $optArgs)
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
     * Lists network serviceproviders for a given physical network.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $name list providers by name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId the Physical Network ID
     *     @type string $state list providers by state
     * }
     */
    public function listNetworkServiceProviders(array $optArgs = array()) {
        return $this->request("listNetworkServiceProviders",
            $optArgs
        );
    }

    /**
     * Updates a network serviceProvider of a physical network
     *
     * @param string $id network service provider id
     * @param array  $optArgs {
     *     @type string $serviceList the list of services to be enabled for this physical network service provider
     *     @type string $state Enabled/Disabled/Shutdown the physical network service provider
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
     * Creates a Storage network IP range.
     *
     * @param string $gateway the gateway for storage network
     * @param string $netmask the netmask for storage network
     * @param string $podId UUID of pod where the ip range belongs to
     * @param string $startIp the beginning IP address
     * @param array  $optArgs {
     *     @type string $endIp the ending IP address
     *     @type string $vlan Optional. The vlan the ip range sits on, default to Null when it is not
     *     specificed which means you network is not on any Vlan. This is mainly for Vmware
     *     as other hypervisors can directly reterive bridge from pyhsical network traffic
     *     type table
     * }
     */
    public function createStorageNetworkIpRange($gateway, $netmask, $podId, $startIp, array $optArgs = array()) {
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }
        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }
        if (empty($startIp)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startIp"), MISSING_ARGUMENT);
        }
        return $this->request("createStorageNetworkIpRange",
            array_merge(array(
                'gateway' => $gateway,
                'netmask' => $netmask,
                'podid' => $podId,
                'startip' => $startIp
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
     * List a storage network IP range.
     *
     * @param array  $optArgs {
     *     @type string $id optional parameter. Storaget network IP range uuid, if specicied, using it to
     *     search the range.
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $podId optional parameter. Pod uuid, if specicied and range uuid is absent, using it to
     *     search the range.
     *     @type string $zoneId optional parameter. Zone uuid, if specicied and both pod uuid and range uuid are
     *     absent, using it to search the range.
     * }
     */
    public function listStorageNetworkIpRange(array $optArgs = array()) {
        return $this->request("listStorageNetworkIpRange",
            $optArgs
        );
    }

    /**
     * Update a Storage network IP range, only allowed when no IPs in this range have
     * been allocated.
     *
     * @param string $id UUID of storage network ip range
     * @param array  $optArgs {
     *     @type string $endIp the ending IP address
     *     @type string $netmask the netmask for storage network
     *     @type string $startIp the beginning IP address
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
     * lists network that are using a F5 load balancer device
     *
     * @param string $lbDeviceId f5 load balancer device ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listF5LoadBalancerNetworks($lbDeviceId, array $optArgs = array()) {
        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("listF5LoadBalancerNetworks",
            array_merge(array(
                'lbdeviceid' => $lbDeviceId
            ), $optArgs)
        );
    }

    /**
     * lists network that are using SRX firewall device
     *
     * @param string $lbDeviceId netscaler load balancer device ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listSrxFirewallNetworks($lbDeviceId, array $optArgs = array()) {
        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("listSrxFirewallNetworks",
            array_merge(array(
                'lbdeviceid' => $lbDeviceId
            ), $optArgs)
        );
    }

    /**
     * lists network that are using Palo Alto firewall device
     *
     * @param string $lbDeviceId palo alto balancer device ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listPaloAltoFirewallNetworks($lbDeviceId, array $optArgs = array()) {
        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("listPaloAltoFirewallNetworks",
            array_merge(array(
                'lbdeviceid' => $lbDeviceId
            ), $optArgs)
        );
    }

    /**
     * lists network that are using a netscaler load balancer device
     *
     * @param string $lbDeviceId netscaler load balancer device ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listNetscalerLoadBalancerNetworks($lbDeviceId, array $optArgs = array()) {
        if (empty($lbDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("listNetscalerLoadBalancerNetworks",
            array_merge(array(
                'lbdeviceid' => $lbDeviceId
            ), $optArgs)
        );
    }

    /**
     * lists network that are using a nicira nvp device
     *
     * @param string $nvpDeviceId nicira nvp device ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listNiciraNvpDeviceNetworks($nvpDeviceId, array $optArgs = array()) {
        if (empty($nvpDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nvpDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("listNiciraNvpDeviceNetworks",
            array_merge(array(
                'nvpdeviceid' => $nvpDeviceId
            ), $optArgs)
        );
    }

    /**
     * Lists supported methods of network isolation
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listNetworkIsolationMethods(array $optArgs = array()) {
        return $this->request("listNetworkIsolationMethods",
            $optArgs
        );
    }

    /**
     * Creates and automatically starts a virtual machine based on a service offering,
     * disk offering, and template.
     *
     * @param string $serviceOfferingId the ID of the service offering for the virtual machine
     * @param string $templateId the ID of the template for the virtual machine
     * @param string $zoneId availability zone for the virtual machine
     * @param array  $optArgs {
     *     @type string $account an optional account for the virtual machine. Must be used with domainId.
     *     @type string $affinityGroupIds comma separated list of affinity groups id that are going to be applied to the
     *     virtual machine. Mutually exclusive with affinitygroupnames parameter
     *     @type string $affinityGroupNames comma separated list of affinity groups names that are going to be applied to
     *     the virtual machine.Mutually exclusive with affinitygroupids parameter
     *     @type string $details used to specify the custom parameters.
     *     @type string $diskOfferingId the ID of the disk offering for the virtual machine. If the template is of ISO
     *     format, the diskOfferingId is for the root disk volume. Otherwise this parameter
     *     is used to indicate the offering for the data disk volume. If the templateId
     *     parameter passed is from a Template object, the diskOfferingId refers to a DATA
     *     Disk Volume created. If the templateId parameter passed is from an ISO object,
     *     the diskOfferingId refers to a ROOT Disk Volume created.
     *     @type string $displayName an optional user generated name for the virtual machine
     *     @type string $displayVm an optional field, whether to the display the vm to the end user or not.
     *     @type string $domainId an optional domainId for the virtual machine. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $group an optional group for the virtual machine
     *     @type string $hostId destination Host ID to deploy the VM to - parameter available for root admin
     *     only
     *     @type string $hypervisor the hypervisor on which to deploy the virtual machine
     *     @type string $ip6Address the ipv6 address for default vm's network
     *     @type string $ipAddress the ip address for default vm's network
     *     @type string $ipToNetWorkList ip to network mapping. Can't be specified with networkIds parameter. Example:
     *     iptonetworklist[0].ip=10.10.10.11&iptonetworklist[0].ipv6=fc00:1234:5678::abcd&iptonetworklist[0].networkid=uuid
     *     - requests to use ip 10.10.10.11 in network id=uuid
     *     @type string $keyboard an optional keyboard device type for the virtual machine. valid value can be one
     *     of de,de-ch,es,fi,fr,fr-be,fr-ch,is,it,jp,nl-be,no,pt,uk,us
     *     @type string $keyPair name of the ssh key pair used to login to the virtual machine
     *     @type string $name host name for the virtual machine
     *     @type string $networkIds list of network ids used by virtual machine. Can't be specified with
     *     ipToNetworkList parameter
     *     @type string $projectId Deploy vm for the project
     *     @type string $securityGroupIds comma separated list of security groups id that going to be applied to the
     *     virtual machine. Should be passed only when vm is created from a zone with Basic
     *     Network support. Mutually exclusive with securitygroupnames parameter
     *     @type string $securityGroupNames comma separated list of security groups names that going to be applied to the
     *     virtual machine. Should be passed only when vm is created from a zone with Basic
     *     Network support. Mutually exclusive with securitygroupids parameter
     *     @type string $size the arbitrary size for the DATADISK volume. Mutually exclusive with
     *     diskOfferingId
     *     @type string $startVm true if network offering supports specifying ip ranges; defaulted to true if not
     *     specified
     *     @type string $userData an optional binary data that can be sent to the virtual machine upon a
     *     successful deployment. This binary data must be base64 encoded before adding it
     *     to the request. Using HTTP GET (via querystring), you can send up to 2KB of data
     *     after base64 encoding. Using HTTP POST(via POST body), you can send up to 32K of
     *     data after base64 encoding.
     * }
     */
    public function deployVirtualMachine($serviceOfferingId, $templateId, $zoneId, array $optArgs = array()) {
        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }
        if (empty($templateId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateId"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("deployVirtualMachine",
            array_merge(array(
                'serviceofferingid' => $serviceOfferingId,
                'templateid' => $templateId,
                'zoneid' => $zoneId
            ), $optArgs)
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
     * Starts a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $hostId destination Host ID to deploy the VM to - parameter available for root admin
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
     * Updates properties of a virtual machine. The VM has to be stopped and restarted
     * for the new properties to take effect. UpdateVirtualMachine does not first check
     * whether the VM is stopped. Therefore, stop the VM manually before issuing this
     * call.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $displayName user generated name
     *     @type string $displayVm an optional field, whether to the display the vm to the end user or not.
     *     @type string $group group of the virtual machine
     *     @type string $haEnable true if high-availability is enabled for the virtual machine, false otherwise
     *     @type string $isDynamicallyScalable true if VM contains XS/VMWare tools inorder to support dynamic scaling of VM
     *     cpu/memory
     *     @type string $osTypeId the ID of the OS type that best represents this VM.
     *     @type string $userData an optional binary data that can be sent to the virtual machine upon a
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
     * List the virtual machines owned by the account.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $affinityGroupId list vms by affinity group
     *     @type string $details comma separated list of host details requested, value can be a list of [all,
     *     group, nics, stats, secgrp, tmpl, servoff, iso, volume, min, affgrp]. If no
     *     parameter is passed in, the details will be defaulted to all
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $forVirtualNetwork list by network type; true if need to list vms using Virtual Network, false
     *     otherwise
     *     @type string $groupId the group ID
     *     @type string $hostId the host ID
     *     @type string $hypervisor the target hypervisor for the template
     *     @type string $id the ID of the virtual machine
     *     @type string $isoId list vms by iso
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name name of the virtual machine
     *     @type string $networkId list by network id
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $podId the pod ID
     *     @type string $projectId list objects by project
     *     @type string $state state of the virtual machine
     *     @type string $storageId the storage ID where vm's volumes belong to
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $templateId list vms by template
     *     @type string $vpcId list vms by vpc
     *     @type string $zoneId the availability zone ID
     * }
     */
    public function listVirtualMachines(array $optArgs = array()) {
        return $this->request("listVirtualMachines",
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
     * Restore a VM to original template/ISO or new template/ISO
     *
     * @param string $virtualMachineId Virtual Machine ID
     * @param array  $optArgs {
     *     @type string $templateId an optional template Id to restore vm from the new template. This can be an ISO
     *     id in case of restore vm deployed using ISO
     * }
     */
    public function restoreVirtualMachine($virtualMachineId, array $optArgs = array()) {
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("restoreVirtualMachine",
            array_merge(array(
                'virtualmachineid' => $virtualMachineId
            ), $optArgs)
        );
    }

    /**
     * Changes the service offering for a virtual machine. The virtual machine must be
     * in a "Stopped" state for this command to take effect.
     *
     * @param string $id The ID of the virtual machine
     * @param string $serviceOfferingId the service offering ID to apply to the virtual machine
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu, memory and cpunumber. example
     *     details[i].name=value
     * }
     */
    public function changeServiceForVirtualMachine($id, $serviceOfferingId, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }
        return $this->request("changeServiceForVirtualMachine",
            array_merge(array(
                'id' => $id,
                'serviceofferingid' => $serviceOfferingId
            ), $optArgs)
        );
    }

    /**
     * Scales the virtual machine to a new service offering.
     *
     * @param string $id The ID of the virtual machine
     * @param string $serviceOfferingId the ID of the service offering for the virtual machine
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu,memory and cpunumber. example
     *     details[i].name=value
     * }
     */
    public function scaleVirtualMachine($id, $serviceOfferingId, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }
        return $this->request("scaleVirtualMachine",
            array_merge(array(
                'id' => $id,
                'serviceofferingid' => $serviceOfferingId
            ), $optArgs)
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
     * @param string $domainId domain id of the new VM owner.
     * @param string $virtualMachineId id of the VM to be moved
     * @param array  $optArgs {
     *     @type string $networkIds list of new network ids in which the moved VM will participate. In case no
     *     network ids are provided the VM will be part of the default network for that
     *     zone. In case there is no network yet created for the new account the default
     *     network will be created.
     *     @type string $securityGroupIds list of security group ids to be applied on the virtual machine. In case no
     *     security groups are provided the VM is part of the default security group.
     * }
     */
    public function assignVirtualMachine($account, $domainId, $virtualMachineId, array $optArgs = array()) {
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("assignVirtualMachine",
            array_merge(array(
                'account' => $account,
                'domainid' => $domainId,
                'virtualmachineid' => $virtualMachineId
            ), $optArgs)
        );
    }

    /**
     * Attempts Migration of a VM to a different host or Root volume of the vm to a
     * different storage pool
     *
     * @param string $virtualMachineId the ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $hostId Destination Host ID to migrate VM to. Required for live migrating a VM from host
     *     to host
     *     @type string $storageId Destination storage pool ID to migrate VM volumes to. Required for migrating the
     *     root disk volume
     * }
     */
    public function migrateVirtualMachine($virtualMachineId, array $optArgs = array()) {
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("migrateVirtualMachine",
            array_merge(array(
                'virtualmachineid' => $virtualMachineId
            ), $optArgs)
        );
    }

    /**
     * Attempts Migration of a VM with its volumes to a different host
     *
     * @param string $hostId Destination Host ID to migrate VM to.
     * @param string $virtualMachineId the ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $migrateTo Map of pool to which each volume should be migrated (volume/pool pair)
     * }
     */
    public function migrateVirtualMachineWithVolume($hostId, $virtualMachineId, array $optArgs = array()) {
        if (empty($hostId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostId"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("migrateVirtualMachineWithVolume",
            array_merge(array(
                'hostid' => $hostId,
                'virtualmachineid' => $virtualMachineId
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
     * Cleanups VM reservations in the database.
     *
     */
    public function cleanVMReservations() {
        return $this->request("cleanVMReservations",
            $optArgs
        );
    }

    /**
     * Adds VM to specified network by creating a NIC
     *
     * @param string $networkId Network ID
     * @param string $virtualMachineId Virtual Machine ID
     * @param array  $optArgs {
     *     @type string $ipAddress IP Address for the new network
     * }
     */
    public function addNicToVirtualMachine($networkId, $virtualMachineId, array $optArgs = array()) {
        if (empty($networkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkId"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("addNicToVirtualMachine",
            array_merge(array(
                'networkid' => $networkId,
                'virtualmachineid' => $virtualMachineId
            ), $optArgs)
        );
    }

    /**
     * Removes VM from specified network by deleting a NIC
     *
     * @param string $nicId NIC ID
     * @param string $virtualMachineId Virtual Machine ID
     */
    public function removeNicFromVirtualMachine($nicId, $virtualMachineId) {
        if (empty($nicId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nicId"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("removeNicFromVirtualMachine",
            array(
                'nicid' => $nicId,
                'virtualmachineid' => $virtualMachineId
            )
        );
    }

    /**
     * Changes the default NIC on a VM
     *
     * @param string $nicId NIC ID
     * @param string $virtualMachineId Virtual Machine ID
     */
    public function updateDefaultNicForVirtualMachine($nicId, $virtualMachineId) {
        if (empty($nicId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nicId"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("updateDefaultNicForVirtualMachine",
            array(
                'nicid' => $nicId,
                'virtualmachineid' => $virtualMachineId
            )
        );
    }

    /**
     * Adds metric counter
     *
     * @param string $name Name of the counter.
     * @param string $source Source of the counter.
     * @param string $value Value of the counter e.g. oid in case of snmp.
     */
    public function createCounter($name, $source, $value) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($source)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "source"), MISSING_ARGUMENT);
        }
        if (empty($value)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "value"), MISSING_ARGUMENT);
        }
        return $this->request("createCounter",
            array(
                'name' => $name,
                'source' => $source,
                'value' => $value
            )
        );
    }

    /**
     * Creates a condition
     *
     * @param string $counterId ID of the Counter.
     * @param string $relationalOperator Relational Operator to be used with threshold.
     * @param string $threshold Threshold value.
     * @param array  $optArgs {
     *     @type string $account the account of the condition. Must be used with the domainId parameter.
     *     @type string $domainId the domain ID of the account.
     * }
     */
    public function createCondition($counterId, $relationalOperator, $threshold, array $optArgs = array()) {
        if (empty($counterId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "counterId"), MISSING_ARGUMENT);
        }
        if (empty($relationalOperator)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "relationalOperator"), MISSING_ARGUMENT);
        }
        if (empty($threshold)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "threshold"), MISSING_ARGUMENT);
        }
        return $this->request("createCondition",
            array_merge(array(
                'counterid' => $counterId,
                'relationaloperator' => $relationalOperator,
                'threshold' => $threshold
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
     * @param string $conditionIds the list of IDs of the conditions that are being evaluated on every interval
     * @param string $duration the duration for which the conditions have to be true before action is taken
     * @param array  $optArgs {
     *     @type string $quietTime the cool down period for which the policy should not be evaluated after the
     *     action has been taken
     * }
     */
    public function createAutoScalePolicy($action, $conditionIds, $duration, array $optArgs = array()) {
        if (empty($action)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "action"), MISSING_ARGUMENT);
        }
        if (empty($conditionIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "conditionIds"), MISSING_ARGUMENT);
        }
        if (empty($duration)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "duration"), MISSING_ARGUMENT);
        }
        return $this->request("createAutoScalePolicy",
            array_merge(array(
                'action' => $action,
                'conditionids' => $conditionIds,
                'duration' => $duration
            ), $optArgs)
        );
    }

    /**
     * Creates a profile that contains information about the virtual machine which will
     * be provisioned automatically by autoscale feature.
     *
     * @param string $serviceOfferingId the service offering of the auto deployed virtual machine
     * @param string $templateId the template of the auto deployed virtual machine
     * @param string $zoneId availability zone for the auto deployed virtual machine
     * @param array  $optArgs {
     *     @type string $autoScaleUserId the ID of the user used to launch and destroy the VMs
     *     @type string $counterParam counterparam list. Example:
     *     counterparam[0].name=snmpcommunity&counterparam[0].value=public&counterparam[1].name=snmpport&counterparam[1].value=161
     *     @type string $destroyVmGracePeriod the time allowed for existing connections to get closed before a vm is
     *     destroyed
     *     @type string $otherDeployParams parameters other than zoneId/serviceOfferringId/templateId of the auto deployed
     *     virtual machine
     * }
     */
    public function createAutoScaleVmProfile($serviceOfferingId, $templateId, $zoneId, array $optArgs = array()) {
        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }
        if (empty($templateId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateId"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("createAutoScaleVmProfile",
            array_merge(array(
                'serviceofferingid' => $serviceOfferingId,
                'templateid' => $templateId,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Creates and automatically starts a virtual machine based on a service offering,
     * disk offering, and template.
     *
     * @param string $lbruleId the ID of the load balancer rule
     * @param string $maxMembers the maximum number of members in the vmgroup, The number of instances in the vm
     * group will be equal to or less than this number.
     * @param string $minMembers the minimum number of members in the vmgroup, the number of instances in the vm
     * group will be equal to or more than this number.
     * @param string $scaleDownPolicyIds list of scaledown autoscale policies
     * @param string $scaleUpPolicyIds list of scaleup autoscale policies
     * @param string $vmProfileId the autoscale profile that contains information about the vms in the vm group.
     * @param array  $optArgs {
     *     @type string $interval the frequency at which the conditions have to be evaluated
     * }
     */
    public function createAutoScaleVmGroup($lbruleId, $maxMembers, $minMembers, $scaleDownPolicyIds, $scaleUpPolicyIds, $vmProfileId, array $optArgs = array()) {
        if (empty($lbruleId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lbruleId"), MISSING_ARGUMENT);
        }
        if (empty($maxMembers)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "maxMembers"), MISSING_ARGUMENT);
        }
        if (empty($minMembers)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "minMembers"), MISSING_ARGUMENT);
        }
        if (empty($scaleDownPolicyIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "scaleDownPolicyIds"), MISSING_ARGUMENT);
        }
        if (empty($scaleUpPolicyIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "scaleUpPolicyIds"), MISSING_ARGUMENT);
        }
        if (empty($vmProfileId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vmProfileId"), MISSING_ARGUMENT);
        }
        return $this->request("createAutoScaleVmGroup",
            array_merge(array(
                'lbruleid' => $lbruleId,
                'maxmembers' => $maxMembers,
                'minmembers' => $minMembers,
                'scaledownpolicyids' => $scaleDownPolicyIds,
                'scaleuppolicyids' => $scaleUpPolicyIds,
                'vmprofileid' => $vmProfileId
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
     * List the counters
     *
     * @param array  $optArgs {
     *     @type string $id ID of the Counter.
     *     @type string $keyword List by keyword
     *     @type string $name Name of the counter.
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $source Source of the counter.
     * }
     */
    public function listCounters(array $optArgs = array()) {
        return $this->request("listCounters",
            $optArgs
        );
    }

    /**
     * List Conditions for the specific user
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $counterId Counter-id of the condition.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id ID of the Condition.
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $policyId the ID of the policy
     * }
     */
    public function listConditions(array $optArgs = array()) {
        return $this->request("listConditions",
            $optArgs
        );
    }

    /**
     * Lists autoscale policies.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $action the action to be executed if all the conditions evaluate to true for the
     *     specified duration.
     *     @type string $conditionId the ID of the condition of the policy
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id the ID of the autoscale policy
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $vmGroupId the ID of the autoscale vm group
     * }
     */
    public function listAutoScalePolicies(array $optArgs = array()) {
        return $this->request("listAutoScalePolicies",
            $optArgs
        );
    }

    /**
     * Lists autoscale vm profiles.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id the ID of the autoscale vm profile
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $otherDeployParams the otherdeployparameters of the autoscale vm profile
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $templateId the templateid of the autoscale vm profile
     * }
     */
    public function listAutoScaleVmProfiles(array $optArgs = array()) {
        return $this->request("listAutoScaleVmProfiles",
            $optArgs
        );
    }

    /**
     * Lists autoscale vm groups.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id the ID of the autoscale vm group
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $lbruleId the ID of the loadbalancer
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $policyId the ID of the policy
     *     @type string $projectId list objects by project
     *     @type string $vmProfileId the ID of the profile
     *     @type string $zoneId the availability zone ID
     * }
     */
    public function listAutoScaleVmGroups(array $optArgs = array()) {
        return $this->request("listAutoScaleVmGroups",
            $optArgs
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
     * Updates an existing autoscale policy.
     *
     * @param string $id the ID of the autoscale policy
     * @param array  $optArgs {
     *     @type string $conditionIds the list of IDs of the conditions that are being evaluated on every interval
     *     @type string $duration the duration for which the conditions have to be true before action is taken
     *     @type string $quietTime the cool down period for which the policy should not be evaluated after the
     *     action has been taken
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
     * Updates an existing autoscale vm profile.
     *
     * @param string $id the ID of the autoscale vm profile
     * @param array  $optArgs {
     *     @type string $autoScaleUserId the ID of the user used to launch and destroy the VMs
     *     @type string $counterParam counterparam list. Example:
     *     counterparam[0].name=snmpcommunity&counterparam[0].value=public&counterparam[1].name=snmpport&counterparam[1].value=161
     *     @type string $destroyVmGracePeriod the time allowed for existing connections to get closed before a vm is
     *     destroyed
     *     @type string $templateId the template of the auto deployed virtual machine
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
     * Updates an existing autoscale vm group.
     *
     * @param string $id the ID of the autoscale group
     * @param array  $optArgs {
     *     @type string $interval the frequency at which the conditions have to be evaluated
     *     @type string $maxMembers the maximum number of members in the vmgroup, The number of instances in the vm
     *     group will be equal to or less than this number.
     *     @type string $minMembers the minimum number of members in the vmgroup, the number of instances in the vm
     *     group will be equal to or more than this number.
     *     @type string $scaleDownPolicyIds list of scaledown autoscale policies
     *     @type string $scaleUpPolicyIds list of scaleup autoscale policies
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
     * Lists all port forwarding rules for an IP address.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id Lists rule with the specified ID.
     *     @type string $ipAddressId the id of IP address of the port forwarding services
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $networkId list port forwarding rules for ceratin network
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $tags List resources by tags (key/value pairs)
     * }
     */
    public function listPortForwardingRules(array $optArgs = array()) {
        return $this->request("listPortForwardingRules",
            $optArgs
        );
    }

    /**
     * Creates a port forwarding rule
     *
     * @param string $ipAddressId the IP address id of the port forwarding rule
     * @param string $privatePort the starting port of port forwarding rule's private port range
     * @param string $protocol the protocol for the port fowarding rule. Valid values are TCP or UDP.
     * @param string $publicPort the starting port of port forwarding rule's public port range
     * @param string $virtualMachineId the ID of the virtual machine for the port forwarding rule
     * @param array  $optArgs {
     *     @type string $cidrList the cidr list to forward traffic from
     *     @type string $networkId The network of the vm the Port Forwarding rule will be created for. Required
     *     when public Ip address is not associated with any Guest network yet (VPC case)
     *     @type string $openFirewall if true, firewall rule for source/end pubic port is automatically created; if
     *     false - firewall rule has to be created explicitely. If not specified 1)
     *     defaulted to false when PF rule is being created for VPC guest network 2) in all
     *     other cases defaulted to true
     *     @type string $privateEndPort the ending port of port forwarding rule's private port range
     *     @type string $publicEndPort the ending port of port forwarding rule's private port range
     *     @type string $vmGuestIp VM guest nic Secondary ip address for the port forwarding rule
     * }
     */
    public function createPortForwardingRule($ipAddressId, $privatePort, $protocol, $publicPort, $virtualMachineId, array $optArgs = array()) {
        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }
        if (empty($privatePort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privatePort"), MISSING_ARGUMENT);
        }
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        if (empty($publicPort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicPort"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("createPortForwardingRule",
            array_merge(array(
                'ipaddressid' => $ipAddressId,
                'privateport' => $privatePort,
                'protocol' => $protocol,
                'publicport' => $publicPort,
                'virtualmachineid' => $virtualMachineId
            ), $optArgs)
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
     * Updates a port forwarding rule.  Only the private port and the virtual machine
     * can be updated.
     *
     * @param string $ipAddressId the IP address id of the port forwarding rule
     * @param string $privatePort the private port of the port forwarding rule
     * @param string $protocol the protocol for the port fowarding rule. Valid values are TCP or UDP.
     * @param string $publicPort the public port of the port forwarding rule
     * @param array  $optArgs {
     *     @type string $privateIp the private IP address of the port forwarding rule
     *     @type string $virtualMachineId the ID of the virtual machine for the port forwarding rule
     * }
     */
    public function updatePortForwardingRule($ipAddressId, $privatePort, $protocol, $publicPort, array $optArgs = array()) {
        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }
        if (empty($privatePort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "privatePort"), MISSING_ARGUMENT);
        }
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        if (empty($publicPort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicPort"), MISSING_ARGUMENT);
        }
        return $this->request("updatePortForwardingRule",
            array_merge(array(
                'ipaddressid' => $ipAddressId,
                'privateport' => $privatePort,
                'protocol' => $protocol,
                'publicport' => $publicPort
            ), $optArgs)
        );
    }

    /**
     * Creates a firewall rule for a given ip address
     *
     * @param string $ipAddressId the IP address id of the port forwarding rule
     * @param string $protocol the protocol for the firewall rule. Valid values are TCP/UDP/ICMP.
     * @param array  $optArgs {
     *     @type string $cidrList the cidr list to forward traffic from
     *     @type string $endPort the ending port of firewall rule
     *     @type string $icmpCode error code for this icmp message
     *     @type string $icmpType type of the icmp message being sent
     *     @type string $startPort the starting port of firewall rule
     *     @type string $type type of firewallrule: system/user
     * }
     */
    public function createFirewallRule($ipAddressId, $protocol, array $optArgs = array()) {
        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        return $this->request("createFirewallRule",
            array_merge(array(
                'ipaddressid' => $ipAddressId,
                'protocol' => $protocol
            ), $optArgs)
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
     * Lists all firewall rules for an IP address.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id Lists rule with the specified ID.
     *     @type string $ipAddressId the id of IP address of the firwall services
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $networkId list firewall rules for ceratin network
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $tags List resources by tags (key/value pairs)
     * }
     */
    public function listFirewallRules(array $optArgs = array()) {
        return $this->request("listFirewallRules",
            $optArgs
        );
    }

    /**
     * Creates a egress firewall rule for a given network
     *
     * @param string $networkId the network id of the port forwarding rule
     * @param string $protocol the protocol for the firewall rule. Valid values are TCP/UDP/ICMP.
     * @param array  $optArgs {
     *     @type string $cidrList the cidr list to forward traffic from
     *     @type string $endPort the ending port of firewall rule
     *     @type string $icmpCode error code for this icmp message
     *     @type string $icmpType type of the icmp message being sent
     *     @type string $startPort the starting port of firewall rule
     *     @type string $type type of firewallrule: system/user
     * }
     */
    public function createEgressFirewallRule($networkId, $protocol, array $optArgs = array()) {
        if (empty($networkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkId"), MISSING_ARGUMENT);
        }
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        return $this->request("createEgressFirewallRule",
            array_merge(array(
                'networkid' => $networkId,
                'protocol' => $protocol
            ), $optArgs)
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
     * Lists all egress firewall rules for network id.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id Lists rule with the specified ID.
     *     @type string $id Lists rule with the specified ID.
     *     @type string $ipAddressId the id of IP address of the firwall services
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $networkId list firewall rules for ceratin network
     *     @type string $networkId the id network network for the egress firwall services
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $tags List resources by tags (key/value pairs)
     * }
     */
    public function listEgressFirewallRules(array $optArgs = array()) {
        return $this->request("listEgressFirewallRules",
            $optArgs
        );
    }

    /**
     * Adds a SRX firewall device
     *
     * @param string $networkDeviceType supports only JuniperSRXFirewall
     * @param string $password Credentials to reach SRX firewall device
     * @param string $physicalNetworkId the Physical Network ID
     * @param string $url URL of the SRX appliance.
     * @param string $userName Credentials to reach SRX firewall device
     */
    public function addSrxFirewall($networkDeviceType, $password, $physicalNetworkId, $url, $userName) {
        if (empty($networkDeviceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkDeviceType"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("addSrxFirewall",
            array(
                'networkdevicetype' => $networkDeviceType,
                'password' => $password,
                'physicalnetworkid' => $physicalNetworkId,
                'url' => $url,
                'username' => $userName
            )
        );
    }

    /**
     * delete a SRX firewall device
     *
     * @param string $fwDeviceId srx firewall device ID
     */
    public function deleteSrxFirewall($fwDeviceId) {
        if (empty($fwDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteSrxFirewall",
            array(
                'fwdeviceid' => $fwDeviceId
            )
        );
    }

    /**
     * Configures a SRX firewall device
     *
     * @param string $fwDeviceId SRX firewall device ID
     * @param array  $optArgs {
     *     @type string $fwDeviceCapacity capacity of the firewall device, Capacity will be interpreted as number of
     *     networks device can handle
     * }
     */
    public function configureSrxFirewall($fwDeviceId, array $optArgs = array()) {
        if (empty($fwDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("configureSrxFirewall",
            array_merge(array(
                'fwdeviceid' => $fwDeviceId
            ), $optArgs)
        );
    }

    /**
     * lists SRX firewall devices in a physical network
     *
     * @param array  $optArgs {
     *     @type string $fwDeviceId SRX firewall device ID
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId the Physical Network ID
     * }
     */
    public function listSrxFirewalls(array $optArgs = array()) {
        return $this->request("listSrxFirewalls",
            $optArgs
        );
    }

    /**
     * Adds a Palo Alto firewall device
     *
     * @param string $networkDeviceType supports only PaloAltoFirewall
     * @param string $password Credentials to reach Palo Alto firewall device
     * @param string $physicalNetworkId the Physical Network ID
     * @param string $url URL of the Palo Alto appliance.
     * @param string $userName Credentials to reach Palo Alto firewall device
     */
    public function addPaloAltoFirewall($networkDeviceType, $password, $physicalNetworkId, $url, $userName) {
        if (empty($networkDeviceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkDeviceType"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("addPaloAltoFirewall",
            array(
                'networkdevicetype' => $networkDeviceType,
                'password' => $password,
                'physicalnetworkid' => $physicalNetworkId,
                'url' => $url,
                'username' => $userName
            )
        );
    }

    /**
     * delete a Palo Alto firewall device
     *
     * @param string $fwDeviceId Palo Alto firewall device ID
     */
    public function deletePaloAltoFirewall($fwDeviceId) {
        if (empty($fwDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("deletePaloAltoFirewall",
            array(
                'fwdeviceid' => $fwDeviceId
            )
        );
    }

    /**
     * Configures a Palo Alto firewall device
     *
     * @param string $fwDeviceId Palo Alto firewall device ID
     * @param array  $optArgs {
     *     @type string $fwDeviceCapacity capacity of the firewall device, Capacity will be interpreted as number of
     *     networks device can handle
     * }
     */
    public function configurePaloAltoFirewall($fwDeviceId, array $optArgs = array()) {
        if (empty($fwDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "fwDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("configurePaloAltoFirewall",
            array_merge(array(
                'fwdeviceid' => $fwDeviceId
            ), $optArgs)
        );
    }

    /**
     * lists Palo Alto firewall devices in a physical network
     *
     * @param array  $optArgs {
     *     @type string $fwDeviceId Palo Alto firewall device ID
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId the Physical Network ID
     * }
     */
    public function listPaloAltoFirewalls(array $optArgs = array()) {
        return $this->request("listPaloAltoFirewalls",
            $optArgs
        );
    }

    /**
     * Creates a l2tp/ipsec remote access vpn
     *
     * @param string $publicIpId public ip address id of the vpn server
     * @param array  $optArgs {
     *     @type string $account an optional account for the VPN. Must be used with domainId.
     *     @type string $domainId an optional domainId for the VPN. If the account parameter is used, domainId
     *     must also be used.
     *     @type string $ipRange the range of ip addresses to allocate to vpn clients. The first ip in the range
     *     will be taken by the vpn server
     *     @type string $openFirewall if true, firewall rule for source/end pubic port is automatically created; if
     *     false - firewall rule has to be created explicitely. Has value true by default
     * }
     */
    public function createRemoteAccessVpn($publicIpId, array $optArgs = array()) {
        if (empty($publicIpId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicIpId"), MISSING_ARGUMENT);
        }
        return $this->request("createRemoteAccessVpn",
            array_merge(array(
                'publicipid' => $publicIpId
            ), $optArgs)
        );
    }

    /**
     * Destroys a l2tp/ipsec remote access vpn
     *
     * @param string $publicIpId public ip address id of the vpn server
     */
    public function deleteRemoteAccessVpn($publicIpId) {
        if (empty($publicIpId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicIpId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteRemoteAccessVpn",
            array(
                'publicipid' => $publicIpId
            )
        );
    }

    /**
     * Lists remote access vpns
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id Lists remote access vpn rule with the specified ID
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $networkId list remote access VPNs for ceratin network
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $publicIpId public ip address id of the vpn server
     * }
     */
    public function listRemoteAccessVpns(array $optArgs = array()) {
        return $this->request("listRemoteAccessVpns",
            $optArgs
        );
    }

    /**
     * Adds vpn users
     *
     * @param string $password password for the username
     * @param string $userName username for the vpn user
     * @param array  $optArgs {
     *     @type string $account an optional account for the vpn user. Must be used with domainId.
     *     @type string $domainId an optional domainId for the vpn user. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $projectId add vpn user to the specific project
     * }
     */
    public function addVpnUser($password, $userName, array $optArgs = array()) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("addVpnUser",
            array_merge(array(
                'password' => $password,
                'username' => $userName
            ), $optArgs)
        );
    }

    /**
     * Removes vpn user
     *
     * @param string $userName username for the vpn user
     * @param array  $optArgs {
     *     @type string $account an optional account for the vpn user. Must be used with domainId.
     *     @type string $domainId an optional domainId for the vpn user. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $projectId remove vpn user from the project
     * }
     */
    public function removeVpnUser($userName, array $optArgs = array()) {
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("removeVpnUser",
            array_merge(array(
                'username' => $userName
            ), $optArgs)
        );
    }

    /**
     * Lists vpn users
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id The uuid of the Vpn user
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $userName the username of the vpn user.
     * }
     */
    public function listVpnUsers(array $optArgs = array()) {
        return $this->request("listVpnUsers",
            $optArgs
        );
    }

    /**
     * Creates site to site vpn customer gateway
     *
     * @param string $cidrList guest cidr list of the customer gateway
     * @param string $espPolicy ESP policy of the customer gateway
     * @param string $gateway public ip address id of the customer gateway
     * @param string $ikePolicy IKE policy of the customer gateway
     * @param string $ipsecPsk IPsec Preshared-Key of the customer gateway
     * @param array  $optArgs {
     *     @type string $account the account associated with the gateway. Must be used with the domainId
     *     parameter.
     *     @type string $domainId the domain ID associated with the gateway. If used with the account parameter
     *     returns the gateway associated with the account for the specified domain.
     *     @type string $dpd If DPD is enabled for VPN connection
     *     @type string $espLifetime Lifetime of phase 2 VPN connection to the customer gateway, in seconds
     *     @type string $ikeLifetime Lifetime of phase 1 VPN connection to the customer gateway, in seconds
     *     @type string $name name of this customer gateway
     * }
     */
    public function createVpnCustomerGateway($cidrList, $espPolicy, $gateway, $ikePolicy, $ipsecPsk, array $optArgs = array()) {
        if (empty($cidrList)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidrList"), MISSING_ARGUMENT);
        }
        if (empty($espPolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "espPolicy"), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        if (empty($ikePolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ikePolicy"), MISSING_ARGUMENT);
        }
        if (empty($ipsecPsk)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipsecPsk"), MISSING_ARGUMENT);
        }
        return $this->request("createVpnCustomerGateway",
            array_merge(array(
                'cidrlist' => $cidrList,
                'esppolicy' => $espPolicy,
                'gateway' => $gateway,
                'ikepolicy' => $ikePolicy,
                'ipsecpsk' => $ipsecPsk
            ), $optArgs)
        );
    }

    /**
     * Creates site to site vpn local gateway
     *
     * @param string $vpcId public ip address id of the vpn gateway
     */
    public function createVpnGateway($vpcId) {
        if (empty($vpcId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcId"), MISSING_ARGUMENT);
        }
        return $this->request("createVpnGateway",
            array(
                'vpcid' => $vpcId
            )
        );
    }

    /**
     * Create site to site vpn connection
     *
     * @param string $s2sCustomerGatewayId id of the customer gateway
     * @param string $s2sVpnGatewayId id of the vpn gateway
     * @param array  $optArgs {
     *     @type string $passive connection is passive or not
     * }
     */
    public function createVpnConnection($s2sCustomerGatewayId, $s2sVpnGatewayId, array $optArgs = array()) {
        if (empty($s2sCustomerGatewayId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "s2sCustomerGatewayId"), MISSING_ARGUMENT);
        }
        if (empty($s2sVpnGatewayId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "s2sVpnGatewayId"), MISSING_ARGUMENT);
        }
        return $this->request("createVpnConnection",
            array_merge(array(
                's2scustomergatewayid' => $s2sCustomerGatewayId,
                's2svpngatewayid' => $s2sVpnGatewayId
            ), $optArgs)
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
     * Update site to site vpn customer gateway
     *
     * @param string $id id of customer gateway
     * @param string $cidrList guest cidr of the customer gateway
     * @param string $espPolicy ESP policy of the customer gateway
     * @param string $gateway public ip address id of the customer gateway
     * @param string $ikePolicy IKE policy of the customer gateway
     * @param string $ipsecPsk IPsec Preshared-Key of the customer gateway
     * @param array  $optArgs {
     *     @type string $account the account associated with the gateway. Must be used with the domainId
     *     parameter.
     *     @type string $domainId the domain ID associated with the gateway. If used with the account parameter
     *     returns the gateway associated with the account for the specified domain.
     *     @type string $dpd If DPD is enabled for VPN connection
     *     @type string $espLifetime Lifetime of phase 2 VPN connection to the customer gateway, in seconds
     *     @type string $ikeLifetime Lifetime of phase 1 VPN connection to the customer gateway, in seconds
     *     @type string $name name of this customer gateway
     * }
     */
    public function updateVpnCustomerGateway($id, $cidrList, $espPolicy, $gateway, $ikePolicy, $ipsecPsk, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($cidrList)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidrList"), MISSING_ARGUMENT);
        }
        if (empty($espPolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "espPolicy"), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        if (empty($ikePolicy)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ikePolicy"), MISSING_ARGUMENT);
        }
        if (empty($ipsecPsk)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipsecPsk"), MISSING_ARGUMENT);
        }
        return $this->request("updateVpnCustomerGateway",
            array_merge(array(
                'id' => $id,
                'cidrlist' => $cidrList,
                'esppolicy' => $espPolicy,
                'gateway' => $gateway,
                'ikepolicy' => $ikePolicy,
                'ipsecpsk' => $ipsecPsk
            ), $optArgs)
        );
    }

    /**
     * Reset site to site vpn connection
     *
     * @param string $id id of vpn connection
     * @param array  $optArgs {
     *     @type string $account an optional account for connection. Must be used with domainId.
     *     @type string $domainId an optional domainId for connection. If the account parameter is used, domainId
     *     must also be used.
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
     * Lists site to site vpn customer gateways
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id id of the customer gateway
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     * }
     */
    public function listVpnCustomerGateways(array $optArgs = array()) {
        return $this->request("listVpnCustomerGateways",
            $optArgs
        );
    }

    /**
     * Lists site 2 site vpn gateways
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id id of the vpn gateway
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $vpcId id of vpc
     * }
     */
    public function listVpnGateways(array $optArgs = array()) {
        return $this->request("listVpnGateways",
            $optArgs
        );
    }

    /**
     * Lists site to site vpn connection gateways
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id id of the vpn connection
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $vpcId id of vpc
     * }
     */
    public function listVpnConnections(array $optArgs = array()) {
        return $this->request("listVpnConnections",
            $optArgs
        );
    }

    /**
     * Creates a VPC
     *
     * @param string $cidr the cidr of the VPC. All VPC guest networks' cidrs should be within this CIDR
     * @param string $displayText the display text of the VPC
     * @param string $name the name of the VPC
     * @param string $vpcOfferingId the ID of the VPC offering
     * @param string $zoneId the ID of the availability zone
     * @param array  $optArgs {
     *     @type string $account the account associated with the VPC. Must be used with the domainId parameter.
     *     @type string $domainId the domain ID associated with the VPC. If used with the account parameter
     *     returns the VPC associated with the account for the specified domain.
     *     @type string $networkDomain VPC network domain. All networks inside the VPC will belong to this domain
     *     @type string $projectId create VPC for the project
     *     @type string $start If set to false, the VPC won't start (VPC VR will not get allocated) until its
     *     first network gets implemented. True by default.
     * }
     */
    public function createVPC($cidr, $displayText, $name, $vpcOfferingId, $zoneId, array $optArgs = array()) {
        if (empty($cidr)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidr"), MISSING_ARGUMENT);
        }
        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($vpcOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcOfferingId"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("createVPC",
            array_merge(array(
                'cidr' => $cidr,
                'displaytext' => $displayText,
                'name' => $name,
                'vpcofferingid' => $vpcOfferingId,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Lists VPCs
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $cidr list by cidr of the VPC. All VPC guest networks' cidrs should be within this
     *     CIDR
     *     @type string $displayText List by display text of the VPC
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id list VPC by id
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name list by name of the VPC
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $restartRequired list VPCs by restartRequired option
     *     @type string $state list VPCs by state
     *     @type string $supportedServices list VPC supporting certain services
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $vpcOfferingId list by ID of the VPC offering
     *     @type string $zoneId list by zone
     * }
     */
    public function listVPCs(array $optArgs = array()) {
        return $this->request("listVPCs",
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
     * Updates a VPC
     *
     * @param string $id the id of the VPC
     * @param string $name the name of the VPC
     * @param array  $optArgs {
     *     @type string $displayText the display text of the VPC
     * }
     */
    public function updateVPC($id, $name, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("updateVPC",
            array_merge(array(
                'id' => $id,
                'name' => $name
            ), $optArgs)
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
     * Creates VPC offering
     *
     * @param string $displayText the display text of the vpc offering
     * @param string $name the name of the vpc offering
     * @param string $supportedServices services supported by the vpc offering
     * @param array  $optArgs {
     *     @type string $serviceOfferingId the ID of the service offering for the VPC router appliance
     *     @type string $serviceProviderList provider to service mapping. If not specified, the provider for the service will
     *     be mapped to the default provider on the physical network
     * }
     */
    public function createVPCOffering($displayText, $name, $supportedServices, array $optArgs = array()) {
        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($supportedServices)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "supportedServices"), MISSING_ARGUMENT);
        }
        return $this->request("createVPCOffering",
            array_merge(array(
                'displaytext' => $displayText,
                'name' => $name,
                'supportedservices' => $supportedServices
            ), $optArgs)
        );
    }

    /**
     * Updates VPC offering
     *
     * @param string $id the id of the VPC offering
     * @param array  $optArgs {
     *     @type string $displayText the display text of the VPC offering
     *     @type string $name the name of the VPC offering
     *     @type string $state update state for the VPC offering; supported states - Enabled/Disabled
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
     * Lists VPC offerings
     *
     * @param array  $optArgs {
     *     @type string $displayText list VPC offerings by display text
     *     @type string $id list VPC offerings by id
     *     @type string $isDefault true if need to list only default VPC offerings. Default value is false
     *     @type string $keyword List by keyword
     *     @type string $name list VPC offerings by name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $state list VPC offerings by state
     *     @type string $supportedServices list VPC offerings supporting certain services
     * }
     */
    public function listVPCOfferings(array $optArgs = array()) {
        return $this->request("listVPCOfferings",
            $optArgs
        );
    }

    /**
     * Creates a private gateway
     *
     * @param string $gateway the gateway of the Private gateway
     * @param string $ipAddress the IP address of the Private gateaway
     * @param string $netmask the netmask of the Private gateway
     * @param string $vlan the network implementation uri for the private gateway
     * @param string $vpcId the VPC network belongs to
     * @param array  $optArgs {
     *     @type string $aclId the ID of the network ACL
     *     @type string $networkOfferingId the uuid of the network offering to use for the private gateways network
     *     connection
     *     @type string $physicalNetworkId the Physical Network ID the network belongs to
     *     @type string $sourceNatSupported source NAT supported value. Default value false. If 'true' source NAT is enabled
     *     on the private gateway 'false': sourcenat is not supported
     * }
     */
    public function createPrivateGateway($gateway, $ipAddress, $netmask, $vlan, $vpcId, array $optArgs = array()) {
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        if (empty($ipAddress)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddress"), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }
        if (empty($vlan)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vlan"), MISSING_ARGUMENT);
        }
        if (empty($vpcId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcId"), MISSING_ARGUMENT);
        }
        return $this->request("createPrivateGateway",
            array_merge(array(
                'gateway' => $gateway,
                'ipaddress' => $ipAddress,
                'netmask' => $netmask,
                'vlan' => $vlan,
                'vpcid' => $vpcId
            ), $optArgs)
        );
    }

    /**
     * List private gateways
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id list private gateway by id
     *     @type string $ipAddress list gateways by ip address
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $state list gateways by state
     *     @type string $vlan list gateways by vlan
     *     @type string $vpcId list gateways by vpc
     * }
     */
    public function listPrivateGateways(array $optArgs = array()) {
        return $this->request("listPrivateGateways",
            $optArgs
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
     * Creates a static route
     *
     * @param string $cidr static route cidr
     * @param string $gatewayId the gateway id we are creating static route for
     */
    public function createStaticRoute($cidr, $gatewayId) {
        if (empty($cidr)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "cidr"), MISSING_ARGUMENT);
        }
        if (empty($gatewayId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gatewayId"), MISSING_ARGUMENT);
        }
        return $this->request("createStaticRoute",
            array(
                'cidr' => $cidr,
                'gatewayid' => $gatewayId
            )
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
     * Lists all static routes
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $gatewayId list static routes by gateway id
     *     @type string $id list static route by id
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $vpcId list static routes by vpc id
     * }
     */
    public function listStaticRoutes(array $optArgs = array()) {
        return $this->request("listStaticRoutes",
            $optArgs
        );
    }

    /**
     * Adds a new host.
     *
     * @param string $hypervisor hypervisor type of the host
     * @param string $password the password for the host
     * @param string $podId the Pod ID for the host
     * @param string $url the host URL
     * @param string $userName the username for the host
     * @param string $zoneId the Zone ID for the host
     * @param array  $optArgs {
     *     @type string $allocationState Allocation state of this Host for allocation of new resources
     *     @type string $clusterId the cluster ID for the host
     *     @type string $clusterName the cluster name for the host
     *     @type string $hosttags list of tags to be added to the host
     * }
     */
    public function addHost($hypervisor, $password, $podId, $url, $userName, $zoneId, array $optArgs = array()) {
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("addHost",
            array_merge(array(
                'hypervisor' => $hypervisor,
                'password' => $password,
                'podid' => $podId,
                'url' => $url,
                'username' => $userName,
                'zoneid' => $zoneId
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
     * Updates a host.
     *
     * @param string $id the ID of the host to update
     * @param array  $optArgs {
     *     @type string $allocationState Change resource state of host, valid values are [Enable, Disable]. Operation may
     *     failed if host in states not allowing Enable/Disable
     *     @type string $hosttags list of tags to be added to the host
     *     @type string $osCategoryId the id of Os category to update the host with
     *     @type string $url the new uri for the secondary storage: nfs://host/path
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
     * Deletes a host.
     *
     * @param string $id the host ID
     * @param array  $optArgs {
     *     @type string $forced Force delete the host. All HA enabled vms running on the host will be put to HA;
     *     HA disabled ones will be stopped
     *     @type string $forceDestroyLocalStorage Force destroy local storage on this host. All VMs created on this local storage
     *     will be destroyed
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
     * Lists hosts.
     *
     * @param array  $optArgs {
     *     @type string $clusterId lists hosts existing in particular cluster
     *     @type string $details comma separated list of host details requested, value can be a list of [ min,
     *     all, capacity, events, stats]
     *     @type string $haHost if true, list only hosts dedicated to HA
     *     @type string $hypervisor hypervisor type of host: XenServer,KVM,VMware,Hyperv,BareMetal,Simulator
     *     @type string $id the id of the host
     *     @type string $keyword List by keyword
     *     @type string $name the name of the host
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $podId the Pod ID for the host
     *     @type string $resourcestate list hosts by resource state. Resource state represents current state determined
     *     by admin of host, valule can be one of [Enabled, Disabled, Unmanaged,
     *     PrepareForMaintenance, ErrorInMaintenance, Maintenance, Error]
     *     @type string $state the state of the host
     *     @type string $type the host type
     *     @type string $virtualMachineId lists hosts in the same cluster as this VM and flag hosts with enough CPU/RAm to
     *     host this VM
     *     @type string $zoneId the Zone ID for the host
     * }
     */
    public function listHosts(array $optArgs = array()) {
        return $this->request("listHosts",
            $optArgs
        );
    }

    /**
     * Find hosts suitable for migrating a virtual machine.
     *
     * @param string $virtualMachineId find hosts to which this VM can be migrated and flag the hosts with enough
     * CPU/RAM to host the VM
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function findHostsForMigration($virtualMachineId, array $optArgs = array()) {
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("findHostsForMigration",
            array_merge(array(
                'virtualmachineid' => $virtualMachineId
            ), $optArgs)
        );
    }

    /**
     * Adds secondary storage.
     *
     * @param string $url the URL for the secondary storage
     * @param array  $optArgs {
     *     @type string $zoneId the Zone ID for the secondary storage
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
     * Update password of a host/pool on management server.
     *
     * @param string $password the new password for the host/cluster
     * @param string $userName the username for the host/cluster
     * @param array  $optArgs {
     *     @type string $clusterId the cluster ID
     *     @type string $hostId the host ID
     * }
     */
    public function updateHostPassword($password, $userName, array $optArgs = array()) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("updateHostPassword",
            array_merge(array(
                'password' => $password,
                'username' => $userName
            ), $optArgs)
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
     * add a baremetal host
     *
     * @param string $hypervisor hypervisor type of the host
     * @param string $password the password for the host
     * @param string $podId the Pod ID for the host
     * @param string $url the host URL
     * @param string $userName the username for the host
     * @param string $zoneId the Zone ID for the host
     * @param array  $optArgs {
     *     @type string $allocationState Allocation state of this Host for allocation of new resources
     *     @type string $clusterId the cluster ID for the host
     *     @type string $clusterName the cluster name for the host
     *     @type string $hosttags list of tags to be added to the host
     *     @type string $ipAddress ip address intentionally allocated to this host after provisioning
     * }
     */
    public function addBaremetalHost($hypervisor, $password, $podId, $url, $userName, $zoneId, array $optArgs = array()) {
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("addBaremetalHost",
            array_merge(array(
                'hypervisor' => $hypervisor,
                'password' => $password,
                'podid' => $podId,
                'url' => $url,
                'username' => $userName,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Dedicates a host.
     *
     * @param string $domainId the ID of the containing domain
     * @param string $hostId the ID of the host to update
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     */
    public function dedicateHost($domainId, $hostId, array $optArgs = array()) {
        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }
        if (empty($hostId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostId"), MISSING_ARGUMENT);
        }
        return $this->request("dedicateHost",
            array_merge(array(
                'domainid' => $domainId,
                'hostid' => $hostId
            ), $optArgs)
        );
    }

    /**
     * Release the dedication for host
     *
     * @param string $hostId the ID of the host
     */
    public function releaseDedicatedHost($hostId) {
        if (empty($hostId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostId"), MISSING_ARGUMENT);
        }
        return $this->request("releaseDedicatedHost",
            array(
                'hostid' => $hostId
            )
        );
    }

    /**
     * Lists dedicated hosts.
     *
     * @param array  $optArgs {
     *     @type string $account the name of the account associated with the host. Must be used with domainId.
     *     @type string $affinityGroupId list dedicated hosts by affinity group
     *     @type string $domainId the ID of the domain associated with the host
     *     @type string $hostId the ID of the host
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listDedicatedHosts(array $optArgs = array()) {
        return $this->request("listDedicatedHosts",
            $optArgs
        );
    }

    /**
     * Attaches a disk volume to a virtual machine.
     *
     * @param string $id the ID of the disk volume
     * @param string $virtualMachineId the ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $deviceId the ID of the device to map the volume to within the guest OS. If no deviceId is
     *     passed in, the next available deviceId will be chosen. Possible values for a
     *     Linux OS are:* 1 - /dev/xvdb* 2 - /dev/xvdc* 4 - /dev/xvde* 5 - /dev/xvdf* 6 -
     *     /dev/xvdg* 7 - /dev/xvdh* 8 - /dev/xvdi* 9 - /dev/xvdj
     * }
     */
    public function attachVolume($id, $virtualMachineId, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("attachVolume",
            array_merge(array(
                'id' => $id,
                'virtualmachineid' => $virtualMachineId
            ), $optArgs)
        );
    }

    /**
     * Uploads a data disk.
     *
     * @param string $format the format for the volume. Possible values include QCOW2, OVA, and VHD.
     * @param string $name the name of the volume
     * @param string $url the URL of where the volume is hosted. Possible URL include http:// and
     * https://
     * @param string $zoneId the ID of the zone the volume is to be hosted on
     * @param array  $optArgs {
     *     @type string $account an optional accountName. Must be used with domainId.
     *     @type string $checksum the MD5 checksum value of this volume
     *     @type string $domainId an optional domainId. If the account parameter is used, domainId must also be
     *     used.
     *     @type string $imageStoreUuid Image store uuid
     *     @type string $projectId Upload volume for the project
     * }
     */
    public function uploadVolume($format, $name, $url, $zoneId, array $optArgs = array()) {
        if (empty($format)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "format"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("uploadVolume",
            array_merge(array(
                'format' => $format,
                'name' => $name,
                'url' => $url,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Detaches a disk volume from a virtual machine.
     *
     * @param array  $optArgs {
     *     @type string $deviceId the device ID on the virtual machine where volume is detached from
     *     @type string $id the ID of the disk volume
     *     @type string $virtualMachineId the ID of the virtual machine where the volume is detached from
     * }
     */
    public function detachVolume(array $optArgs = array()) {
        return $this->request("detachVolume",
            $optArgs
        );
    }

    /**
     * Creates a disk volume from a disk offering. This disk volume must still be
     * attached to a virtual machine to make use of it.
     *
     * @param string $name the name of the disk volume
     * @param array  $optArgs {
     *     @type string $account the account associated with the disk volume. Must be used with the domainId
     *     parameter.
     *     @type string $diskOfferingId the ID of the disk offering. Either diskOfferingId or snapshotId must be passed
     *     in.
     *     @type string $displayVolume an optional field, whether to display the volume to the end user or not.
     *     @type string $domainId the domain ID associated with the disk offering. If used with the account
     *     parameter returns the disk volume associated with the account for the specified
     *     domain.
     *     @type string $maxIops max iops
     *     @type string $minIops min iops
     *     @type string $projectId the project associated with the volume. Mutually exclusive with account
     *     parameter
     *     @type string $size Arbitrary volume size
     *     @type string $snapshotId the snapshot ID for the disk volume. Either diskOfferingId or snapshotId must be
     *     passed in.
     *     @type string $virtualMachineId the ID of the virtual machine; to be used with snapshot Id, VM to which the
     *     volume gets attached after creation
     *     @type string $zoneId the ID of the availability zone
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
     * Lists all volumes.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $hostId list volumes on specified host
     *     @type string $id the ID of the disk volume
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name the name of the disk volume
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $podId the pod id the disk volume belongs to
     *     @type string $projectId list objects by project
     *     @type string $storageId the ID of the storage pool, available to ROOT admin only
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $type the type of disk volume
     *     @type string $virtualMachineId the ID of the virtual machine
     *     @type string $zoneId the ID of the availability zone
     * }
     */
    public function listVolumes(array $optArgs = array()) {
        return $this->request("listVolumes",
            $optArgs
        );
    }

    /**
     * Extracts volume
     *
     * @param string $id the ID of the volume
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param string $zoneId the ID of the zone where the volume is located
     * @param array  $optArgs {
     *     @type string $url the url to which the volume would be extracted
     * }
     */
    public function extractVolume($id, $mode, $zoneId, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "mode"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("extractVolume",
            array_merge(array(
                'id' => $id,
                'mode' => $mode,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Migrate volume
     *
     * @param string $storageId destination storage pool ID to migrate the volume to
     * @param string $volumeId the ID of the volume
     * @param array  $optArgs {
     *     @type string $liveMigrate if the volume should be live migrated when it is attached to a running vm
     * }
     */
    public function migrateVolume($storageId, $volumeId, array $optArgs = array()) {
        if (empty($storageId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "storageId"), MISSING_ARGUMENT);
        }
        if (empty($volumeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeId"), MISSING_ARGUMENT);
        }
        return $this->request("migrateVolume",
            array_merge(array(
                'storageid' => $storageId,
                'volumeid' => $volumeId
            ), $optArgs)
        );
    }

    /**
     * Resizes a volume
     *
     * @param array  $optArgs {
     *     @type string $diskOfferingId new disk offering id
     *     @type string $id the ID of the disk volume
     *     @type string $shrinkOk Verify OK to Shrink
     *     @type string $size New volume size in G
     * }
     */
    public function resizeVolume(array $optArgs = array()) {
        return $this->request("resizeVolume",
            $optArgs
        );
    }

    /**
     * Updates the volume.
     *
     * @param array  $optArgs {
     *     @type string $displayVolume an optional field, whether to the display the volume to the end user or not.
     *     @type string $id the ID of the disk volume
     *     @type string $path The path of the volume
     *     @type string $state The state of the volume
     *     @type string $storageId Destination storage pool UUID for the volume
     * }
     */
    public function updateVolume(array $optArgs = array()) {
        return $this->request("updateVolume",
            $optArgs
        );
    }

    /**
     * Create a volume
     *
     * @param string $aggregateName aggregate name.
     * @param string $ipAddress ip address.
     * @param string $password password.
     * @param string $poolName pool name.
     * @param string $size volume size.
     * @param string $userName user name.
     * @param string $volumeName volume name.
     * @param array  $optArgs {
     *     @type string $snapshotPolicy snapshot policy.
     *     @type string $snapshotReservation snapshot reservation.
     * }
     */
    public function createVolumeOnFiler($aggregateName, $ipAddress, $password, $poolName, $size, $userName, $volumeName, array $optArgs = array()) {
        if (empty($aggregateName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "aggregateName"), MISSING_ARGUMENT);
        }
        if (empty($ipAddress)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddress"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($poolName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "poolName"), MISSING_ARGUMENT);
        }
        if (empty($size)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "size"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        if (empty($volumeName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeName"), MISSING_ARGUMENT);
        }
        return $this->request("createVolumeOnFiler",
            array_merge(array(
                'aggregatename' => $aggregateName,
                'ipaddress' => $ipAddress,
                'password' => $password,
                'poolname' => $poolName,
                'size' => $size,
                'username' => $userName,
                'volumename' => $volumeName
            ), $optArgs)
        );
    }

    /**
     * Destroy a Volume
     *
     * @param string $aggregateName aggregate name.
     * @param string $ipAddress ip address.
     * @param string $volumeName volume name.
     */
    public function destroyVolumeOnFiler($aggregateName, $ipAddress, $volumeName) {
        if (empty($aggregateName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "aggregateName"), MISSING_ARGUMENT);
        }
        if (empty($ipAddress)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddress"), MISSING_ARGUMENT);
        }
        if (empty($volumeName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeName"), MISSING_ARGUMENT);
        }
        return $this->request("destroyVolumeOnFiler",
            array(
                'aggregatename' => $aggregateName,
                'ipaddress' => $ipAddress,
                'volumename' => $volumeName
            )
        );
    }

    /**
     * List Volumes
     *
     * @param string $poolName pool name.
     */
    public function listVolumesOnFiler($poolName) {
        if (empty($poolName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "poolName"), MISSING_ARGUMENT);
        }
        return $this->request("listVolumesOnFiler",
            array(
                'poolname' => $poolName
            )
        );
    }

    /**
     * Creates a template of a virtual machine. The virtual machine must be in a
     * STOPPED state. A template created from this command is automatically designated
     * as a private template visible to the account that created it.
     *
     * @param string $displayText the display text of the template. This is usually used for display purposes.
     * @param string $name the name of the template
     * @param string $osTypeId the ID of the OS Type that best represents the OS of this template.
     * @param array  $optArgs {
     *     @type string $bits 32 or 64 bit
     *     @type string $details Template details in key/value pairs.
     *     @type string $isDynamicallyScalable true if template contains XS/VMWare tools inorder to support dynamic scaling of
     *     VM cpu/memory
     *     @type string $isFeatured true if this template is a featured template, false otherwise
     *     @type string $isPublic true if this template is a public template, false otherwise
     *     @type string $passwordEnabled true if the template supports the password reset feature; default is false
     *     @type string $requireShvm true if the template requres HVM, false otherwise
     *     @type string $snapshotId the ID of the snapshot the template is being created from. Either this
     *     parameter, or volumeId has to be passed in
     *     @type string $templateTag the tag for this template.
     *     @type string $url Optional, only for baremetal hypervisor. The directory name where template
     *     stored on CIFS server
     *     @type string $virtualMachineId Optional, VM ID. If this presents, it is going to create a baremetal template
     *     for VM this ID refers to. This is only for VM whose hypervisor type is
     *     BareMetal
     *     @type string $volumeId the ID of the disk volume the template is being created from. Either this
     *     parameter, or snapshotId has to be passed in
     * }
     */
    public function createTemplate($displayText, $name, $osTypeId, array $optArgs = array()) {
        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($osTypeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "osTypeId"), MISSING_ARGUMENT);
        }
        return $this->request("createTemplate",
            array_merge(array(
                'displaytext' => $displayText,
                'name' => $name,
                'ostypeid' => $osTypeId
            ), $optArgs)
        );
    }

    /**
     * Registers an existing template into the CloudStack cloud.
     *
     * @param string $displayText the display text of the template. This is usually used for display purposes.
     * @param string $format the format for the template. Possible values include QCOW2, RAW, and VHD.
     * @param string $hypervisor the target hypervisor for the template
     * @param string $name the name of the template
     * @param string $osTypeId the ID of the OS Type that best represents the OS of this template.
     * @param string $url the URL of where the template is hosted. Possible URL include http:// and
     * https://
     * @param string $zoneId the ID of the zone the template is to be hosted on
     * @param array  $optArgs {
     *     @type string $account an optional accountName. Must be used with domainId.
     *     @type string $bits 32 or 64 bits support. 64 by default
     *     @type string $checksum the MD5 checksum value of this template
     *     @type string $details Template details in key/value pairs.
     *     @type string $domainId an optional domainId. If the account parameter is used, domainId must also be
     *     used.
     *     @type string $isDynamicallyScalable true if template contains XS/VMWare tools inorder to support dynamic scaling of
     *     VM cpu/memory
     *     @type string $isExtractable true if the template or its derivatives are extractable; default is false
     *     @type string $isFeatured true if this template is a featured template, false otherwise
     *     @type string $isPublic true if the template is available to all accounts; default is true
     *     @type string $isRouting true if the template type is routing i.e., if template is used to deploy router
     *     @type string $passwordEnabled true if the template supports the password reset feature; default is false
     *     @type string $projectId Register template for the project
     *     @type string $requireShvm true if this template requires HVM
     *     @type string $sshkeyEnabled true if the template supports the sshkey upload feature; default is false
     *     @type string $templateTag the tag for this template.
     * }
     */
    public function registerTemplate($displayText, $format, $hypervisor, $name, $osTypeId, $url, $zoneId, array $optArgs = array()) {
        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }
        if (empty($format)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "format"), MISSING_ARGUMENT);
        }
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($osTypeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "osTypeId"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("registerTemplate",
            array_merge(array(
                'displaytext' => $displayText,
                'format' => $format,
                'hypervisor' => $hypervisor,
                'name' => $name,
                'ostypeid' => $osTypeId,
                'url' => $url,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Updates attributes of a template.
     *
     * @param string $id the ID of the image file
     * @param array  $optArgs {
     *     @type string $bootable true if image is bootable, false otherwise
     *     @type string $displayText the display text of the image
     *     @type string $format the format for the image
     *     @type string $isDynamicallyScalable true if template/ISO contains XS/VMWare tools inorder to support dynamic scaling
     *     of VM cpu/memory
     *     @type string $isRouting true if the template type is routing i.e., if template is used to deploy router
     *     @type string $name the name of the image file
     *     @type string $osTypeId the ID of the OS type that best represents the OS of this image.
     *     @type string $passwordEnabled true if the image supports the password reset feature; default is false
     *     @type string $sortKey sort key of the template, integer
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
     * Copies a template from one zone to another.
     *
     * @param string $id Template ID.
     * @param string $destzoneId ID of the zone the template is being copied to.
     * @param array  $optArgs {
     *     @type string $sourceZoneId ID of the zone the template is currently hosted on. If not specified and
     *     template is cross-zone, then we will sync this template to region wide image
     *     store
     * }
     */
    public function copyTemplate($id, $destzoneId, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($destzoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "destzoneId"), MISSING_ARGUMENT);
        }
        return $this->request("copyTemplate",
            array_merge(array(
                'id' => $id,
                'destzoneid' => $destzoneId
            ), $optArgs)
        );
    }

    /**
     * Deletes a template from the system. All virtual machines using the deleted
     * template will not be affected.
     *
     * @param string $id the ID of the template
     * @param array  $optArgs {
     *     @type string $zoneId the ID of zone of the template
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
     * List all public, private, and privileged templates.
     *
     * @param string $templateFilter possible values are "featured", "self",
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
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $hypervisor the hypervisor for which to restrict the search
     *     @type string $id the template ID
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name the template name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $showRemoved show removed templates as well
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $zoneId list templates by zoneId
     * }
     */
    public function listTemplates($templateFilter, array $optArgs = array()) {
        if (empty($templateFilter)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateFilter"), MISSING_ARGUMENT);
        }
        return $this->request("listTemplates",
            array_merge(array(
                'templatefilter' => $templateFilter
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
     *     @type string $accounts a comma delimited list of accounts. If specified, "op" parameter has to be
     *     passed in.
     *     @type string $isExtractable true if the template/iso is extractable, false other wise. Can be set only by
     *     root admin
     *     @type string $isFeatured true for featured template/iso, false otherwise
     *     @type string $isPublic true for public template/iso, false for private templates/isos
     *     @type string $op permission operator (add, remove, reset)
     *     @type string $projectids a comma delimited list of projects. If specified, "op" parameter has to be
     *     passed in.
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
     * Extracts a template
     *
     * @param string $id the ID of the template
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param array  $optArgs {
     *     @type string $url the url to which the ISO would be extracted
     *     @type string $zoneId the ID of the zone where the ISO is originally located
     * }
     */
    public function extractTemplate($id, $mode, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "mode"), MISSING_ARGUMENT);
        }
        return $this->request("extractTemplate",
            array_merge(array(
                'id' => $id,
                'mode' => $mode
            ), $optArgs)
        );
    }

    /**
     * load template into primary storage
     *
     * @param string $templateId template ID of the template to be prepared in primary storage(s).
     * @param string $zoneId zone ID of the template to be prepared in primary storage(s).
     */
    public function prepareTemplate($templateId, $zoneId) {
        if (empty($templateId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateId"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("prepareTemplate",
            array(
                'templateid' => $templateId,
                'zoneid' => $zoneId
            )
        );
    }

    /**
     * Upgrades router to use newer template
     *
     * @param array  $optArgs {
     *     @type string $account upgrades all routers owned by the specified account
     *     @type string $clusterId upgrades all routers within the specified cluster
     *     @type string $domainId upgrades all routers owned by the specified domain
     *     @type string $id upgrades router with the specified Id
     *     @type string $podId upgrades all routers within the specified pod
     *     @type string $zoneId upgrades all routers within the specified zone
     * }
     */
    public function upgradeRouterTemplate(array $optArgs = array()) {
        return $this->request("upgradeRouterTemplate",
            $optArgs
        );
    }

    /**
     * List templates in ucs manager
     *
     * @param string $ucsManagerId the id for the ucs manager
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listUcsTemplates($ucsManagerId, array $optArgs = array()) {
        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }
        return $this->request("listUcsTemplates",
            array_merge(array(
                'ucsmanagerid' => $ucsManagerId
            ), $optArgs)
        );
    }

    /**
     * create a profile of template and associate to a blade
     *
     * @param string $bladeId blade id
     * @param string $templateDn template dn
     * @param string $ucsManagerId ucs manager id
     * @param array  $optArgs {
     *     @type string $profileName profile name
     * }
     */
    public function instantiateUcsTemplateAndAssocaciateToBlade($bladeId, $templateDn, $ucsManagerId, array $optArgs = array()) {
        if (empty($bladeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bladeId"), MISSING_ARGUMENT);
        }
        if (empty($templateDn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "templateDn"), MISSING_ARGUMENT);
        }
        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }
        return $this->request("instantiateUcsTemplateAndAssocaciateToBlade",
            array_merge(array(
                'bladeid' => $bladeId,
                'templatedn' => $templateDn,
                'ucsmanagerid' => $ucsManagerId
            ), $optArgs)
        );
    }

    /**
     * Creates a user for an account that already exists
     *
     * @param string $account Creates the user under the specified account. If no account is specified, the
     * username will be used as the account name.
     * @param string $email email
     * @param string $firstName firstname
     * @param string $lastname lastname
     * @param string $password Clear text password (Default hashed to SHA256SALT). If you wish to use any other
     * hashing algorithm, you would need to write a custom authentication adapter See
     * Docs section.
     * @param string $userName Unique username.
     * @param array  $optArgs {
     *     @type string $domainId Creates the user under the specified domain. Has to be accompanied with the
     *     account parameter
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone
     *     parameter, see Time Zone Format.
     *     @type string $userId User UUID, required for adding account from external provisioning system
     * }
     */
    public function createUser($account, $email, $firstName, $lastname, $password, $userName, array $optArgs = array()) {
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($email)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "email"), MISSING_ARGUMENT);
        }
        if (empty($firstName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "firstName"), MISSING_ARGUMENT);
        }
        if (empty($lastname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lastname"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("createUser",
            array_merge(array(
                'account' => $account,
                'email' => $email,
                'firstname' => $firstName,
                'lastname' => $lastname,
                'password' => $password,
                'username' => $userName
            ), $optArgs)
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
     * Updates a user account
     *
     * @param string $id User uuid
     * @param array  $optArgs {
     *     @type string $email email
     *     @type string $firstName first name
     *     @type string $lastname last name
     *     @type string $password Clear text password (default hashed to SHA256SALT). If you wish to use any other
     *     hasing algorithm, you would need to write a custom authentication adapter
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone
     *     parameter, see Time Zone Format.
     *     @type string $userApiKey The API key for the user. Must be specified with userSecretKey
     *     @type string $userName Unique username
     *     @type string $userSecretKey The secret key for the user. Must be specified with userApiKey
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
     * Lists user accounts
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $accountType List users by account type. Valid types include admin, domain-admin,
     *     read-only-admin, or user.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id List user by ID.
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $state List users by state of the user account.
     *     @type string $userName List user by the username
     * }
     */
    public function listUsers(array $optArgs = array()) {
        return $this->request("listUsers",
            $optArgs
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
     * Find user account by API key
     *
     * @param string $userApiKey API key of the user
     */
    public function getUser($userApiKey) {
        if (empty($userApiKey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userApiKey"), MISSING_ARGUMENT);
        }
        return $this->request("getUser",
            array(
                'userapikey' => $userApiKey
            )
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
     * Lists all LDAP Users
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $listType Determines whether all ldap users are returned or just non-cloudstack users
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listLdapUsers(array $optArgs = array()) {
        return $this->request("listLdapUsers",
            $optArgs
        );
    }

    /**
     * Import LDAP users
     *
     * @param string $accountType Type of the account.  Specify 0 for user, 1 for root admin, and 2 for domain
     * admin
     * @param array  $optArgs {
     *     @type string $accountDetails details for account used to store specific parameters
     *     @type string $domainId Specifies the domain to which the ldap users are to be imported. If no domain is
     *     specified, a domain will created using group parameter. If the group is also not
     *     specified, a domain name based on the OU information will be created. If no OU
     *     hierarchy exists, will be defaulted to ROOT domain
     *     @type string $group Specifies the group name from which the ldap users are to be imported. If no
     *     group is specified, all the users will be imported.
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone
     *     parameter, see Time Zone Format.
     * }
     */
    public function importLdapUsers($accountType, array $optArgs = array()) {
        if (empty($accountType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accountType"), MISSING_ARGUMENT);
        }
        return $this->request("importLdapUsers",
            array_merge(array(
                'accounttype' => $accountType
            ), $optArgs)
        );
    }

    /**
     * Adds traffic type to a physical network
     *
     * @param string $physicalNetworkId the Physical Network ID
     * @param string $trafficType the trafficType to be added to the physical network
     * @param array  $optArgs {
     *     @type string $hypervNetworkLabel The network name label of the physical device dedicated to this traffic on a
     *     Hyperv host
     *     @type string $isolationMethod Used if physical network has multiple isolation types and traffic type is
     *     public. Choose which isolation method. Valid options currently 'vlan' or
     *     'vxlan', defaults to 'vlan'.
     *     @type string $kvmNetworkLabel The network name label of the physical device dedicated to this traffic on a KVM
     *     host
     *     @type string $vlan The VLAN id to be used for Management traffic by VMware host
     *     @type string $vmwareNetworkLabel The network name label of the physical device dedicated to this traffic on a
     *     VMware host
     *     @type string $xenNetworkLabel The network name label of the physical device dedicated to this traffic on a
     *     XenServer host
     * }
     */
    public function addTrafficType($physicalNetworkId, $trafficType, array $optArgs = array()) {
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($trafficType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "trafficType"), MISSING_ARGUMENT);
        }
        return $this->request("addTrafficType",
            array_merge(array(
                'physicalnetworkid' => $physicalNetworkId,
                'traffictype' => $trafficType
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
     * Lists traffic types of a given physical network.
     *
     * @param string $physicalNetworkId the Physical Network ID
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listTrafficTypes($physicalNetworkId, array $optArgs = array()) {
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        return $this->request("listTrafficTypes",
            array_merge(array(
                'physicalnetworkid' => $physicalNetworkId
            ), $optArgs)
        );
    }

    /**
     * Updates traffic type of a physical network
     *
     * @param string $id traffic type id
     * @param array  $optArgs {
     *     @type string $hypervNetworkLabel The network name label of the physical device dedicated to this traffic on a
     *     Hyperv host
     *     @type string $kvmNetworkLabel The network name label of the physical device dedicated to this traffic on a KVM
     *     host
     *     @type string $vmwareNetworkLabel The network name label of the physical device dedicated to this traffic on a
     *     VMware host
     *     @type string $xenNetworkLabel The network name label of the physical device dedicated to this traffic on a
     *     XenServer host
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
     * Lists implementors of implementor of a network traffic type or implementors of
     * all network traffic types
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $trafficType Optional. The network traffic type, if specified, return its implementor.
     *     Otherwise, return all traffic types with their implementor
     * }
     */
    public function listTrafficTypeImplementors(array $optArgs = array()) {
        return $this->request("listTrafficTypeImplementors",
            $optArgs
        );
    }

    /**
     * Generates usage records. This will generate records only if there any records to
     * be generated, i.e if the scheduled usage job was not run or failed
     *
     * @param string $endDate End date range for usage record query. Use yyyy-MM-dd as the date format, e.g.
     * startDate=2009-06-03.
     * @param string $startDate Start date range for usage record query. Use yyyy-MM-dd as the date format, e.g.
     * startDate=2009-06-01.
     * @param array  $optArgs {
     *     @type string $domainId List events for the specified domain.
     * }
     */
    public function generateUsageRecords($endDate, $startDate, array $optArgs = array()) {
        if (empty($endDate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "endDate"), MISSING_ARGUMENT);
        }
        if (empty($startDate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startDate"), MISSING_ARGUMENT);
        }
        return $this->request("generateUsageRecords",
            array_merge(array(
                'enddate' => $endDate,
                'startdate' => $startDate
            ), $optArgs)
        );
    }

    /**
     * Lists usage records for accounts
     *
     * @param string $endDate End date range for usage record query. Use yyyy-MM-dd as the date format, e.g.
     * startDate=2009-06-03.
     * @param string $startDate Start date range for usage record query. Use yyyy-MM-dd as the date format, e.g.
     * startDate=2009-06-01.
     * @param array  $optArgs {
     *     @type string $account List usage records for the specified user.
     *     @type string $accountId List usage records for the specified account
     *     @type string $domainId List usage records for the specified domain.
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId List usage records for specified project
     *     @type string $type List usage records for the specified usage type
     * }
     */
    public function listUsageRecords($endDate, $startDate, array $optArgs = array()) {
        if (empty($endDate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "endDate"), MISSING_ARGUMENT);
        }
        if (empty($startDate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startDate"), MISSING_ARGUMENT);
        }
        return $this->request("listUsageRecords",
            array_merge(array(
                'enddate' => $endDate,
                'startdate' => $startDate
            ), $optArgs)
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
     * Adds Traffic Monitor Host for Direct Network Usage
     *
     * @param string $url URL of the traffic monitor Host
     * @param string $zoneId Zone in which to add the external firewall appliance.
     * @param array  $optArgs {
     *     @type string $excludeZones Traffic going into the listed zones will not be metered
     *     @type string $includeZones Traffic going into the listed zones will be metered
     * }
     */
    public function addTrafficMonitor($url, $zoneId, array $optArgs = array()) {
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("addTrafficMonitor",
            array_merge(array(
                'url' => $url,
                'zoneid' => $zoneId
            ), $optArgs)
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
     * List traffic monitor Hosts.
     *
     * @param string $zoneId zone Id
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listTrafficMonitors($zoneId, array $optArgs = array()) {
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("listTrafficMonitors",
            array_merge(array(
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Creates an instant snapshot of a volume.
     *
     * @param string $volumeId The ID of the disk volume
     * @param array  $optArgs {
     *     @type string $account The account of the snapshot. The account parameter must be used with the
     *     domainId parameter.
     *     @type string $domainId The domain ID of the snapshot. If used with the account parameter, specifies a
     *     domain for the account associated with the disk volume.
     *     @type string $policyId policy id of the snapshot, if this is null, then use MANUAL_POLICY.
     *     @type string $quiesceVm quiesce vm if true
     * }
     */
    public function createSnapshot($volumeId, array $optArgs = array()) {
        if (empty($volumeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeId"), MISSING_ARGUMENT);
        }
        return $this->request("createSnapshot",
            array_merge(array(
                'volumeid' => $volumeId
            ), $optArgs)
        );
    }

    /**
     * Lists all available snapshots for the account.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id lists snapshot by snapshot ID
     *     @type string $intervalType valid values are HOURLY, DAILY, WEEKLY, and MONTHLY.
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name lists snapshot by snapshot name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $snapshotType valid values are MANUAL or RECURRING.
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $volumeId the ID of the disk volume
     *     @type string $zoneId list snapshots by zone id
     * }
     */
    public function listSnapshots(array $optArgs = array()) {
        return $this->request("listSnapshots",
            $optArgs
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
     * Creates a snapshot policy for the account.
     *
     * @param string $intervalType valid values are HOURLY, DAILY, WEEKLY, and MONTHLY
     * @param string $maxSnaps maximum number of snapshots to retain
     * @param string $schedule time the snapshot is scheduled to be taken. Format is:* if HOURLY, MM* if DAILY,
     * MM:HH* if WEEKLY, MM:HH:DD (1-7)* if MONTHLY, MM:HH:DD (1-28)
     * @param string $timezone Specifies a timezone for this command. For more information on the timezone
     * parameter, see Time Zone Format.
     * @param string $volumeId the ID of the disk volume
     */
    public function createSnapshotPolicy($intervalType, $maxSnaps, $schedule, $timezone, $volumeId) {
        if (empty($intervalType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "intervalType"), MISSING_ARGUMENT);
        }
        if (empty($maxSnaps)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "maxSnaps"), MISSING_ARGUMENT);
        }
        if (empty($schedule)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "schedule"), MISSING_ARGUMENT);
        }
        if (empty($timezone)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "timezone"), MISSING_ARGUMENT);
        }
        if (empty($volumeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeId"), MISSING_ARGUMENT);
        }
        return $this->request("createSnapshotPolicy",
            array(
                'intervaltype' => $intervalType,
                'maxsnaps' => $maxSnaps,
                'schedule' => $schedule,
                'timezone' => $timezone,
                'volumeid' => $volumeId
            )
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
     * Lists snapshot policies.
     *
     * @param string $volumeId the ID of the disk volume
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listSnapshotPolicies($volumeId, array $optArgs = array()) {
        if (empty($volumeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "volumeId"), MISSING_ARGUMENT);
        }
        return $this->request("listSnapshotPolicies",
            array_merge(array(
                'volumeid' => $volumeId
            ), $optArgs)
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

    /**
     * List virtual machine snapshot by conditions
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name lists snapshot by snapshot name or display name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $state state of the virtual machine snapshot
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $virtualMachineId the ID of the vm
     *     @type string $vmSnapshotId The ID of the VM snapshot
     * }
     */
    public function listVMSnapshot(array $optArgs = array()) {
        return $this->request("listVMSnapshot",
            $optArgs
        );
    }

    /**
     * Creates snapshot for a vm.
     *
     * @param string $virtualMachineId The ID of the vm
     * @param array  $optArgs {
     *     @type string $description The discription of the snapshot
     *     @type string $name The display name of the snapshot
     *     @type string $quiesceVm quiesce vm if true
     *     @type string $snapshotMemory snapshot memory if true
     * }
     */
    public function createVMSnapshot($virtualMachineId, array $optArgs = array()) {
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("createVMSnapshot",
            array_merge(array(
                'virtualmachineid' => $virtualMachineId
            ), $optArgs)
        );
    }

    /**
     * Deletes a vmsnapshot.
     *
     * @param string $vmSnapshotId The ID of the VM snapshot
     */
    public function deleteVMSnapshot($vmSnapshotId) {
        if (empty($vmSnapshotId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vmSnapshotId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteVMSnapshot",
            array(
                'vmsnapshotid' => $vmSnapshotId
            )
        );
    }

    /**
     * Revert VM from a vmsnapshot.
     *
     * @param string $vmSnapshotId The ID of the vm snapshot
     */
    public function revertToVMSnapshot($vmSnapshotId) {
        if (empty($vmSnapshotId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vmSnapshotId"), MISSING_ARGUMENT);
        }
        return $this->request("revertToVMSnapshot",
            array(
                'vmsnapshotid' => $vmSnapshotId
            )
        );
    }

    /**
     * Creates an account
     *
     * @param string $accountType Type of the account.  Specify 0 for user, 1 for root admin, and 2 for domain
     * admin
     * @param string $email email
     * @param string $firstName firstname
     * @param string $lastname lastname
     * @param string $password Clear text password (Default hashed to SHA256SALT). If you wish to use any other
     * hashing algorithm, you would need to write a custom authentication adapter See
     * Docs section.
     * @param string $userName Unique username.
     * @param array  $optArgs {
     *     @type string $account Creates the user under the specified account. If no account is specified, the
     *     username will be used as the account name.
     *     @type string $accountDetails details for account used to store specific parameters
     *     @type string $accountId Account UUID, required for adding account from external provisioning system
     *     @type string $domainId Creates the user under the specified domain.
     *     @type string $networkDomain Network domain for the account's networks
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone
     *     parameter, see Time Zone Format.
     *     @type string $userId User UUID, required for adding account from external provisioning system
     * }
     */
    public function createAccount($accountType, $email, $firstName, $lastname, $password, $userName, array $optArgs = array()) {
        if (empty($accountType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accountType"), MISSING_ARGUMENT);
        }
        if (empty($email)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "email"), MISSING_ARGUMENT);
        }
        if (empty($firstName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "firstName"), MISSING_ARGUMENT);
        }
        if (empty($lastname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "lastname"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("createAccount",
            array_merge(array(
                'accounttype' => $accountType,
                'email' => $email,
                'firstname' => $firstName,
                'lastname' => $lastname,
                'password' => $password,
                'username' => $userName
            ), $optArgs)
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
     * Updates account information for the authenticated user
     *
     * @param string $newName new name for the account
     * @param array  $optArgs {
     *     @type string $account the current account name
     *     @type string $accountDetails details for account used to store specific parameters
     *     @type string $domainId the ID of the domain where the account exists
     *     @type string $id Account id
     *     @type string $networkDomain Network domain for the account's networks; empty string will update domainName
     *     with NULL value
     * }
     */
    public function updateAccount($newName, array $optArgs = array()) {
        if (empty($newName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "newName"), MISSING_ARGUMENT);
        }
        return $this->request("updateAccount",
            array_merge(array(
                'newname' => $newName
            ), $optArgs)
        );
    }

    /**
     * Disables an account
     *
     * @param string $lock If true, only lock the account; else disable the account
     * @param array  $optArgs {
     *     @type string $account Disables specified account.
     *     @type string $domainId Disables specified account in this domain.
     *     @type string $id Account id
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
     * Enables an account
     *
     * @param array  $optArgs {
     *     @type string $account Enables specified account.
     *     @type string $domainId Enables specified account in this domain.
     *     @type string $id Account id
     * }
     */
    public function enableAccount(array $optArgs = array()) {
        return $this->request("enableAccount",
            $optArgs
        );
    }

    /**
     * Locks an account
     *
     * @param string $account Locks the specified account.
     * @param string $domainId Locks the specified account on this domain.
     */
    public function lockAccount($account, $domainId) {
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }
        return $this->request("lockAccount",
            array(
                'account' => $account,
                'domainid' => $domainId
            )
        );
    }

    /**
     * Lists accounts and provides detailed account information for listed accounts
     *
     * @param array  $optArgs {
     *     @type string $accountType list accounts by account type. Valid account types are 1 (admin), 2
     *     (domain-admin), and 0 (user).
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id list account by account ID
     *     @type string $isCleanUpRequired list accounts by cleanuprequred attribute (values are true or false)
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name list account by account name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $state list accounts by state. Valid states are enabled, disabled, and locked.
     * }
     */
    public function listAccounts(array $optArgs = array()) {
        return $this->request("listAccounts",
            $optArgs
        );
    }

    /**
     * Marks a default zone for this account
     *
     * @param string $account Name of the account that is to be marked.
     * @param string $domainId Marks the account that belongs to the specified domain.
     * @param string $zoneId The Zone ID with which the account is to be marked.
     */
    public function markDefaultZoneForAccount($account, $domainId, $zoneId) {
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("markDefaultZoneForAccount",
            array(
                'account' => $account,
                'domainid' => $domainId,
                'zoneid' => $zoneId
            )
        );
    }

    /**
     * Adds acoount to a project
     *
     * @param string $projectId id of the project to add the account to
     * @param array  $optArgs {
     *     @type string $account name of the account to be added to the project
     *     @type string $email email to which invitation to the project is going to be sent
     * }
     */
    public function addAccountToProject($projectId, array $optArgs = array()) {
        if (empty($projectId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectId"), MISSING_ARGUMENT);
        }
        return $this->request("addAccountToProject",
            array_merge(array(
                'projectid' => $projectId
            ), $optArgs)
        );
    }

    /**
     * Deletes account from the project
     *
     * @param string $account name of the account to be removed from the project
     * @param string $projectId id of the project to remove the account from
     */
    public function deleteAccountFromProject($account, $projectId) {
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($projectId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteAccountFromProject",
            array(
                'account' => $account,
                'projectid' => $projectId
            )
        );
    }

    /**
     * Lists project's accounts
     *
     * @param string $projectId id of the project
     * @param array  $optArgs {
     *     @type string $account list accounts of the project by account name
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $role list accounts of the project by role
     * }
     */
    public function listProjectAccounts($projectId, array $optArgs = array()) {
        if (empty($projectId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectId"), MISSING_ARGUMENT);
        }
        return $this->request("listProjectAccounts",
            array_merge(array(
                'projectid' => $projectId
            ), $optArgs)
        );
    }

    /**
     * Creates a Zone.
     *
     * @param string $dns1 the first DNS for the Zone
     * @param string $internalDns1 the first internal DNS for the Zone
     * @param string $name the name of the Zone
     * @param string $networkType network type of the zone, can be Basic or Advanced
     * @param array  $optArgs {
     *     @type string $allocationState Allocation state of this Zone for allocation of new resources
     *     @type string $dns2 the second DNS for the Zone
     *     @type string $domain Network domain name for the networks in the zone
     *     @type string $domainId the ID of the containing domain, null for public zones
     *     @type string $guestCidrAddress the guest CIDR address for the Zone
     *     @type string $internalDns2 the second internal DNS for the Zone
     *     @type string $ip6Dns1 the first DNS for IPv6 network in the Zone
     *     @type string $ip6Dns2 the second DNS for IPv6 network in the Zone
     *     @type string $localStorageEnabled true if local storage offering enabled, false otherwise
     *     @type string $securityGroupEnabled true if network is security group enabled, false otherwise
     * }
     */
    public function createZone($dns1, $internalDns1, $name, $networkType, array $optArgs = array()) {
        if (empty($dns1)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "dns1"), MISSING_ARGUMENT);
        }
        if (empty($internalDns1)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "internalDns1"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($networkType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "networkType"), MISSING_ARGUMENT);
        }
        return $this->request("createZone",
            array_merge(array(
                'dns1' => $dns1,
                'internaldns1' => $internalDns1,
                'name' => $name,
                'networktype' => $networkType
            ), $optArgs)
        );
    }

    /**
     * Updates a Zone.
     *
     * @param string $id the ID of the Zone
     * @param array  $optArgs {
     *     @type string $allocationState Allocation state of this cluster for allocation of new resources
     *     @type string $details the details for the Zone
     *     @type string $dhcpProvider the dhcp Provider for the Zone
     *     @type string $dns1 the first DNS for the Zone
     *     @type string $dns2 the second DNS for the Zone
     *     @type string $dnsSearchOrder the dns search order list
     *     @type string $domain Network domain name for the networks in the zone; empty string will update
     *     domain with NULL value
     *     @type string $guestCidrAddress the guest CIDR address for the Zone
     *     @type string $internalDns1 the first internal DNS for the Zone
     *     @type string $internalDns2 the second internal DNS for the Zone
     *     @type string $ip6Dns1 the first DNS for IPv6 network in the Zone
     *     @type string $ip6Dns2 the second DNS for IPv6 network in the Zone
     *     @type string $isPublic updates a private zone to public if set, but not vice-versa
     *     @type string $localStorageEnabled true if local storage offering enabled, false otherwise
     *     @type string $name the name of the Zone
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
     * Lists zones
     *
     * @param array  $optArgs {
     *     @type string $available true if you want to retrieve all available Zones. False if you only want to
     *     return the Zones from which you have at least one VM. Default is false.
     *     @type string $domainId the ID of the domain associated with the zone
     *     @type string $id the ID of the zone
     *     @type string $keyword List by keyword
     *     @type string $name the name of the zone
     *     @type string $networkType the network type of the zone that the virtual machine belongs to
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $showCapacities flag to display the capacity of the zones
     *     @type string $tags List zones by resource tags (key/value pairs)
     * }
     */
    public function listZones(array $optArgs = array()) {
        return $this->request("listZones",
            $optArgs
        );
    }

    /**
     * Adds a VMware datacenter to specified zone
     *
     * @param string $name Name of VMware datacenter to be added to specified zone.
     * @param string $vCenter The name/ip of vCenter. Make sure it is IP address or full qualified domain name
     * for host running vCenter server.
     * @param string $zoneId The Zone ID.
     * @param array  $optArgs {
     *     @type string $password The password for specified username.
     *     @type string $userName The Username required to connect to resource.
     * }
     */
    public function addVmwareDc($name, $vCenter, $zoneId, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($vCenter)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vCenter"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("addVmwareDc",
            array_merge(array(
                'name' => $name,
                'vcenter' => $vCenter,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Remove a VMware datacenter from a zone.
     *
     * @param string $zoneId The id of Zone from which VMware datacenter has to be removed.
     */
    public function removeVmwareDc($zoneId) {
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("removeVmwareDc",
            array(
                'zoneid' => $zoneId
            )
        );
    }

    /**
     * Retrieves VMware DC(s) associated with a zone.
     *
     * @param string $zoneId Id of the CloudStack zone.
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listVmwareDcs($zoneId, array $optArgs = array()) {
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("listVmwareDcs",
            array_merge(array(
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Dedicates a zones.
     *
     * @param string $domainId the ID of the containing domain
     * @param string $zoneId the ID of the zone
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     */
    public function dedicateZone($domainId, $zoneId, array $optArgs = array()) {
        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("dedicateZone",
            array_merge(array(
                'domainid' => $domainId,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Release dedication of zone
     *
     * @param string $zoneId the ID of the Zone
     */
    public function releaseDedicatedZone($zoneId) {
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("releaseDedicatedZone",
            array(
                'zoneid' => $zoneId
            )
        );
    }

    /**
     * List dedicated zones.
     *
     * @param array  $optArgs {
     *     @type string $account the name of the account associated with the zone. Must be used with domainId.
     *     @type string $affinityGroupId list dedicated zones by affinity group
     *     @type string $domainId the ID of the domain associated with the zone
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $zoneId the ID of the Zone
     * }
     */
    public function listDedicatedZones(array $optArgs = array()) {
        return $this->request("listDedicatedZones",
            $optArgs
        );
    }

    /**
     * Attaches an ISO to a virtual machine.
     *
     * @param string $id the ID of the ISO file
     * @param string $virtualMachineId the ID of the virtual machine
     */
    public function attachIso($id, $virtualMachineId) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("attachIso",
            array(
                'id' => $id,
                'virtualmachineid' => $virtualMachineId
            )
        );
    }

    /**
     * Detaches any ISO file (if any) currently attached to a virtual machine.
     *
     * @param string $virtualMachineId The ID of the virtual machine
     */
    public function detachIso($virtualMachineId) {
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("detachIso",
            array(
                'virtualmachineid' => $virtualMachineId
            )
        );
    }

    /**
     * Lists all available ISO files.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $bootable true if the ISO is bootable, false otherwise
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $hypervisor the hypervisor for which to restrict the search
     *     @type string $id list ISO by id
     *     @type string $isoFilter possible values are "featured", "self",
     *     "selfexecutable","sharedexecutable","executable", and "community". * featured :
     *     templates that have been marked as featured and public. * self : templates that
     *     have been registered or created by the calling user. * selfexecutable : same as
     *     self, but only returns templates that can be used to deploy a new VM. *
     *     sharedexecutable : templates ready to be deployed that have been granted to the
     *     calling user by another user. * executable : templates that are owned by the
     *     calling user, or public templates, that can be used to deploy a VM. * community
     *     : templates that have been marked as public but not featured. * all : all
     *     templates (only usable by admins).
     *     @type string $isPublic true if the ISO is publicly available to all users, false otherwise.
     *     @type string $isReady true if this ISO is ready to be deployed
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name list all isos by name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $showRemoved show removed ISOs as well
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $zoneId the ID of the zone
     * }
     */
    public function listIsos(array $optArgs = array()) {
        return $this->request("listIsos",
            $optArgs
        );
    }

    /**
     * Registers an existing ISO into the CloudStack Cloud.
     *
     * @param string $displayText the display text of the ISO. This is usually used for display purposes.
     * @param string $name the name of the ISO
     * @param string $url the URL to where the ISO is currently being hosted
     * @param string $zoneId the ID of the zone you wish to register the ISO to.
     * @param array  $optArgs {
     *     @type string $account an optional account name. Must be used with domainId.
     *     @type string $bootable true if this ISO is bootable. If not passed explicitly its assumed to be true
     *     @type string $checksum the MD5 checksum value of this ISO
     *     @type string $domainId an optional domainId. If the account parameter is used, domainId must also be
     *     used.
     *     @type string $imageStoreUuid Image store uuid
     *     @type string $isDynamicallyScalable true if iso contains XS/VMWare tools inorder to support dynamic scaling of VM
     *     cpu/memory
     *     @type string $isExtractable true if the iso or its derivatives are extractable; default is false
     *     @type string $isFeatured true if you want this ISO to be featured
     *     @type string $isPublic true if you want to register the ISO to be publicly available to all users,
     *     false otherwise.
     *     @type string $osTypeId the ID of the OS Type that best represents the OS of this ISO. If the iso is
     *     bootable this parameter needs to be passed
     *     @type string $projectId Register iso for the project
     * }
     */
    public function registerIso($displayText, $name, $url, $zoneId, array $optArgs = array()) {
        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("registerIso",
            array_merge(array(
                'displaytext' => $displayText,
                'name' => $name,
                'url' => $url,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Updates an ISO file.
     *
     * @param string $id the ID of the image file
     * @param array  $optArgs {
     *     @type string $bootable true if image is bootable, false otherwise
     *     @type string $displayText the display text of the image
     *     @type string $format the format for the image
     *     @type string $isDynamicallyScalable true if template/ISO contains XS/VMWare tools inorder to support dynamic scaling
     *     of VM cpu/memory
     *     @type string $isRouting true if the template type is routing i.e., if template is used to deploy router
     *     @type string $name the name of the image file
     *     @type string $osTypeId the ID of the OS type that best represents the OS of this image.
     *     @type string $passwordEnabled true if the image supports the password reset feature; default is false
     *     @type string $sortKey sort key of the template, integer
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
     * Deletes an ISO file.
     *
     * @param string $id the ID of the ISO file
     * @param array  $optArgs {
     *     @type string $zoneId the ID of the zone of the ISO file. If not specified, the ISO will be deleted
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
     * Copies an iso from one zone to another.
     *
     * @param string $id Template ID.
     * @param string $destzoneId ID of the zone the template is being copied to.
     * @param array  $optArgs {
     *     @type string $sourceZoneId ID of the zone the template is currently hosted on. If not specified and
     *     template is cross-zone, then we will sync this template to region wide image
     *     store
     * }
     */
    public function copyIso($id, $destzoneId, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($destzoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "destzoneId"), MISSING_ARGUMENT);
        }
        return $this->request("copyIso",
            array_merge(array(
                'id' => $id,
                'destzoneid' => $destzoneId
            ), $optArgs)
        );
    }

    /**
     * Updates iso permissions
     *
     * @param string $id the template ID
     * @param array  $optArgs {
     *     @type string $accounts a comma delimited list of accounts. If specified, "op" parameter has to be
     *     passed in.
     *     @type string $isExtractable true if the template/iso is extractable, false other wise. Can be set only by
     *     root admin
     *     @type string $isFeatured true for featured template/iso, false otherwise
     *     @type string $isPublic true for public template/iso, false for private templates/isos
     *     @type string $op permission operator (add, remove, reset)
     *     @type string $projectids a comma delimited list of projects. If specified, "op" parameter has to be
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
     * Extracts an ISO
     *
     * @param string $id the ID of the ISO file
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param array  $optArgs {
     *     @type string $url the url to which the ISO would be extracted
     *     @type string $zoneId the ID of the zone where the ISO is originally located
     * }
     */
    public function extractIso($id, $mode, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($mode)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "mode"), MISSING_ARGUMENT);
        }
        return $this->request("extractIso",
            array_merge(array(
                'id' => $id,
                'mode' => $mode
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
     * Retrieves a Cisco Nexus 1000v Virtual Switch Manager device associated with a
     * Cluster
     *
     * @param array  $optArgs {
     *     @type string $clusterId Id of the CloudStack cluster in which the Cisco Nexus 1000v VSM appliance.
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $zoneId Id of the CloudStack cluster in which the Cisco Nexus 1000v VSM appliance.
     * }
     */
    public function listCiscoNexusVSMs(array $optArgs = array()) {
        return $this->request("listCiscoNexusVSMs",
            $optArgs
        );
    }

    /**
     * Adds a Cisco Vnmc Controller
     *
     * @param string $hostname Hostname or ip address of the Cisco VNMC Controller.
     * @param string $password Credentials to access the Cisco VNMC Controller API
     * @param string $physicalNetworkId the Physical Network ID
     * @param string $userName Credentials to access the Cisco VNMC Controller API
     */
    public function addCiscoVnmcResource($hostname, $password, $physicalNetworkId, $userName) {
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("addCiscoVnmcResource",
            array(
                'hostname' => $hostname,
                'password' => $password,
                'physicalnetworkid' => $physicalNetworkId,
                'username' => $userName
            )
        );
    }

    /**
     * Deletes a Cisco Vnmc controller
     *
     * @param string $resourceId Cisco Vnmc resource ID
     */
    public function deleteCiscoVnmcResource($resourceId) {
        if (empty($resourceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteCiscoVnmcResource",
            array(
                'resourceid' => $resourceId
            )
        );
    }

    /**
     * Lists Cisco VNMC controllers
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId the Physical Network ID
     *     @type string $resourceId Cisco VNMC resource ID
     * }
     */
    public function listCiscoVnmcResources(array $optArgs = array()) {
        return $this->request("listCiscoVnmcResources",
            $optArgs
        );
    }

    /**
     * Adds a Cisco Asa 1000v appliance
     *
     * @param string $clusterId the Cluster ID
     * @param string $hostname Hostname or ip address of the Cisco ASA 1000v appliance.
     * @param string $insidePortProfile Nexus port profile associated with inside interface of ASA 1000v
     * @param string $physicalNetworkId the Physical Network ID
     */
    public function addCiscoAsa1000vResource($clusterId, $hostname, $insidePortProfile, $physicalNetworkId) {
        if (empty($clusterId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterId"), MISSING_ARGUMENT);
        }
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }
        if (empty($insidePortProfile)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "insidePortProfile"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        return $this->request("addCiscoAsa1000vResource",
            array(
                'clusterid' => $clusterId,
                'hostname' => $hostname,
                'insideportprofile' => $insidePortProfile,
                'physicalnetworkid' => $physicalNetworkId
            )
        );
    }

    /**
     * Deletes a Cisco ASA 1000v appliance
     *
     * @param string $resourceId Cisco ASA 1000v resource ID
     */
    public function deleteCiscoAsa1000vResource($resourceId) {
        if (empty($resourceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteCiscoAsa1000vResource",
            array(
                'resourceid' => $resourceId
            )
        );
    }

    /**
     * Lists Cisco ASA 1000v appliances
     *
     * @param array  $optArgs {
     *     @type string $hostname Hostname or ip address of the Cisco ASA 1000v appliance.
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId the Physical Network ID
     *     @type string $resourceId Cisco ASA 1000v resource ID
     * }
     */
    public function listCiscoAsa1000vResources(array $optArgs = array()) {
        return $this->request("listCiscoAsa1000vResources",
            $optArgs
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
     * Upgrades domain router to a new service offering
     *
     * @param string $id The ID of the router
     * @param string $serviceOfferingId the service offering ID to apply to the domain router
     */
    public function changeServiceForRouter($id, $serviceOfferingId) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }
        return $this->request("changeServiceForRouter",
            array(
                'id' => $id,
                'serviceofferingid' => $serviceOfferingId
            )
        );
    }

    /**
     * List routers.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $clusterId the cluster ID of the router
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $forVpc if true is passed for this parameter, list only VPC routers
     *     @type string $hostId the host ID of the router
     *     @type string $id the ID of the disk router
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name the name of the router
     *     @type string $networkId list by network id
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $podId the Pod ID of the router
     *     @type string $projectId list objects by project
     *     @type string $state the state of the router
     *     @type string $version list virtual router elements by version
     *     @type string $vpcId List networks by VPC
     *     @type string $zoneId the Zone ID of the router
     * }
     */
    public function listRouters(array $optArgs = array()) {
        return $this->request("listRouters",
            $optArgs
        );
    }

    /**
     * Lists all available virtual router elements.
     *
     * @param array  $optArgs {
     *     @type string $enabled list network offerings by enabled state
     *     @type string $id list virtual router elements by id
     *     @type string $keyword List by keyword
     *     @type string $nspId list virtual router elements by network service provider id
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listVirtualRouterElements(array $optArgs = array()) {
        return $this->request("listVirtualRouterElements",
            $optArgs
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
     * Create a virtual router element.
     *
     * @param string $nspId the network service provider ID of the virtual router element
     * @param array  $optArgs {
     *     @type string $providerType The provider type. Supported types are VirtualRouter (default) and
     *     VPCVirtualRouter
     * }
     */
    public function createVirtualRouterElement($nspId, array $optArgs = array()) {
        if (empty($nspId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nspId"), MISSING_ARGUMENT);
        }
        return $this->request("createVirtualRouterElement",
            array_merge(array(
                'nspid' => $nspId
            ), $optArgs)
        );
    }

    /**
     * Creates a project
     *
     * @param string $displayText display text of the project
     * @param string $name name of the project
     * @param array  $optArgs {
     *     @type string $account account who will be Admin for the project
     *     @type string $domainId domain ID of the account owning a project
     * }
     */
    public function createProject($displayText, $name, array $optArgs = array()) {
        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createProject",
            array_merge(array(
                'displaytext' => $displayText,
                'name' => $name
            ), $optArgs)
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
     * Updates a project
     *
     * @param string $id id of the project to be modified
     * @param array  $optArgs {
     *     @type string $account new Admin account for the project
     *     @type string $displayText display text of the project
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
     * Lists projects and provides detailed information for listed projects
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $displayText list projects by display text
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id list projects by project ID
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name list projects by name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $state list projects by state
     *     @type string $tags List projects by tags (key/value pairs)
     * }
     */
    public function listProjects(array $optArgs = array()) {
        return $this->request("listProjects",
            $optArgs
        );
    }

    /**
     * Lists projects and provides detailed information for listed projects
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $activeOnly if true, list only active invitations - having Pending state and ones that are
     *     not timed out yet
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id list invitations by id
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list by project id
     *     @type string $state list invitations by state
     * }
     */
    public function listProjectInvitations(array $optArgs = array()) {
        return $this->request("listProjectInvitations",
            $optArgs
        );
    }

    /**
     * Accepts or declines project invitation
     *
     * @param string $projectId id of the project to join
     * @param array  $optArgs {
     *     @type string $accept if true, accept the invitation, decline if false. True by default
     *     @type string $account account that is joining the project
     *     @type string $token list invitations for specified account; this parameter has to be specified with
     *     domainId
     * }
     */
    public function updateProjectInvitation($projectId, array $optArgs = array()) {
        if (empty($projectId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "projectId"), MISSING_ARGUMENT);
        }
        return $this->request("updateProjectInvitation",
            array_merge(array(
                'projectid' => $projectId
            ), $optArgs)
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
     * Lists storage pools.
     *
     * @param array  $optArgs {
     *     @type string $clusterId list storage pools belongig to the specific cluster
     *     @type string $id the ID of the storage pool
     *     @type string $ipAddress the IP address for the storage pool
     *     @type string $keyword List by keyword
     *     @type string $name the name of the storage pool
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $path the storage pool path
     *     @type string $podId the Pod ID for the storage pool
     *     @type string $scope the ID of the storage pool
     *     @type string $zoneId the Zone ID for the storage pool
     * }
     */
    public function listStoragePools(array $optArgs = array()) {
        return $this->request("listStoragePools",
            $optArgs
        );
    }

    /**
     * Creates a storage pool.
     *
     * @param string $name the name for the storage pool
     * @param string $url the URL of the storage pool
     * @param string $zoneId the Zone ID for the storage pool
     * @param array  $optArgs {
     *     @type string $capacityBytes bytes CloudStack can provision from this storage pool
     *     @type string $capacityIops IOPS CloudStack can provision from this storage pool
     *     @type string $clusterId the cluster ID for the storage pool
     *     @type string $details the details for the storage pool
     *     @type string $hypervisor hypervisor type of the hosts in zone that will be attached to this storage pool.
     *     KVM, VMware supported as of now.
     *     @type string $managed whether the storage should be managed by CloudStack
     *     @type string $podId the Pod ID for the storage pool
     *     @type string $provider the storage provider name
     *     @type string $scope the scope of the storage: cluster or zone
     *     @type string $tags the tags for the storage pool
     * }
     */
    public function createStoragePool($name, $url, $zoneId, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("createStoragePool",
            array_merge(array(
                'name' => $name,
                'url' => $url,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Updates a storage pool.
     *
     * @param string $id the Id of the storage pool
     * @param array  $optArgs {
     *     @type string $capacityBytes bytes CloudStack can provision from this storage pool
     *     @type string $capacityIops IOPS CloudStack can provision from this storage pool
     *     @type string $tags comma-separated list of tags for the storage pool
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
     * Lists storage pools available for migration of a volume.
     *
     * @param string $id the ID of the volume
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
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
     * Create a pool
     *
     * @param string $algorithm algorithm.
     * @param string $name pool name.
     */
    public function createPool($algorithm, $name) {
        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "algorithm"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createPool",
            array(
                'algorithm' => $algorithm,
                'name' => $name
            )
        );
    }

    /**
     * Delete a pool
     *
     * @param string $poolName pool name.
     */
    public function deletePool($poolName) {
        if (empty($poolName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "poolName"), MISSING_ARGUMENT);
        }
        return $this->request("deletePool",
            array(
                'poolname' => $poolName
            )
        );
    }

    /**
     * Modify pool
     *
     * @param string $algorithm algorithm.
     * @param string $poolName pool name.
     */
    public function modifyPool($algorithm, $poolName) {
        if (empty($algorithm)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "algorithm"), MISSING_ARGUMENT);
        }
        if (empty($poolName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "poolName"), MISSING_ARGUMENT);
        }
        return $this->request("modifyPool",
            array(
                'algorithm' => $algorithm,
                'poolname' => $poolName
            )
        );
    }

    /**
     * List Pool
     *
     */
    public function listPools() {
        return $this->request("listPools",
            $optArgs
        );
    }

    /**
     * Adds a Ucs manager
     *
     * @param string $password the password of UCS
     * @param string $url the name of UCS url
     * @param string $userName the username of UCS
     * @param string $zoneId the Zone id for the ucs manager
     * @param array  $optArgs {
     *     @type string $name the name of UCS manager
     * }
     */
    public function addUcsManager($password, $url, $userName, $zoneId, array $optArgs = array()) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("addUcsManager",
            array_merge(array(
                'password' => $password,
                'url' => $url,
                'username' => $userName,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * List ucs manager
     *
     * @param array  $optArgs {
     *     @type string $id the ID of the ucs manager
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $zoneId the zone id
     * }
     */
    public function listUcsManagers(array $optArgs = array()) {
        return $this->request("listUcsManagers",
            $optArgs
        );
    }

    /**
     * List profile in ucs manager
     *
     * @param string $ucsManagerId the id for the ucs manager
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listUcsProfiles($ucsManagerId, array $optArgs = array()) {
        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }
        return $this->request("listUcsProfiles",
            array_merge(array(
                'ucsmanagerid' => $ucsManagerId
            ), $optArgs)
        );
    }

    /**
     * List ucs blades
     *
     * @param string $ucsManagerId ucs manager id
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listUcsBlades($ucsManagerId, array $optArgs = array()) {
        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }
        return $this->request("listUcsBlades",
            array_merge(array(
                'ucsmanagerid' => $ucsManagerId
            ), $optArgs)
        );
    }

    /**
     * associate a profile to a blade
     *
     * @param string $bladeId blade id
     * @param string $profileDn profile dn
     * @param string $ucsManagerId ucs manager id
     */
    public function associateUcsProfileToBlade($bladeId, $profileDn, $ucsManagerId) {
        if (empty($bladeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bladeId"), MISSING_ARGUMENT);
        }
        if (empty($profileDn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "profileDn"), MISSING_ARGUMENT);
        }
        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }
        return $this->request("associateUcsProfileToBlade",
            array(
                'bladeid' => $bladeId,
                'profiledn' => $profileDn,
                'ucsmanagerid' => $ucsManagerId
            )
        );
    }

    /**
     * Delete a Ucs manager
     *
     * @param string $ucsManagerId ucs manager id
     */
    public function deleteUcsManager($ucsManagerId) {
        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteUcsManager",
            array(
                'ucsmanagerid' => $ucsManagerId
            )
        );
    }

    /**
     * disassociate a profile from a blade
     *
     * @param string $bladeId blade id
     * @param array  $optArgs {
     *     @type string $deleteProfile is deleting profile after disassociating
     * }
     */
    public function disassociateUcsProfileFromBlade($bladeId, array $optArgs = array()) {
        if (empty($bladeId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bladeId"), MISSING_ARGUMENT);
        }
        return $this->request("disassociateUcsProfileFromBlade",
            array_merge(array(
                'bladeid' => $bladeId
            ), $optArgs)
        );
    }

    /**
     * refresh ucs blades to sync with UCS manager
     *
     * @param string $ucsManagerId ucs manager id
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function refreshUcsBlades($ucsManagerId, array $optArgs = array()) {
        if (empty($ucsManagerId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ucsManagerId"), MISSING_ARGUMENT);
        }
        return $this->request("refreshUcsBlades",
            array_merge(array(
                'ucsmanagerid' => $ucsManagerId
            ), $optArgs)
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
     * List system virtual machines.
     *
     * @param array  $optArgs {
     *     @type string $hostId the host ID of the system VM
     *     @type string $id the ID of the system VM
     *     @type string $keyword List by keyword
     *     @type string $name the name of the system VM
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $podId the Pod ID of the system VM
     *     @type string $state the state of the system VM
     *     @type string $storageId the storage ID where vm's volumes belong to
     *     @type string $systemVmType the system VM type. Possible types are "consoleproxy" and "secondarystoragevm".
     *     @type string $zoneId the Zone ID of the system VM
     * }
     */
    public function listSystemVms(array $optArgs = array()) {
        return $this->request("listSystemVms",
            $optArgs
        );
    }

    /**
     * Attempts Migration of a system virtual machine to the host specified.
     *
     * @param string $hostId destination Host ID to migrate VM to
     * @param string $virtualMachineId the ID of the virtual machine
     */
    public function migrateSystemVm($hostId, $virtualMachineId) {
        if (empty($hostId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostId"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("migrateSystemVm",
            array(
                'hostid' => $hostId,
                'virtualmachineid' => $virtualMachineId
            )
        );
    }

    /**
     * Changes the service offering for a system vm (console proxy or secondary
     * storage). The system vm must be in a "Stopped" state for this command to take
     * effect.
     *
     * @param string $id The ID of the system vm
     * @param string $serviceOfferingId the service offering ID to apply to the system vm
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu, memory and cpunumber. example
     *     details[i].name=value
     * }
     */
    public function changeServiceForSystemVm($id, $serviceOfferingId, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }
        return $this->request("changeServiceForSystemVm",
            array_merge(array(
                'id' => $id,
                'serviceofferingid' => $serviceOfferingId
            ), $optArgs)
        );
    }

    /**
     * Scale the service offering for a system vm (console proxy or secondary storage).
     * The system vm must be in a "Stopped" state for this command to take effect.
     *
     * @param string $id The ID of the system vm
     * @param string $serviceOfferingId the service offering ID to apply to the system vm
     * @param array  $optArgs {
     *     @type string $details name value pairs of custom parameters for cpu, memory and cpunumber. example
     *     details[i].name=value
     * }
     */
    public function scaleSystemVm($id, $serviceOfferingId, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "serviceOfferingId"), MISSING_ARGUMENT);
        }
        return $this->request("scaleSystemVm",
            array_merge(array(
                'id' => $id,
                'serviceofferingid' => $serviceOfferingId
            ), $optArgs)
        );
    }

    /**
     * Creates a ACL rule in the given network (the network has to belong to VPC)
     *
     * @param string $protocol the protocol for the ACL rule. Valid values are TCP/UDP/ICMP/ALL or valid
     * protocol number
     * @param array  $optArgs {
     *     @type string $aclId The network of the vm the ACL will be created for
     *     @type string $action scl entry action, allow or deny
     *     @type string $cidrList the cidr list to allow traffic from/to
     *     @type string $endPort the ending port of ACL
     *     @type string $icmpCode error code for this icmp message
     *     @type string $icmpType type of the icmp message being sent
     *     @type string $networkId The network of the vm the ACL will be created for
     *     @type string $number The network of the vm the ACL will be created for
     *     @type string $startPort the starting port of ACL
     *     @type string $trafficType the traffic type for the ACL,can be Ingress or Egress, defaulted to Ingress if
     *     not specified
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
     * Updates ACL Item with specified Id
     *
     * @param string $id the ID of the network ACL Item
     * @param array  $optArgs {
     *     @type string $action scl entry action, allow or deny
     *     @type string $cidrList the cidr list to allow traffic from/to
     *     @type string $endPort the ending port of ACL
     *     @type string $icmpCode error code for this icmp message
     *     @type string $icmpType type of the icmp message being sent
     *     @type string $number The network of the vm the ACL will be created for
     *     @type string $protocol the protocol for the ACL rule. Valid values are TCP/UDP/ICMP/ALL or valid
     *     protocol number
     *     @type string $startPort the starting port of ACL
     *     @type string $trafficType the traffic type for the ACL,can be Ingress or Egress, defaulted to Ingress if
     *     not specified
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
     * Lists all network ACL items
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $aclId list network ACL Items by ACL Id
     *     @type string $action list network ACL Items by Action
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id Lists network ACL Item with the specified ID
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $networkId list network ACL Items by network Id
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $protocol list network ACL Items by Protocol
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $trafficType list network ACL Items by traffic type - Ingress or Egress
     * }
     */
    public function listNetworkACLs(array $optArgs = array()) {
        return $this->request("listNetworkACLs",
            $optArgs
        );
    }

    /**
     * Creates a Network ACL for the given VPC
     *
     * @param string $name Name of the network ACL List
     * @param string $vpcId Id of the VPC associated with this network ACL List
     * @param array  $optArgs {
     *     @type string $description Description of the network ACL List
     * }
     */
    public function createNetworkACLList($name, $vpcId, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($vpcId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vpcId"), MISSING_ARGUMENT);
        }
        return $this->request("createNetworkACLList",
            array_merge(array(
                'name' => $name,
                'vpcid' => $vpcId
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
     * Replaces ACL associated with a Network or private gateway
     *
     * @param string $aclId the ID of the network ACL
     * @param array  $optArgs {
     *     @type string $gatewayId the ID of the private gateway
     *     @type string $networkId the ID of the network
     * }
     */
    public function replaceNetworkACLList($aclId, array $optArgs = array()) {
        if (empty($aclId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "aclId"), MISSING_ARGUMENT);
        }
        return $this->request("replaceNetworkACLList",
            array_merge(array(
                'aclid' => $aclId
            ), $optArgs)
        );
    }

    /**
     * Lists all network ACLs
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id Lists network ACL with the specified ID.
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name list network ACLs by specified name
     *     @type string $networkId list network ACLs by network Id
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $vpcId list network ACLs by Vpc Id
     * }
     */
    public function listNetworkACLLists(array $optArgs = array()) {
        return $this->request("listNetworkACLLists",
            $optArgs
        );
    }

    /**
     * Creates a security group
     *
     * @param string $name name of the security group
     * @param array  $optArgs {
     *     @type string $account an optional account for the security group. Must be used with domainId.
     *     @type string $description the description of the security group
     *     @type string $domainId an optional domainId for the security group. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $projectId Create security group for project
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
     * Deletes security group
     *
     * @param array  $optArgs {
     *     @type string $account the account of the security group. Must be specified with domain ID
     *     @type string $domainId the domain ID of account owning the security group
     *     @type string $id The ID of the security group. Mutually exclusive with name parameter
     *     @type string $name The ID of the security group. Mutually exclusive with id parameter
     *     @type string $projectId the project of the security group
     * }
     */
    public function deleteSecurityGroup(array $optArgs = array()) {
        return $this->request("deleteSecurityGroup",
            $optArgs
        );
    }

    /**
     * Authorizes a particular ingress rule for this security group
     *
     * @param array  $optArgs {
     *     @type string $account an optional account for the security group. Must be used with domainId.
     *     @type string $cidrList the cidr list associated
     *     @type string $domainId an optional domainId for the security group. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $endPort end port for this ingress rule
     *     @type string $icmpCode error code for this icmp message
     *     @type string $icmpType type of the icmp message being sent
     *     @type string $projectId an optional project of the security group
     *     @type string $protocol TCP is default. UDP is the other supported protocol
     *     @type string $securityGroupId The ID of the security group. Mutually exclusive with securityGroupName
     *     parameter
     *     @type string $securityGroupName The name of the security group. Mutually exclusive with securityGroupName
     *     parameter
     *     @type string $startPort start port for this ingress rule
     *     @type string $userSecurityGroupList user to security group mapping
     * }
     */
    public function authorizeSecurityGroupIngress(array $optArgs = array()) {
        return $this->request("authorizeSecurityGroupIngress",
            $optArgs
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
     * Authorizes a particular egress rule for this security group
     *
     * @param array  $optArgs {
     *     @type string $account an optional account for the security group. Must be used with domainId.
     *     @type string $cidrList the cidr list associated
     *     @type string $domainId an optional domainId for the security group. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $endPort end port for this egress rule
     *     @type string $icmpCode error code for this icmp message
     *     @type string $icmpType type of the icmp message being sent
     *     @type string $projectId an optional project of the security group
     *     @type string $protocol TCP is default. UDP is the other supported protocol
     *     @type string $securityGroupId The ID of the security group. Mutually exclusive with securityGroupName
     *     parameter
     *     @type string $securityGroupName The name of the security group. Mutually exclusive with securityGroupName
     *     parameter
     *     @type string $startPort start port for this egress rule
     *     @type string $userSecurityGroupList user to security group mapping
     * }
     */
    public function authorizeSecurityGroupEgress(array $optArgs = array()) {
        return $this->request("authorizeSecurityGroupEgress",
            $optArgs
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
     * Lists security groups
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id list the security group by the id provided
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $securityGroupName lists security groups by name
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $virtualMachineId lists security groups by virtual machine id
     * }
     */
    public function listSecurityGroups(array $optArgs = array()) {
        return $this->request("listSecurityGroups",
            $optArgs
        );
    }

    /**
     * Creates a new Pod.
     *
     * @param string $gateway the gateway for the Pod
     * @param string $name the name of the Pod
     * @param string $netmask the netmask for the Pod
     * @param string $startIp the starting IP address for the Pod
     * @param string $zoneId the Zone ID in which the Pod will be created
     * @param array  $optArgs {
     *     @type string $allocationState Allocation state of this Pod for allocation of new resources
     *     @type string $endIp the ending IP address for the Pod
     * }
     */
    public function createPod($gateway, $name, $netmask, $startIp, $zoneId, array $optArgs = array()) {
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }
        if (empty($startIp)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startIp"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("createPod",
            array_merge(array(
                'gateway' => $gateway,
                'name' => $name,
                'netmask' => $netmask,
                'startip' => $startIp,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Updates a Pod.
     *
     * @param string $id the ID of the Pod
     * @param array  $optArgs {
     *     @type string $allocationState Allocation state of this cluster for allocation of new resources
     *     @type string $endIp the ending IP address for the Pod
     *     @type string $gateway the gateway for the Pod
     *     @type string $name the name of the Pod
     *     @type string $netmask the netmask of the Pod
     *     @type string $startIp the starting IP address for the Pod
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
     * Lists all Pods.
     *
     * @param array  $optArgs {
     *     @type string $allocationState list pods by allocation state
     *     @type string $id list Pods by ID
     *     @type string $keyword List by keyword
     *     @type string $name list Pods by name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $showCapacities flag to display the capacity of the pods
     *     @type string $zoneId list Pods by Zone ID
     * }
     */
    public function listPods(array $optArgs = array()) {
        return $this->request("listPods",
            $optArgs
        );
    }

    /**
     * Dedicates a Pod.
     *
     * @param string $domainId the ID of the containing domain
     * @param string $podId the ID of the Pod
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     */
    public function dedicatePod($domainId, $podId, array $optArgs = array()) {
        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }
        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }
        return $this->request("dedicatePod",
            array_merge(array(
                'domainid' => $domainId,
                'podid' => $podId
            ), $optArgs)
        );
    }

    /**
     * Release the dedication for the pod
     *
     * @param string $podId the ID of the Pod
     */
    public function releaseDedicatedPod($podId) {
        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }
        return $this->request("releaseDedicatedPod",
            array(
                'podid' => $podId
            )
        );
    }

    /**
     * Lists dedicated pods.
     *
     * @param array  $optArgs {
     *     @type string $account the name of the account associated with the pod. Must be used with domainId.
     *     @type string $affinityGroupId list dedicated pods by affinity group
     *     @type string $domainId the ID of the domain associated with the pod
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $podId the ID of the pod
     * }
     */
    public function listDedicatedPods(array $optArgs = array()) {
        return $this->request("listDedicatedPods",
            $optArgs
        );
    }

    /**
     * Adds backup image store.
     *
     * @param string $provider the image store provider name
     * @param array  $optArgs {
     *     @type string $details the details for the image store. Example:
     *     details[0].key=accesskey&details[0].value=s389ddssaa&details[1].key=secretkey&details[1].value=8dshfsss
     *     @type string $name the name for the image store
     *     @type string $url the URL for the image store
     *     @type string $zoneId the Zone ID for the image store
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
     * Lists image stores.
     *
     * @param array  $optArgs {
     *     @type string $id the ID of the storage pool
     *     @type string $keyword List by keyword
     *     @type string $name the name of the image store
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $protocol the image store protocol
     *     @type string $provider the image store provider
     *     @type string $zoneId the Zone ID for the image store
     * }
     */
    public function listImageStores(array $optArgs = array()) {
        return $this->request("listImageStores",
            $optArgs
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
     * create secondary staging store.
     *
     * @param string $url the URL for the staging store
     * @param array  $optArgs {
     *     @type string $details the details for the staging store
     *     @type string $provider the staging store provider name
     *     @type string $scope the scope of the staging store: zone only for now
     *     @type string $zoneId the Zone ID for the staging store
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
     * Lists secondary staging stores.
     *
     * @param array  $optArgs {
     *     @type string $id the ID of the staging store
     *     @type string $keyword List by keyword
     *     @type string $name the name of the staging store
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $protocol the staging store protocol
     *     @type string $provider the staging store provider
     *     @type string $zoneId the Zone ID for the staging store
     * }
     */
    public function listSecondaryStagingStores(array $optArgs = array()) {
        return $this->request("listSecondaryStagingStores",
            $optArgs
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
     * Migrate current NFS secondary storages to use object store.
     *
     * @param string $provider the image store provider name
     * @param array  $optArgs {
     *     @type string $details the details for the image store. Example:
     *     details[0].key=accesskey&details[0].value=s389ddssaa&details[1].key=secretkey&details[1].value=8dshfsss
     *     @type string $name the name for the image store
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
     * Updates a configuration.
     *
     * @param string $name the name of the configuration
     * @param array  $optArgs {
     *     @type string $accountId the ID of the Account to update the parameter value for corresponding account
     *     @type string $clusterId the ID of the Cluster to update the parameter value for corresponding cluster
     *     @type string $storageId the ID of the Storage pool to update the parameter value for corresponding
     *     storage pool
     *     @type string $value the value of the configuration
     *     @type string $zoneId the ID of the Zone to update the parameter value for corresponding zone
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
     * Lists all configurations.
     *
     * @param array  $optArgs {
     *     @type string $accountId the ID of the Account to update the parameter value for corresponding account
     *     @type string $category lists configurations by category
     *     @type string $clusterId the ID of the Cluster to update the parameter value for corresponding cluster
     *     @type string $keyword List by keyword
     *     @type string $name lists configuration by name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $storageId the ID of the Storage pool to update the parameter value for corresponding
     *     storage pool
     *     @type string $zoneId the ID of the Zone to update the parameter value for corresponding zone
     * }
     */
    public function listConfigurations(array $optArgs = array()) {
        return $this->request("listConfigurations",
            $optArgs
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
     * Lists all DeploymentPlanners available.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listDeploymentPlanners(array $optArgs = array()) {
        return $this->request("listDeploymentPlanners",
            $optArgs
        );
    }

    /**
     * Lists all LDAP configurations
     *
     * @param array  $optArgs {
     *     @type string $hostname Hostname
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $port Port
     * }
     */
    public function listLdapConfigurations(array $optArgs = array()) {
        return $this->request("listLdapConfigurations",
            $optArgs
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
     * Adds a new cluster
     *
     * @param string $clusterName the cluster name
     * @param string $clusterType type of the cluster: CloudManaged, ExternalManaged
     * @param string $hypervisor hypervisor type of the cluster: XenServer,KVM,VMware,Hyperv,BareMetal,Simulator
     * @param string $podId the Pod ID for the host
     * @param string $zoneId the Zone ID for the cluster
     * @param array  $optArgs {
     *     @type string $allocationState Allocation state of this cluster for allocation of new resources
     *     @type string $guestVswitchName Name of virtual switch used for guest traffic in the cluster. This would
     *     override zone wide traffic label setting.
     *     @type string $guestVswitchType Type of virtual switch used for guest traffic in the cluster. Allowed values
     *     are, vmwaresvs (for VMware standard vSwitch) and vmwaredvs (for VMware
     *     distributed vSwitch)
     *     @type string $password the password for the host
     *     @type string $publicVswitchName Name of virtual switch used for public traffic in the cluster.  This would
     *     override zone wide traffic label setting.
     *     @type string $publicVswitchType Type of virtual switch used for public traffic in the cluster. Allowed values
     *     are, vmwaresvs (for VMware standard vSwitch) and vmwaredvs (for VMware
     *     distributed vSwitch)
     *     @type string $url the URL
     *     @type string $userName the username for the cluster
     *     @type string $vsmIpAddress the ipaddress of the VSM associated with this cluster
     *     @type string $vsmPassword the password for the VSM associated with this cluster
     *     @type string $vsmUsername the username for the VSM associated with this cluster
     * }
     */
    public function addCluster($clusterName, $clusterType, $hypervisor, $podId, $zoneId, array $optArgs = array()) {
        if (empty($clusterName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterName"), MISSING_ARGUMENT);
        }
        if (empty($clusterType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterType"), MISSING_ARGUMENT);
        }
        if (empty($hypervisor)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hypervisor"), MISSING_ARGUMENT);
        }
        if (empty($podId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "podId"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("addCluster",
            array_merge(array(
                'clustername' => $clusterName,
                'clustertype' => $clusterType,
                'hypervisor' => $hypervisor,
                'podid' => $podId,
                'zoneid' => $zoneId
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
     * Updates an existing cluster
     *
     * @param string $id the ID of the Cluster
     * @param array  $optArgs {
     *     @type string $allocationState Allocation state of this cluster for allocation of new resources
     *     @type string $clusterName the cluster name
     *     @type string $clusterType hypervisor type of the cluster
     *     @type string $hypervisor hypervisor type of the cluster
     *     @type string $managedState whether this cluster is managed by cloudstack
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
     * Lists clusters.
     *
     * @param array  $optArgs {
     *     @type string $allocationState lists clusters by allocation state
     *     @type string $clusterType lists clusters by cluster type
     *     @type string $hypervisor lists clusters by hypervisor type
     *     @type string $id lists clusters by the cluster ID
     *     @type string $keyword List by keyword
     *     @type string $managedState whether this cluster is managed by cloudstack
     *     @type string $name lists clusters by the cluster name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $podId lists clusters by Pod ID
     *     @type string $showCapacities flag to display the capacity of the clusters
     *     @type string $zoneId lists clusters by Zone ID
     * }
     */
    public function listClusters(array $optArgs = array()) {
        return $this->request("listClusters",
            $optArgs
        );
    }

    /**
     * Dedicate an existing cluster
     *
     * @param string $clusterId the ID of the Cluster
     * @param string $domainId the ID of the containing domain
     * @param array  $optArgs {
     *     @type string $account the name of the account which needs dedication. Must be used with domainId.
     * }
     */
    public function dedicateCluster($clusterId, $domainId, array $optArgs = array()) {
        if (empty($clusterId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterId"), MISSING_ARGUMENT);
        }
        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }
        return $this->request("dedicateCluster",
            array_merge(array(
                'clusterid' => $clusterId,
                'domainid' => $domainId
            ), $optArgs)
        );
    }

    /**
     * Release the dedication for cluster
     *
     * @param string $clusterId the ID of the Cluster
     */
    public function releaseDedicatedCluster($clusterId) {
        if (empty($clusterId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "clusterId"), MISSING_ARGUMENT);
        }
        return $this->request("releaseDedicatedCluster",
            array(
                'clusterid' => $clusterId
            )
        );
    }

    /**
     * Lists dedicated clusters.
     *
     * @param array  $optArgs {
     *     @type string $account the name of the account associated with the cluster. Must be used with
     *     domainId.
     *     @type string $affinityGroupId list dedicated clusters by affinity group
     *     @type string $clusterId the ID of the cluster
     *     @type string $domainId the ID of the domain associated with the cluster
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listDedicatedClusters(array $optArgs = array()) {
        return $this->request("listDedicatedClusters",
            $optArgs
        );
    }

    /**
     * Creates a VLAN IP range.
     *
     * @param array  $optArgs {
     *     @type string $account account who will own the VLAN. If VLAN is Zone wide, this parameter should be
     *     ommited
     *     @type string $domainId domain ID of the account owning a VLAN
     *     @type string $endIp the ending IP address in the VLAN IP range
     *     @type string $endIpv6 the ending IPv6 address in the IPv6 network range
     *     @type string $forVirtualNetwork true if VLAN is of Virtual type, false if Direct
     *     @type string $gateway the gateway of the VLAN IP range
     *     @type string $ip6Cidr the CIDR of IPv6 network, must be at least /64
     *     @type string $ip6Gateway the gateway of the IPv6 network. Required for Shared networks and Isolated
     *     networks when it belongs to VPC
     *     @type string $netmask the netmask of the VLAN IP range
     *     @type string $networkId the network id
     *     @type string $physicalNetworkId the physical network id
     *     @type string $podId optional parameter. Have to be specified for Direct Untagged vlan only.
     *     @type string $projectId project who will own the VLAN. If VLAN is Zone wide, this parameter should be
     *     ommited
     *     @type string $startIp the beginning IP address in the VLAN IP range
     *     @type string $startIpv6 the beginning IPv6 address in the IPv6 network range
     *     @type string $vlan the ID or VID of the VLAN. If not specified, will be defaulted to the vlan of
     *     the network or if vlan of the network is null - to Untagged
     *     @type string $zoneId the Zone ID of the VLAN IP range
     * }
     */
    public function createVlanIpRange(array $optArgs = array()) {
        return $this->request("createVlanIpRange",
            $optArgs
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
     * Lists all VLAN IP ranges.
     *
     * @param array  $optArgs {
     *     @type string $account the account with which the VLAN IP range is associated. Must be used with the
     *     domainId parameter.
     *     @type string $domainId the domain ID with which the VLAN IP range is associated.  If used with the
     *     account parameter, returns all VLAN IP ranges for that account in the specified
     *     domain.
     *     @type string $forVirtualNetwork true if VLAN is of Virtual type, false if Direct
     *     @type string $id the ID of the VLAN IP range
     *     @type string $keyword List by keyword
     *     @type string $networkId network id of the VLAN IP range
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId physical network id of the VLAN IP range
     *     @type string $podId the Pod ID of the VLAN IP range
     *     @type string $projectId project who will own the VLAN
     *     @type string $vlan the ID or VID of the VLAN. Default is an "untagged" VLAN.
     *     @type string $zoneId the Zone ID of the VLAN IP range
     * }
     */
    public function listVlanIpRanges(array $optArgs = array()) {
        return $this->request("listVlanIpRanges",
            $optArgs
        );
    }

    /**
     * Dedicates a guest vlan range to an account
     *
     * @param string $account account who will own the VLAN
     * @param string $domainId domain ID of the account owning a VLAN
     * @param string $physicalNetworkId physical network ID of the vlan
     * @param string $vlanRange guest vlan range to be dedicated
     * @param array  $optArgs {
     *     @type string $projectId project who will own the VLAN
     * }
     */
    public function dedicateGuestVlanRange($account, $domainId, $physicalNetworkId, $vlanRange, array $optArgs = array()) {
        if (empty($account)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "account"), MISSING_ARGUMENT);
        }
        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($vlanRange)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vlanRange"), MISSING_ARGUMENT);
        }
        return $this->request("dedicateGuestVlanRange",
            array_merge(array(
                'account' => $account,
                'domainid' => $domainId,
                'physicalnetworkid' => $physicalNetworkId,
                'vlanrange' => $vlanRange
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
     * Lists dedicated guest vlan ranges
     *
     * @param array  $optArgs {
     *     @type string $account the account with which the guest VLAN range is associated. Must be used with the
     *     domainId parameter.
     *     @type string $domainId the domain ID with which the guest VLAN range is associated.  If used with the
     *     account parameter, returns all guest VLAN ranges for that account in the
     *     specified domain.
     *     @type string $guestVlanRange the dedicated guest vlan range
     *     @type string $id list dedicated guest vlan ranges by id
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId physical network id of the guest VLAN range
     *     @type string $projectId project who will own the guest VLAN range
     *     @type string $zoneId zone of the guest VLAN range
     * }
     */
    public function listDedicatedGuestVlanRanges(array $optArgs = array()) {
        return $this->request("listDedicatedGuestVlanRanges",
            $optArgs
        );
    }

    /**
     * Configures an Internal Load Balancer element.
     *
     * @param string $id the ID of the internal lb provider
     * @param string $enabled Enables/Disables the Internal Load Balancer element
     */
    public function configureInternalLoadBalancerElement($id, $enabled) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($enabled)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "enabled"), MISSING_ARGUMENT);
        }
        return $this->request("configureInternalLoadBalancerElement",
            array(
                'id' => $id,
                'enabled' => $enabled
            )
        );
    }

    /**
     * Create an Internal Load Balancer element.
     *
     * @param string $nspId the network service provider ID of the internal load balancer element
     */
    public function createInternalLoadBalancerElement($nspId) {
        if (empty($nspId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nspId"), MISSING_ARGUMENT);
        }
        return $this->request("createInternalLoadBalancerElement",
            array(
                'nspid' => $nspId
            )
        );
    }

    /**
     * Lists all available Internal Load Balancer elements.
     *
     * @param array  $optArgs {
     *     @type string $enabled list internal load balancer elements by enabled state
     *     @type string $id list internal load balancer elements by id
     *     @type string $keyword List by keyword
     *     @type string $nspId list internal load balancer elements by network service provider id
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listInternalLoadBalancerElements(array $optArgs = array()) {
        return $this->request("listInternalLoadBalancerElements",
            $optArgs
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
     * List internal LB VMs.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $forVpc if true is passed for this parameter, list only VPC Internal LB VMs
     *     @type string $hostId the host ID of the Internal LB VM
     *     @type string $id the ID of the Internal LB VM
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name the name of the Internal LB VM
     *     @type string $networkId list by network id
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $podId the Pod ID of the Internal LB VM
     *     @type string $projectId list objects by project
     *     @type string $state the state of the Internal LB VM
     *     @type string $vpcId List Internal LB VMs by VPC
     *     @type string $zoneId the Zone ID of the Internal LB VM
     * }
     */
    public function listInternalLoadBalancerVMs(array $optArgs = array()) {
        return $this->request("listInternalLoadBalancerVMs",
            $optArgs
        );
    }

    /**
     * Create a LUN from a pool
     *
     * @param string $name pool name.
     * @param string $size LUN size.
     */
    public function createLunOnFiler($name, $size) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($size)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "size"), MISSING_ARGUMENT);
        }
        return $this->request("createLunOnFiler",
            array(
                'name' => $name,
                'size' => $size
            )
        );
    }

    /**
     * Destroy a LUN
     *
     * @param string $path LUN path.
     */
    public function destroyLunOnFiler($path) {
        if (empty($path)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "path"), MISSING_ARGUMENT);
        }
        return $this->request("destroyLunOnFiler",
            array(
                'path' => $path
            )
        );
    }

    /**
     * List LUN
     *
     * @param string $poolName pool name.
     */
    public function listLunsOnFiler($poolName) {
        if (empty($poolName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "poolName"), MISSING_ARGUMENT);
        }
        return $this->request("listLunsOnFiler",
            array(
                'poolname' => $poolName
            )
        );
    }

    /**
     * Associate a LUN with a guest IQN
     *
     * @param string $iqn Guest IQN to which the LUN associate.
     * @param string $name LUN name.
     */
    public function associateLun($iqn, $name) {
        if (empty($iqn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "iqn"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("associateLun",
            array(
                'iqn' => $iqn,
                'name' => $name
            )
        );
    }

    /**
     * Dissociate a LUN
     *
     * @param string $iqn Guest IQN.
     * @param string $path LUN path.
     */
    public function dissociateLun($iqn, $path) {
        if (empty($iqn)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "iqn"), MISSING_ARGUMENT);
        }
        if (empty($path)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "path"), MISSING_ARGUMENT);
        }
        return $this->request("dissociateLun",
            array(
                'iqn' => $iqn,
                'path' => $path
            )
        );
    }

    /**
     * Resets the SSH Key for virtual machine. The virtual machine must be in a
     * "Stopped" state. [async]
     *
     * @param string $id The ID of the virtual machine
     * @param string $keyPair name of the ssh key pair used to login to the virtual machine
     * @param array  $optArgs {
     *     @type string $account an optional account for the ssh key. Must be used with domainId.
     *     @type string $domainId an optional domainId for the virtual machine. If the account parameter is used,
     *     domainId must also be used.
     *     @type string $projectId an optional project for the ssh key
     * }
     */
    public function resetSSHKeyForVirtualMachine($id, $keyPair, array $optArgs = array()) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($keyPair)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "keyPair"), MISSING_ARGUMENT);
        }
        return $this->request("resetSSHKeyForVirtualMachine",
            array_merge(array(
                'id' => $id,
                'keypair' => $keyPair
            ), $optArgs)
        );
    }

    /**
     * Register a public key in a keypair under a certain name
     *
     * @param string $name Name of the keypair
     * @param string $publicKey Public key material of the keypair
     * @param array  $optArgs {
     *     @type string $account an optional account for the ssh key. Must be used with domainId.
     *     @type string $domainId an optional domainId for the ssh key. If the account parameter is used, domainId
     *     must also be used.
     *     @type string $projectId an optional project for the ssh key
     * }
     */
    public function registerSSHKeyPair($name, $publicKey, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($publicKey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "publicKey"), MISSING_ARGUMENT);
        }
        return $this->request("registerSSHKeyPair",
            array_merge(array(
                'name' => $name,
                'publickey' => $publicKey
            ), $optArgs)
        );
    }

    /**
     * Create a new keypair and returns the private key
     *
     * @param string $name Name of the keypair
     * @param array  $optArgs {
     *     @type string $account an optional account for the ssh key. Must be used with domainId.
     *     @type string $domainId an optional domainId for the ssh key. If the account parameter is used, domainId
     *     must also be used.
     *     @type string $projectId an optional project for the ssh key
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
     * Deletes a keypair by name
     *
     * @param string $name Name of the keypair
     * @param array  $optArgs {
     *     @type string $account the account associated with the keypair. Must be used with the domainId
     *     parameter.
     *     @type string $domainId the domain ID associated with the keypair
     *     @type string $projectId the project associated with keypair
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
     * List registered keypairs
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $fingerprint A public key fingerprint to look for
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name A key pair name to look for
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     * }
     */
    public function listSSHKeyPairs(array $optArgs = array()) {
        return $this->request("listSSHKeyPairs",
            $optArgs
        );
    }

    /**
     * Enables static nat for given ip address
     *
     * @param string $ipAddressId the public IP address id for which static nat feature is being enabled
     * @param string $virtualMachineId the ID of the virtual machine for enabling static nat feature
     * @param array  $optArgs {
     *     @type string $networkId The network of the vm the static nat will be enabled for. Required when public
     *     Ip address is not associated with any Guest network yet (VPC case)
     *     @type string $vmGuestIp VM guest nic Secondary ip address for the port forwarding rule
     * }
     */
    public function enableStaticNat($ipAddressId, $virtualMachineId, array $optArgs = array()) {
        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("enableStaticNat",
            array_merge(array(
                'ipaddressid' => $ipAddressId,
                'virtualmachineid' => $virtualMachineId
            ), $optArgs)
        );
    }

    /**
     * Creates an ip forwarding rule
     *
     * @param string $ipAddressId the public IP address id of the forwarding rule, already associated via
     * associateIp
     * @param string $protocol the protocol for the rule. Valid values are TCP or UDP.
     * @param string $startPort the start port for the rule
     * @param array  $optArgs {
     *     @type string $cidrList the cidr list to forward traffic from
     *     @type string $endPort the end port for the rule
     *     @type string $openFirewall if true, firewall rule for source/end pubic port is automatically created; if
     *     false - firewall rule has to be created explicitely. Has value true by default
     * }
     */
    public function createIpForwardingRule($ipAddressId, $protocol, $startPort, array $optArgs = array()) {
        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }
        if (empty($protocol)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "protocol"), MISSING_ARGUMENT);
        }
        if (empty($startPort)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startPort"), MISSING_ARGUMENT);
        }
        return $this->request("createIpForwardingRule",
            array_merge(array(
                'ipaddressid' => $ipAddressId,
                'protocol' => $protocol,
                'startport' => $startPort
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
     * List the ip forwarding rules
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id Lists rule with the specified ID.
     *     @type string $ipAddressId list the rule belonging to this public ip address
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $virtualMachineId Lists all rules applied to the specified Vm.
     * }
     */
    public function listIpForwardingRules(array $optArgs = array()) {
        return $this->request("listIpForwardingRules",
            $optArgs
        );
    }

    /**
     * Disables static rule for given ip address
     *
     * @param string $ipAddressId the public IP address id for which static nat feature is being disableed
     */
    public function disableStaticNat($ipAddressId) {
        if (empty($ipAddressId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "ipAddressId"), MISSING_ARGUMENT);
        }
        return $this->request("disableStaticNat",
            array(
                'ipaddressid' => $ipAddressId
            )
        );
    }

    /**
     * Updates resource limits for an account or domain.
     *
     * @param string $resourceType Type of resource to update. Values are 0, 1, 2, 3, 4, 6, 7, 8, 9, 10 and 11. 0 -
     * Instance. Number of instances a user can create. 1 - IP. Number of public IP
     * addresses a user can own. 2 - Volume. Number of disk volumes a user can create.3
     * - Snapshot. Number of snapshots a user can create.4 - Template. Number of
     * templates that a user can register/create.6 - Network. Number of guest network a
     * user can create.7 - VPC. Number of VPC a user can create.8 - CPU. Total number
     * of CPU cores a user can use.9 - Memory. Total Memory (in MB) a user can use.10 -
     * PrimaryStorage. Total primary storage space (in GiB) a user can use.11 -
     * SecondaryStorage. Total secondary storage space (in GiB) a user can use.
     * @param array  $optArgs {
     *     @type string $account Update resource for a specified account. Must be used with the domainId
     *     parameter.
     *     @type string $domainId Update resource limits for all accounts in specified domain. If used with the
     *     account parameter, updates resource limits for a specified account in specified
     *     domain.
     *     @type string $max Maximum resource limit.
     *     @type string $projectId Update resource limits for project
     * }
     */
    public function updateResourceLimit($resourceType, array $optArgs = array()) {
        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }
        return $this->request("updateResourceLimit",
            array_merge(array(
                'resourcetype' => $resourceType
            ), $optArgs)
        );
    }

    /**
     * Recalculate and update resource count for an account or domain.
     *
     * @param string $domainId If account parameter specified then updates resource counts for a specified
     * account in this domain else update resource counts for all accounts & child
     * domains in specified domain.
     * @param array  $optArgs {
     *     @type string $account Update resource count for a specified account. Must be used with the domainId
     *     parameter.
     *     @type string $projectId Update resource limits for project
     *     @type string $resourceType Type of resource to update. If specifies valid values are 0, 1, 2, 3, 4, 5, 6,
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
    public function updateResourceCount($domainId, array $optArgs = array()) {
        if (empty($domainId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainId"), MISSING_ARGUMENT);
        }
        return $this->request("updateResourceCount",
            array_merge(array(
                'domainid' => $domainId
            ), $optArgs)
        );
    }

    /**
     * Lists resource limits.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id Lists resource limits by ID.
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $resourceType Type of resource to update. Values are 0, 1, 2, 3, and 4.0 - Instance. Number of
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
     * Get API limit count for the caller
     *
     */
    public function getApiLimit() {
        return $this->request("getApiLimit",
            $optArgs
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
     * Creates a domain
     *
     * @param string $name creates domain with this name
     * @param array  $optArgs {
     *     @type string $domainId Domain UUID, required for adding domain from another Region
     *     @type string $networkDomain Network domain for networks in the domain
     *     @type string $parentDomainId assigns new domain a parent domain by domain ID of the parent.  If no parent
     *     domain is specied, the ROOT domain is assumed.
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
     * Updates a domain with a new name
     *
     * @param string $id ID of domain to update
     * @param array  $optArgs {
     *     @type string $name updates domain with this name
     *     @type string $networkDomain Network domain for the domain's networks; empty string will update domainName
     *     with NULL value
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
     * Lists domains and provides detailed information for listed domains
     *
     * @param array  $optArgs {
     *     @type string $id List domain by domain ID.
     *     @type string $keyword List by keyword
     *     @type string $level List domains by domain level.
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name List domain by domain name.
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listDomains(array $optArgs = array()) {
        return $this->request("listDomains",
            $optArgs
        );
    }

    /**
     * Lists all children domains belonging to a specified domain
     *
     * @param array  $optArgs {
     *     @type string $id list children domain by parent domain ID.
     *     @type string $isRecursive to return the entire tree, use the value "true". To return the first level
     *     children, use the value "false".
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name list children domains by name
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listDomainChildren(array $optArgs = array()) {
        return $this->request("listDomainChildren",
            $optArgs
        );
    }

    /**
     * add a baremetal pxe server
     *
     * @param string $password Credentials to reach external pxe device
     * @param string $physicalNetworkId the Physical Network ID
     * @param string $pxeServerType type of pxe device
     * @param string $tftpDir Tftp root directory of PXE server
     * @param string $url URL of the external pxe device
     * @param string $userName Credentials to reach external pxe device
     * @param array  $optArgs {
     *     @type string $podId Pod Id
     * }
     */
    public function addBaremetalPxeKickStartServer($password, $physicalNetworkId, $pxeServerType, $tftpDir, $url, $userName, array $optArgs = array()) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($pxeServerType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pxeServerType"), MISSING_ARGUMENT);
        }
        if (empty($tftpDir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "tftpDir"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("addBaremetalPxeKickStartServer",
            array_merge(array(
                'password' => $password,
                'physicalnetworkid' => $physicalNetworkId,
                'pxeservertype' => $pxeServerType,
                'tftpdir' => $tftpDir,
                'url' => $url,
                'username' => $userName
            ), $optArgs)
        );
    }

    /**
     * add a baremetal ping pxe server
     *
     * @param string $password Credentials to reach external pxe device
     * @param string $physicalNetworkId the Physical Network ID
     * @param string $pingDir Root directory on PING storage server
     * @param string $pingStorageServerIp PING storage server ip
     * @param string $pxeServerType type of pxe device
     * @param string $tftpDir Tftp root directory of PXE server
     * @param string $url URL of the external pxe device
     * @param string $userName Credentials to reach external pxe device
     * @param array  $optArgs {
     *     @type string $pingCifsPassword Password of PING storage server
     *     @type string $pingCifsUsername Username of PING storage server
     *     @type string $podId Pod Id
     * }
     */
    public function addBaremetalPxePingServer($password, $physicalNetworkId, $pingDir, $pingStorageServerIp, $pxeServerType, $tftpDir, $url, $userName, array $optArgs = array()) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($pingDir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pingDir"), MISSING_ARGUMENT);
        }
        if (empty($pingStorageServerIp)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pingStorageServerIp"), MISSING_ARGUMENT);
        }
        if (empty($pxeServerType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "pxeServerType"), MISSING_ARGUMENT);
        }
        if (empty($tftpDir)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "tftpDir"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("addBaremetalPxePingServer",
            array_merge(array(
                'password' => $password,
                'physicalnetworkid' => $physicalNetworkId,
                'pingdir' => $pingDir,
                'pingstorageserverip' => $pingStorageServerIp,
                'pxeservertype' => $pxeServerType,
                'tftpdir' => $tftpDir,
                'url' => $url,
                'username' => $userName
            ), $optArgs)
        );
    }

    /**
     * adds a baremetal dhcp server
     *
     * @param string $dhcpServerType Type of dhcp device
     * @param string $password Credentials to reach external dhcp device
     * @param string $physicalNetworkId the Physical Network ID
     * @param string $url URL of the external dhcp appliance.
     * @param string $userName Credentials to reach external dhcp device
     */
    public function addBaremetalDhcp($dhcpServerType, $password, $physicalNetworkId, $url, $userName) {
        if (empty($dhcpServerType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "dhcpServerType"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("addBaremetalDhcp",
            array(
                'dhcpservertype' => $dhcpServerType,
                'password' => $password,
                'physicalnetworkid' => $physicalNetworkId,
                'url' => $url,
                'username' => $userName
            )
        );
    }

    /**
     * list baremetal dhcp servers
     *
     * @param array  $optArgs {
     *     @type string $dhcpServerType Type of DHCP device
     *     @type string $id DHCP server device ID
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listBaremetalDhcp(array $optArgs = array()) {
        return $this->request("listBaremetalDhcp",
            $optArgs
        );
    }

    /**
     * list baremetal pxe server
     *
     * @param array  $optArgs {
     *     @type string $id Pxe server device ID
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listBaremetalPxeServers(array $optArgs = array()) {
        return $this->request("listBaremetalPxeServers",
            $optArgs
        );
    }

    /**
     * Creates an affinity/anti-affinity group
     *
     * @param string $name name of the affinity group
     * @param string $type Type of the affinity group from the available affinity/anti-affinity group
     * types
     * @param array  $optArgs {
     *     @type string $account an account for the affinity group. Must be used with domainId.
     *     @type string $description optional description of the affinity group
     *     @type string $domainId domainId of the account owning the affinity group
     * }
     */
    public function createAffinityGroup($name, $type, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "type"), MISSING_ARGUMENT);
        }
        return $this->request("createAffinityGroup",
            array_merge(array(
                'name' => $name,
                'type' => $type
            ), $optArgs)
        );
    }

    /**
     * Deletes affinity group
     *
     * @param array  $optArgs {
     *     @type string $account the account of the affinity group. Must be specified with domain ID
     *     @type string $domainId the domain ID of account owning the affinity group
     *     @type string $id The ID of the affinity group. Mutually exclusive with name parameter
     *     @type string $name The name of the affinity group. Mutually exclusive with id parameter
     * }
     */
    public function deleteAffinityGroup(array $optArgs = array()) {
        return $this->request("deleteAffinityGroup",
            $optArgs
        );
    }

    /**
     * Lists affinity groups
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id list the affinity group by the id provided
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name lists affinity groups by name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $type lists affinity groups by type
     *     @type string $virtualMachineId lists affinity groups by virtual machine id
     * }
     */
    public function listAffinityGroups(array $optArgs = array()) {
        return $this->request("listAffinityGroups",
            $optArgs
        );
    }

    /**
     * Updates the affinity/anti-affinity group associations of a virtual machine. The
     * VM has to be stopped and restarted for the new properties to take effect.
     *
     * @param string $id The ID of the virtual machine
     * @param array  $optArgs {
     *     @type string $affinityGroupIds comma separated list of affinity groups id that are going to be applied to the
     *     virtual machine. Should be passed only when vm is created from a zone with Basic
     *     Network support. Mutually exclusive with securitygroupnames parameter
     *     @type string $affinityGroupNames comma separated list of affinity groups names that are going to be applied to
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
     * Lists affinity group types available
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listAffinityGroupTypes(array $optArgs = array()) {
        return $this->request("listAffinityGroupTypes",
            $optArgs
        );
    }

    /**
     * Creates a vm group
     *
     * @param string $name the name of the instance group
     * @param array  $optArgs {
     *     @type string $account the account of the instance group. The account parameter must be used with the
     *     domainId parameter.
     *     @type string $domainId the domain ID of account owning the instance group
     *     @type string $projectId The project of the instance group
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
     * Lists vm groups
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $id list instance groups by ID
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $name list instance groups by name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     * }
     */
    public function listInstanceGroups(array $optArgs = array()) {
        return $this->request("listInstanceGroups",
            $optArgs
        );
    }

    /**
     * Creates a service offering.
     *
     * @param string $displayText the display text of the service offering
     * @param string $name the name of the service offering
     * @param array  $optArgs {
     *     @type string $bytesReadRate bytes read rate of the disk offering
     *     @type string $bytesWriteRate bytes write rate of the disk offering
     *     @type string $cpuNumber the CPU number of the service offering
     *     @type string $cpuSpeed the CPU speed of the service offering in MHz.
     *     @type string $deploymentPlanner The deployment planner heuristics used to deploy a VM of this offering. If null,
     *     value of global config vm.deployment.planner is used
     *     @type string $domainId the ID of the containing domain, null for public offerings
     *     @type string $hosttags the host tag for this service offering.
     *     @type string $iopsReadRate io requests read rate of the disk offering
     *     @type string $iopsWriteRate io requests write rate of the disk offering
     *     @type string $isSystem is this a system vm offering
     *     @type string $isVolatile true if the virtual machine needs to be volatile so that on every reboot of VM,
     *     original root disk is dettached then destroyed and a fresh root disk is created
     *     and attached to VM
     *     @type string $limitCpuUse restrict the CPU usage to committed service offering
     *     @type string $memory the total memory of the service offering in MB
     *     @type string $networkRate data transfer rate in megabits per second allowed. Supported only for non-System
     *     offering and system offerings having "domainrouter" systemvmtype
     *     @type string $offerHa the HA for the service offering
     *     @type string $serviceOfferingDetails details for planner, used to store specific parameters
     *     @type string $storageType the storage type of the service offering. Values are local and shared.
     *     @type string $systemVmType the system VM type. Possible types are "domainrouter", "consoleproxy" and
     *     "secondarystoragevm".
     *     @type string $tags the tags for this service offering.
     * }
     */
    public function createServiceOffering($displayText, $name, array $optArgs = array()) {
        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createServiceOffering",
            array_merge(array(
                'displaytext' => $displayText,
                'name' => $name
            ), $optArgs)
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
     * Updates a service offering.
     *
     * @param string $id the ID of the service offering to be updated
     * @param array  $optArgs {
     *     @type string $displayText the display text of the service offering to be updated
     *     @type string $name the name of the service offering to be updated
     *     @type string $sortKey sort key of the service offering, integer
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
     * Lists all available service offerings.
     *
     * @param array  $optArgs {
     *     @type string $domainId the ID of the domain associated with the service offering
     *     @type string $id ID of the service offering
     *     @type string $isSystem is this a system vm offering
     *     @type string $keyword List by keyword
     *     @type string $name name of the service offering
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $systemVmType the system VM type. Possible types are "consoleproxy", "secondarystoragevm" or
     *     "domainrouter".
     *     @type string $virtualMachineId the ID of the virtual machine. Pass this in if you want to see the available
     *     service offering that a virtual machine can be changed to.
     * }
     */
    public function listServiceOfferings(array $optArgs = array()) {
        return $this->request("listServiceOfferings",
            $optArgs
        );
    }

    /**
     * Adds a Region
     *
     * @param string $id Id of the Region
     * @param string $endPoint Region service endpoint
     * @param string $name Name of the region
     */
    public function addRegion($id, $endPoint, $name) {
        if (empty($id)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "id"), MISSING_ARGUMENT);
        }
        if (empty($endPoint)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "endPoint"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("addRegion",
            array(
                'id' => $id,
                'endpoint' => $endPoint,
                'name' => $name
            )
        );
    }

    /**
     * Updates a region
     *
     * @param string $id Id of region to update
     * @param array  $optArgs {
     *     @type string $endPoint updates region with this end point
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
     * Lists Regions
     *
     * @param array  $optArgs {
     *     @type string $id List Region by region ID.
     *     @type string $keyword List by keyword
     *     @type string $name List Region by region name.
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listRegions(array $optArgs = array()) {
        return $this->request("listRegions",
            $optArgs
        );
    }

    /**
     * Creates a network offering.
     *
     * @param string $displayText the display text of the network offering
     * @param string $guestIpType guest type of the network offering: Shared or Isolated
     * @param string $name the name of the network offering
     * @param string $supportedServices services supported by the network offering
     * @param string $trafficType the traffic type for the network offering. Supported type in current release is
     * GUEST only
     * @param array  $optArgs {
     *     @type string $availability the availability of network offering. Default value is Optional
     *     @type string $conserveMode true if the network offering is IP conserve mode enabled
     *     @type string $details Network offering details in key/value pairs. Supported keys are
     *     internallbprovider/publiclbprovider with service provider as a value
     *     @type string $egressDefaultPolicy true if default guest network egress policy is allow; false if default egress
     *     policy is deny
     *     @type string $isPersistent true if network offering supports persistent networks; defaulted to false if not
     *     specified
     *     @type string $keepAliveEnabled if true keepalive will be turned on in the loadbalancer. At the time of writing
     *     this has only an effect on haproxy; the mode http and httpclose options are
     *     unset in the haproxy conf file.
     *     @type string $maxConnections maximum number of concurrent connections supported by the network offering
     *     @type string $networkRate data transfer rate in megabits per second allowed
     *     @type string $serviceCapabilityList desired service capabilities as part of network offering
     *     @type string $serviceOfferingId the service offering ID used by virtual router provider
     *     @type string $serviceProviderList provider to service mapping. If not specified, the provider for the service will
     *     be mapped to the default provider on the physical network
     *     @type string $specifyIpRanges true if network offering supports specifying ip ranges; defaulted to false if
     *     not specified
     *     @type string $specifyVlan true if network offering supports vlans
     *     @type string $tags the tags for the network offering.
     * }
     */
    public function createNetworkOffering($displayText, $guestIpType, $name, $supportedServices, $trafficType, array $optArgs = array()) {
        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }
        if (empty($guestIpType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "guestIpType"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($supportedServices)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "supportedServices"), MISSING_ARGUMENT);
        }
        if (empty($trafficType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "trafficType"), MISSING_ARGUMENT);
        }
        return $this->request("createNetworkOffering",
            array_merge(array(
                'displaytext' => $displayText,
                'guestiptype' => $guestIpType,
                'name' => $name,
                'supportedservices' => $supportedServices,
                'traffictype' => $trafficType
            ), $optArgs)
        );
    }

    /**
     * Updates a network offering.
     *
     * @param array  $optArgs {
     *     @type string $availability the availability of network offering. Default value is Required for Guest
     *     Virtual network offering; Optional for Guest Direct network offering
     *     @type string $displayText the display text of the network offering
     *     @type string $id the id of the network offering
     *     @type string $keepAliveEnabled if true keepalive will be turned on in the loadbalancer. At the time of writing
     *     this has only an effect on haproxy; the mode http and httpclose options are
     *     unset in the haproxy conf file.
     *     @type string $maxConnections maximum number of concurrent connections supported by the network offering
     *     @type string $name the name of the network offering
     *     @type string $sortKey sort key of the network offering, integer
     *     @type string $state update state for the network offering
     * }
     */
    public function updateNetworkOffering(array $optArgs = array()) {
        return $this->request("updateNetworkOffering",
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
     * Lists all available network offerings.
     *
     * @param array  $optArgs {
     *     @type string $availability the availability of network offering. Default value is Required
     *     @type string $displayText list network offerings by display text
     *     @type string $forVpc the network offering can be used only for network creation inside the VPC
     *     @type string $guestIpType list network offerings by guest type: Shared or Isolated
     *     @type string $id list network offerings by id
     *     @type string $isDefault true if need to list only default network offerings. Default value is false
     *     @type string $isTagged true if offering has tags specified
     *     @type string $keyword List by keyword
     *     @type string $name list network offerings by name
     *     @type string $networkId the ID of the network. Pass this in if you want to see the available network
     *     offering that a network can be changed to.
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $sourceNatSupported true if need to list only netwok offerings where source nat is supported, false
     *     otherwise
     *     @type string $specifyIpRanges true if need to list only network offerings which support specifying ip ranges
     *     @type string $specifyVlan the tags for the network offering.
     *     @type string $state list network offerings by state
     *     @type string $supportedServices list network offerings supporting certain services
     *     @type string $tags list network offerings by tags
     *     @type string $trafficType list by traffic type
     *     @type string $zoneId list netowrk offerings available for network creation in specific zone
     * }
     */
    public function listNetworkOfferings(array $optArgs = array()) {
        return $this->request("listNetworkOfferings",
            $optArgs
        );
    }

    /**
     * A command to list events.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $duration the duration of the event
     *     @type string $endDate the end date range of the list you want to retrieve (use format "yyyy-MM-dd" or
     *     the new format "yyyy-MM-dd HH:mm:ss")
     *     @type string $entryTime the time the event was entered
     *     @type string $id the ID of the event
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $level the event level (INFO, WARN, ERROR)
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $startDate the start date range of the list you want to retrieve (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-dd HH:mm:ss")
     *     @type string $type the event type (see event types)
     * }
     */
    public function listEvents(array $optArgs = array()) {
        return $this->request("listEvents",
            $optArgs
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
     * Archive one or more events.
     *
     * @param array  $optArgs {
     *     @type string $endDate end date range to archive events (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $ids the IDs of the events
     *     @type string $startDate start date range to archive events (including) this date (use format
     *     "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $type archive by event type
     * }
     */
    public function archiveEvents(array $optArgs = array()) {
        return $this->request("archiveEvents",
            $optArgs
        );
    }

    /**
     * Delete one or more events.
     *
     * @param array  $optArgs {
     *     @type string $endDate end date range to delete events (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $ids the IDs of the events
     *     @type string $startDate start date range to delete events (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $type delete by event type
     * }
     */
    public function deleteEvents(array $optArgs = array()) {
        return $this->request("deleteEvents",
            $optArgs
        );
    }

    /**
     * Creates a disk offering.
     *
     * @param string $displayText alternate display text of the disk offering
     * @param string $name name of the disk offering
     * @param array  $optArgs {
     *     @type string $bytesReadRate bytes read rate of the disk offering
     *     @type string $bytesWriteRate bytes write rate of the disk offering
     *     @type string $customized whether disk offering size is custom or not
     *     @type string $customizedIops whether disk offering iops is custom or not
     *     @type string $diskSize size of the disk offering in GB
     *     @type string $displayOffering an optional field, whether to display the offering to the end user or not.
     *     @type string $domainId the ID of the containing domain, null for public offerings
     *     @type string $hypervisorSnapshotReserve Hypervisor snapshot reserve space as a percent of a volume (for managed storage
     *     using Xen or VMware)
     *     @type string $iopsReadRate io requests read rate of the disk offering
     *     @type string $iopsWriteRate io requests write rate of the disk offering
     *     @type string $maxIops max iops of the disk offering
     *     @type string $minIops min iops of the disk offering
     *     @type string $storageType the storage type of the disk offering. Values are local and shared.
     *     @type string $tags tags for the disk offering
     * }
     */
    public function createDiskOffering($displayText, $name, array $optArgs = array()) {
        if (empty($displayText)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "displayText"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        return $this->request("createDiskOffering",
            array_merge(array(
                'displaytext' => $displayText,
                'name' => $name
            ), $optArgs)
        );
    }

    /**
     * Updates a disk offering.
     *
     * @param string $id ID of the disk offering
     * @param array  $optArgs {
     *     @type string $displayOffering an optional field, whether to display the offering to the end user or not.
     *     @type string $displayText updates alternate display text of the disk offering with this value
     *     @type string $name updates name of the disk offering with this value
     *     @type string $sortKey sort key of the disk offering, integer
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
     * Lists all available disk offerings.
     *
     * @param array  $optArgs {
     *     @type string $domainId the ID of the domain of the disk offering.
     *     @type string $id ID of the disk offering
     *     @type string $keyword List by keyword
     *     @type string $name name of the disk offering
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listDiskOfferings(array $optArgs = array()) {
        return $this->request("listDiskOfferings",
            $optArgs
        );
    }

    /**
     * Lists all alerts.
     *
     * @param array  $optArgs {
     *     @type string $id the ID of the alert
     *     @type string $keyword List by keyword
     *     @type string $name list by alert name
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $type list by alert type
     * }
     */
    public function listAlerts(array $optArgs = array()) {
        return $this->request("listAlerts",
            $optArgs
        );
    }

    /**
     * Archive one or more alerts.
     *
     * @param array  $optArgs {
     *     @type string $endDate end date range to archive alerts (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $ids the IDs of the alerts
     *     @type string $startDate start date range to archive alerts (including) this date (use format
     *     "yyyy-MM-dd" or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $type archive by alert type
     * }
     */
    public function archiveAlerts(array $optArgs = array()) {
        return $this->request("archiveAlerts",
            $optArgs
        );
    }

    /**
     * Delete one or more alerts.
     *
     * @param array  $optArgs {
     *     @type string $endDate end date range to delete alerts (including) this date (use format "yyyy-MM-dd"
     *     or the new format "yyyy-MM-ddThh:mm:ss")
     *     @type string $ids the IDs of the alerts
     *     @type string $startDate start date range to delete alerts (including) this date (use format "yyyy-MM-dd"
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
     * Generates an alert
     *
     * @param string $description Alert description
     * @param string $name Name of the alert
     * @param string $type Type of the alert
     * @param array  $optArgs {
     *     @type string $podId Pod id for which alert is generated
     *     @type string $zoneId Zone id for which alert is generated
     * }
     */
    public function generateAlert($description, $name, $type, array $optArgs = array()) {
        if (empty($description)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "description"), MISSING_ARGUMENT);
        }
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($type)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "type"), MISSING_ARGUMENT);
        }
        return $this->request("generateAlert",
            array_merge(array(
                'description' => $description,
                'name' => $name,
                'type' => $type
            ), $optArgs)
        );
    }

    /**
     * Lists storage providers.
     *
     * @param string $type the type of storage provider: either primary or image
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
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
     * Creates resource tag(s)
     *
     * @param string $resourceIds list of resources to create the tags for
     * @param string $resourceType type of the resource
     * @param string $tags Map of tags (key/value pairs)
     * @param array  $optArgs {
     *     @type string $customer identifies client specific tag. When the value is not null, the tag can't be
     *     used by cloudStack code internally
     * }
     */
    public function createTags($resourceIds, $resourceType, $tags, array $optArgs = array()) {
        if (empty($resourceIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceIds"), MISSING_ARGUMENT);
        }
        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }
        if (empty($tags)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "tags"), MISSING_ARGUMENT);
        }
        return $this->request("createTags",
            array_merge(array(
                'resourceids' => $resourceIds,
                'resourcetype' => $resourceType,
                'tags' => $tags
            ), $optArgs)
        );
    }

    /**
     * Deleting resource tag(s)
     *
     * @param string $resourceIds Delete tags for resource id(s)
     * @param string $resourceType Delete tag by resource type
     * @param array  $optArgs {
     *     @type string $tags Delete tags matching key/value pairs
     * }
     */
    public function deleteTags($resourceIds, $resourceType, array $optArgs = array()) {
        if (empty($resourceIds)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceIds"), MISSING_ARGUMENT);
        }
        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }
        return $this->request("deleteTags",
            array_merge(array(
                'resourceids' => $resourceIds,
                'resourcetype' => $resourceType
            ), $optArgs)
        );
    }

    /**
     * List resource tag(s)
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $customer list by customer name
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $key list by key
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     *     @type string $resourceId list by resource id
     *     @type string $resourceType list by resource type
     *     @type string $value list by value
     * }
     */
    public function listTags(array $optArgs = array()) {
        return $this->request("listTags",
            $optArgs
        );
    }

    /**
     * Adds detail for the Resource.
     *
     * @param string $details Map of (key/value pairs)
     * @param string $resourceId resource id to create the details for
     * @param string $resourceType type of the resource
     */
    public function addResourceDetail($details, $resourceId, $resourceType) {
        if (empty($details)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "details"), MISSING_ARGUMENT);
        }
        if (empty($resourceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceId"), MISSING_ARGUMENT);
        }
        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }
        return $this->request("addResourceDetail",
            array(
                'details' => $details,
                'resourceid' => $resourceId,
                'resourcetype' => $resourceType
            )
        );
    }

    /**
     * Removes detail for the Resource.
     *
     * @param string $resourceId Delete details for resource id
     * @param string $resourceType Delete detail by resource type
     * @param array  $optArgs {
     *     @type string $key Delete details matching key/value pairs
     * }
     */
    public function removeResourceDetail($resourceId, $resourceType, array $optArgs = array()) {
        if (empty($resourceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceId"), MISSING_ARGUMENT);
        }
        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }
        return $this->request("removeResourceDetail",
            array_merge(array(
                'resourceid' => $resourceId,
                'resourcetype' => $resourceType
            ), $optArgs)
        );
    }

    /**
     * List resource detail(s)
     *
     * @param string $resourceId list by resource id
     * @param string $resourceType list by resource type
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $forDisplay if set to true, only details marked with display=true, are returned. Always
     *     false is the call is made by the regular user
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $key list by key
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $projectId list objects by project
     * }
     */
    public function listResourceDetails($resourceId, $resourceType, array $optArgs = array()) {
        if (empty($resourceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceId"), MISSING_ARGUMENT);
        }
        if (empty($resourceType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "resourceType"), MISSING_ARGUMENT);
        }
        return $this->request("listResourceDetails",
            array_merge(array(
                'resourceid' => $resourceId,
                'resourcetype' => $resourceType
            ), $optArgs)
        );
    }

    /**
     * adds a range of portable public IP's to a region
     *
     * @param string $endIp the ending IP address in the portable IP range
     * @param string $gateway the gateway for the portable IP range
     * @param string $netmask the netmask of the portable IP range
     * @param string $regionId Id of the Region
     * @param string $startIp the beginning IP address in the portable IP range
     * @param array  $optArgs {
     *     @type string $vlan VLAN id, if not specified defaulted to untagged
     * }
     */
    public function createPortableIpRange($endIp, $gateway, $netmask, $regionId, $startIp, array $optArgs = array()) {
        if (empty($endIp)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "endIp"), MISSING_ARGUMENT);
        }
        if (empty($gateway)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "gateway"), MISSING_ARGUMENT);
        }
        if (empty($netmask)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "netmask"), MISSING_ARGUMENT);
        }
        if (empty($regionId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "regionId"), MISSING_ARGUMENT);
        }
        if (empty($startIp)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "startIp"), MISSING_ARGUMENT);
        }
        return $this->request("createPortableIpRange",
            array_merge(array(
                'endip' => $endIp,
                'gateway' => $gateway,
                'netmask' => $netmask,
                'regionid' => $regionId,
                'startip' => $startIp
            ), $optArgs)
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
     * list portable IP ranges
     *
     * @param array  $optArgs {
     *     @type string $id Id of the portable ip range
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $regionId Id of a Region
     * }
     */
    public function listPortableIpRanges(array $optArgs = array()) {
        return $this->request("listPortableIpRanges",
            $optArgs
        );
    }

    /**
     * Adds a Nicira NVP device
     *
     * @param string $hostname Hostname of ip address of the Nicira NVP Controller.
     * @param string $password Credentials to access the Nicira Controller API
     * @param string $physicalNetworkId the Physical Network ID
     * @param string $transportZoneUuid The Transportzone UUID configured on the Nicira Controller
     * @param string $userName Credentials to access the Nicira Controller API
     * @param array  $optArgs {
     *     @type string $l3GatewayServiceUuid The L3 Gateway Service UUID configured on the Nicira Controller
     * }
     */
    public function addNiciraNvpDevice($hostname, $password, $physicalNetworkId, $transportZoneUuid, $userName, array $optArgs = array()) {
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        if (empty($transportZoneUuid)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "transportZoneUuid"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("addNiciraNvpDevice",
            array_merge(array(
                'hostname' => $hostname,
                'password' => $password,
                'physicalnetworkid' => $physicalNetworkId,
                'transportzoneuuid' => $transportZoneUuid,
                'username' => $userName
            ), $optArgs)
        );
    }

    /**
     * delete a nicira nvp device
     *
     * @param string $nvpDeviceId Nicira device ID
     */
    public function deleteNiciraNvpDevice($nvpDeviceId) {
        if (empty($nvpDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nvpDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteNiciraNvpDevice",
            array(
                'nvpdeviceid' => $nvpDeviceId
            )
        );
    }

    /**
     * Lists Nicira NVP devices
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $nvpDeviceId nicira nvp device ID
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId the Physical Network ID
     * }
     */
    public function listNiciraNvpDevices(array $optArgs = array()) {
        return $this->request("listNiciraNvpDevices",
            $optArgs
        );
    }

    /**
     * Assigns secondary IP to NIC
     *
     * @param string $nicId the ID of the nic to which you want to assign private IP
     * @param array  $optArgs {
     *     @type string $ipAddress Secondary IP Address
     * }
     */
    public function addIpToNic($nicId, array $optArgs = array()) {
        if (empty($nicId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "nicId"), MISSING_ARGUMENT);
        }
        return $this->request("addIpToNic",
            array_merge(array(
                'nicid' => $nicId
            ), $optArgs)
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
     * list the vm nics  IP to NIC
     *
     * @param string $virtualMachineId the ID of the vm
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $nicId the ID of the nic to to list IPs
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listNics($virtualMachineId, array $optArgs = array()) {
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "virtualMachineId"), MISSING_ARGUMENT);
        }
        return $this->request("listNics",
            array_merge(array(
                'virtualmachineid' => $virtualMachineId
            ), $optArgs)
        );
    }

    /**
     * Adds a network device of one of the following types: ExternalDhcp,
     * ExternalFirewall, ExternalLoadBalancer, PxeServer
     *
     * @param array  $optArgs {
     *     @type string $networkDeviceParameterList parameters for network device
     *     @type string $networkDeviceType Network device type, now supports ExternalDhcp, PxeServer,
     *     NetscalerMPXLoadBalancer, NetscalerVPXLoadBalancer, NetscalerSDXLoadBalancer,
     *     F5BigIpLoadBalancer, JuniperSRXFirewall, PaloAltoFirewall
     * }
     */
    public function addNetworkDevice(array $optArgs = array()) {
        return $this->request("addNetworkDevice",
            $optArgs
        );
    }

    /**
     * List network devices
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $networkDeviceParameterList parameters for network device
     *     @type string $networkDeviceType Network device type, now supports ExternalDhcp, PxeServer,
     *     NetscalerMPXLoadBalancer, NetscalerVPXLoadBalancer, NetscalerSDXLoadBalancer,
     *     F5BigIpLoadBalancer, JuniperSRXFirewall, PaloAltoFirewall
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listNetworkDevice(array $optArgs = array()) {
        return $this->request("listNetworkDevice",
            $optArgs
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
     * List hypervisors
     *
     * @param array  $optArgs {
     *     @type string $zoneId the zone id for listing hypervisors.
     * }
     */
    public function listHypervisors(array $optArgs = array()) {
        return $this->request("listHypervisors",
            $optArgs
        );
    }

    /**
     * Updates a hypervisor capabilities.
     *
     * @param array  $optArgs {
     *     @type string $id ID of the hypervisor capability
     *     @type string $maxGuestsLimit the max number of Guest VMs per host for this hypervisor.
     *     @type string $securityGroupEnabled set true to enable security group for this hypervisor.
     * }
     */
    public function updateHypervisorCapabilities(array $optArgs = array()) {
        return $this->request("updateHypervisorCapabilities",
            $optArgs
        );
    }

    /**
     * Lists all hypervisor capabilities.
     *
     * @param array  $optArgs {
     *     @type string $hypervisor the hypervisor for which to restrict the search
     *     @type string $id ID of the hypervisor capability
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listHypervisorCapabilities(array $optArgs = array()) {
        return $this->request("listHypervisorCapabilities",
            $optArgs
        );
    }

    /**
     * Adds F5 external load balancer appliance.
     *
     * @param string $password Password of the external load balancer appliance.
     * @param string $url URL of the external load balancer appliance.
     * @param string $userName Username of the external load balancer appliance.
     * @param string $zoneId Zone in which to add the external load balancer appliance.
     */
    public function addExternalLoadBalancer($password, $url, $userName, $zoneId) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("addExternalLoadBalancer",
            array(
                'password' => $password,
                'url' => $url,
                'username' => $userName,
                'zoneid' => $zoneId
            )
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
     * Lists F5 external load balancer appliances added in a zone.
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $zoneId zone Id
     * }
     */
    public function listExternalLoadBalancers(array $optArgs = array()) {
        return $this->request("listExternalLoadBalancers",
            $optArgs
        );
    }

    /**
     * Adds an external firewall appliance
     *
     * @param string $password Password of the external firewall appliance.
     * @param string $url URL of the external firewall appliance.
     * @param string $userName Username of the external firewall appliance.
     * @param string $zoneId Zone in which to add the external firewall appliance.
     */
    public function addExternalFirewall($password, $url, $userName, $zoneId) {
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("addExternalFirewall",
            array(
                'password' => $password,
                'url' => $url,
                'username' => $userName,
                'zoneid' => $zoneId
            )
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
     * List external firewall appliances.
     *
     * @param string $zoneId zone Id
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listExternalFirewalls($zoneId, array $optArgs = array()) {
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("listExternalFirewalls",
            array_merge(array(
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

    /**
     * Adds a BigSwitch VNS device
     *
     * @param string $hostname Hostname of ip address of the BigSwitch VNS Controller.
     * @param string $physicalNetworkId the Physical Network ID
     */
    public function addBigSwitchVnsDevice($hostname, $physicalNetworkId) {
        if (empty($hostname)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "hostname"), MISSING_ARGUMENT);
        }
        if (empty($physicalNetworkId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "physicalNetworkId"), MISSING_ARGUMENT);
        }
        return $this->request("addBigSwitchVnsDevice",
            array(
                'hostname' => $hostname,
                'physicalnetworkid' => $physicalNetworkId
            )
        );
    }

    /**
     * delete a bigswitch vns device
     *
     * @param string $vnsDeviceId BigSwitch device ID
     */
    public function deleteBigSwitchVnsDevice($vnsDeviceId) {
        if (empty($vnsDeviceId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "vnsDeviceId"), MISSING_ARGUMENT);
        }
        return $this->request("deleteBigSwitchVnsDevice",
            array(
                'vnsdeviceid' => $vnsDeviceId
            )
        );
    }

    /**
     * Lists BigSwitch Vns devices
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId the Physical Network ID
     *     @type string $vnsDeviceId bigswitch vns device ID
     * }
     */
    public function listBigSwitchVnsDevices(array $optArgs = array()) {
        return $this->request("listBigSwitchVnsDevices",
            $optArgs
        );
    }

    /**
     * Acquires and associates a public IP to an account.
     *
     * @param array  $optArgs {
     *     @type string $account the account to associate with this IP address
     *     @type string $domainId the ID of the domain to associate with this IP address
     *     @type string $isPortable should be set to true if public IP is required to be transferable across zones,
     *     if not specified defaults to false
     *     @type string $networkId The network this ip address should be associated to.
     *     @type string $projectId Deploy vm for the project
     *     @type string $regionId region ID from where portable ip is to be associated.
     *     @type string $vpcId the VPC you want the ip address to be associated with
     *     @type string $zoneId the ID of the availability zone you want to acquire an public IP address from
     * }
     */
    public function associateIpAddress(array $optArgs = array()) {
        return $this->request("associateIpAddress",
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
     * Lists all public ip addresses
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $allocatedOnly limits search results to allocated public IP addresses
     *     @type string $associatedNetworkId lists all public IP addresses associated to the network specified
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $forLoadBalancing list only ips used for load balancing
     *     @type string $forVirtualNetwork the virtual network for the IP address
     *     @type string $id lists ip address by id
     *     @type string $ipAddress lists the specified IP address
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $isSourceNat list only source nat ip addresses
     *     @type string $isStaticNat list only static nat ip addresses
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $physicalNetworkId lists all public IP addresses by physical network id
     *     @type string $projectId list objects by project
     *     @type string $tags List resources by tags (key/value pairs)
     *     @type string $vlanId lists all public IP addresses by VLAN ID
     *     @type string $vpcId List ips belonging to the VPC
     *     @type string $zoneId lists all public IP addresses by Zone ID
     * }
     */
    public function listPublicIpAddresses(array $optArgs = array()) {
        return $this->request("listPublicIpAddresses",
            $optArgs
        );
    }

    /**
     * Adds Swift.
     *
     * @param string $url the URL for swift
     * @param array  $optArgs {
     *     @type string $account the account for swift
     *     @type string $key key for the user for swift
     *     @type string $userName the username for swift
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
     * List Swift.
     *
     * @param array  $optArgs {
     *     @type string $id the id of the swift
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listSwifts(array $optArgs = array()) {
        return $this->request("listSwifts",
            $optArgs
        );
    }

    /**
     * Adds S3
     *
     * @param string $accessKey S3 access key
     * @param string $bucket name of the template storage bucket
     * @param string $secretKey S3 secret key
     * @param array  $optArgs {
     *     @type string $connectionTimeout connection timeout (milliseconds)
     *     @type string $endPoint S3 host name
     *     @type string $maxErrorRetry maximum number of times to retry on error
     *     @type string $socketTimeout socket timeout (milliseconds)
     *     @type string $useHttps connect to the S3 endpoint via HTTPS?
     * }
     */
    public function addS3($accessKey, $bucket, $secretKey, array $optArgs = array()) {
        if (empty($accessKey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accessKey"), MISSING_ARGUMENT);
        }
        if (empty($bucket)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "bucket"), MISSING_ARGUMENT);
        }
        if (empty($secretKey)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "secretKey"), MISSING_ARGUMENT);
        }
        return $this->request("addS3",
            array_merge(array(
                'accesskey' => $accessKey,
                'bucket' => $bucket,
                'secretkey' => $secretKey
            ), $optArgs)
        );
    }

    /**
     * Lists S3s
     *
     * @param array  $optArgs {
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listS3s(array $optArgs = array()) {
        return $this->request("listS3s",
            $optArgs
        );
    }

    /**
     * Lists all supported OS types for this cloud.
     *
     * @param array  $optArgs {
     *     @type string $description list os by description
     *     @type string $id list by Os type Id
     *     @type string $keyword List by keyword
     *     @type string $osCategoryId list by Os Category id
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listOsTypes(array $optArgs = array()) {
        return $this->request("listOsTypes",
            $optArgs
        );
    }

    /**
     * Lists all supported OS categories for this cloud.
     *
     * @param array  $optArgs {
     *     @type string $id list Os category by id
     *     @type string $keyword List by keyword
     *     @type string $name list os category by name
     *     @type string $page 
     *     @type string $pageSize 
     * }
     */
    public function listOsCategories(array $optArgs = array()) {
        return $this->request("listOsCategories",
            $optArgs
        );
    }

    /**
     * Retrieves the current status of asynchronous job.
     *
     * @param string $jobId the ID of the asychronous job
     */
    public function queryAsyncJobResult($jobId) {
        if (empty($jobId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "jobId"), MISSING_ARGUMENT);
        }
        return $this->request("queryAsyncJobResult",
            array(
                'jobid' => $jobId
            )
        );
    }

    /**
     * Lists all pending asynchronous jobs for the account.
     *
     * @param array  $optArgs {
     *     @type string $account list resources by account. Must be used with the domainId parameter.
     *     @type string $domainId list only resources belonging to the domain specified
     *     @type string $isRecursive defaults to false, but if true, lists all resources from the parent specified by
     *     the domainId till leaves.
     *     @type string $keyword List by keyword
     *     @type string $listAll If set to false, list only resources belonging to the command's caller; if set
     *     to true - list resources that the caller is authorized to see. Default value is
     *     false
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $startDate the start date of the async job
     * }
     */
    public function listAsyncJobs(array $optArgs = array()) {
        return $this->request("listAsyncJobs",
            $optArgs
        );
    }

    /**
     * Lists all the system wide capacities.
     *
     * @param array  $optArgs {
     *     @type string $clusterId lists capacity by the Cluster ID
     *     @type string $fetchLatest recalculate capacities and fetch the latest
     *     @type string $keyword List by keyword
     *     @type string $page 
     *     @type string $pageSize 
     *     @type string $podId lists capacity by the Pod ID
     *     @type string $sortBy Sort the results. Available values: Usage
     *     @type string $type lists capacity by type* CAPACITY_TYPE_MEMORY = 0* CAPACITY_TYPE_CPU = 1*
     *     CAPACITY_TYPE_STORAGE = 2* CAPACITY_TYPE_STORAGE_ALLOCATED = 3*
     *     CAPACITY_TYPE_VIRTUAL_NETWORK_PUBLIC_IP = 4* CAPACITY_TYPE_PRIVATE_IP = 5*
     *     CAPACITY_TYPE_SECONDARY_STORAGE = 6* CAPACITY_TYPE_VLAN = 7*
     *     CAPACITY_TYPE_DIRECT_ATTACHED_PUBLIC_IP = 8* CAPACITY_TYPE_LOCAL_STORAGE = 9.
     *     @type string $zoneId lists capacity by the Zone ID
     * }
     */
    public function listCapacity(array $optArgs = array()) {
        return $this->request("listCapacity",
            $optArgs
        );
    }

    /**
     * Logs out the user
     *
     */
    public function logout() {
        return $this->request("logout",
            $optArgs
        );
    }

    /**
     * Logs a user into the CloudStack. A successful login attempt will generate a
     * JSESSIONID cookie value that can be passed in subsequent Query command calls
     * until the "logout" command has been issued or the session has expired.
     *
     * @param string $userName Username
     * @param string $password Hashed password (Default is MD5). If you wish to use any other hashing
     * algorithm, you would need to write a custom authentication adapter See Docs
     * section.
     * @param array  $optArgs {
     *     @type string $domain path of the domain that the user belongs to. Example:
     *     domain=/com/cloud/internal.  If no domain is passed in, the ROOT domain is
     *     assumed.
     *     @type string $domainId id of the domain that the user belongs to. If both domain and domainId are
     *     passed in, "domainId" parameter takes precendence
     * }
     */
    public function login($userName, $password, array $optArgs = array()) {
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        if (empty($password)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "password"), MISSING_ARGUMENT);
        }
        return $this->request("login",
            array_merge(array(
                'username' => $userName,
                'password' => $password
            ), $optArgs)
        );
    }

    /**
     * Creates an account from an LDAP user
     *
     * @param string $accountType Type of the account.  Specify 0 for user, 1 for root admin, and 2 for domain
     * admin
     * @param string $userName Unique username.
     * @param array  $optArgs {
     *     @type string $account Creates the user under the specified account. If no account is specified, the
     *     username will be used as the account name.
     *     @type string $accountDetails details for account used to store specific parameters
     *     @type string $accountId Account UUID, required for adding account from external provisioning system
     *     @type string $domainId Creates the user under the specified domain.
     *     @type string $networkDomain Network domain for the account's networks
     *     @type string $timezone Specifies a timezone for this command. For more information on the timezone
     *     parameter, see Time Zone Format.
     *     @type string $userId User UUID, required for adding account from external provisioning system
     * }
     */
    public function ldapCreateAccount($accountType, $userName, array $optArgs = array()) {
        if (empty($accountType)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "accountType"), MISSING_ARGUMENT);
        }
        if (empty($userName)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userName"), MISSING_ARGUMENT);
        }
        return $this->request("ldapCreateAccount",
            array_merge(array(
                'accounttype' => $accountType,
                'username' => $userName
            ), $optArgs)
        );
    }

    /**
     * Retrieves a cloud identifier.
     *
     * @param string $userId the user ID for the cloud identifier
     */
    public function getCloudIdentifier($userId) {
        if (empty($userId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "userId"), MISSING_ARGUMENT);
        }
        return $this->request("getCloudIdentifier",
            array(
                'userid' => $userId
            )
        );
    }

    /**
     * Uploads a custom certificate for the console proxy VMs to use for SSL. Can be
     * used to upload a single certificate signed by a known CA. Can also be used,
     * through multiple calls, to upload a chain of certificates from CA to the custom
     * certificate itself.
     *
     * @param string $certificate The certificate to be uploaded.
     * @param string $domainSuffix DNS domain suffix that the certificate is granted for.
     * @param array  $optArgs {
     *     @type string $id An integer providing the location in a chain that the certificate will hold.
     *     Usually, this can be left empty. When creating a chain, the top level
     *     certificate should have an ID of 1, with each step in the chain incrementing by
     *     one. Example, CA with id = 1, Intermediate CA with id = 2, Site certificate with
     *     ID = 3
     *     @type string $name A name / alias for the certificate.
     *     @type string $privateKey The private key for the attached certificate.
     * }
     */
    public function uploadCustomCertificate($certificate, $domainSuffix, array $optArgs = array()) {
        if (empty($certificate)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "certificate"), MISSING_ARGUMENT);
        }
        if (empty($domainSuffix)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "domainSuffix"), MISSING_ARGUMENT);
        }
        return $this->request("uploadCustomCertificate",
            array_merge(array(
                'certificate' => $certificate,
                'domainsuffix' => $domainSuffix
            ), $optArgs)
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
     * Adds stratosphere ssp server
     *
     * @param string $name stratosphere ssp api name
     * @param string $url stratosphere ssp server url
     * @param string $zoneId the zone ID
     * @param array  $optArgs {
     *     @type string $password stratosphere ssp api password
     *     @type string $tenantUuid stratosphere ssp tenant uuid
     *     @type string $userName stratosphere ssp api username
     * }
     */
    public function addStratosphereSsp($name, $url, $zoneId, array $optArgs = array()) {
        if (empty($name)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "name"), MISSING_ARGUMENT);
        }
        if (empty($url)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "url"), MISSING_ARGUMENT);
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(sprintf(MISSING_ARGUMENT_MSG, "zoneId"), MISSING_ARGUMENT);
        }
        return $this->request("addStratosphereSsp",
            array_merge(array(
                'name' => $name,
                'url' => $url,
                'zoneid' => $zoneId
            ), $optArgs)
        );
    }

}
