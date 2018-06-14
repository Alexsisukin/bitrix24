<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 08.06.18
 * Time: 14:05
 */

namespace alexsisukin\bitrix24;


use alexsisukin\bitrix24\Http\Client;

class Items
{
    /** @var Client */
    protected $http_client;
    protected $domain;
    protected $access_token;


    public function __construct()
    {
        $this->http_client = new Client();
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

}