<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\unit\models\form;

use app\models\Playlist;
use app\models\form\PlaylistCreateForm;
use app\tests\unit\fixtures\music\PlaylistCreateFormFixture;
use Codeception\Test\Unit;
use UnitTester;

class PlaylistCreateFormTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    public function testSave(): void
    {
        $fixtures['playlists'] = PlaylistCreateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $tracks = $this->tester->grabFixture('playlists');

        // invalid
        $form = new PlaylistCreateForm;
        $form->url = 'https://example.com/foo/bar';
        $this->assertFalse($form->save());

        // invalid: unique validation
        $form = new PlaylistCreateForm;
        $form->url = $tracks['playlist1']['url'];
        $this->assertFalse($form->save());
        $this->assertTrue($form->hasErrors('url'));

        // valid
        $form = new PlaylistCreateForm;
        $form->url = 'https://www.youtube.com/playlist?list=foo';
        $this->assertTrue($form->save());

        $track = Playlist::findOne(['title' => 'Foo Title']);

        $this->assertSame('https://www.youtube.com/playlist?list=foo', $track->url);
        $this->assertSame(Playlist::PROVIDER_YOUTUBE, $track->provider);
        $this->assertSame('foo', $track->provider_key);
        $this->assertSame('Foo Title', $track->title);
        $this->assertSame(Playlist::TYPE_PLAYLIST, $track->type);
        $this->assertSame('http://dev.plusarchive:8080/assets/apple-touch-icon.png', $track->image);
        $this->assertGreaterThanOrEqual(time(), $track->created_at);
        $this->assertGreaterThanOrEqual(time(), $track->updated_at);
    }
}
