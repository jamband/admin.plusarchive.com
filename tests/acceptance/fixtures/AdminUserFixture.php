<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\models\User;
use yii\test\ActiveFixture;

class AdminUserFixture extends ActiveFixture
{
    public $modelClass = User::class;

    protected function getData(): array
    {
        return [
            'admin' => [
                'username' => app()->params['admin-username'],
                'email' => app()->params['admin-email'],
                'password' => security()->generatePasswordHash(app()->params['admin-password'], 4),
                'auth_key' => security()->generateRandomString(),
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
