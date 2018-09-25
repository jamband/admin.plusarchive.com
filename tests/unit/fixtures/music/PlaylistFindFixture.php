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

namespace app\tests\unit\fixtures\music;

use app\models\Playlist;

class PlaylistFindFixture extends PlaylistFixture
{
    protected function getData()
    {
        return [
            'track1' => [
                'url' => 'https://example.bandcamp.com/track/track1',
                'provider' => Playlist::PROVIDER_BANDCAMP,
                'provider_key' => '1',
                'title' => 'track1',
                'image' => 'track1.jpg',
                'type' => Playlist::TYPE_TRACK,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'playlist1' => [
                'url' => 'https://soundcloud.com/account_name/set/playlist1',
                'provider' => Playlist::PROVIDER_SOUNDCLOUD,
                'provider_key' => '1',
                'title' => 'playlist1',
                'image' => 'playlist1.jpg',
                'type' => Playlist::TYPE_PLAYLIST,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'playlist2' => [
                'url' => 'https://www.youtube.com/playlist?list=playlist2',
                'provider' => Playlist::PROVIDER_YOUTUBE,
                'provider_key' => 'playlist2',
                'title' => 'playlist2',
                'image' => 'playlist2.jpg',
                'type' => Playlist::TYPE_PLAYLIST,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
