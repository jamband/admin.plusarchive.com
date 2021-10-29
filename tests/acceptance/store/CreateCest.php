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

/**
 * @noinspection PhpUnused
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
    public function ensureThatStoreCreateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/store/create']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/store/admin']));
        $I->see('Admin: 3', '#menu-action');

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/stores/create');

        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->seeElement('.is-invalid');

        $I->fillField('#store-name', 'newstore');
        $I->fillField('#store-url', 'https://newstore.example.com');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->see('Store has been added.');
        $I->seeCurrentUrlEquals('/index-test.php/stores/4');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 4', '#menu-action');
    }
}
