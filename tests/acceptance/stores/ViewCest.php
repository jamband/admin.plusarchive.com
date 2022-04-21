<?php

declare(strict_types=1);

namespace app\tests\acceptance\stores;

use AcceptanceTester;
use app\controllers\stores\ViewController;
use app\tests\acceptance\fixtures\StoreFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see ViewController
 */
class ViewCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['stores'] = StoreFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatStoresViewWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/stores/view/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/stores/admin'));
        $I->click('//*[@id="grid-view-stores"]/table/tbody/tr[1]/td[7]/a[1]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/view/1'));
        $I->see('Store', '#menu-controller');
        $I->see('View', '#menu-action');
        $I->see('store1', '.detail-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/admin'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/create'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Update', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/update/1'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 2', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/admin'));
    }
}
