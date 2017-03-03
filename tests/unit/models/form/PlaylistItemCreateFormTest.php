<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\tests\unit\models\form;

use app\models\Playlist;
use app\models\PlaylistItem;
use app\models\form\PlaylistItemCreateForm;
use app\tests\unit\fixtures\PlaylistFixture;
use app\tests\unit\fixtures\PlaylistItemFixture;
use app\tests\unit\fixtures\TrackFixture;
use Codeception\Test\Unit;

class PlaylistItemCreateFormTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $playlist;
    private $track;
    private $items;

    protected function setUp()
    {
        parent::setUp();

        $this->tester->haveFixtures([
            'playlist' => [
                'class' => PlaylistFixture::class,
                'dataFile' => '@fixture/playlist-item-create-form/playlist.php',
            ],
            'track' => [
                'class' => TrackFixture::class,
                'dataFile' => '@fixture/playlist-item-create-form/track.php',
            ],
            'items' => [
                'class' => PlaylistItemFixture::class,
                'dataFile' => '@fixture/playlist-item-create-form/playlist_item.php',
            ],
        ]);

        $fixtures = $this->tester->grabFixtures();
        $this->playlist = $fixtures['playlist'];
        $this->track = $fixtures['track'];
        $this->items = $fixtures['items'];
    }

    public function testValidateProvider()
    {
        $model = new PlaylistItemCreateForm([
            'playlist_id' => $this->playlist['ambient']['id'],
            'track_id' => $this->track['youtube2']['id'],
            'track_title' => $this->track['youtube2']['title'],
        ]);
        $this->assertFalse($model->save());
        $this->assertTrue(isset($model->errors['track_id']));

        $model->playlist_id = $this->playlist['rock-music-video']['id'];
        $this->assertTrue($model->save());

        $model->playlist_id = $this->playlist['jamband']['id'];
        $this->assertTrue($model->save());
    }

    public function testValidateUnique()
    {
        $model = new PlaylistItemCreateForm([
            'playlist_id' => $this->playlist['rock-music-video']['id'],
            'track_id' => $this->track['youtube1']['id'],
            'track_title' => $this->track['youtube1']['title'],
        ]);
        $this->assertFalse($model->save());
        $this->assertTrue(isset($model->errors['track_id']));

        $model->track_id = $this->track['youtube2']['id'];
        $model->track_title = $this->track['youtube2']['title'];
        $this->assertTrue($model->save());
    }

    public function testSave()
    {
        // if a track does not exist in the playlist.
        $playlist_id = $this->playlist['jamband']['id'];

        $model = new PlaylistItemCreateForm([
            'playlist_id' => $playlist_id,
            'track_id' => $this->track['youtube1']['id'],
            'track_title' => $this->track['youtube1']['title'],
        ]);
        $this->assertTrue($model->save());

        $query = PlaylistItem::find()->playlist($playlist_id);
        $this->assertSame(1, (int)$query->count());
        $this->assertSame(1, (int)$query->max('track_number'));

        $playlist = Playlist::findOne($playlist_id);
        $this->assertGreaterThan($this->playlist['jamband']['updated_at'], $playlist->updated_at);
        $this->assertSame(1, $playlist->frequency);

        // if some track already exists in the playlist.
        $playlist_id = $this->playlist['rock-music-video']['id'];

        $model = new PlaylistItemCreateForm([
            'playlist_id' => $playlist_id,
            'track_id' => $this->track['youtube2']['id'],
            'track_title' => $this->track['youtube2']['title'],
        ]);
        $this->assertTrue($model->save());
        $query = PlaylistItem::find()->playlist($playlist_id);
        $this->assertSame(2, (int)$query->count());
        $this->assertSame(2, (int)$query->max('track_number'));

        $playlist = Playlist::findOne($playlist_id);
        $this->assertGreaterThan($this->playlist['rock-music-video']['updated_at'], $playlist->updated_at);
        $this->assertSame(2, $playlist->frequency);
    }
}
