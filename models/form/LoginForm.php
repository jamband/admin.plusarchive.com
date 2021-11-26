<?php

declare(strict_types=1);

namespace app\models\form;

use app\models\User;
use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private User|null|bool $_user = false;

    public function attributeLabels(): array
    {
        return [
            'rememberMe' => 'Remember Me',
        ];
    }

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],

            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * @noinspection PhpUnused
     */
    public function validatePassword(): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError(null, 'Incorrect username or password.');
            }
        }
    }

    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }

        Yii::warning('failure logged in');

        return false;
    }

    protected function getUser(): User|null
    {
        if (!$this->_user) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
