<?php

use Proxyrequest\ProxyRequestGet;

require '../vendor/autoload.php';

/**
 * Usage example
 */
$proxyRequestGet = new ProxyRequestGet();

echo $proxyRequestGet->sendRequest();
