<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\auth;

class LoginFormFixture extends UserFixture
{
    protected function getData(): array
    {
        return [
            'user1' => [
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
