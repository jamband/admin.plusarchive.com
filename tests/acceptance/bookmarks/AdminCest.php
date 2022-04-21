<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmarks;

use AcceptanceTester;
use app\controllers\bookmarks\AdminController;
use app\tests\acceptance\fixtures\BookmarkFixture;
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
        $fixtures['bookmarks'] = BookmarkFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatBookmarksAdminWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/bookmarks/admin'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/bookmarks/admin'));
        $I->see('Bookmarks', '#menu-controller');
        $I->see('Admin: 4', '#menu-action');
        $I->see('bookmark1', '.grid-view');
        $I->see('bookmark2', '.grid-view');
        $I->see('bookmark3', '.grid-view');
        $I->see('bookmark4', '.grid-view');

        $I->fillField('input[name="BookmarkSearch[name]"]', 4);
        $I->pressKey(['name' => 'BookmarkSearch[name]'], WebDriverKeys::ENTER);
        $I->waitForText('Admin: 1', selector: '#menu-action');
        $I->see('bookmark4', '.grid-view');
        $I->dontSee('bookmark1', '.grid-view');
        $I->dontSee('bookmark2', '.grid-view');
        $I->dontSee('bookmark3', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 4', '#menu-action');
        $I->see('bookmark1', '.grid-view');
        $I->see('bookmark2', '.grid-view');
        $I->see('bookmark3', '.grid-view');
        $I->see('bookmark4', '.grid-view');

        $I->selectOption('select[name="BookmarkSearch[country]"]', 'Japan');
        $I->waitForText('Admin: 2', selector: '#menu-action');
        $I->see('Japan', '.grid-view');
        $I->dontSee('bookmark2', '.grid-view');
        $I->dontSee('bookmark3', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->fillField('input[name="BookmarkSearch[link]"]', 'you');
        $I->pressKey(['name' => 'BookmarkSearch[link]'], WebDriverKeys::ENTER);
        $I->waitForText('Admin: 1', selector: '#menu-action');
        $I->see('bookmark4', '.grid-view');
        $I->seeElement('.fa-youtube-square');
        $I->dontSee('bookmark1', '.grid-view');
        $I->dontSee('bookmark2', '.grid-view');
        $I->dontSee('bookmark3', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 4', '#menu-action');
        $I->see('bookmark1', '.grid-view');
        $I->see('bookmark2', '.grid-view');
        $I->see('bookmark3', '.grid-view');
        $I->see('bookmark4', '.grid-view');
    }
}
