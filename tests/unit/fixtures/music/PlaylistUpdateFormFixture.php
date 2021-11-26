<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\Music;
use app\models\Playlist;
use yii\test\ActiveFixture;

class PlaylistUpdateFormFixture extends ActiveFixture
{
    public $modelClass = Playlist::class;

    protected function getData(): array
    {
        return [
            'playlist1' => [
                'url' => 'https://www.youtube.com/playlist?list=playlist1',
                'provider' => Music::PROVIDER_YOUTUBE,
                'provider_key' => 'playlist1',
                'title' => 'playlist1',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
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
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Music::TYPE_PLAYLIST,
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
