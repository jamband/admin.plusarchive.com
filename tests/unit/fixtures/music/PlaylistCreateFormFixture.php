<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\unit\fixtures\music;

use app\models\Music;
use app\models\Playlist;
use yii\test\ActiveFixture;

class PlaylistCreateFormFixture extends ActiveFixture
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
        ];
    }
}
