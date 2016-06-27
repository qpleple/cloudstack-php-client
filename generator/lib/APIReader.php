<?php
/*
 * This file is part of the CloudStack Client Generator.
 *
 * (c) Quentin Pleplé <quentin.pleple@gmail.com>
 * (c) Aaron Hurt <ahurt@anbcs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class APIReader
{
    /** @var Lib */
    protected $lib;
    
    protected $config;
    protected $extension;

    /**
     * APIReader constructor.
     * @param Lib $lib
     * @throws Exception
     */
    function __construct(Lib $lib)
    {
        $this->lib = $lib;
        $this->config = $lib->config;
        if ($this->config['language'] == "php") {
            $this->extension = "php";
        } elseif ($this->config['language'] == "python") {
            $this->extension = "py";
        } else {
            throw new Exception("Language " . $this->config['language'] . " not supported.");
        }
    }

    public function dumpMethodData($method)
    {
        $methods = $this->fetchApiData();
        if (isset($methods[$method])) {
            var_dump($this->getMethodData($methods[$method]));
        } else {
            print "Unknown Method!\n";
        }
    }

    public function dumpMethod($method)
    {
        $methods = $this->fetchApiData();
        if (isset($methods[$method])) {
            $this->lib->render("method." . $this->extension . ".twig", array(
                "method" => $this->getMethodData($methods[$method]),
                "config" => $this->config,
            ));
        }
    }

    public function dumpMethodNames()
    {
        $methods = $this->fetchApiData();
        foreach ($methods as $method) {
            printf("%s - %s\n", $method->name, $method->description);
        }
    }

    public function dumpClass()
    {
        $methods = $this->fetchApiData();
        $methodsData = array();

        // walk through all links
        foreach ($methods as $method) {
            $methodsData[] = $this->getMethodData($method);
        }

        $this->lib->render("class." . $this->extension . ".twig", array(
            "methods" => $methodsData,
            "config" => $this->config,
        ));
    }

    public function getMethodData($raw)
    {
        $data = array(
            'name' => trim($raw->name),
            'description' => trim($raw->description),
            'required' => 0,
            'optional' => 0,
            'params' => array()
        );

        // loop through paramaters
        foreach($raw->params as $param) {
            // increase counts
            if ($param->required == true) {
                $data['required']++;
            } else {
                $data['optional']++;
            }
            // special case for missing descriptions
            switch ($param->name) {
                case "pagesize":
                    $param->description = "the number of entries per page";
                break;
                case "page":
                    $param->description = "the page number of the result set";
                break;
            }
            // build paramater data
            $data['params'][] = array(
                "name" => trim($param->name),
                "description" => trim($param->description),
                "required" => (bool) $param->required,
            );
        }

        return $data;
    }

    private function fetchApiData() {
        // Pull API list from CloudStack
        $rawData = $this->lib->cloudstack->request('listApis', array());
        $methodData = array();
        foreach ($rawData as $method) {
            $methodData[$method->name] = $method;
        }
        return $methodData;
    }

}
