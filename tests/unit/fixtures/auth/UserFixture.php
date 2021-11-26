<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\auth;

use app\models\User;
use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = User::class;
}
