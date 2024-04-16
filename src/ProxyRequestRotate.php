<?php

namespace Proxyrequest;

use Exception;
use Proxyrequest\Conract\ProxyRequestInterface;
use Proxyrequest\Response\ProxyResponse;

class ProxyRequestRotate implements ProxyRequestInterface
{
    const SERVER_PUBLIC = 'http://public.proxyrequest.ru';

    const TOKEN_PUBLIC = 'i_am_a_test_token_i_can_intentionally_parse_only_proxyrequest_ru';

    /**
     * @var mixed|string
     */
    private $server;

    /**
     * @var string
     */
    private $urlToGet;

    /**
     * @var string
     */
    private $token;

    /**
     *
     * @var bool
     */
    private $isMobileOnlyUserAgent;

    /**
     * @var array|mixed
     */
    private $cookies;

    /**
     * @var string
     */
    private $referer;

    /**
     *
     * @param string $urlToGet
     * @param string $token
     * @param string $isMobileOnlyUserAgent any value is treated as yes, empty for no
     * @param [] $cookies
     * @param string $referer
     */
    public function __construct($urlToGet, $token = self::TOKEN_PUBLIC,
                                $isMobileOnlyUserAgent = '', $cookies = [],
                                $referer = '', $server = '')
    {

        $this->server = $server ?: self::SERVER_PUBLIC;
        $this->urlToGet = $urlToGet;
        $this->token = $token;
        $this->isMobileOnlyUserAgent = $isMobileOnlyUserAgent;
        $this->cookies = $cookies;
        $this->referer = $referer;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }


    /**
     * @param bool|string $isMobileOnlyUserAgent
     */
    public function setIsMobileOnlyUserAgent($isMobileOnlyUserAgent)
    {
        $this->isMobileOnlyUserAgent = $isMobileOnlyUserAgent;
        return $this;
    }

    /**
     * @param array|mixed $cookies
     */
    public function setCookies($cookies)
    {
        $this->cookies = $cookies;
        return $this;
    }

    /**
     * @param string $referer
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;
        return $this;
    }


    /**
     *
     *
     * Use only if you have dedicated server for processing requests
     * @param $url
     * @return $this
     */
    public function setServer($url)
    {
        $this->server = $url;
        return $this;
    }

    /**
     *
     * Returns false if request failed
     * On success returns ProxyResponse
     *
     * @return false|ProxyResponse
     */
    public function sendRequest()
    {
        static $timesTried = 0;


        $urlFinal = $this->getUrlFinal();

        try {
            $dataInJson = file_get_contents($urlFinal);

        } catch (Exception $e) {

            if ($timesTried < 3) {
                $timesTried++;
                return $this->sendRequest();
            }

            $timesTried = 0;

            return false;
        }

        $proxyResponse = new ProxyResponse($dataInJson);

        if (!$proxyResponse->success) {
            return false;
        }

        return $proxyResponse;
    }


    private function getUrlFinal()
    {
        $urlEncoded = base64_encode($this->urlToGet);

        $server = $this->server;

        $token = $this->token;

        $params = http_build_query([
            'token' => $token,
            'urlToGet' => $urlEncoded,
            'isMobileOnlyUserAgent' => $this->isMobileOnlyUserAgent,
            'cookies' => $this->cookies,
            'referer' => $this->referer
        ]);

        $urlFinal = "$server/api/rotate/$token?$params";

        return $urlFinal;
    }

}
