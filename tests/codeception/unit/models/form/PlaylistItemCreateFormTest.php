<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\codeception\unit\models\form;

use app\models\PlaylistItem;
use app\models\form\PlaylistItemCreateForm;
use tests\codeception\unit\fixtures\PlaylistFixture;
use tests\codeception\unit\fixtures\PlaylistItemFixture;
use tests\codeception\unit\fixtures\TrackFixture;
use yii\codeception\DbTestCase;

class PlaylistItemCreateFormTest extends DbTestCase
{
    public function fixtures()
    {
        return [
            'playlist' => [
                'class' => PlaylistFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/playlist-item-create-form/playlist.php',
            ],
            'track' => [
                'class' => TrackFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/playlist-item-create-form/track.php',
            ],
            'items' => [
                'class' => PlaylistItemFixture::class,
                'dataFile' => '@tests/codeception/unit/fixtures/data/playlist-item-create-form/playlist_item.php',
            ],
        ];
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
    }
}
