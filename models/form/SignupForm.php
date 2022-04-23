<?php

declare(strict_types=1);

namespace app\models\form;

use app\models\User;
use yii\base\Model;

class SignupForm extends Model
{
    public string|null $username = null;
    public string|null $email = null;
    public string|null $password = null;

    public function rules(): array
    {
        return [
            ['username', 'required'],
            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => User::class,
                'message' => 'This {attribute} is not available.',
            ],
            ['username', 'match', 'pattern' => '/^[a-z0-9_]{4,20}$/'],

            ['email', 'required'],
            ['email', 'trim'],
            ['email', 'unique', 'targetClass' => User::class,
                'message' => 'This {attribute} is not available.',
            ],
            ['email', 'email'],

            ['password', 'required'],
            ['password', 'trim'],
            ['password', 'match', 'pattern' => '/^[A-Za-z0-9_]{8,60}$/'],
        ];
    }

    public function signup(): User|null
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->setAuthKey();
            $user->save();

            return $user;
        }

        return null;
    }
}
