<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\User;
use yii\test\ActiveFixture;

class BaseUserFixture extends ActiveFixture
{
    public $modelClass = User::class;
}
