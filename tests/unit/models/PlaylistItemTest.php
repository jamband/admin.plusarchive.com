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

class PlaylistItemTest extends Unit
{
    protected function setUp()
    {
        parent::setUp();

        $this->tester->haveFixtures([
            'playlists' => PlaylistFixture::class,
            'items' => PlaylistItemFixture::class,
        ]);

        $fixtures = $this->tester->grabFixtures();
        $this->items = $fixtures['items'];
    }

    public function testDelete()
    {
        $this->assertSame(Playlist::STATUS_PUBLISH, Playlist::findOne($this->items['item1']['playlist_id'])->status);
        $this->assertSame(1, Playlist::findOne($this->items['item1']['playlist_id'])->frequency);

        PlaylistItem::findOne($this->items['item1']['id'])->delete();
        $this->assertSame(Playlist::STATUS_INCOMPLETE, Playlist::findOne($this->items['item1']['playlist_id'])->status);
        $this->assertSame(0, Playlist::findOne($this->items['item1']['playlist_id'])->frequency);
    }
}
