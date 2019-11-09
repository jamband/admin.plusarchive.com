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

class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'bookmarks' => BookmarkTagFixture::class,
        ]);
    }

    public function ensureThatBookmarkTagUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/bookmark-tag/update', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/bookmark-tag/admin']));
        $I->click('//*[@id="grid-view-bookmark-tag"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark-tag/update/1');
        $I->see('BookmarkTag', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->seeInField('#bookmarktag-name', 'tag1');

        $I->fillField('#bookmarktag-name', '');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeElement('.is-invalid');

        $I->fillField('#bookmarktag-name', 'tag-one');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/bookmark-tag/admin');
        $I->see('Bookmark tag has been updated.');
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag-one', '.grid-view');
        $I->dontSee('tag1', '.grid-view');

        $I->click('//*[@id="grid-view-bookmark-tag"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark-tag/update/1');

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->wait(1);
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->seeCurrentUrlEquals('/index-test.php/bookmark-tag/admin');
        $I->see('Admin: 2', '#menu-action');
        $I->dontSee('tag-one', '.grid-view');
    }
}
