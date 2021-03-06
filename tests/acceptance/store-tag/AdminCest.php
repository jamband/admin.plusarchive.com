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

namespace app\tests\acceptance\storeTag;

use AcceptanceTester;
use app\tests\acceptance\fixtures\StoreTagFixture;
use Facebook\WebDriver\WebDriverKeys;

class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tags'] = StoreTagFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatStoreTagAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/store-tag/admin']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/store-tag/admin']));
        $I->see('StoreTag', '#menu-controller');
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag1', '.grid-view');
        $I->see('tag2', '.grid-view');
        $I->see('tag3', '.grid-view');

        $I->fillField('input[name="StoreTagSearch[name]"]', 3);
        $I->pressKey(['name' => 'StoreTagSearch[name]'], WebDriverKeys::ENTER);
        $I->wait(0.5);
        $I->see('Admin: 1', '#menu-action');
        $I->see('tag3', '.grid-view');
        $I->dontSee('tag1', '.grid-view');
        $I->dontSee('tag2', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag1', '.grid-view');
        $I->see('tag2', '.grid-view');
        $I->see('tag3', '.grid-view');
    }
}
