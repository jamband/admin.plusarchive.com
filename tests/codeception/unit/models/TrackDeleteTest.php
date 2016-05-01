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
use app\models\Track;
use yii\codeception\TestCase;
use tests\codeception\unit\fixtures\TrackFixture;
use tests\codeception\unit\fixtures\PlaylistFixture;
use tests\codeception\unit\fixtures\PlaylistItemFixture;

class TrackDeleteTest extends TestCase
{
    public function fixtures()
    {
        return [
            'track' => [
                'class' => TrackFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/track-delete/track.php',
            ],
            'playlist' => [
                'class' => PlaylistFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/track-delete/playlist.php',
            ],
            'items' => [
                'class' => PlaylistItemFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/track-delete/playlist_item.php',
            ],
        ];
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
    }
}
