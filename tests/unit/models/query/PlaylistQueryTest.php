<?php

declare(strict_types=1);

namespace app\tests\unit\models\query;

use app\models\Music;
use app\models\Playlist;
use app\models\query\PlaylistQuery;
use app\tests\unit\fixtures\music\PlaylistQueryInitFixture;
use app\tests\unit\fixtures\music\PlaylistQueryLatestFixture;
use Codeception\Test\Unit;
use UnitTester;

/** @see PlaylistQuery */
class PlaylistQueryTest extends Unit
{
    protected UnitTester $tester;

    public function testInit(): void
    {
        $fixtures['playlists'] = PlaylistQueryInitFixture::class;
        $this->tester->haveFixtures($fixtures);

        $playlists = Playlist::find()->all();
        $this->assertSame(2, count($playlists));
        $this->assertSame(Music::TYPE_PLAYLIST, $playlists[0]->type);
        $this->assertSame(Music::TYPE_PLAYLIST, $playlists[1]->type);
    }

    public function testLatest(): void
    {
        $fixtures['playlists'] = PlaylistQueryLatestFixture::class;
        $this->tester->haveFixtures($fixtures);

        $playlists = Playlist::find()->latest()->all();
        $this->assertSame(3, count($playlists));
        $this->assertSame('playlist1', $playlists[0]->title);
        $this->assertSame('playlist3', $playlists[1]->title);
        $this->assertSame('playlist2', $playlists[2]->title);
    }
}
