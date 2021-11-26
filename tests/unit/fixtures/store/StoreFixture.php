<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\store;

use app\models\store;
use yii\test\ActiveFixture;

class StoreFixture extends ActiveFixture
{
    public $modelClass = Store::class;
}
