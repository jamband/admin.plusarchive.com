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

namespace app\tests\acceptance\bookmark;

use AcceptanceTester;
use app\tests\acceptance\fixtures\BookmarkFixture;

class CreateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['bookmarks'] = BookmarkFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatBookmarkCreateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/bookmark/create']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/bookmark/admin']));
        $I->see('Admin: 4', '#menu-action');

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/create');

        $I->fillField('#bookmark-name', 'newbookmark');
        $I->fillField('#bookmark-url', 'http://newbookmark.example.com');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->see('Bookmark has been added.');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/5');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 5', '#menu-action');

        $I->click('Bookmark', '.navbar');
        $I->see('5 results', '.total-count');
    }
}
