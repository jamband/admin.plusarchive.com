<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\auth;

use app\tests\fixtures\BaseUserFixture;

class SignupFormFixture extends BaseUserFixture
{
    protected function getData(): array
    {
        return [
            'user1' => [
                'username' => 'user1',
                'email' => 'user1@example.com',
                'password' => '$2y$04$F2O81Pc44dl/msuRw2ROW.9aEx6wcVfD1PJ499EBjfO8.NyC97BVy', // user1user1
                'auth_key' => 'QV0OpWDL_ML-UG_upnuNt1G7enK4rqCq',
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
