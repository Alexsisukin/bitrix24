<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18.06.18
 * Time: 12:22
 */

namespace alexsisukin\bitrix24\CRM;


use alexsisukin\bitrix24\Items;

class Companies extends Items
{

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
        'ADDRESS_LEGAL' => [
            'name' => '',
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
        'BANKING_DETAILS' => [
            'name' => 'Банковские реквизиты',
            'type' => 'string'
        ],
        'COMMENTS' => [
            'name' => 'Комментарии',
            'type' => 'string'
        ],
        'COMPANY_TYPE' => [
            'name' => 'Тип компании',
            'type' => 'crm_status'
        ],
        'CREATED_DY_ID' => [
            'name' => 'Кем создана',
            'type' => 'user'
        ],
        'CURRENCY_ID' => [
            'name' => 'Валюта',
            'type' => 'crm_currency'
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
        'EMPLOYESS' => [
            'name' => 'Количество сотрудников',
            'type' => 'crm_status'
        ],
        'HAS_MAIL' => [
            'name' => 'Проверка заполненности поля электронной почты',
            'type' => 'char'
        ],
        'HAS_PHONE' => [
            'name' => 'Проверка заполненности поля телефон',
            'type' => 'char',
        ],
        'ID' => [
            'name' => 'Идентификатор контакта',
            'type' => 'integer'
        ],
        'IM' => [
            'name' => 'Мессенджеры',
            'type' => 'crm_multifield'
        ],
        'INDUSTRY' => [
            'name' => 'Сфера деятельности',
            'type' => 'crm_status'
        ],
        'IS_MY_COMPANY' => [
            'name' => '',
            'type' => 'char'
        ],
        'LEAD_ID' => [
            'name' => 'Идентификатор лида, связанного с контактом',
            'type' => 'crm_lead',
        ],
        'LOGO' => [
            'name' => 'Логотип',
            'type' => 'file'
        ],
        'MODIFY_BY_ID' => [
            'name' => 'Идентификатор автора последнего изменения',
            'type' => 'user'
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
        'REG_ADDRESS' => [
            'name' => 'Юридический адрес контакта',
            'type' => 'string'
        ],
        'REG_ADDRESS_2' => [
            'name' => 'Вторая страница юридического адреса',
            'type' => 'string'
        ],
        'REG_ADDRESS_CITY' => [
            'name' => 'Город юридического адреса',
            'type' => 'string'
        ],
        'REG_ADDRESS_COUNTRY' => [
            'name' => 'Страна юридического адреса',
            'type' => 'string'
        ],
        'REG_ADDRESS_COUNTRY_CODE' => [
            'name' => 'Код страны юридического адреса',
            'type' => 'string'
        ],
        'REG_ADDRESS_LEGAL' => [
            'name' => '',
            'type' => 'string',
        ],
        'REG_ADDRESS_POSTAL_CODE' => [
            'name' => 'Почтовый индекс юридического адреса',
            'type' => 'string'
        ],
        'REG_ADDRESS_PROVINCE' => [
            'name' => 'Область юридического адреса',
            'type' => 'string'
        ],
        'REG_ADDRESS_REGION' => [
            'name' => 'Район юридического адреса',
            'type' => 'string'
        ],
        'REVENUE' => [
            'name' => 'Годовой оборот',
            'type' => 'double'
        ],
        'TITLE' => [
            'name' => 'Название',
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

    public function getCompanyFields()
    {
        $url = 'https://' . $this->domain . '/rest/crm.company.fields.json';

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
                    'ENTITY_ID' => 'COMPANY_TYPE'
                ]
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);
    }

    public function CompanyAdd($data)
    {
        if (!isset($data['fields'])) {
            return false;
        }
        $bitrix_fields = $this->getCompanyFields();
        $data['fields'] = $this->validateFields($data['fields'], $bitrix_fields, ['TITLE']);
        if ($data['fields'] === false) {
            return false;
        }
        $url = 'https://' . $this->domain . '/rest/crm.company.add.json';
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

    /**
     * @param $filter array
     * @return array|false
     */
    public function CompanyList($filter)
    {
        $url = 'https://' . $this->domain . '/rest/crm.company.list.json';

        $options = [
            'json' => [
                'auth' => $this->access_token,
                'filter' => $filter
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);
    }

    public function CompanyGet($id)
    {
        $url = 'https://' . $this->domain . '/rest/crm.company.get.json';

        $options = [
            'json' => [
                'auth' => $this->access_token,
                'id' => $id
            ],
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ];
        $response = $this->http_client->Post($url, $options);
        return $this->jsonDecode($response);
    }
}