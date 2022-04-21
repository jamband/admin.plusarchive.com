<?php

declare(strict_types=1);

namespace app\tests\acceptance\stores;

use AcceptanceTester;
use app\controllers\stores\CreateController;
use app\tests\acceptance\fixtures\StoreFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see CreateController
 */
class CreateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['stores'] = StoreFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatStoresCreateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/stores/create'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/stores/admin'));
        $I->see('Admin: 3', '#menu-action');

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/create'));

        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#store-name', 'new_store');
        $I->fillField('#store-url', 'https://newstore.example.com');
        $I->click('button[type=submit]');
        $I->waitForText('Store has been added.');
        $I->seeCurrentUrlEquals(Url::toRoute('/stores/view/4'));

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 4', '#menu-action');
    }
}
