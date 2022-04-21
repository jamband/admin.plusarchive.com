<?php

declare(strict_types=1);

namespace app\tests\acceptance\stores;

use AcceptanceTester;
use app\controllers\stores\UpdateController;
use app\tests\acceptance\fixtures\StoreFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see UpdateController
 */
class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['stores'] = StoreFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatStoresUpdateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/stores/update/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/stores/admin'));
        $I->click('//*[@id="grid-view-stores"]/table/tbody/tr[1]/td[7]/a[2]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/update/1'));
        $I->see('Store', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/admin'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/create'));
        $I->moveBack();

        $I->seeInField('#store-name', 'store1');
        $I->seeInField('#store-country', 'Japan');
        $I->seeInField('#store-url', 'https://store1.example.com/');
        $I->seeInField('#store-link', "https://twitter.com/store1\nhttps://soundcloud.com/store1");

        $I->fillField('#store-name', '');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#store-name', 'store-one');
        $I->click('button[type=submit]');
        $I->waitForText('Store has been updated.');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/view/1'));

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 3', '#menu-action');
        $I->see('store-one', '.grid-view');
        $I->dontSee('store1', '.grid-view');

        $I->click('//*[@id="grid-view-stores"]/table/tbody/tr[1]/td[7]/a[2]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/update/1'));

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 2', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/admin'));
        $I->dontSee('store-one', '.grid-view');
    }
}
