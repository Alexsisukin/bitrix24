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

    protected $fields = [
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
            'name' => 'Привязка контакта к компании',
            'type' => 'crm_company'
        ],
        'COMPANY_IDS' => [
            'name' => 'Привязка контакта к нескольким компаниям',
            'type' => 'crm_company'
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
        'EXPORT' => [
            'name' => 'Участвует ли контакт в экспорте. Eсли N, то выгрузить его невозможно.',
            'type' => 'char'
        ],
        'FACE_ID' => [
            'name' => 'Привязка к лицам из модуля faceid',
            'type' => 'integer'
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
        'LAST_NAME' => [
            'name' => 'Фамилия',
            'type' => 'string'
        ],
        'LEAD_ID' => [
            'name' => 'Идентификатор лида, связанного с контактом',
            'type' => 'crm_lead'
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
        'PHOTO' => [
            'name' => 'Фото контакта',
            'type' => 'file'
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
        'TYPE_ID' => [
            'name' => 'Идентификатор типа',
            'type' => 'crm_status'
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
        'UTM_SOURSE' => [
            'name' => 'Рекламная система',
            'type' => 'string'
        ],
        'UTM_TERM' => [
            'name' => 'Условие поиска кампании',
            'type' => 'string'
        ],
        'WEB' => [
            'name' => 'URL ресурсов контакта',
            'type' => 'crm_multifield'
        ],
    ];


    /**
     * @return false|array
     */
    public function getContactFields()
    {
        $url = 'https://' . $this->domain . '/rest/crm.contact.fields.json';

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

    public function ContactList($filter, $select = ["ID", "NAME", "LAST_NAME"])
    {
        if (!is_array($filter)) {
            return false;
        }

        $url = 'https://' . $this->domain . '/rest/crm.contact.list.json';

        $options = [
            'json' => [
                'auth' => $this->access_token,
                'filter' => $filter,
                'select' => $select
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);

    }


    public function ContactAdd($data)
    {
        if (!isset($data['fields'])) {
            return false;
        }
        $bitrix_fields = $this->getContactFields();
        $data['fields'] = $this->validateFields($data['fields'], $bitrix_fields, ['NAME', 'LAST_NAME']);
        if ($data['fields'] === false) {
            return false;
        }

        $url = 'https://' . $this->domain . '/rest/crm.contact.add.json';

        $data['auth'] = $this->access_token;
        $options = [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);
    }

    public function ContactGet($id)
    {
        $id = abs((int)$id);

        $url = 'https://' . $this->domain . '/rest/crm.contact.get.json';

        $options = [
            'json' => [
                'auth' => $this->access_token,
                'id' => $id,
            ],
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
                    'ENTITY_ID' => 'CONTACT_TYPE'
                ]
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);
    }


}