<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\LabelTag;
use yii\test\ActiveFixture;

class BaseLabelTagFixture extends ActiveFixture
{
    public $modelClass = LabelTag::class;
}
