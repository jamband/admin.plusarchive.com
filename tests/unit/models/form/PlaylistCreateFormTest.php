<?php

declare(strict_types=1);

namespace app\tests\unit\models\form;

use app\models\form\PlaylistCreateForm;
use app\models\Music;
use app\models\Playlist;
use app\tests\unit\fixtures\music\PlaylistCreateFormFixture;
use Codeception\Test\Unit;
use UnitTester;

class PlaylistCreateFormTest extends Unit
{
    protected UnitTester $tester;

    public function testSaveFails(): void
    {
        $form = new PlaylistCreateForm;
        $form->url = 'https://example.com/foo/bar';
        $this->assertFalse($form->save());
    }

    public function testUniqueValidation(): void
    {
        $fixtures['playlists'] = PlaylistCreateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $playlist = $this->tester->grabFixture('playlists', 'playlist1');

        $model = new PlaylistCreateForm;
        $model->url = $playlist['url'];
        $this->assertFalse($model->save());
        $this->assertTrue($model->hasErrors('url'));
    }

    public function testSave(): void
    {
        $model = new PlaylistCreateForm;
        $model->url = 'https://www.youtube.com/playlist?list=foo';
        $this->assertTrue($model->save());

        $track = Playlist::findOne(['title' => 'Foo Title']);

        $this->assertSame('https://www.youtube.com/playlist?list=foo', $track->url);
        $this->assertSame(Music::PROVIDER_YOUTUBE, $track->provider);
        $this->assertSame('foo', $track->provider_key);
        $this->assertSame('Foo Title', $track->title);
        $this->assertSame(Music::TYPE_PLAYLIST, $track->type);
        $this->assertSame('http://dev.plusarchive:8080/assets/apple-touch-icon.png', $track->image);
        $this->assertGreaterThanOrEqual(time(), $track->created_at);
        $this->assertGreaterThanOrEqual(time(), $track->updated_at);
    }
}
