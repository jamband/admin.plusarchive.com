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
use app\models\Track;
use app\tests\unit\fixtures\TrackFixture;
use app\tests\unit\fixtures\PlaylistFixture;
use app\tests\unit\fixtures\PlaylistItemFixture;
use Codeception\Test\Unit;

class TrackDeleteTest extends Unit
{
    protected function setUp()
    {
        parent::setUp();

        $this->tester->haveFixtures([
            'track' => [
                'class' => TrackFixture::class,
                'dataFile' => '@fixture/track-delete/track.php',
            ],
            'playlist' => [
                'class' => PlaylistFixture::class,
                'dataFile' => '@fixture/track-delete/playlist.php',
            ],
            'items' => [
                'class' => PlaylistItemFixture::class,
                'dataFile' => '@fixture/track-delete/playlist_item.php',
            ],
        ]);

        $fixtures = $this->tester->grabFixtures();
        $this->track = $fixtures['track'];
        $this->playlist = $fixtures['playlist'];
    }

    public function testDelete()
    {
        $this->assertSame(Playlist::STATUS_PUBLISH, Playlist::findOne($this->playlist['playlist1']['id'])->status);
        $this->assertSame(Playlist::STATUS_PUBLISH, Playlist::findOne($this->playlist['playlist2']['id'])->status);
        $this->assertSame(1, (int)PlaylistItem::find()->track($this->track['track3']['id'])->count());

        Track::findOne($this->track['track3']['id'])->delete();

        $this->assertSame(Playlist::STATUS_PUBLISH, Playlist::findOne($this->playlist['playlist1']['id'])->status);
        $this->assertSame(Playlist::STATUS_INCOMPLETE, Playlist::findOne($this->playlist['playlist2']['id'])->status);
        $this->assertSame(0, (int)PlaylistItem::find()->track($this->track['track3']['id'])->count());

        $playlist = Playlist::findOne($this->playlist['playlist2']['id']);
        $this->assertGreaterThan($this->playlist['playlist2']['updated_at'], $playlist->updated_at);
    }
}
