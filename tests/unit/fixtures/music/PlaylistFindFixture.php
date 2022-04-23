<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\Music;
use app\tests\fixtures\BasePlaylistFixture;

class PlaylistFindFixture extends BasePlaylistFixture
{
    protected function getData(): array
    {
        return [
            'track1' => [
                'url' => 'https://example.bandcamp.com/track/track1',
                'provider' => Music::PROVIDER_BANDCAMP,
                'provider_key' => '1',
                'title' => 'track1',
                'image' => 'track1.jpg',
                'type' => Music::TYPE_TRACK,
                'urge' => 0,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'playlist1' => [
                'url' => 'https://soundcloud.com/account_name/set/playlist1',
                'provider' => Music::PROVIDER_SOUNDCLOUD,
                'provider_key' => '1',
                'title' => 'playlist1',
                'image' => 'playlist1.jpg',
                'type' => Music::TYPE_PLAYLIST,
                'urge' => 0,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'playlist2' => [
                'url' => 'https://www.youtube.com/playlist?list=playlist2',
                'provider' => Music::PROVIDER_YOUTUBE,
                'provider_key' => 'playlist2',
                'title' => 'playlist2',
                'image' => 'playlist2.jpg',
                'type' => Music::TYPE_PLAYLIST,
                'urge' => 0,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
