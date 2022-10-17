<?php

namespace frontend\libraries;

use Yii;
use yii\helpers\Json;

class Auth extends Instance
{
    private array|bool $user = false;

    public function __construct()
    {
        if (!$this->user)
            $this->setUser();
    }

    private function setUser()
    {
        if (static::getToken()) {
            $this->user = Api::getInstance()->getData('/users/data')->toArray();
        }
    }

    public function getUser(): bool|array
    {
        return $this->user;
    }

    public function setToken($token)
    {
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'access_token',
            'value' => $token,
        ]));
    }

    public static function deleteToken()
    {
        Yii::$app->response->cookies->remove('access_token');
    }

    public static function getToken()
    {
        $request = Yii::$app->request->cookies;
        return (!empty($request->getValue('access_token'))) ? $request->getValue('access_token') : false;
    }
}