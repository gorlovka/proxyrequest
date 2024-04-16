<?php

use Proxyrequest\ProxyRequestRotate;

require 'vendor/autoload.php';

/**
 * Usage example
 */
$proxyRequestRotate = new ProxyRequestRotate('http://proxyrequest.ru','internal_BGFkldfc6gbds456gSmg5nghs79hSmndsF375sd0Hnjss');

echo $proxyRequestRotate->sendRequest();