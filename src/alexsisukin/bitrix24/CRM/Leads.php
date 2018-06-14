<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 08.06.18
 * Time: 14:04
 */

namespace alexsisukin\bitrix24\CRM;


use alexsisukin\bitrix24\Http\Client;
use alexsisukin\bitrix24\Items;

class Leads extends Items
{

    /** @var Client */
    protected $http_client;

    public function getLeadFields()
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