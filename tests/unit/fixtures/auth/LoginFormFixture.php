<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\auth;

use app\tests\fixtures\BaseUserFixture;

class LoginFormFixture extends BaseUserFixture
{
    protected function getData(): array
    {
        return [
            'user1' => [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => '$2y$04$XRdLB9Eug8NIn0klDfQf.u6c2D25nJ0Udj8.I0dc2wUHC25np7ISC', // adminadmin
                'auth_key' => '0b8Cu9Tk9UFoGnN7xmk3a0_JZ6941u96',
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
