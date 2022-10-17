<?php

namespace frontend\models;

use yii\base\Model;

/**
 * Users model
 *
 * @property integer $id
 * @property string $name
 * @property string $patronymic
 * @property string $surname
 * @property array $avatar
 * @property array $city
 * @property string $email
 * @property string $phone
 *
 * @property integer $created_at
 * @property integer $updated_at
 */
class Users extends Model
{
    public $id;
    public $name;
    public $patronymic;
    public $surname;
    public $avatar;
    public $city;
    public $phone;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'patronymic', 'surname', 'email', 'phone'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'patronymic', 'surname', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['city', 'avatar',], 'safe'],

            [['email'], 'email'],
            [['name', 'patronymic', 'surname', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'trim'],
            [['phone'], 'filter', 'filter' => function ($value) {
                return preg_replace("/(\+7)(\d{3})(\d{3})(\d{2})(\d{2})/", "$1 ($2) $3-$4-$5", $value);
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'avatar' => 'Аватар',
            'id' => 'ID',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'surname' => 'Фамилия',
            'auth_key' => 'Ключ авторизации',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'city' => 'Город',
            'phone' => 'Телефон',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'admin' => 'Администратор'
        ];
    }
}
