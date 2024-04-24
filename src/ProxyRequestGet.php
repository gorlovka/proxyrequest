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

    /**
     * @var mixed|string
     */
    private $server;

    /**
     * @var mixed|string
     */
    private $token;

    /**
     * @var int
     */
    private $limit;

    /**
     * Limit proxy to countries
     * Separated by comma or single,
     * GE,IT,RO
     * IT
     * @var string
     */
    private $countryCodeRaw;

    /**
     * Exclude countries from proxy list
     * Separated by comma or single,
     * GE,IT,RO
     * IT
     * @var string
     */
    private $notCountryCodeRaw;


    /**
     * 1 - Return only proxies for http protocol
     * 0 - do nothing
     * @var int
     */
    private $http;

    /**
     * 1 - Return only proxies for socks protocol
     * 0 - do nothing
     * @var int
     */
    private $socks;

    /**
     *
     * Return proxies with specified port only
     * @var int
     */
    private $portProxy;

    /**
     * @param string $token
     * @param string $server
     */
    public function __construct($token = '', $server = '')
    {
        $this->token = $token ?: self::TOKEN_FREE;
        $this->server = $server ?: self::SERVER_PUBLIC;
    }

    /**
     * @return false|string
     */
    public function sendRequest()
    {
        $query = http_build_query([
            'limit' => $this->limit,
            'country_code_raw' => $this->countryCodeRaw,
            'not_country_code_raw' => $this->notCountryCodeRaw,
            'http' => $this->http,
            'socks' => $this->socks,
            'port_proxy' => $this->portProxy
        ]);

        $urlFinal = "{$this->server}/api/proxyget/{$this->token}?{$query}";

        return file_get_contents($urlFinal);
    }


    /**
     *
     * Separated by comma or single,
     * GE,IT,RO
     * IT
     *
     * @param mixed $countryCodeRaw
     * @return ProxyRequestGet
     */
    public function setCountryCodeRaw($countryCodeRaw)
    {
        $this->countryCodeRaw = $countryCodeRaw;
        return $this;
    }

    /**
     * @param mixed $limit
     * @return ProxyRequestGet
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Separated by comma or single,
     * GE,IT,RO
     * IT
     * @param mixed $notCountryCodeRaw
     * @return ProxyRequestGet
     */
    public function setNotCountryCodeRaw($notCountryCodeRaw)
    {
        $this->notCountryCodeRaw = $notCountryCodeRaw;
        return $this;
    }

    /**
     *
     *
     * @param mixed $http 1 or 0
     * @return ProxyRequestGet
     */
    public function setHttp($http)
    {
        if ($http && $this->socks) {
            $this->socks = 0;
        }

        $this->http = $http;
        return $this;
    }

    /**
     * @param mixed $socks 1 or 0
     * @return ProxyRequestGet
     */
    public function setSocks($socks)
    {
        if ($socks && $this->http) {
            $this->http = 0;
        }

        $this->socks = $socks;
        return $this;
    }

    /**
     * @param mixed $portProxy
     * @return ProxyRequestGet
     */
    public function setPortProxy($portProxy)
    {
        $this->portProxy = $portProxy;
        return $this;
    }


}
