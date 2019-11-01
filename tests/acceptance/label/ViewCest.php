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

namespace app\tests\acceptance\label;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelFixture;

class ViewCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'labels' => LabelFixture::class,
        ]);
    }

    public function ensureThatLabelViewWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label/view', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/label/admin']));
        $I->click('//*[@id="grid-view-label"]/table/tbody/tr[1]/td[7]/a[1]/i');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/label/1');
        $I->see('Label', '#menu-controller');
        $I->see('View', '#menu-action');
        $I->see('label1', '.detail-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/label/admin');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/label/create');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Update', '#menu-action + .dropdown-menu');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/label/update/1');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->wait(1);
        $I->seeInPopup('Are you sure you want to delete this item?');
        $I->cancelPopup();

        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->seeCurrentUrlEquals('/index-test.php/label/admin');
        $I->see('Admin: 2', '#menu-action');
    }
}