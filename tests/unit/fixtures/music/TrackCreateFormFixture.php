<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\Music;
use app\tests\fixtures\BaseTrackFixture;

class TrackCreateFormFixture extends BaseTrackFixture
{
    protected function getData(): array
    {
        return [
            'track1' => [
                'url' => 'https://www.youtube.com/watch?v=track1',
                'provider' => Music::PROVIDER_YOUTUBE,
                'provider_key' => 'track1',
                'title' => 'track1',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Music::TYPE_TRACK,
                'urge' => 0,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
