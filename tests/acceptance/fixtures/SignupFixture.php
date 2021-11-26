<?php

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
