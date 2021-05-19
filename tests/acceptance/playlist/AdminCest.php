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
use Facebook\WebDriver\WebDriverKeys;

class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['playlists'] = PlaylistFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatPlaylistAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/playlist/admin']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/playlist/admin']));
        $I->see('Playlist', '#menu-controller');
        $I->see('Admin: 3', '#menu-action');
        $I->see('playlist1', '.grid-view');
        $I->see('playlist2', '.grid-view');
        $I->see('playlist3', '.grid-view');

        $I->fillField('input[name="PlaylistSearch[title]"]', 3);
        $I->pressKey(['name' => 'PlaylistSearch[title]'], WebDriverKeys::ENTER);
        $I->wait(0.5);
        $I->see('Admin: 1', '#menu-action');
        $I->see('playlist3', '.grid-view');
        $I->dontSee('playlist1', '.grid-view');
        $I->dontSee('playlist2', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 3', '#menu-action');
        $I->see('playlist1', '.grid-view');
        $I->see('playlist2', '.grid-view');
        $I->see('playlist3', '.grid-view');
    }
}
