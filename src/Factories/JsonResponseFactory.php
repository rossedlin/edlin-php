<?php

namespace Cryslo\Factories;

use App\Objects\JsonResponse;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 30/08/18
 * Time: 13:00
 *
 * Class JsonResponse
 * @package App\Factories
 */
class JsonResponseFactory
{
    /**
     * @return JsonResponse
     */
    public static function fail()
    {
        $jsonResponse = new JsonResponse();
        $jsonResponse->setSuccess(false);

        return $jsonResponse;
    }

    /**
     * @param array $debug
     * @return JsonResponse
     */
    public static function failWithDebug(array $debug)
    {
        $jsonResponse = new JsonResponse();
        $jsonResponse->setSuccess(false);
        $jsonResponse->setDebug($debug);

        return $jsonResponse;
    }

    /**
     * @return JsonResponse
     */
    public static function success()
    {
        $jsonResponse = new JsonResponse();
        $jsonResponse->setSuccess(true);

        return $jsonResponse;
    }

    /**
     * @param array $payload
     * @return JsonResponse
     */
    public static function successWithPayload(array $payload = [])
    {
        $jsonResponse = new JsonResponse();
        $jsonResponse->setSuccess(true);
        $jsonResponse->setPayload($payload);

        return $jsonResponse;
    }
}
