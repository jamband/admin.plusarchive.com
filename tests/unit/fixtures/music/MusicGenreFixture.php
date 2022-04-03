<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\tests\fixtures\BaseMusicGenreFixture;

class MusicGenreFixture extends BaseMusicGenreFixture
{
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
