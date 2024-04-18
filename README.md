# # Proxyrequest - Proxy lists,  Rotating proxy, Bypass Cloudflare

#### With this tool you can:
1. Get proxy lists for parsing from API endpoint, curl or php
1. Rotating proxy for parsing anything - proxy are being changed automatically until website returns proper content
1. Parsing pages protected by Cloudflare from scraping

#### Free plans available for each usage case

If you are looking for a way to parse website which is protected by cloudflare or some other custom made solution you are in the right place.

Usually if you need to get a few dozens of pages from website you can go directory for website and scrape data easily.  Issues comes if website has some kind of protection you need to get a lot of data on regular basis.

We handle all blocking from protection on our behalf.
You get data like you were requesting them directly.

This solution works for parsing and collection of data. It doesn't work for DDOS, spam sending or abusing internet.

Javascript is optionally executed if you need it. Essentially it's slower than just getting page as is so consider finding a way to get data without Javascript execution.

------------



### Free proxy lists

### 1. Inside browser
[**Link to free proxy list**](http://public.proxyrequest.ru/api/proxyget/free "Click link to see")

####2. Using curl:
`curl http://public.proxyrequest.ru/api/proxyget/free`

#### 3. PHP composer package:
Run first composer command in your shell:
`composer require gorlovka/proxy-request-builder`
```php
<?php

use Proxyrequest\ProxyRequestGet;

$proxyRequestGet = new ProxyRequestGet();
echo $proxyRequestGet->sendRequest();
```
See TestProxyGet.php file for example.

------------
### Rotating proxy
###1. Inside browser
[Link to url](http:/public.proxyrequest.ru/api/rotate/PRIVATE_TOKEN?urlToGet=http://ar61.ru "Link to url")

###2. Using curl
`bash tests/TestCurlRotateProxy.sh`

###3. PHP composer package
Run first composer command in your shell:
`composer require gorlovka/proxy-request-builder`
```php
<?php

use Proxyrequest\ProxyRequestRotate;

$proxyRequestRotate = new ProxyRequestRotate('URL_TO_GET', 'PRIVATE_TOKEN_KEY_HERE');
/***
 * To be called to use private server instead of public by default
 */
// $proxyRequestRotate->setServer('');

echo $proxyRequestRotate->sendRequest();
```

[Link to url](http:/public.proxyrequest.ru/api/rotate/PRIVATE_TOKEN?urlToGet=http://ar61.ru "Link to url")



## Usage via GET request

Just do GET request  using any programming language or from browser:

    http://PROXY_SERVER_ADDRESS/api/forwardRequestInParallelV2?token=TOKEN_SECRET&urlToGet=urlEncodedInBase64

That's all

In response you get JSON object:

    {
	   "success":true,
	   "value":{
	      "statusCode":200,
	      "refererUsed":null,
	      "cookiesUsed":null,
	      "userAgentUsed":"Mozilla\/5.0 (Windows NT 6.2; WOW64; rv:42.0) Gecko\/20100101 Firefox\/42.0",
	      "content":"Field you are interested in",
	      "requestId" : "Id your query was assigned on server"
	   },
	   "message": "contains error description in the case of error",
	   "error":  false
	}

## There is a client for PHP

```
   // required parameter
    $proxyServerAddress= env('PROXY_SERVER');
    
    // required parameter
    $secretToken = env('TOKEN_SECRET');           
    
    // required parameter
    $urlToGet ='http://websiteProtectedFromParsing.com';    
    
    $proxyBuilder = new ProxyRequestBuilder($proxyServerAddress,
          $urlToGet, $secretToken, $isMobileOnlyBrowserHeaders ='0',
          $cookies =[], $referer ='');

    /**
     * Here you get raw content of requested page like
     *  you were requesting it directly
     */
    $content = $proxyBuilder->getContent();
   
    That's all
```


## Getting token
1. You can get **for FREE** token_secret which allows to handle up to **200** requests per day.
2.  More requests are supported on the premise of SaaS principles for paid subscription based count of request per month. Please contact me if you need more.

## Token specifics
Each token is valid of parsing only single wesbite. So please specify me its address in email.

## Contacts
Email for contacts is [jagen@meta.ua](mailto:jagen@meta.ua). I usually response with 12 hours or faster.

Specify in email a) address of targeted webite, b) whether you would like to get free key or subscribe, c) desired approximate number of requests per day/month


## Russian
Email для получения токена и адреса севера jagen@meta.ua.

Поле $content содержит такое же содержимое, как если бы запрашивали напрямую

tokenApi - получение по запросу

userAgent - mobile_only - если нужно userAgent мобильного устройства,
поле какой именно заголовок был использован userAgentUsed возвращается в ответе


Использование:


        $proxyServerAddress= env('PROXY_SERVER');
        $secretToken = env('TOKEN_API_FOR_VIOLITY');
        $isMobileOnlyBrowserHeaders = '1'

        $cookies = [
           'a' => 5,
           'bbbb' => 7
        ];

        $referer = 'http://website.ua';

        $proxyBuilder = new ProxyRequestBuilder($proxyServerAddress,
              $urlToGet, $secretToken, $isMobileOnlyBrowserHeaders,
              $cookies, $referer);

        /**
         * Тут содержимое ответа
         */
        $content = $proxyBuilder->getContent();

        /**
         * Тут можно дополнительные поля получить
         */
        $cookies = $proxyBuilder->getCookiesUsed();
        $referer = $proxyBuilder->getRefererUsed();

        $userAgentUsed = $proxyBuilder->getUserAgentUsed();


        dump($userAgentUsed);

        dump($cookies);

        dump($referer);

        die('');

Поле $content содержит такое же содержимое, как если бы запрашивали напрямую

tokenApi - получение по запросу

userAgent - mobile_only - если нужно userAgent мобильного устройства,
поле какой именно заголовок был использован userAgentUsed возвращается в ответе
