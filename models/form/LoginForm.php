<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    /**
     * @var User|null|bool
     */
    private $_user = false;

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'rememberMe' => 'Remember Me',
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],

            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * Validates the password.
     * @noinspection PhpUnused
     *
     * @return void
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

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }

        Yii::warning('failure logged in');

        return false;
    }

    /**
     * Finds user by username.
     *
     * @return User|null
     */
    protected function getUser(): ?User
    {
        if (!$this->_user) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
