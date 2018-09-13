<?php

namespace App\Objects;

use Cryslo\Enums\Env;

/**
 * Created by PhpStorm.
 *
 * @author Ross Edlin <contact@rossedlin.com>
 *
 * Date: 30/08/18
 * Time: 12:58
 *
 * Class JsonResponse
 * @package App\Objects
 */
class JsonResponse
{
    private $success = false;

    private $debug = [];

    private $payload = [];

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success)
    {
        $this->success = $success;
    }

    /**
     * @param array $debug
     */
    public function setDebug(array $debug)
    {
        $this->debug = $debug;
    }

    /**
     * @param array $payload
     */
    public function setPayload(array $payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        if (getenv(Env::APP_ENV) == 'local' ||
            getenv(Env::APP_ENV) == 'testing' ||
            getenv(Env::APP_ENV) == 'develop' ||
            getenv(Env::APP_ENV) == 'uat') {

            /**
             * Local / Development / UAT
             */
            return [
                'success' => $this->success,
                'app_env' => getenv(Env::APP_ENV),
                'debug'   => $this->debug,
                'payload' => $this->payload,
            ];
        } else {

            /**
             * Everything Else
             */
            return [
                'success' => $this->success,
                'payload' => $this->payload,
            ];
        }
    }
}
