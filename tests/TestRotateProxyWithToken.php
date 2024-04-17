<?php

use Proxyrequest\ProxyRequestRotate;

require '../vendor/autoload.php';

/**
 * Usage example
 */
$proxyRequestRotate = new ProxyRequestRotate('http://', 'example_of_token_BGFkldfc6gbds456gSmg5nghs79hSmndsF375sd0H4866');
/***
 * To be called to use private server
 */
// $proxyRequestRotate->setServer('');

echo $proxyRequestRotate->sendRequest();