<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.06.18
 * Time: 14:43
 */

namespace alexsisukin\bitrix24;


use alexsisukin\bitrix24\CRM\Companies;
use alexsisukin\bitrix24\CRM\Contacts;
use alexsisukin\bitrix24\CRM\Leads;
use alexsisukin\bitrix24\User\Users;

class Bitrix24
{
    /** @var Auth */
    private $Auth;
    /** @var */
    public $http_client;
    /** @var Leads */
    private $leads;
    /** @var Contacts */
    private $contacts;
    /** @var Companies */
    private $companies;
    /** @var Users */
    private $users;

    private $domain;
    private $access_token;
    private $refresh_token;
    private $state;
    private $expires;
    private $client_id;
    private $secret_id;
    private $json_auth;
    private $handler_token_save = false;

    public function __construct($client_id, $secret, $handler_token_save)
    {
        $this->client_id = $client_id;
        $this->secret_id = $secret;
        $this->handler_token_save = $handler_token_save;
    }

    /**
     * @param $json
     * @return bool true = new  access_token false = old access_token
     * @throws \Exception
     */
    public function setAuthJson($json)
    {
        $config = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('json key invalid');
        }
        if (!isset($config['access_token'])) {
            throw new \Exception('access_token not found');
        }
        $this->access_token = $config['access_token'];
        if (!isset($config['refresh_token'])) {
            throw new \Exception('refresh_token not found');
        }
        $this->refresh_token = $config['refresh_token'];
        if (!isset($config['expires'])) {
            throw new \Exception('expires not found');
        }
        $this->expires = $config['expires'];
        if (!isset($config['domain'])) {
            throw new \Exception('domain not found');
        }
        $this->domain = $config['domain'];
        if (time() > $this->expires) {
            $response = $this->Auth()->getRefreshToken();
            if (is_string($response)) {
                $this->setAuthJson($response);
                $this->json_auth = $response;
                if (is_callable($this->handler_token_save)) {
                    $saver = $this->handler_token_save;
                    $saver($response);
                }
                return true;
            }
        }
        $this->json_auth = $json;
        return false;
    }

    /**
     * @return Leads
     */
    public function Leads()
    {
        $this->leads = new Leads();
        $this->leads->setDomain($this->domain);
        $this->leads->setAccessToken($this->access_token);
        return $this->leads;
    }

    /**
     * @return Contacts
     */
    public function Contacts()
    {
        $this->contacts = new Contacts();
        $this->contacts->setDomain($this->domain);
        $this->contacts->setAccessToken($this->access_token);
        return $this->contacts;
    }

    /**
     * @return Companies
     */
    public function Companies()
    {
        $this->companies = new Companies();
        $this->companies->setDomain($this->domain);
        $this->companies->setAccessToken($this->access_token);
        return $this->companies;
    }

    public function Users()
    {
        $this->users = new Users();
        $this->users->setDomain($this->domain);
        $this->users->setAccessToken($this->access_token);
        return $this->users;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getAuthKey()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getSecretId()
    {
        return $this->secret_id;
    }

    /**
     * @param mixed $secret_id
     */
    public function setSecretId($secret_id)
    {
        $this->secret_id = $secret_id;
    }

    /**
     * @return Auth
     */
    public function Auth()
    {
        $this->Auth = new Auth();
        $this->Auth->setSecret($this->secret_id);
        $this->Auth->setClientId($this->client_id);
        $this->Auth->setDomain($this->domain);
        $this->Auth->setState($this->state);
        $this->Auth->setRefreshToken($this->refresh_token);
        return $this->Auth;
    }

    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * @param mixed $refresh_token
     */
    public function setRefreshToken($refresh_token)
    {
        $this->refresh_token = $refresh_token;
    }


    /**
     * @return mixed
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param mixed $expires
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;
    }

    /**
     * @return mixed
     */
    public function getJsonAuth()
    {
        return $this->json_auth;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @param bool $handler_token_save
     */
    public function setHandlerTokenSave($handler_token_save)
    {
        $this->handler_token_save = $handler_token_save;
    }


}