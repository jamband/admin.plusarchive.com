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
use Facebook\WebDriver\WebDriverKeys;

class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['stores'] = StoreFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatStoresWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->click('Store', '#navbar');
        $I->seeCurrentUrlEquals('/index-test.php/stores');
        $I->see('Stores', 'h1');
        $I->see('store1');
        $I->see('store2');
        $I->see('store3');
        $I->seeElement('.fa-soundcloud');
        $I->seeElement('.fa-youtube-square');
        $I->seeElement('.fa-twitter-square');
        $I->see('3 results');

        $I->click('Countries', '.col-lg-4');
        $I->click('Japan', '.col-lg-4');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/stores?country=Japan');
        $I->see('store1');
        $I->dontSee('store2');
        $I->dontSee('store3');
        $I->see('1 results');

        $I->fillField('input[name=search]', '1');
        $I->pressKey('input[name=search]', WebDriverKeys::ENTER);
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/stores?search=1');
        $I->see('1 results');
        $I->see('store1');
        $I->dontSee('store2');
        $I->dontSee('store3');

        $I->click('Reset All');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/stores');
        $I->see('3 results');
    }
}
