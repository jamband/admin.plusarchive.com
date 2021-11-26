<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\Track;
use yii\test\ActiveFixture;

class TrackFixture extends ActiveFixture
{
    public $modelClass = Track::class;
}
