<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\models\Music;
use app\models\Playlist;
use yii\test\ActiveFixture;

class PlaylistFixture extends ActiveFixture
{
    public $modelClass = Playlist::class;

    public $depends = [
        AdminUserFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'playlist1' => [
                'url' => 'https://soundcloud.com/account/sets/playlist1',
                'provider' => Music::PROVIDER_SOUNDCLOUD,
                'provider_key' => '123',
                'title' => 'playlist1',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Music::TYPE_PLAYLIST,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'playlist2' => [
                'url' => 'https://soundcloud.com/account/sets/playlist2',
                'provider' => Music::PROVIDER_SOUNDCLOUD,
                'provider_key' => '123',
                'title' => 'playlist2',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Music::TYPE_PLAYLIST,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'playlist3' => [
                'url' => 'https://www.youtube.com/playlist?list=123',
                'provider' => Music::PROVIDER_YOUTUBE,
                'provider_key' => '123',
                'title' => 'playlist3',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Music::TYPE_PLAYLIST,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
