<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\tests\fixtures\BaseMusicGenreFixture;
use app\tests\unit\fixtures\music\MusicGenreAssnFixture;

class MusicGenreFixture extends BaseMusicGenreFixture
{
    public $depends = [
        MusicGenreAssnFixture::class,
    ];

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
            'genre3' => [
                'name' => 'genre3',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'genre4' => [
                'name' => 'genre4',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'genre5' => [
                'name' => 'genre5',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
