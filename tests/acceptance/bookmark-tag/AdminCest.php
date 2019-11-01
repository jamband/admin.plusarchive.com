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

namespace app\tests\acceptance\bookmarkTag;

use AcceptanceTester;
use app\tests\acceptance\fixtures\BookmarkTagFixture;
use WebDriverKeys;

class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'bookmarks' => BookmarkTagFixture::class,
        ]);
    }

    public function ensureThatBookmarkTagAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/bookmark-tag/admin']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/bookmark-tag/admin']));
        $I->see('BookmarkTag', '#menu-controller');
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag1', '.grid-view');
        $I->see('tag2', '.grid-view');
        $I->see('tag3', '.grid-view');

        $I->fillField('input[name="BookmarkTagSearch[name]"]', 3);
        $I->pressKey(['name' => 'BookmarkTagSearch[name]'], WebDriverKeys::ENTER);
        $I->wait(1);
        $I->see('Admin: 1', '#menu-action');
        $I->see('tag3', '.grid-view');
        $I->dontSee('tag1', '.grid-view');
        $I->dontSee('tag2', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->wait(1);
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag1', '.grid-view');
        $I->see('tag2', '.grid-view');
        $I->see('tag3', '.grid-view');
    }
}