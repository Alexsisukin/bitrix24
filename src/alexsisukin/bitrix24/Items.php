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
    protected $fields;

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

    public function HumanLabelFields($fields)
    {
        foreach ($fields as $field_name => $field) {
            $humanLabel = '';
            if (key_exists($field_name, $this->fields)) {
                $humanLabel = $this->fields[$field_name]['name'];
            } else {
                if (isset($field['listLabel'])) {
                    $humanLabel = $field['listLabel'];
                }
            }
            $fields[$field_name]['humanLabel'] = $humanLabel;
        }
        return $fields;
    }

    protected function FieldsTypeValidate($fields)
    {
        foreach ($fields as $field_name => $field) {

            if (!isset($field_name, $this->fields)) {
                unset($fields[$field_name]);
                continue;
            }

        }
        return $fields;
    }

    /**
     * @param $json string
     * @return false|array
     */
    protected function jsonDecode($json)
    {
        $array = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }
        if (!is_array($array)) {
            return false;
        }
        return $array;
    }

    /**
     * @param $fields array
     * @param $bitrix_fields array
     * @param $required_fields array
     * @return false|array
     */
    protected function validateFields($fields, $bitrix_fields, $required_fields)
    {
        if (!isset($bitrix_fields['result'])) {
            return false;
        }
        foreach ($fields as $field_name => $field) {
            if (!key_exists($field_name, $bitrix_fields['result'])) {
                unset($fields[$field_name]);
            }
        }
        foreach ($required_fields as $required_field) {
            if (!isset($fields[$required_field])) {
                return false;
            }
        }
        return $fields;
    }
}