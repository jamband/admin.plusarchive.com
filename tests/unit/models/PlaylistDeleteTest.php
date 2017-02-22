<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\tests\unit\models;

use app\models\Playlist;
use app\models\PlaylistItem;
use app\tests\unit\fixtures\PlaylistFixture;
use app\tests\unit\fixtures\PlaylistItemFixture;
use Codeception\Test\Unit;

class PlaylistDeleteTest extends Unit
{
    protected function setUp()
    {
        parent::setUp();

        $this->tester->haveFixtures([
            'playlists' => [
                'class' => PlaylistFixture::class,
                'dataFile' => '@fixture/playlist-delete/playlist.php',
            ],
            'items' => [
                'class' => PlaylistItemFixture::class,
                'dataFile' => '@fixture/playlist-delete/playlist_item.php',
            ],
        ]);

        $fixtures = $this->tester->grabFixtures();
        $this->playlists = $fixtures['playlists'];
        $this->items = $fixtures['items'];
    }

    public function testDelete()
    {
        $this->assertSame(2, (int)PlaylistItem::find()->playlist($this->playlists['playlist2']['id'])->count());

        Playlist::findOne($this->playlists['playlist2']['id'])->delete();
        $this->assertSame(0, (int)PlaylistItem::find()->playlist($this->playlists['playlist2']['id'])->count());

    }
}
