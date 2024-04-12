<?php

namespace Proxyrequest;

class ProxyRequestRotate
{

    const FORMAT_JSON = 'json',
        FORMAT_TXT = 'txt';

    private $format;

    private $server;

    private $urlToGet;
    private $token;
    private $messageErrorLast;


    /**
     *
     * @var bool
     */
    private $isMobileOnlyUserAgent;

    /**
     *
     * @var string
     */
    private $cookies;

    /**
     *
     * @var string
     */
    private $referer;
    private $statusCode = null;

    /**
     *
     *  Returned in response from server
     *
     * @var string
     */
    private $userAgentUsed;
    private $cookiesUsed;
    private $refererUsed;

    private $responseCookies;
    private $responseHeaders;

    /**
     *
     * @param string $urlToGet
     * @param string $token
     * @param string $isMobileOnlyUserAgent any value is treated as yes, empty for no
     * @param [] $cookies
     * @param string $referer
     */
    public function __construct($urlToGet, $token,
                                $isMobileOnlyUserAgent = '', $cookies = [],
                                $referer = '')
    {

        $this->server = 'http://public.proxyrequest.ru';;
        $this->urlToGet = $urlToGet;
        $this->token = $token;
        $this->isMobileOnlyUserAgent = $isMobileOnlyUserAgent;
        $this->cookies = $cookies;
        $this->referer = $referer;
    }

    public function setServer($url)
    {
        $this->server = $url;
        return $this;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getMessageErrorLast()
    {
        return $this->messageErrorLast;
    }

    public function getUserAgentUsed()
    {
        return $this->userAgentUsed;
    }

    public function getCookiesUsed()
    {
        return $this->cookiesUsed;
    }

    public function getRefererUsed()
    {
        return $this->refererUsed;
    }

    /**
     * @return array
     */
    public function getResponseCookies()
    {
        return $this->responseCookies;
    }

    /**
     * @return array
     */
    public function getResponseHeaders()
    {
        return $this->responseHeaders;
    }


    public function getUrlFinal()
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

        $urlFinal = "$server/api/forwardRequestInParallelV2?$params";


        return $urlFinal;
    }

    /**
     * Returns false if request failed,
     *  check $messageErrorLast field  for more information
     *
     *
     * @staticvar int $timesTried
     * @return boolean|string
     */
    public function getContent()
    {
        return '111';

        static $timesTried = 0;

        $urlFinal = $this->getUrlFinal();


        try {
            $dataInJson = file_get_contents($urlFinal);
        } catch (\Exception $e) {

            if ($timesTried < 2) {
                $timesTried++;
                return $this->getContent();
            }

            $timesTried = 0;

            return false;
        }


        $response = json_decode($dataInJson, true);


        $this->messageErrorLast = $response['message'];

        $value = $response['value'];

        /**
         * что-то не так на нашей стороне
         */
        if (!array_key_exists('statusCode', $value)) {
            return false;
        }


        if (!$response['success']) {
            return $this->getContent();
        }

        $statusCode = $value['statusCode'];


        $this->userAgentUsed = $value['userAgentUsed'];
        $this->statusCode = $statusCode;
        $this->refererUsed = $value['refererUsed'];
        $this->cookiesUsed = $value['cookiesUsed'];

        $this->responseHeaders = $value['headers'];

        $contentInBase64 = $value['content'];

        return base64_decode($contentInBase64);
    }

}
