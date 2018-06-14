<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13.06.18
 * Time: 16:20
 */

namespace alexsisukin\bitrix24\CRM;


use alexsisukin\bitrix24\Http\Client;
use alexsisukin\bitrix24\Items;

class Contacts extends Items
{

    /** @var Client */
    protected $http_client;

    public function getContactFields()
    {
        $url = 'https://' . $this->domain . '/rest/crm.lead.fields.json';

        $options = [
            'json' => [
                'auth' => $this->access_token,
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        return $this->http_client->Post($url, $options);

    }

}