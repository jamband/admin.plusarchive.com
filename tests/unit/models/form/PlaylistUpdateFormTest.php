<?php

declare(strict_types=1);

namespace app\tests\unit\models\form;

use app\models\form\PlaylistUpdateForm;
use app\models\Music;
use app\models\Playlist;
use app\tests\unit\fixtures\music\PlaylistUpdateFormFixture;
use Codeception\Test\Unit;
use UnitTester;

/** @see PlaylistUpdateForm */
class PlaylistUpdateFormTest extends Unit
{
    protected UnitTester $tester;

    public function testSaveFails(): void
    {
        $fixtures['playlists'] = PlaylistUpdateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $playlist1 = $this->tester->grabFixture('playlists', 'playlist1');

        $model = new PlaylistUpdateForm($playlist1->id);
        $model->url = 'https://example.com/foo/bar';
        $this->assertFalse($model->save());
    }

    public function testUrlUniqueValidation(): void
    {
        $fixtures['playlists'] = PlaylistUpdateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $playlist1 = $this->tester->grabFixture('playlists', 'playlist1');
        $playlist2 = $this->tester->grabFixture('playlists', 'playlist2');

        $model = new PlaylistUpdateForm($playlist2->id);
        $model->url = $playlist1->url;
        $this->assertFalse($model->save());
        $this->assertTrue($model->hasErrors('url'));
    }

    public function testSave(): void
    {
        $fixtures['playlists'] = PlaylistUpdateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $playlist2 = $this->tester->grabFixture('playlists', 'playlist2');

        $model = new PlaylistUpdateForm($playlist2->id);
        $model->title = 'Updated Title';
        $this->assertTrue($model->save());

        $track = Playlist::findOne(['title' => 'Updated Title']);

        $this->assertSame('https://www.youtube.com/playlist?list=playlist2', $track->url);
        $this->assertSame(Music::PROVIDER_YOUTUBE, $track->provider);
        $this->assertSame('playlist2', $track->provider_key);
        $this->assertSame('Updated Title', $track->title);
        $this->assertSame(Music::TYPE_PLAYLIST, $track->type);
        $this->assertSame('http://dev.plusarchive:8080/assets/favicon.png', $track->image);
        $this->assertGreaterThanOrEqual(time(), $track->created_at);
        $this->assertGreaterThanOrEqual(time(), $track->updated_at);
    }
}
