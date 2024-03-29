<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmarks;

use AcceptanceTester;
use app\controllers\bookmarks\IndexController;
use app\tests\acceptance\fixtures\BookmarkFixture;
use Facebook\WebDriver\WebDriverKeys;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see IndexController
 */
class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['bookmarks'] = BookmarkFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatBookmarksWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/'));
        $I->click('Bookmark', '#navbar');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks'));
        $I->see('Bookmarks', 'h1');
        $I->see('bookmark1');
        $I->see('bookmark2');
        $I->see('bookmark3');
        $I->seeElement('.fa-soundcloud');
        $I->seeElement('.fa-twitter-square');
        $I->see('4 results');

        $I->click('Countries', '.col-lg-4');
        $I->click('Japan', '.col-lg-4');
        $I->waitForText('bookmark1');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks?country=Japan'));
        $I->dontSee('bookmark2');
        $I->dontSee('bookmark3');
        $I->see('2 results');

        $I->fillField('input[name=search]', '1');
        $I->pressKey('input[name=search]', WebDriverKeys::ENTER);
        $I->waitForText('1 results');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks?search=1'));
        $I->see('bookmark1');
        $I->dontSee('bookmark2');
        $I->dontSee('bookmark3');

        $I->click('Reset All');
        $I->waitForText('4 results');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks'));
    }
}
