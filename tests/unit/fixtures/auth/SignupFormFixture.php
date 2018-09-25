<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\unit\fixtures\auth;

class SignupFormFixture extends UserFixture
{
    protected function getData(): array
    {
        return [
            'user1' => [
                'username' => 'user1',
                'email' => 'user1@example.com',
                'password' => security()->generatePasswordHash('user1user1', 4),
                'auth_key' => security()->generateRandomString(),
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
