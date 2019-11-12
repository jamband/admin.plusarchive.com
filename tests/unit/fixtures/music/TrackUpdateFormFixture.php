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

namespace app\tests\unit\fixtures\music;

use app\models\Track;

class TrackUpdateFormFixture extends TrackFixture
{
    protected function getData(): array
    {
        return [
            'track1' => [
                'url' => 'https://www.youtube.com/watch?v=track1',
                'provider' => Track::PROVIDER_YOUTUBE,
                'provider_key' => 'track1',
                'title' => 'track1',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Track::TYPE_TRACK,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'track2' => [
                'url' => 'https://www.youtube.com/watch?v=track2',
                'provider' => Track::PROVIDER_YOUTUBE,
                'provider_key' => 'track2',
                'title' => 'track2',
                'image' => 'http://dev.plusarchive:8080/assets/favicon.png',
                'type' => Track::TYPE_TRACK,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
