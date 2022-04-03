<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\tests\fixtures\BaseUserFixture;

class AdminUserFixture extends BaseUserFixture
{
    protected function getData(): array
    {
        return [
            'admin' => [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => '$2y$04$Fehc6ELHm9t57/4/o7a63uGkoA7u7J40Ey0h/wioZMQnTQZCBFMU6', // adminadmin
                'auth_key' => 'ssgtXCWJ0Htw_Wxgnn-IIYKHgtHwNF7c',
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
