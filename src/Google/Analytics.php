<?php

namespace Edlin\Google;

use Edlin\Enums\Time;
use Edlin\Request;
use Edlin\View;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 30/01/2017
 * Time: 15:37
 *
 * Class Analytics
 * @package Cryslo\Core\Api\Google
 */
class Analytics
{
    /**
     *
     */
    const COOKIE_EXCLUDE = 'exclude-google-analytics';

    /**
     * @return bool
     */
    public static function cookieExists(): bool
    {
        /**
         * Check if we have a cookie set
         * Refresh it if we do
         */
        if (Request::cookie(self::COOKIE_EXCLUDE)) {
            return true;
        }

        return false;
    }

    /**
     * @return void
     */
    public static function setCookie()
    {
        \Edlin\Cookie::set(self::COOKIE_EXCLUDE, true, time() + Time::YEAR);
    }

    /**
     * @param $code
     *
     * @return string
     * @throws \Exception
     */
    public static function getHtml($code)
    {
        return View::getHtml('Google/Analytics', [
            'code' => $code,
        ]);
    }
}