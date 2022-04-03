<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\StoreTag;
use yii\test\ActiveFixture;

class BaseStoreTagFixture extends ActiveFixture
{
    public $modelClass = StoreTag::class;
}
