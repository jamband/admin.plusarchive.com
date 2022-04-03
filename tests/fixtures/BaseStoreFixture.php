<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\Store;
use yii\test\ActiveFixture;

class BaseStoreFixture extends ActiveFixture
{
    public $modelClass = Store::class;
}
