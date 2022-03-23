<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmark;

use AcceptanceTester;
use app\tests\acceptance\fixtures\BookmarkFixture;
use Facebook\WebDriver\WebDriverKeys;

/**
 * @noinspection PhpUnused
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
    public function ensureThatBookmarkAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/bookmark/admin']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/bookmark/admin']));
        $I->see('Bookmark', '#menu-controller');
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
