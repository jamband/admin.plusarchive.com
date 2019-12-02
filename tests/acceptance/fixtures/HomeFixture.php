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

namespace app\tests\acceptance\fixtures;

use app\models\Track;
use yii\test\ActiveFixture;

class HomeFixture extends ActiveFixture
{
    public $modelClass = Track::class;

    public $depends = [
        MusicGenreFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'track1' => [
                'url' => 'https://example.bandcamp.com/track/track1',
                'provider' => Track::PROVIDER_BANDCAMP,
                'provider_key' => 'key1',
                'title' => 'track1',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Track::TYPE_TRACK,
                'urge' => true,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track2' => [
                'url' => 'https://example.bandcamp.com/track/track2',
                'provider' => Track::PROVIDER_BANDCAMP,
                'provider_key' => 'key2',
                'title' => 'track2',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Track::TYPE_TRACK,
                'urge' => true,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track3' => [
                'url' => 'https://example.bandcamp.com/track/track3',
                'provider' => Track::PROVIDER_BANDCAMP,
                'provider_key' => 'key3',
                'title' => 'track3',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Track::TYPE_TRACK,
                'urge' => true,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
