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

    public $fields = [
        'ADDRESS' => [
            'name' => 'Адрес контакта',
            'type' => 'string'
        ],
        'ADDRESS_2' => [
            'name' => 'Вторая страница адреса',
            'type' => 'string'

        ],
        'ADDRESS_CITY' => [
            'name' => 'Город',
            'type' => 'string'
        ],
        'ADDRESS_COUNTRY' => [
            'name' => 'Страна',
            'type' => 'string'
        ],
        'ADDRESS_COUNTRY_CODE' => [
            'name' => 'Код страны',
            'type' => 'string'
        ],
        'ADDRESS_POSTAL_CODE' => [
            'name' => 'Почтовый индекс',
            'type' => 'string'
        ],
        'ADDRESS_PROVINCE' => [
            'name' => 'Область',
            'type' => 'string'
        ],
        'ADDRESS_REGION' => [
            'name' => 'Район',
            'type' => 'string'
        ],
        'ASSIGNED_BY_ID' => [
            'name' => 'Связано с пользователем по ID',
            'type' => 'user'
        ],
        'BIRTHDATE' => [
            'name' => 'Дата рождения',
            'type' => 'date'
        ],
        'COMMENTS' => [
            'name' => 'Комментарии',
            'type' => 'string'
        ],
        'COMPANY_ID' => [
            'name' => 'Привязка лида к компании',
            'type' => 'crm_company'

        ],
        'COMPANY_TITLE' => [
            'name' => 'Название компании, привязанной к лиду',
            'type' => 'crm_company'
        ],
        'CONTACT_ID' => [
            'name' => 'Привязка лида к контакту',
            'type' => 'crm_contact'

        ],
        'CREATED_DY_ID' => [
            'name' => 'Кем создана',
            'type' => 'user'

        ],
        'DATA_CREATE' => [
            'name' => 'Дата создания',
            'type' => 'datetime'

        ],
        'DATA_MODIFY' => [
            'name' => 'Дата изменения',
            'type' => 'datetime'

        ],
        'EMAIL' => [
            'name' => 'Адрес электронной почты',
            'type' => 'crm_multifield'

        ],
        'HAS_MAIL' => [
            'name' => 'Проверка заполненности поля электронной почты',
            'type' => 'char'

        ],
        'HAS_PHONE' => [
            'name' => 'Проверка заполненности поля телефон',
            'type' => 'char'

        ],
        'HONORIFIC' => [
            'name' => 'Вид обращения',
            'type' => 'crm_status'
        ],
        'ID' => [
            'name' => 'Идентификатор контакта',
            'type' => 'integer'

        ],
        'IM' => [
            'name' => 'Мессенджеры',
            'type' => 'crm_multifield'

        ],
        'IS_RETURN_CASTOMER', '' => [
            'name' => 'char',
            'type' => 'Только для чтения'
        ],
        'MODIFY_BY_ID' => [
            'name' => 'Идентификатор автора последнего изменения',
            'type' => 'user'

        ],
        'NAME' => [
            'name' => 'Имя',
            'type' => 'string'

        ],
        'OPENED' => [
            'name' => 'Доступен для всех',
            'type' => 'char'
        ],
        'ORIGINATOR_ID' => [
            'name' => 'Идентификатор источника данных',
            'type' => 'string'

        ],
        'ORIGIN_ID' => [
            'name' => 'Идентификатор элемента в источнике данных',
            'type' => 'string'

        ],
        'ORIGIN_VERSION' => [
            'name' => 'Оригинальная версия',
            'type' => 'string'

        ],
        'PHONE' => [
            'name' => 'Телефон контакта',
            'type' => 'crm_multifield'

        ],
        'POST' => [
            'name' => 'Должность',
            'type' => 'string'
        ],
        'SECOND_NAME' => [
            'name' => 'Отчество',
            'type' => 'string'

        ],
        'SOURCE_DESCRIPTION' => [
            'name' => 'Описание источника?',
            'type' => 'string'
        ],
        'SOURCE_ID' => [
            'name' => 'Идентификатор источника',
            'type' => 'crm_status'

        ],
        'STATUS_DESCRIPTION' => [
            'name' => '',
            'type' => 'string'
        ],
        'STATUS_ID' => [
            'name' => '',
            'type' => 'string'
        ],
        'STATUS_SEMANTIC_ID' => [
            'name' => '',
            'type' => 'string'
        ],
        'TITLE' => [
            'name' => 'Название лида',
            'type' => 'string'

        ],
        'UTM_CAMPAIGN' => [
            'name' => 'Обозначение рекламной кампании',
            'type' => 'string'
        ],
        'UTM_CONTENT' => [
            'name' => 'Содержание кампании',
            'type' => 'string'

        ],
        'UTM_MEDIUM' => [
            'name' => 'Тип трафика',
            'type' => 'string'

        ],
        'UTM_SOURCE' => [
            'name' => 'Рекламная система',
            'type' => 'string'

        ],
        'UTM_TERM' => [
            'name' => 'Условие поиска кампании',
            'type' => 'string'

        ],
        'WEB' => [
            'name' => 'URL ресурсов лида',
            'type' => 'crm_multifield'

        ],
    ];


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
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);

    }

    public function LeadAdd($data)
    {
        if (!isset($data['fields'])) {
            return false;
        }
        $bitrix_fields = $this->getLeadFields();
        $data['fields'] = $this->validateFields($data['fields'], $bitrix_fields, ['TITLE']);
        if ($data['fields'] === false) {
            return false;
        }
        $url = 'https://' . $this->domain . '/rest/crm.lead.add.json';
        $data['auth'] = $this->access_token;
        $options = [
            'json' => $data
            ,
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);
    }

    public function StatusList()
    {
        $url = 'https://' . $this->domain . '/rest/crm.status.list.json';

        $options = [
            'json' => [
                'auth' => $this->access_token,
                'order' => [
                    'SORT' => 'ASC'
                ],
                'filter' => [
                    'ENTITY_ID' => 'STATUS'
                ]
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);
    }

    public function LeadUpdate($id, $data)
    {
        if (!isset($data['fields'])) {
            return false;
        }
        $bitrix_fields = $this->getLeadFields();
        $data['fields'] = $this->validateFields($data['fields'], $bitrix_fields);
        if ($data['fields'] === false) {
            return false;
        }
        $url = 'https://' . $this->domain . '/rest/crm.lead.update.json';
        $data['auth'] = $this->access_token;
        $data['id'] = $id;
        $options = [
            'json' => $data
            ,
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);
    }

    public function LeadGet($id)
    {
        $url = 'https://' . $this->domain . '/rest/crm.lead.get.json';

        $options = [
            'json' => [
                'auth' => $this->access_token,
                'id'=>$id
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);
    }
}