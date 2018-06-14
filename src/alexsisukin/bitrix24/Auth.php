<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.06.18
 * Time: 14:35
 */

namespace alexsisukin\bitrix24;


use alexsisukin\bitrix24\Http\Client;

class Auth
{
    private $client_id = '';
    private $secret = '';
    private $state = '';
    private $access_token;
    private $refresh_token;
    private $domain;
    /** @var Client */
    private $http_client;

    public function __construct()
    {
        $this->http_client = new Client();
    }

    public function generateAuthUrl()
    {
        return 'https://oauth.bitrix.info/oauth/authorize/?' .
            http_build_query(
                [
                    'client_id' => $this->client_id,
                    'state' => $this->state
                ]
            );
    }

    private function validateDomain($domain)
    {
        if (!filter_var('http://' . $domain, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED)) {
            return false;
        }
        if (!preg_match('~^[0-9a-z-]+\.bitrix24\.[a-z]{2,6}$~ui', $domain)) {
            return false;
        }

        return $domain;

    }

    public function getAccessToken($code)
    {

        if (!$this->validateDomain($this->domain)){
            return false;
        }
        $url = 'https://' . $this->domain . '/oauth/token/?';

        $options = [
            'form_params' => [
                "grant_type" => "authorization_code",
                "code" => $code,
                'client_id' => $this->client_id,
                'client_secret' => $this->secret,
                'redirect_uri' => 'http://ucalc-git.ru/aaaaa'
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',

            ],
        ];
        return $this->http_client->Post($url, $options);

    }

    public function getRefreshToken()
    {

        if (!$this->validateDomain($this->domain)){
            return false;
        }
        $url = 'https://' . $this->domain . '/oauth/token/?';


        $options = [
            'form_params' => [
                "grant_type" => "refresh_token",
                "refresh_token" => $this->refresh_token,
                'client_id' => $this->client_id,
                'client_secret' => $this->secret,
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',

            ],
        ];
        return $this->http_client->Post($url, $options);

    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
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

    /**
     * @param mixed $refresh_token
     */
    public function setRefreshToken($refresh_token)
    {
        $this->refresh_token = $refresh_token;
    }
}