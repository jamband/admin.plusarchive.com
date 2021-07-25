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

namespace app\tests\acceptance\label;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelFixture;

class ViewCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['labels'] = LabelFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatLabelViewWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label/view', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/label/admin']));
        $I->click('//*[@id="grid-view-label"]/table/tbody/tr[1]/td[7]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/labels/1');
        $I->see('Label', '#menu-controller');
        $I->see('View', '#menu-action');
        $I->see('label1', '.detail-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/labels/admin');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/labels/create');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Update', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/labels/update/1');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->wait(0.5);
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/labels/admin');
        $I->see('Admin: 2', '#menu-action');
    }
}
