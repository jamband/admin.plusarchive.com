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

class ViewCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['bookmarks'] = BookmarkFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatBookmarkViewWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/bookmark/view', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/bookmark/admin']));
        $I->click('//*[@id="grid-view-bookmark"]/table/tbody/tr[1]/td[7]/a[1]/i'); // View link
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/1');
        $I->see('Bookmark', '#menu-controller');
        $I->see('View', '#menu-action');
        $I->see('bookmark1', '.detail-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/create');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Update', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/update/1');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
        $I->see('Admin: 3', '#menu-action');
    }
}
