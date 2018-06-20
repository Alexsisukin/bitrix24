<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.06.18
 * Time: 17:12
 */

namespace alexsisukin\bitrix24\User;


use alexsisukin\bitrix24\Items;

class Users extends Items
{

    public function Get($id = 0)
    {
        $id = abs((int)$id);

        $url = 'https://' . $this->domain . '/rest/user.get.json';
        $data= [];
        $data['auth']=$this->access_token;
        if ($id !==0){
            $data['ID']=$id;
        }
        $options = [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);
    }

}