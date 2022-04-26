<?php

declare(strict_types=1);

namespace app\tests\acceptance\musicGenres;

use AcceptanceTester;
use app\controllers\musicGenres\UpdateController;
use app\tests\acceptance\fixtures\AdminUserFixture;
use app\tests\acceptance\fixtures\MusicGenreFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see UpdateController
 */
class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['users'] = AdminUserFixture::class;
        $fixtures['genres'] = MusicGenreFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatMusicGenresUpdateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/musicGenres/update/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/musicGenres/admin'));
        $I->click('//*[@id="grid-view-music-genres"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/musicGenres/update/1'));
        $I->see('MusicGenre', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->seeInField('#musicgenre-name', 'genre1');

        $I->fillField('#musicgenre-name', '');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#musicgenre-name', 'genre-one');
        $I->click('button[type=submit]');
        $I->waitForText('Music genre has been updated.');
        $I->seeCurrentUrlEquals(Url::toRoute('/musicGenres/admin'));
        $I->see('Admin: 5', '#menu-action');
        $I->see('genre-one', '.grid-view');
        $I->dontSee('genre1', '.grid-view');

        $I->click('//*[@id="grid-view-music-genres"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/musicGenres/update/1'));

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 4', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/musicGenres/admin'));
        $I->dontSee('genre-one', '.grid-view');
    }
}
