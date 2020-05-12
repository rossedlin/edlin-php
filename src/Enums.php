<?php

namespace Edlin;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 18/09/2016
 * Time: 16:48
 */
class Enums
{
    /**
     * Line Endings
     */
    const CRLF = "\r\n";
    const LF   = "\n";

    /**
     * Html
     */
    const PRE = "<pre>";
    const PRE_END = "</pre>";

    /**
     * PHP Server Global Vars
     */
    const DOCUMENT_ROOT = 'DOCUMENT_ROOT';
    const REMOTE_ADDR   = 'REMOTE_ADDR';

    /**
     * Content Types
     */
    const CONTENT_TYPE_PLAIN = 'text/plain';
    const CONTENT_TYPE_HTML  = 'text/html';
}
