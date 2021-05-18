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

namespace app\tests\acceptance\playlist;

use AcceptanceTester;
use app\tests\acceptance\fixtures\PlaylistFixture;

class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['playlist'] = PlaylistFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatPlaylistsWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->click('Playlist', '.navbar');
        $I->seeCurrentUrlEquals('/index-test.php/playlists');
        $I->see('Playlists', 'h1');
        $I->see('playlist1', '.playlist-title');
        $I->see('playlist2', '.playlist-title');
        $I->see('playlist3', '.playlist-title');

        $I->click('playlist1', '.playlist-title');
        $I->seeCurrentUrlEquals('/index-test.php/playlist/'.hashids()->encode(1));

        // close privacy consent popup
        $I->click('.toast-close-button');
        $I->wait(1);

        $I->click('Back to playlists');
        $I->seeCurrentUrlEquals('/index-test.php/playlists');
    }
}
