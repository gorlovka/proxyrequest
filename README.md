## Proxyrequest - Proxy lists,  Rotating proxy, Bypass Cloudflare

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

#### 2. Using curl:
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
### 1. Inside browser
[Link to url](http:/public.proxyrequest.ru/api/rotate/PRIVATE_TOKEN?urlToGet=http://ar61.ru "Link to url")

### 2. Using curl
`bash tests/TestCurlRotateProxy.sh`

### 3. PHP composer package
Run first composer command in your shell:
`composer require gorlovka/proxy-request-builder`
```php
<?php

use Proxyrequest\ProxyRequestRotate;

$proxyRequestRotate = new ProxyRequestRotate('URL_TO_GET', 'PRIVATE_TOKEN_KEY_HERE');
echo $proxyRequestRotate->sendRequest();
```

### Cloudflare bypassing
Not publicly available. Available upon request. Possibility of it depends on how it's configured on exact website. Feel free to get in touch mentioning the address of website and how many pages per day is it needed to collect.


## Getting token
[**You can get token for FREE here**](https://proxyrequest.ru/request-token-view ". You can get **for FREE** here")


## By using service you agree:
To use these proxies responsibly, without abusing them, and without intent to DDoS any resources.

## Contacts
Email for contacts is [support@proxyrequest.ru](mailto:support@proxyrequest.ru).