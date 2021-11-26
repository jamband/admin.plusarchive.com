<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\models\MusicGenre;
use yii\test\ActiveFixture;

class MusicGenreFixture extends ActiveFixture
{
    public $modelClass = MusicGenre::class;

    public $depends = [
        AdminUserFixture::class,
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
