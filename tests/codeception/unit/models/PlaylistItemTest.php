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

class PlaylistItemTest extends TestCase
{
    public function fixtures()
    {
        return [
            'playlists' => PlaylistFixture::class,
            'items' => PlaylistItemFixture::class,
        ];
    }

    public function testDelete()
    {
        $this->assertSame(Playlist::STATUS_PUBLISH, Playlist::findOne($this->items['item1']['playlist_id'])->status);
        PlaylistItem::findOne($this->items['item1']['id'])->delete();
        $this->assertSame(Playlist::STATUS_INCOMPLETE, Playlist::findOne($this->items['item1']['playlist_id'])->status);
    }
}
