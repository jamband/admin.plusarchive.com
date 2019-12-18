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

class TrackQuerySortFixture extends TrackFixture
{
    protected function getData(): array
    {
        return [
            'track1' => [
                'url' => 'https://example.bandcamp.com/track/track1',
                'provider' => Track::PROVIDER_BANDCAMP,
                'provider_key' => '1',
                'title' => 'foo',
                'image' => 'track1.jpg',
                'type' => Track::TYPE_TRACK,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time() + 1,
            ],
            'track2' => [
                'url' => 'https://soundcloud.com/account_name/track2',
                'provider' => Track::PROVIDER_SOUNDCLOUD,
                'provider_key' => '1',
                'title' => 'bar',
                'image' => 'track2.jpg',
                'type' => Track::TYPE_TRACK,
                'urge' => false,
                'created_at' => time() + 1,
                'updated_at' => time() + 2,
            ],
            'track3' => [
                'url' => 'https://www.youtube.com/watch?v=track3',
                'provider' => Track::PROVIDER_YOUTUBE,
                'provider_key' => 'track3',
                'title' => 'baz',
                'image' => 'track3.jpg',
                'type' => Track::TYPE_TRACK,
                'urge' => false,
                'created_at' => time() + 2,
                'updated_at' => time(),
            ],
        ];
    }
}
