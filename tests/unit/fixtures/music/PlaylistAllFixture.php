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

class PlaylistAllFixture extends PlaylistFixture
{
    protected function getData(): array
    {
        return [
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
                'created_at' => time() + 2,
                'updated_at' => time(),
            ],
            'playlist3' => [
                'url' => 'https://www.youtube.com/playlist?list=playlist3',
                'provider' => Playlist::PROVIDER_YOUTUBE,
                'provider_key' => 'playlist3',
                'title' => 'playlist3',
                'image' => 'playlist3.jpg',
                'type' => Playlist::TYPE_PLAYLIST,
                'created_at' => time() + 1,
                'updated_at' => time(),
            ],
        ];
    }
}
