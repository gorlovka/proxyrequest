<?php

use Proxyrequest\ProxyRequestRotate;

require '../vendor/autoload.php';

/**
 * Usage example
 */
$proxyRequestRotate = new ProxyRequestRotate('http://proxyrequest.ru');

echo $proxyRequestRotate->sendRequest();
