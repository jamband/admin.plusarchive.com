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

namespace app\tests\acceptance\store;

use AcceptanceTester;
use app\tests\acceptance\fixtures\StoreFixture;

class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'stores' => StoreFixture::class,
        ]);
    }

    public function ensureThatStoreUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/store/update', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/store/admin']));
        $I->click('//*[@id="grid-view-store"]/table/tbody/tr[1]/td[7]/a[2]/i');
        $I->seeCurrentUrlEquals('/index-test.php/store/update/1');
        $I->see('Store', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/store/admin');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/store/create');
        $I->moveBack();

        $I->seeInField('#store-name', 'store1');
        $I->seeInField('#store-country', 'Japan');
        $I->seeInField('#store-url', 'https://store1.example.com/');
        $I->seeInField('#store-link', "https://twitter.com/store1\nhttps://soundcloud.com/store1");

        $I->fillField('#store-name', '');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeElement('.is-invalid');

        $I->fillField('#store-name', 'store-one');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/store/1');
        $I->see('Store has been updated.');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 3', '#menu-action');
        $I->see('store-one', '.grid-view');
        $I->dontSee('store1', '.grid-view');

        $I->click('//*[@id="grid-view-store"]/table/tbody/tr[1]/td[7]/a[2]/i');
        $I->seeCurrentUrlEquals('/index-test.php/store/update/1');

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure you want to delete this item?');
        $I->cancelPopup();

        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->seeCurrentUrlEquals('/index-test.php/store/admin');
        $I->see('Admin: 2', '#menu-action');
        $I->dontSee('store-one', '.grid-view');
    }
}