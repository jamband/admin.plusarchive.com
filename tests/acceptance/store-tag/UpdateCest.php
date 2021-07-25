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

namespace app\tests\acceptance\storeTag;

use AcceptanceTester;
use app\tests\acceptance\fixtures\StoreTagFixture;

class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tags'] = StoreTagFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatStoreTagUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/store-tag/update', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/store-tag/admin']));
        $I->click('//*[@id="grid-view-store-tag"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/store-tags/update/1');
        $I->see('StoreTag', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->seeInField('#storetag-name', 'tag1');

        $I->fillField('#storetag-name', '');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->seeElement('.is-invalid');

        $I->fillField('#storetag-name', 'tag-one');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/store-tags/admin');
        $I->see('Store tag has been updated.');
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag-one', '.grid-view');
        $I->dontSee('tag1', '.grid-view');

        $I->click('//*[@id="grid-view-store-tag"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/store-tags/update/1');

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/store-tags/admin');
        $I->see('Admin: 2', '#menu-action');
        $I->dontSee('tag-one', '.grid-view');
    }
}
