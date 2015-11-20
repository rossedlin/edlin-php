<?php
namespace Cryslo\Object;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 30/09/2015
 * Time: 20:41
 */

class API extends _Object
{
    /** @var string */
    private $version;

    /** @var string */
    private $group = false;

    /** @var string */
    private $plugin = false;

    /** @var array */
    private $response;

    /** @var array */
    private $data;

    //*****************************************************************************************************************************
    //Abstract
    //*****************************************************************************************************************************

    /**
     * @return null
     */
    public function init()
    {

    }

    /**
     * @param array $data
     * @return bool
     */
    public function load(array $data)
    {
        if (isset($data['version'])) $this->setVersion($data['version']);
        if (isset($data['group'])) $this->setGroup($data['group']);
        if (isset($data['plugin'])) $this->setPlugin($data['plugin']);

        //response
        if ((isset($data['response'])) && (is_array($data['response']))) $this->setResponse($data['response']);
        if ((isset($data['data'])) && (is_array($data['data']))) $this->setData($data['data']);
    }

    //*****************************************************************************************************************************
    //Getters - Setters
    //*****************************************************************************************************************************

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        if (is_numeric($version))
        {
            $this->version = $version;
        }
    }

    /**
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param string $group
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getPlugin()
    {
        return $this->plugin;
    }

    /**
     * @param string $plugin_name
     */
    public function setPlugin($plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param array $response
     */
    public function setResponse(array $response)
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }
}