<?php

use Proxyrequest\ProxyRequestRotate;

require '../vendor/autoload.php';

/**
 * Usage example
 */
$proxyRequestRotate = new ProxyRequestRotate('http://ar61.ru', 'PRIVATE_TOKEN_KEY_HERE');
/***
 * To be called to use private server instead of public by default
 */
// $proxyRequestRotate->setServer('');

echo $proxyRequestRotate->sendRequest();