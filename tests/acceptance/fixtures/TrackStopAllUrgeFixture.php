<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\models\Music;
use app\tests\fixtures\BaseTrackFixture;

class TrackStopAllUrgeFixture extends BaseTrackFixture
{
    public $depends = [
        AdminUserFixture::class,
        MusicGenreFixture::class,
    ];

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
                'urge' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track2' => [
                'url' => 'https://example.bandcamp.com/track/track2',
                'provider' => Music::PROVIDER_BANDCAMP,
                'provider_key' => '2',
                'title' => 'track2',
                'image' => 'track2.jpg',
                'type' => Music::TYPE_TRACK,
                'urge' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track3' => [
                'url' => 'https://example.bandcamp.com/track/track3',
                'provider' => Music::PROVIDER_BANDCAMP,
                'provider_key' => '3',
                'title' => 'track3',
                'image' => 'track3.jpg',
                'type' => Music::TYPE_TRACK,
                'urge' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
