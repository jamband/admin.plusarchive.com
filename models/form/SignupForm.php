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
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username', 'email', 'password'], 'trim'],
            [['username', 'email'], 'unique', 'targetClass' => User::class,
                'message' => 'This {attribute} is not available.',
            ],
            ['username', 'match', 'pattern' => '/^[a-z0-9_]{4,20}$/'],
            ['email', 'email'],
            ['password', 'match', 'pattern' => '/^[A-Za-z0-9_]{8,60}$/'],
        ];
    }

    /**
     * Signup user.
     *
     * @return null|User
     */
    public function signup(): ?User
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->setAuthKey();
        $user->save();

        return $user;
    }
}
