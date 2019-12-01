<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

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
                'provider' => Track::PROVIDER_BANDCAMP,
                'provider_key' => 'track1',
                'title' => 'track1',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Track::TYPE_TRACK,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track2' => [
                'url' => 'https://soundcloud.com/account_name/track2',
                'provider' => Track::PROVIDER_SOUNDCLOUD,
                'provider_key' => 'track2',
                'title' => 'track2',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Track::TYPE_TRACK,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track3' => [
                'url' => 'https://vimeo/3',
                'provider' => Track::PROVIDER_VIMEO,
                'provider_key' => '3',
                'title' => 'track3',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Track::TYPE_TRACK,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track4' => [
                'url' => 'https://www.youtube.com/watch?v=track4',
                'provider' => Track::PROVIDER_YOUTUBE,
                'provider_key' => 'track4',
                'title' => 'track4',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Track::TYPE_TRACK,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track5' => [
                'url' => 'https://www.youtube.com/watch?v=track5',
                'provider' => Track::PROVIDER_YOUTUBE,
                'provider_key' => 'track5',
                'title' => 'track5',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Track::TYPE_TRACK,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
