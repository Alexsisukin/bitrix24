<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06.06.18
 * Time: 15:11
 */

namespace alexsisukin\bitrix24\Http;

use GuzzleHttp\Exception\GuzzleException;

class Client
{

    static $request_qty = 0;
    protected $client;
    private $debug;

    public function __construct($debug = false)
    {
        $this->client = new \GuzzleHttp\Client([
            'timeout' => 10.0,
        ]);
        $this->debug = $debug;
    }


    public function Post($uri, $option = [])
    {
        return $this->send('POST', $uri, $option);
    }


    public function Get($uri, $option = [])
    {
        return $this->send('GET', $uri, $option);
    }

    private function send($method, $uri, $option = [])
    {

        try {
            if (self::$request_qty > 0) {
                sleep(1);
            }
            self::$request_qty++;
            $option['debug'] = (bool)$this->debug;
            $response = $this->client->request($method, $uri, $option);
        } catch (GuzzleException $e) {
            return false;
        }
        if ($response->getStatusCode() !== 200 && $response->getStatusCode() !== 204) {
            return false;
        }
        return $response->getBody()->getContents();
    }

}