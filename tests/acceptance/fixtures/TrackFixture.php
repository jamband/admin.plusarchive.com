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

use app\models\Track;
use yii\test\ActiveFixture;

class TrackFixture extends ActiveFixture
{
    public $modelClass = Track::class;

    public $depends = [
        AdminUserFixture::class,
        MusicGenreFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'track1' => [
                'url' => 'https://example.bandcamp.com/track/track1',
                'provider' => 1,
                'provider_key' => 'track1',
                'title' => 'track1',
                'image' => 'track1.jpg',
                'type' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track2' => [
                'url' => 'https://soundcloud.com/account_name/track2',
                'provider' => 2,
                'provider_key' => 'track2',
                'title' => 'track2',
                'image' => 'track2.jpg',
                'type' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track3' => [
                'url' => 'https://vimeo/3',
                'provider' => 3,
                'provider_key' => '3',
                'title' => 'track3',
                'image' => 'track3.jpg',
                'type' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track4' => [
                'url' => 'https://www.youtube.com/watch?v=track4',
                'provider' => 4,
                'provider_key' => 'track4',
                'title' => 'track4',
                'image' => 'track4.jpg',
                'type' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track5' => [
                'url' => 'https://www.youtube.com/watch?v=track5',
                'provider' => 4,
                'provider_key' => 'track5',
                'title' => 'track5',
                'image' => 'track5.jpg',
                'type' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
