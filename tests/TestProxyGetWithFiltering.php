<?php

use Proxyrequest\ProxyRequestGet;

require '../vendor/autoload.php';

/**
 *
 * Usage example with parameters,
 * Filtering is available with private token
 */
$proxyRequestGet = new ProxyRequestGet();

$proxyRequestGet->setPortProxy('80')
    ->setHttp(1)
    ->setLimit(100)
    ->setCountryCodeRaw('IT,DE');

echo $proxyRequestGet->sendRequest();
