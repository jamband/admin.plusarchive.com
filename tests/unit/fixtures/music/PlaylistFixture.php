<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\Playlist;
use yii\test\ActiveFixture;

class PlaylistFixture extends ActiveFixture
{
    public $modelClass = Playlist::class;
}
