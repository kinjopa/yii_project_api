<?php

namespace frontend\libraries;

use yii\helpers\Json;
use yii\httpclient\Client;
use yii\httpclient\Response;

class Api extends Instance
{
    private Client $client;
    private string $host = 'api';
    private Response $response;

    public function __construct()
    {
        $this->client = new Client([
            'baseUrl' => $this->host,
            'transport' => 'yii\httpclient\CurlTransport'
        ]);
    }

    /**
     * @throws \yii\httpclient\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function getData($action = '', $method = 'get', $data = []): static
    {
        $this->response = $this->client->createRequest()
            ->setMethod($method)
            ->setUrl($action)
            ->setData($data)
            ->setHeaders([
                'Accept' => 'application/json, text/javascript',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . Auth::getToken(),
            ])
            ->setFormat(Client::FORMAT_JSON)
            ->setOptions(['sslVerifyPeer' => false])
            ->send();
        return $this;
    }

    public function toArray(){
        if ($this->response->isOk) {
            return Json::decode($this->response->content);
        }
        return [];
    }

    /**
     * @throws \yii\httpclient\Exception
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function login($email, $password): bool
    {
        $response = $this->client->createRequest()
            ->setMethod('POST')
            ->setUrl('/users/login')
            ->setData(['email' => $email, 'password' => $password])
            ->send();

        if ($response->isOk) {
            Auth::getInstance()->setToken($response->data['access_token']);
            return true;
        }
        return false;
    }

    public function logout(){
        Auth::getInstance()->deleteToken();
    }
}