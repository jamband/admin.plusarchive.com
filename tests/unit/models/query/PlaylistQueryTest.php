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

namespace app\tests\unit\models\query;

use app\models\Playlist;
use app\tests\unit\fixtures\music\PlaylistFindFixture;
use Codeception\Test\Unit;

class PlaylistQueryTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testInit(): void
    {
        $this->tester->haveFixtures([
            PlaylistFindFixture::class,
        ]);

        $playlists = Playlist::find()->all();
        $this->assertSame(2, count($playlists));
        $this->assertSame(Playlist::TYPE_PLAYLIST, $playlists[0]->type);
        $this->assertSame(Playlist::TYPE_PLAYLIST, $playlists[1]->type);
    }
}
