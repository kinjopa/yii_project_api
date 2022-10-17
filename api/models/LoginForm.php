<?php

namespace api\models;

use DateTime;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends \common\models\LoginForm
{
    const EXPIRE_TIME = 3600*24; // Срок действия токена, действует 24 часа

    /**
     * @throws \yii\base\Exception
     * @throws \Exception
     */
    public function login()
    {
        if ($this->validate()) {
            //return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            if ($user = Users::getUserByEmail($this->email) and Yii::$app->getSecurity()->validatePassword($this->password, $user->password_hash)) {
                $access_token = $this->generateAccessToken();

                $date = new DateTime();
                $date->setTimestamp(time() + static::EXPIRE_TIME);
                $user->expire_at = $date->format('Y-m-d H:i:s');
                $user->auth_key = $access_token;
                $user->update(false, ['expire_at', 'auth_key']);

                return $access_token;
            }
        }
        return false;
    }

    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email']
        ];
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function generateAccessToken()
    {
        return Yii::$app->security->generateRandomString();
    }

}
