<?php

declare(strict_types=1);

namespace app\tests\acceptance\labels;

use AcceptanceTester;
use app\controllers\labels\ViewController;
use app\tests\acceptance\fixtures\LabelFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see ViewController
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
    public function ensureThatLabelsViewWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/labels/view/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/labels/admin'));
        $I->click('//*[@id="grid-view-labels"]/table/tbody/tr[1]/td[7]/a[1]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/view/1'));
        $I->see('Label', '#menu-controller');
        $I->see('View', '#menu-action');
        $I->see('label1', '.detail-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/admin'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/create'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Update', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/update/1'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 2', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/admin'));
    }
}
