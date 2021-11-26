<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmark;

use AcceptanceTester;
use app\tests\acceptance\fixtures\BookmarkFixture;

/**
 * @noinspection PhpUnused
 */
class CreateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['bookmarks'] = BookmarkFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatBookmarkCreateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/bookmark/create']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/bookmark/admin']));
        $I->see('Admin: 4', '#menu-action');

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks/create');

        $I->fillField('#bookmark-name', 'newbookmark');
        $I->fillField('#bookmark-url', 'https://newbookmark.example.com');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->see('Bookmark has been added.');
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks/5');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 5', '#menu-action');
    }
}
