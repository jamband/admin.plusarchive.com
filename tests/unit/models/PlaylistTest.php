<?php

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\Music;
use app\models\Playlist;
use app\tests\unit\fixtures\music\PlaylistAllFixture;
use app\tests\unit\fixtures\music\PlaylistFindFixture;
use Codeception\Test\Unit;
use UnitTester;

class PlaylistTest extends Unit
{
    protected UnitTester $tester;

    public function testFind(): void
    {
        $fixtures['playlists'] = PlaylistFindFixture::class;
        $this->tester->haveFixtures($fixtures);

        $playlists = Playlist::find()->all();
        $this->assertSame(2, count($playlists));
        $this->assertSame(Music::TYPE_PLAYLIST, $playlists[0]->type);
        $this->assertSame(Music::TYPE_PLAYLIST, $playlists[1]->type);
    }

    public function testAll(): void
    {
        $fixtures['playlists'] = PlaylistAllFixture::class;
        $this->tester->haveFixtures($fixtures);

        $playlists = Playlist::all()->models;
        $this->assertSame(3, count($playlists));
        $this->assertSame('playlist2', $playlists[0]->title);
        $this->assertSame('playlist3', $playlists[1]->title);
        $this->assertSame('playlist1', $playlists[2]->title);
    }
}
