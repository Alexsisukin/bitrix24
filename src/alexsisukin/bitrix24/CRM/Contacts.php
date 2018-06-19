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
            'Адрес контакта',
            'string'
        ],
        'ADDRESS_2' => [
            'Вторая страница адреса',
            'string'
        ],
        'ADDRESS_CITY' => [
            'Город',
            'string'
        ],
        'ADDRESS_COUNTRY' => [
            'Страна',
            'string'
        ],
        'ADDRESS_COUNTRY_CODE' => [
            'Код страны',
            'string'
        ],
        'ADDRESS_POSTAL_CODE' => [
            'Почтовый индекс',
            'string'
        ],
        'ADDRESS_PROVINCE' => [
            'Область',
            'string'
        ],
        'ADDRESS_REGION' => [
            'Район',
            'string'
        ],
        'ASSIGNED_BY_ID' => [
            'Связано с пользователем по ID',
            'user'
        ],
        'BIRTHDATE' => [
            'Дата рождения',
            'date'
        ],
        'COMMENTS' => [
            'Комментарии',
            'string'
        ],
        'COMPANY_ID' => [
            'Привязка контакта к компании',
            'crm_company'
        ],
        'COMPANY_IDS' => [
            'Привязка контакта к нескольким компаниям',
            'crm_company'
        ],
        'CREATED_DY_ID' => [
            'Кем создана',
            'user'
        ],
        'DATA_CREATE' => [
            'Дата создания',
            'datetime'
        ],
        'DATA_MODIFY' => [
            'Дата изменения',
            'datetime'
        ],
        'EMAIL' => [
            'Адрес электронной почты',
            'crm_multifield'
        ],
        'EXPORT' => [
            'Участвует ли контакт в экспорте. Eсли N, то выгрузить его невозможно.',
            'char'
        ],
        'FACE_ID' => [
            'Привязка к лицам из модуля faceid',
            'integer'
        ],
        'HAS_MAIL' => [
            'Проверка заполненности поля электронной почты',
            'char'
        ],
        'HAS_PHONE' => [
            'Проверка заполненности поля телефон',
            'char'
        ],
        'HONORIFIC' => [
            'Вид обращения',
            'crm_status'
        ],
        'ID' => [
            'Идентификатор контакта',
            'integer'
        ],
        'IM' => [
            'Мессенджеры',
            'crm_multifield'
        ],
        'LAST_NAME' => [
            'Фамилия',
            'string'
        ],
        'LEAD_ID' => [
            'Идентификатор лида, связанного с контактом',
            'crm_lead'
        ],
        'MODIFY_BY_ID' => [
            'Идентификатор автора последнего изменения',
            'user'
        ],
        'NAME' => [
            'Имя',
            'string'
        ],
        'OPENED' => [
            'Доступен для всех',
            'char'
        ],
        'ORIGINATOR_ID' => [
            'Идентификатор источника данных',
            'string'
        ],
        'ORIGIN_ID' => [
            'Идентификатор элемента в источнике данных',
            'string'
        ],
        'ORIGIN_VERSION' => [
            'Оригинальная версия',
            'string'
        ],
        'PHONE' => [
            'Телефон контакта',
            'crm_multifield'
        ],
        'PHOTO' => [
            'Фото контакта',
            'file'
        ],
        'POST' => [
            'Должность',
            'string'
        ],
        'SECOND_NAME' => [
            'Отчество',
            'string'
        ],
        'SOURCE_DESCRIPTION' => [
            'Описание источника?',
            'string'
        ],
        'SOURCE_ID' => [
            'Идентификатор источника',
            'crm_status'
        ],
        'TYPE_ID' => [
            'Идентификатор типа',
            'crm_status'
        ],
        'UTM_CAMPAIGN' => [
            'Обозначение рекламной кампании',
            'string'
        ],
        'UTM_CONTENT' => [
            'Содержание кампании',
            'string'
        ],
        'UTM_MEDIUM' => [
            'Тип трафика',
            'string'
        ],
        'UTM_SOURSE' => [
            'Рекламная система',
            'string'
        ],
        'UTM_TERM' => [
            'Условие поиска кампании',
            'string'
        ],
        'WEB' => [
            'URL ресурсов контакта',
            'crm_multifield'
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

}