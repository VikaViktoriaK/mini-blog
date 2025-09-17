<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm — вход по email + password.
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    /** @var User|null */
    private $_user = null;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'rememberMe' => 'Remember me',
        ];
    }

    public function validatePassword($attribute, $params = [])
    {
        if ($this->hasErrors()) {
            return;
        }
        $user = $this->getUser();
        if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
            $this->addError($attribute, 'Incorrect email or password.');
        }
    }

    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login(
                $this->getUser(),
                $this->rememberMe ? 3600 * 24 * 30 : 0
            );
        }
        return false;
    }

    protected function getUser(): ?User
    {
        if ($this->_user === null) {
            $this->_user = User::findOne(['email' => $this->email]);
        }
        return $this->_user;
    }
}
