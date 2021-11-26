<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\Music;

class PlaylistAllFixture extends PlaylistFixture
{
    protected function getData(): array
    {
        return [
            'playlist1' => [
                'url' => 'https://soundcloud.com/account_name/set/playlist1',
                'provider' => Music::PROVIDER_SOUNDCLOUD,
                'provider_key' => '1',
                'title' => 'playlist1',
                'image' => 'playlist1.jpg',
                'type' => Music::TYPE_PLAYLIST,
                'urge' => false,
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
                'urge' => false,
                'created_at' => time() + 2,
                'updated_at' => time(),
            ],
            'playlist3' => [
                'url' => 'https://www.youtube.com/playlist?list=playlist3',
                'provider' => Music::PROVIDER_YOUTUBE,
                'provider_key' => 'playlist3',
                'title' => 'playlist3',
                'image' => 'playlist3.jpg',
                'type' => Music::TYPE_PLAYLIST,
                'urge' => false,
                'created_at' => time() + 1,
                'updated_at' => time(),
            ],
        ];
    }
}
