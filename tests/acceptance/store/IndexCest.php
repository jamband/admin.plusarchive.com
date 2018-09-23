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

namespace app\tests\acceptance\store;

use AcceptanceTester;
use app\tests\acceptance\fixtures\StoreFixture;
use WebDriverKeys;

class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'stores' => StoreFixture::class,
        ]);
    }

    public function ensureThatStoresWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->click('Store', '.navbar');
        $I->seeCurrentUrlEquals('/index-test.php/stores');
        $I->see('Stores', 'h2');
        $I->see('store1', '.card-container');
        $I->see('store2', '.card-container');
        $I->see('store3', '.card-container');
        $I->seeElement('.fa-soundcloud');
        $I->seeElement('.fa-youtube-square');
        $I->seeElement('.fa-twitter-square');
        $I->see('3 results', '.total-count');

        $I->click('Countries', '.col-sm-4');
        $I->wait(1);
        $I->click('Japan', '.col-sm-4');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/stores?country=Japan');
        $I->see('store1', '.card-container');
        $I->dontSee('store2', '.card-container');
        $I->dontSee('store3', '.card-container');
        $I->see('1 results', '.total-count');

        $I->fillField('input[name=search]', '1');
        $I->pressKey('input[name=search]', WebDriverKeys::ENTER);
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/stores?search=1');
        $I->see('1 results', '.total-count');
        $I->see('store1', '.card-container');
        $I->dontSee('store2', '.card-container');
        $I->dontSee('store3', '.card-container');

        $I->click('Reset All', '.col-sm-4');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/stores');
        $I->see('3 results', '.total-count');
    }
}
