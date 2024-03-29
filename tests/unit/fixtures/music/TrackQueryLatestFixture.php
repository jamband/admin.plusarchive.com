<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\Music;
use app\tests\fixtures\BaseTrackFixture;

class TrackQueryLatestFixture extends BaseTrackFixture
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
                'created_at' => time() + 3,
                'updated_at' => time(),
            ],
            'track2' => [
                'url' => 'https://soundcloud.com/account_name/track2',
                'provider' => Music::PROVIDER_SOUNDCLOUD,
                'provider_key' => '1',
                'title' => 'track2',
                'image' => 'track2.jpg',
                'type' => Music::TYPE_TRACK,
                'urge' => 0,
                'created_at' => time() + 1,
                'updated_at' => time(),
            ],
            'track3' => [
                'url' => 'https://www.youtube.com/watch?v=track3',
                'provider' => Music::PROVIDER_YOUTUBE,
                'provider_key' => 'track3',
                'title' => 'track3',
                'image' => 'track3.jpg',
                'type' => Music::TYPE_TRACK,
                'urge' => 0,
                'created_at' => time() + 2,
                'updated_at' => time(),
            ],
        ];
    }
}
