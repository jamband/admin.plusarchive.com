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
