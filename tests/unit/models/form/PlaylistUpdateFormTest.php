<?php

declare(strict_types=1);

namespace app\tests\unit\models\form;

use app\models\form\PlaylistUpdateForm;
use app\models\Playlist;
use app\tests\unit\fixtures\music\PlaylistUpdateFormFixture;
use Codeception\Test\Unit;
use UnitTester;

class PlaylistUpdateFormTest extends Unit
{
    protected UnitTester $tester;

    public function testSave(): void
    {
        $fixtures['playlists'] = PlaylistUpdateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $tracks = $this->tester->grabFixture('playlists');

        // invalid
        $form = new PlaylistUpdateForm(2);
        $form->url = 'https://example.com/foo/bar';
        $this->assertFalse($form->save());

        // invalid: unique validation
        $form = new PlaylistUpdateForm(2);
        $form->url = $tracks['playlist1']['url'];
        $this->assertFalse($form->save());
        $this->assertTrue($form->hasErrors('url'));

        // valid
        $form = new PlaylistUpdateForm(2);
        $form->title = 'Updated Title';
        $this->assertTrue($form->save());

        $track = Playlist::findOne(['title' => 'Updated Title']);

        $this->assertSame('https://www.youtube.com/playlist?list=playlist2', $track->url);
        $this->assertSame(Playlist::PROVIDER_YOUTUBE, $track->provider);
        $this->assertSame('playlist2', $track->provider_key);
        $this->assertSame('Updated Title', $track->title);
        $this->assertSame(Playlist::TYPE_PLAYLIST, $track->type);
        $this->assertSame('http://dev.plusarchive:8080/assets/favicon.png', $track->image);
        $this->assertGreaterThanOrEqual(time(), $track->created_at);
        $this->assertGreaterThanOrEqual(time(), $track->updated_at);
    }
}
