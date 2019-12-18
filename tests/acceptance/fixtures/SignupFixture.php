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

namespace app\tests\acceptance\fixtures;

use app\models\User;
use yii\test\ActiveFixture;

class SignupFixture extends ActiveFixture
{
    public $modelClass = User::class;

    public $depends = [
        AdminUserFixture::class,
    ];
}
