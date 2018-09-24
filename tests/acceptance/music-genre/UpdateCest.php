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

namespace app\tests\acceptance\musicGenre;

use AcceptanceTester;
use app\tests\acceptance\fixtures\MusicGenreFixture;

class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'music-genres' => MusicGenreFixture::class,
        ]);
    }

    public function ensureThatMusicGenreUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/music-genre/update', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/music-genre/admin']));
        $I->click('//*[@id="grid-view-music-genre"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/music-genre/update/1');
        $I->see('MusicGenre', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->seeInField('#musicgenre-name', 'genre1');

        $I->fillField('#musicgenre-name', '');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeElement('.is-invalid');

        $I->fillField('#musicgenre-name', 'genre-one');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/music-genre/admin');
        $I->see('Music genre has been updated.');
        $I->see('Admin: 5', '#menu-action');
        $I->see('genre-one', '.grid-view');
        $I->dontSee('genre1', '.grid-view');

        $I->click('//*[@id="grid-view-music-genre"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/music-genre/update/1');

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure you want to delete this item?');
        $I->cancelPopup();

        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->seeCurrentUrlEquals('/index-test.php/music-genre/admin');
        $I->see('Admin: 4', '#menu-action');
        $I->dontSee('genre-one', '.grid-view');
    }
}
