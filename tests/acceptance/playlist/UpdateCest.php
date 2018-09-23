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

class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'playlists' => PlaylistFixture::class,
        ]);
    }

    public function ensureThatPlaylistUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/playlist/update', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/playlist/admin']));
        $I->click('//*[@id="grid-view-playlist"]/table/tbody/tr[1]/td[6]/a[1]/i'); // Update link
        $I->seeCurrentUrlEquals('/index-test.php/playlist/update/1');

        $I->see('Playlist', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/playlist/admin');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/playlist/create');
        $I->moveBack();

        $I->seeInField('#playlist-title', 'playlist1');

        // $I->fillField('#playlist-title', '');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeElement('.is-invalid');

        // $I->fillField('#playlist-title', 'playlist-one');
        // $I->click('button[type=submit]');
        // $I->wait(1);
        // $I->seeCurrentUrlEquals('/index-test.php/playlist/admin');
        // $I->see('Playlist has been updated.');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->click('//*[@id="grid-view-playlist"]/table/tbody/tr[1]/td[6]/a[1]/i'); // Update link
        $I->seeCurrentUrlEquals('/index-test.php/playlist/update/1');

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure you want to delete this item?');
        $I->cancelPopup();

        // $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->seeCurrentUrlEquals('/index-test.php/playlist/admin');
        $I->see('Admin: 2', '#menu-action');
        $I->dontSee('playlist-one', '.grid-view');
    }
}
