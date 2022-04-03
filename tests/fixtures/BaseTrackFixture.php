<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\Track;
use yii\test\ActiveFixture;

class BaseTrackFixture extends ActiveFixture
{
    public $modelClass = Track::class;
}
