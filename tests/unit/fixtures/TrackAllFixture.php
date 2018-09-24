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

namespace app\tests\unit\fixtures;

use app\models\Track;

class TrackAllFixture extends TrackFixture
{
    public $depends = [
        MusicGenreFixture::class,
        MusicGenreAssnFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'track1' => [
                'url' => 'https://example.bandcamp.com/track/track1',
                'provider' => Track::PROVIDER_BANDCAMP,
                'provider_key' => '1',
                'title' => 'track1',
                'image' => 'track1.jpg',
                'type' => Track::TYPE_TRACK,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track2' => [
                'url' => 'https://soundcloud.com/account_name/track2',
                'provider' => Track::PROVIDER_SOUNDCLOUD,
                'provider_key' => '1',
                'title' => 'track2',
                'image' => 'track2.jpg',
                'type' => Track::TYPE_TRACK,
                'created_at' => time() + 1,
                'updated_at' => time() + 1,
            ],
            'track3' => [
                'url' => 'https://www.youtube.com/watch?v=track4',
                'provider' => Track::PROVIDER_YOUTUBE,
                'provider_key' => 'track4',
                'title' => 'track3',
                'image' => 'track3.jpg',
                'type' => Track::TYPE_TRACK,
                'created_at' => time() + 3,
                'updated_at' => time() + 3,
            ],
            'track4' => [
                'url' => 'https://vimeo/4',
                'provider' => Track::PROVIDER_VIMEO,
                'provider_key' => '4',
                'title' => 'track4',
                'image' => 'track4.jpg',
                'type' => Track::TYPE_TRACK,
                'created_at' => time() + 4,
                'updated_at' => time() + 4,
            ],
            'track5' => [
                'url' => 'https://www.youtube.com/watch?v=track5',
                'provider' => Track::PROVIDER_YOUTUBE,
                'provider_key' => 'track5',
                'title' => 'track5',
                'image' => 'track5.jpg',
                'type' => Track::TYPE_TRACK,
                'created_at' => time() + 2,
                'updated_at' => time() + 2,
            ],
        ];
    }
}
