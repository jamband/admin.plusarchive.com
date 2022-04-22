<?php

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\Music;
use app\models\Playlist;
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
}
