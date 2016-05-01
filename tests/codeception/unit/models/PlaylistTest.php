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
use yii\codeception\TestCase;
use tests\codeception\unit\fixtures\PlaylistFixture;
use tests\codeception\unit\fixtures\PlaylistItemFixture;

class PlaylistTest extends TestCase
{
    public function fixtures()
    {
        return [
            'playlists' => PlaylistFixture::class,
            'items' => PlaylistItemFixture::class,
        ];
    }
    public function testSave()
    {
        $model = new Playlist;
        $model->loadDefaultValues();
        $model->title = 'new playlist';

        $this->assertTrue($model->save());
        $this->assertSame(Playlist::STATUS_INCOMPLETE, $model->status);
    }

    public function testValidateItemExists()
    {
        $model = new Playlist;
        $model->title = 'new playlist';
        $model->status = Playlist::STATUS_PUBLISH;
        $this->assertFalse($model->save());
        $this->assertTrue(isset($model->errors['status']));

        $model = Playlist::findOne($this->playlists['playlist3']['id']);
        $model->status = Playlist::STATUS_PUBLISH;
        $this->assertFalse($model->save());
        $this->assertTrue(isset($model->errors['status']));

        $model = Playlist::findOne($this->playlists['playlist2']['id']);
        $model->status = Playlist::STATUS_PUBLISH;
        $this->assertTrue($model->save());
        $this->assertFalse(isset($model->errors['status']));
    }
}
