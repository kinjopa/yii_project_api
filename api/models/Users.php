<?php

namespace api\models;

use DateTime;
use Yii;

class Users extends \common\models\Users
{
    public function fields()
    {
        return [
            'id',
            'name',
            'patronymic',
            'surname',
            'email',
            'avatar',
            'city',
            'phone'
        ];
    }

    public function extraFields()
    {
        return [
            'comments'
        ];
    }

    /**
     * {@inheritdoc}
     * @throws \yii\base\InvalidConfigException
     * Ищем пользователя по токену, проверяем время жизни, обновляем время жизни
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        if ($user = static::findOne(['auth_key' => $token]) and (Yii::$app->formatter->asTimestamp($user->expire_at) > strtotime("now"))) {
            $date = new DateTime();
            $date->setTimestamp(time() + LoginForm::EXPIRE_TIME);
            $user->expire_at = $date->format('Y-m-d H:i:s');
            $user->update(false, ['expire_at']);

            return $user;
        }
        return false;
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

}