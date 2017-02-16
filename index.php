<?php
/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 09/02/2017
 * Time: 12:25
 */

require __DIR__ . '/vendor/autoload.php';

use \Cryslo\Core\Email;

$to   = [
	'rossedlin@gmail.com',
	'rossedlin@hotmail.com',
];
$from = [
	'noreply@cryslo.com' => 'Cryslo Team',
];

$subject = "Test Email";
$message = "Hello World";

pre(Email::sendHtml($to, $from, $subject, Email::getTemplate()));