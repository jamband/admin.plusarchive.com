<?php

declare(strict_types=1);

namespace app\tests\acceptance\musicGenres;

use AcceptanceTester;
use app\controllers\musicGenres\AdminController;
use app\tests\acceptance\fixtures\AdminUserFixture;
use app\tests\acceptance\fixtures\MusicGenreFixture;
use Facebook\WebDriver\WebDriverKeys;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see AdminController
 */
class AdminCest
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
    public function ensureThatMusicGenresAdminWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/musicGenres/admin'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/musicGenres/admin'));
        $I->see('MusicGenre', '#menu-controller');
        $I->see('Admin: 5', '#menu-action');
        $I->see('genre1', '.grid-view');
        $I->see('genre2', '.grid-view');
        $I->see('genre3', '.grid-view');

        $I->fillField('input[name="MusicGenreSearch[name]"]', 3);
        $I->pressKey(['name' => 'MusicGenreSearch[name]'], WebDriverKeys::ENTER);
        $I->waitForText('Admin: 1', selector: '#menu-action');
        $I->see('genre3', '.grid-view');
        $I->dontSee('genre1', '.grid-view');
        $I->dontSee('genre2', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 5', '#menu-action');
        $I->see('genre1', '.grid-view');
        $I->see('genre2', '.grid-view');
        $I->see('genre3', '.grid-view');
    }
}
