<?php
namespace Cryslo;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 21/11/2015
 * Time: 13:36
 */

class Response
{
    /** @var array */
    private $_response = [];

    private $_success = false;

    /**
     * @return array
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * @param string $response
     */
    public function addResponse($response)
    {
        $this->_response[] = $response;
    }

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->_success;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->_success = $success;
    }
}