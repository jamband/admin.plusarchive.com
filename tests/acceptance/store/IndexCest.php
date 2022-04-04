<?php

declare(strict_types=1);

namespace app\tests\acceptance\store;

use AcceptanceTester;
use app\tests\acceptance\fixtures\StoreFixture;
use Facebook\WebDriver\WebDriverKeys;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 */
class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['stores'] = StoreFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatStoresWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::to(['/']));
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
        $I->waitForText('store1');
        $I->seeCurrentUrlEquals('/index-test.php/stores?country=Japan');
        $I->dontSee('store2');
        $I->dontSee('store3');
        $I->see('1 results');

        $I->fillField('input[name=search]', '1');
        $I->pressKey('input[name=search]', WebDriverKeys::ENTER);
        $I->waitForText('1 results');
        $I->seeCurrentUrlEquals('/index-test.php/stores?search=1');
        $I->see('store1');
        $I->dontSee('store2');
        $I->dontSee('store3');

        $I->click('Reset All');
        $I->waitForText('3 results');
        $I->seeCurrentUrlEquals('/index-test.php/stores');
    }
}
