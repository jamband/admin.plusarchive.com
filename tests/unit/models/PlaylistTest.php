<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\Playlist;
use app\tests\unit\fixtures\music\PlaylistAllFixture;
use app\tests\unit\fixtures\music\PlaylistFindFixture;
use Codeception\Test\Unit;

class PlaylistTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testFind(): void
    {
        $this->tester->haveFixtures([
            PlaylistFindFixture::class,
        ]);

        $playlists = Playlist::find()->all();
        $this->assertSame(2, count($playlists));
        $this->assertSame(Playlist::TYPE_PLAYLIST, $playlists[0]->type);
        $this->assertSame(Playlist::TYPE_PLAYLIST, $playlists[1]->type);
    }

    public function testAll(): void
    {
        $this->tester->haveFixtures([
            PlaylistAllFixture::class,
        ]);

        $playlists = Playlist::all()->models;
        $this->assertSame(3, count($playlists));
        $this->assertSame('playlist2', $playlists[0]->title);
        $this->assertSame('playlist3', $playlists[1]->title);
        $this->assertSame('playlist1', $playlists[2]->title);
    }
}
