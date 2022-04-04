<?php

declare(strict_types=1);

namespace app\tests\acceptance\label;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 */
class ViewCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['labels'] = LabelFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLabelViewWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label/view', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(Url::to(['/label/admin']));
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
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 2', selector: '#menu-action');
        $I->seeCurrentUrlEquals('/index-test.php/labels/admin');
    }
}
