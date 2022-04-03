<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\MusicGenre;
use yii\test\ActiveFixture;

class BaseMusicGenreFixture extends ActiveFixture
{
    public $modelClass = MusicGenre::class;
}
