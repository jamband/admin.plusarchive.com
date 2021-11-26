<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use yii\test\ActiveFixture;

class MusicGenreAssnFixture extends ActiveFixture
{
    public $tableName = 'music_genre_assn';

    protected function getData(): array
    {
        return [
            'genre_assn1' => [
                'music_id' => 1,
                'music_genre_id' => 1,
            ],
        ];
    }
}
