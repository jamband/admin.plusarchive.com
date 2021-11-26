<?php

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\Music;

class TrackAllFixture extends TrackFixture
{
    public $depends = [
        MusicGenreFixture::class,
        MusicGenreAssnFixture::class,
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
                'urge' => false,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track2' => [
                'url' => 'https://soundcloud.com/account_name/track2',
                'provider' => Music::PROVIDER_SOUNDCLOUD,
                'provider_key' => '1',
                'title' => 'track2',
                'image' => 'track2.jpg',
                'type' => Music::TYPE_TRACK,
                'urge' => false,
                'created_at' => time() + 1,
                'updated_at' => time() + 1,
            ],
            'track3' => [
                'url' => 'https://www.youtube.com/watch?v=track4',
                'provider' => Music::PROVIDER_YOUTUBE,
                'provider_key' => 'track4',
                'title' => 'track3',
                'image' => 'track3.jpg',
                'type' => Music::TYPE_TRACK,
                'urge' => false,
                'created_at' => time() + 3,
                'updated_at' => time() + 3,
            ],
            'track4' => [
                'url' => 'https://vimeo/4',
                'provider' => Music::PROVIDER_VIMEO,
                'provider_key' => '4',
                'title' => 'track4',
                'image' => 'track4.jpg',
                'type' => Music::TYPE_TRACK,
                'urge' => false,
                'created_at' => time() + 4,
                'updated_at' => time() + 4,
            ],
            'track5' => [
                'url' => 'https://www.youtube.com/watch?v=track5',
                'provider' => Music::PROVIDER_YOUTUBE,
                'provider_key' => 'track5',
                'title' => 'track5',
                'image' => 'track5.jpg',
                'type' => Music::TYPE_TRACK,
                'urge' => false,
                'created_at' => time() + 2,
                'updated_at' => time() + 2,
            ],
        ];
    }
}
