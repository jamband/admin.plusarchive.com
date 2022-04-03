<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\label;
use yii\test\ActiveFixture;

class BaseLabelFixture extends ActiveFixture
{
    public $modelClass = Label::class;
}
