<?php

declare(strict_types=1);

namespace app\tests\acceptance\fixtures;

use app\models\Music;
use app\tests\fixtures\BaseTrackFixture;

class HomeFixture extends BaseTrackFixture
{
    public $depends = [
        MusicGenreFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'track1' => [
                'url' => 'https://example.bandcamp.com/track/track1',
                'provider' => Music::PROVIDER_BANDCAMP,
                'provider_key' => 'key1',
                'title' => 'track1',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Music::TYPE_TRACK,
                'urge' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track2' => [
                'url' => 'https://example.bandcamp.com/track/track2',
                'provider' => Music::PROVIDER_BANDCAMP,
                'provider_key' => 'key2',
                'title' => 'track2',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Music::TYPE_TRACK,
                'urge' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track3' => [
                'url' => 'https://example.bandcamp.com/track/track3',
                'provider' => Music::PROVIDER_BANDCAMP,
                'provider_key' => 'key3',
                'title' => 'track3',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Music::TYPE_TRACK,
                'urge' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
