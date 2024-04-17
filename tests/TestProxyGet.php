<?php

use Proxyrequest\ProxyRequestGet;
use Proxyrequest\ProxyRequestRotate;

require '../vendor/autoload.php';

/**
 * Usage example
 */
$proxyRequestGet = new ProxyRequestGet();

echo $proxyRequestGet->sendRequest();
