<?php
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 09/02/2017
 * Time: 12:25
 */

require __DIR__ . '/vendor/autoload.php';

use \Cryslo\Core\View;

echo View::getHtml('Index/Default');