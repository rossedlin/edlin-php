<?php

namespace Edlin;

use Edlin\Exceptions\EdlinException;

/**
 * Date: 26/09/2021
 * Time: 19:30
 *
 * @author       Ross Edlin <contact@rossedlin.com>
 * @noinspection PhpUnused
 */
class Curl
{
    /**
     * @param string $url
     *
     * @return string
     *
     * @throws EdlinException
     * @noinspection PhpUnused
     */
    public static function getHeaders(string $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_URL, $url);
        $out = curl_exec($ch);

        // line endings is the wonkiest piece of this whole thing
        $out = str_replace("\r", "", $out);

        // only look at the headers
        $headers_end = strpos($out, "\n\n");
        if ($headers_end !== false) {
            return substr($out, 0, $headers_end);
        }

        throw new EdlinException('Could not find headers from URL: ' . $url);
    }
}
