<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\tests\fixtures\BaseMusicGenreAssnFixture;

class MusicGenreAssnFixture extends BaseMusicGenreAssnFixture
{
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
