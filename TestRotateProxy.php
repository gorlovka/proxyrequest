<?php

use Proxyrequest\ProxyRequestRotate;

require 'vendor/autoload.php';

$proxyRequestRotate = new ProxyRequestRotate('http://proxyrequest.ru','i_am_a_test_token_i_can_intentionally_parse_only_proxyrequest_ru');

//echo $proxyRequestRotate->getProxyResponse();
echo $proxyRequestRotate->sendRequest();