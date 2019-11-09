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

namespace app\tests\acceptance\bookmark;

use AcceptanceTester;
use app\tests\acceptance\fixtures\BookmarkFixture;

class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'bookmarks' => BookmarkFixture::class,
        ]);
    }

    public function ensureThatBookmarkUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/bookmark/update', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/bookmark/admin']));
        $I->click('//*[@id="grid-view-bookmark"]/table/tbody/tr[1]/td[7]/a[2]/i'); // Update link
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/update/1');
        $I->see('Bookmark', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/create');
        $I->moveBack();

        $I->seeInField('#bookmark-name', 'bookmark1');
        $I->seeInField('#bookmark-country', 'Japan');
        $I->seeInField('#bookmark-url', 'https://bookmark1.example.com/');
        $I->seeInField('#bookmark-link', "https://twitter.com/bookmark1\nhttps://soundcloud.com/bookmark1");

        $I->fillField('#bookmark-name', '');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeElement('.is-invalid');

        $I->fillField('#bookmark-name', 'bookmark-one');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/1');
        $I->see('Bookmark has been updated.');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 4', '#menu-action');
        $I->see('bookmark-one', '.grid-view');
        $I->dontSee('bookmark1', '.grid-view');

        $I->click('//*[@id="grid-view-bookmark"]/table/tbody/tr[1]/td[7]/a[2]/i'); // Update link
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/update/1');

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
        $I->see('Admin: 3', '#menu-action');
        $I->dontSee('bookmark-one', '.grid-view');
    }
}
