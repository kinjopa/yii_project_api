<?php

namespace frontend\models;

use frontend\libraries\Api;
use frontend\libraries\Auth;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['email', 'email'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Api::getInstance()->login($this->email, $this->password);
        }
        
        return false;
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Auth::getInstance()->getUser();
        }
        return $this->_user;
    }

}
