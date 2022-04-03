<?php

declare(strict_types=1);

namespace app\tests\fixtures;

use app\models\Playlist;
use yii\test\ActiveFixture;

class BasePlaylistFixture extends ActiveFixture
{
    public $modelClass = Playlist::class;
}
