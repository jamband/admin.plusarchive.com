<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\tests\acceptance\fixtures;

use app\models\TrackGenre;
use yii\test\ActiveFixture;

class TrackGenreFixture extends ActiveFixture
{
    public $modelClass = TrackGenre::class;

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
