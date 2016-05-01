<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\codeception\unit\models;

use app\models\Playlist;
use app\models\PlaylistItem;
use yii\codeception\TestCase;
use tests\codeception\unit\fixtures\PlaylistFixture;
use tests\codeception\unit\fixtures\PlaylistItemFixture;

class PlaylistDeleteTest extends TestCase
{
    public function fixtures()
    {
        return [
            'playlists' => [
                'class' => PlaylistFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/playlist-delete/playlist.php',
            ],
            'items' => [
                'class' => PlaylistItemFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/playlist-delete/playlist_item.php',
            ],
        ];
    }

    public function testDelete()
    {
        $this->assertSame(2, (int)PlaylistItem::find()->playlist($this->playlists['playlist2']['id'])->count());

        Playlist::findOne($this->playlists['playlist2']['id'])->delete();
        $this->assertSame(0, (int)PlaylistItem::find()->playlist($this->playlists['playlist2']['id'])->count());

    }
}
