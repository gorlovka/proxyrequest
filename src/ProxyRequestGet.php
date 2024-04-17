<?php

/*
 *   Created on: Jun 23, 2020   12:31:08 AM
 */

namespace Proxyrequest;

use Proxyrequest\Conract\ProxyRequestInterface;

class ProxyRequestGet implements ProxyRequestInterface
{
    const SERVER_PUBLIC = 'http://public.proxyrequest.ru';

    const TOKEN_FREE = 'free';

    private $server;

    private $token;

    public function __construct($token = '', $server = '')
    {
        $this->token = $token ?: self::TOKEN_FREE;
        $this->server = $server ?: self::SERVER_PUBLIC;
    }

    public function sendRequest()
    {
        $urlFinal = "{$this->server}/api/proxyget/{$this->token}";

        return file_get_contents($urlFinal);
    }


}
