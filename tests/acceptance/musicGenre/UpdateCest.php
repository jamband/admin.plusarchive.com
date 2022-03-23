<?php

declare(strict_types=1);

namespace app\tests\acceptance\musicGenre;

use AcceptanceTester;
use app\tests\acceptance\fixtures\MusicGenreFixture;

/**
 * @noinspection PhpUnused
 */
class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['genres'] = MusicGenreFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatMusicGenreUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/music-genre/update', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/music-genre/admin']));
        $I->click('//*[@id="grid-view-music-genre"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/music-genres/update/1');
        $I->see('MusicGenre', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->seeInField('#musicgenre-name', 'genre1');

        $I->fillField('#musicgenre-name', '');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#musicgenre-name', 'genre-one');
        $I->click('button[type=submit]');
        $I->waitForText('Music genre has been updated.');
        $I->seeCurrentUrlEquals('/index-test.php/music-genres/admin');
        $I->see('Admin: 5', '#menu-action');
        $I->see('genre-one', '.grid-view');
        $I->dontSee('genre1', '.grid-view');

        $I->click('//*[@id="grid-view-music-genre"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/music-genres/update/1');

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 4', selector: '#menu-action');
        $I->seeCurrentUrlEquals('/index-test.php/music-genres/admin');
        $I->dontSee('genre-one', '.grid-view');
    }
}
