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
     *     @type string $networkId the id network network for the egress firwall services
     *     @type string $networkId list firewall rules for ceratin network
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
     * Lists capabilities
     *
     */
    public function listCapabilities() {
        return $this->request("listCapabilities",
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

}
