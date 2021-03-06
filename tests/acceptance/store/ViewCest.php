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

namespace app\tests\acceptance\store;

use AcceptanceTester;
use app\tests\acceptance\fixtures\StoreFixture;

class ViewCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['stores'] = StoreFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatStoreViewWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/store/view', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/store/admin']));
        $I->click('//*[@id="grid-view-store"]/table/tbody/tr[1]/td[7]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/store/1');
        $I->see('Store', '#menu-controller');
        $I->see('View', '#menu-action');
        $I->see('store1', '.detail-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/store/admin');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/store/create');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Update', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/store/update/1');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/store/admin');
        $I->see('Admin: 2', '#menu-action');
    }
}
