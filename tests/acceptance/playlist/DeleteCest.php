<?php

declare(strict_types=1);

namespace app\tests\acceptance\playlist;

use AcceptanceTester;
use app\tests\acceptance\fixtures\PlaylistFixture;

/**
 * @noinspection PhpUnused
 */
class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['playlists'] = PlaylistFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPlaylistDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/playlist/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/playlist/delete', 'id' => 1]);
    }
}
