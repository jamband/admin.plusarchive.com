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
use app\tests\unit\fixtures\PlaylistFixture;
use app\tests\unit\fixtures\PlaylistItemFixture;
use Codeception\Test\Unit;

class PlaylistTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $playlists;

    protected function setUp()
    {
        parent::setUp();

        $this->tester->haveFixtures([
            'playlists' => PlaylistFixture::class,
            'items' => PlaylistItemFixture::class,
        ]);

        $fixtures = $this->tester->grabFixtures();
        $this->playlists = $fixtures['playlists'];
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
