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
                'provider' => 2,
                'provider_key' => '123',
                'title' => 'playlist1',
                'image' => 'playlist1.jpg',
                'type' => 3,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'playlist2' => [
                'url' => 'https://soundcloud.com/account/sets/playlist2',
                'provider' => 2,
                'provider_key' => '123',
                'title' => 'playlist2',
                'image' => 'playlist2.jpg',
                'type' => 3,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'playlist3' => [
                'url' => 'https://www.youtube.com/playlist?list=123',
                'provider' => 4,
                'provider_key' => '123',
                'title' => 'playlist3',
                'image' => 'playlist3.jpg',
                'type' => 3,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
