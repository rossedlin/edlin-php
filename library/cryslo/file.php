<?php
namespace Cryslo;
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 21/11/2015
 * Time: 13:32
 */


class File
{
    static public function write($filename, $data)
    {
        $response = new Response();
        if ((file_exists($filename)) && (!is_writable($filename)))
        {
            $response->addResponse("SaveData() file is not writable!");
            $response->setSuccess(false);
            return $response;
        }
    }
}