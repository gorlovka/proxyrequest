<?php

namespace Proxyrequest\Response;

class ProxyResponse
{
    /**
     * @var int
     */
    public $success;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $content_type;

    /**
     * @var int
     */
    public $http_code;

    /**
     * @var int
     */
    public $request_size;

    /**
     * @var int
     */
    public $size_download;

    /**
     * @var int
     */
    public $download_content_length;

    /**
     * @var string
     */
    public $effective_method;

    /**
     * @var string
     */
    public $request_header;

    /**
     * @var string
     */
    public $scheme;

    /**
     * @var string
     */
    public $primary_ip;


    public $keys = [];

    public function __construct($dataInJson)
    {
        $this->success = 0;

        $response = json_decode($dataInJson, true);

        foreach ($response as $key => $val) {
            $this->{$key} = $val;
            $this->keys[] = $key;
        }
    }

    public function __toString()
    {
        return json_encode($this->getValue());
    }

    public function getValue()
    {
        return array_map(function ($key) {
            return [$key => $this->{$key}];
        }, $this->keys);
    }
}
