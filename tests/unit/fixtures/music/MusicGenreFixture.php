<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\MusicGenre;
use yii\test\ActiveFixture;

class MusicGenreFixture extends ActiveFixture
{
    public $modelClass = MusicGenre::class;

    protected function getData(): array
    {
        return [
            'genre1' => [
                'name' => 'genre1',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'genre2' => [
                'name' => 'genre2',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
