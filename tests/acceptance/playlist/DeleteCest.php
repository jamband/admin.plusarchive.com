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

namespace app\tests\acceptance\playlist;

use AcceptanceTester;
use app\tests\acceptance\fixtures\PlaylistFixture;

class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'playlists' => PlaylistFixture::class,
        ]);
    }

    public function ensureThatPlaylistDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/playlist/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/playlist/delete', 'id' => 1]);
    }
}
