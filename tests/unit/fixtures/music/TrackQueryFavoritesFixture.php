<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\Track;

class TrackQueryFavoritesFixture extends TrackFixture
{
    protected function getData(): array
    {
        return [
            'track1' => [
                'url' => 'https://example.bandcamp.com/track/track1',
                'provider' => Track::PROVIDER_BANDCAMP,
                'provider_key' => 'key1',
                'title' => 'title1',
                'image' => 'image1.jpg',
                'type' => Track::TYPE_TRACK,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track2' => [
                'url' => 'https://soundcloud.com/account_name/track2',
                'provider' => Track::PROVIDER_SOUNDCLOUD,
                'provider_key' => 'key2',
                'title' => 'title2',
                'image' => 'image2.jpg',
                'type' => Track::TYPE_TRACK,
                'urge' => true,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track3' => [
                'url' => 'https://www.youtube.com/watch?v=track3',
                'provider' => Track::PROVIDER_YOUTUBE,
                'provider_key' => 'key3',
                'title' => 'title3',
                'image' => 'image3.jpg',
                'type' => Track::TYPE_TRACK,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track4' => [
                'url' => 'https://www.youtube.com/watch?v=track4',
                'provider' => Track::PROVIDER_YOUTUBE,
                'provider_key' => 'key4',
                'title' => 'title4',
                'image' => 'image4.jpg',
                'type' => Track::TYPE_TRACK,
                'urge' => true,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track5' => [
                'url' => 'https://www.youtube.com/watch?v=track5',
                'provider' => Track::PROVIDER_YOUTUBE,
                'provider_key' => 'key5',
                'title' => 'title5',
                'image' => 'image5.jpg',
                'type' => Track::TYPE_TRACK,
                'urge' => true,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
