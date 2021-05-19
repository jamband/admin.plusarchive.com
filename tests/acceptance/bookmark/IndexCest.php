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

namespace app\tests\acceptance\bookmark;

use AcceptanceTester;
use app\tests\acceptance\fixtures\BookmarkFixture;
use Facebook\WebDriver\WebDriverKeys;

class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['bookmarks'] = BookmarkFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatBookmarksWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->click('Bookmark', '#navbar');
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks');
        $I->see('Bookmarks', 'h1');
        $I->see('bookmark1', '.card-container');
        $I->see('bookmark2', '.card-container');
        $I->see('bookmark3', '.card-container');
        $I->seeElement('.fa-soundcloud');
        $I->seeElement('.fa-twitter-square');
        $I->see('4 results');

        $I->click('Countries', '.col-sm-4');
        $I->click('Japan', '.col-sm-4');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks?country=Japan');
        $I->see('bookmark1', '.card-container');
        $I->dontSee('bookmark2', '.card-container');
        $I->dontSee('bookmark3', '.card-container');
        $I->see('2 results');

        $I->fillField('input[name=search]', '1');
        $I->pressKey('input[name=search]', WebDriverKeys::ENTER);
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks?search=1');
        $I->see('1 results');
        $I->see('bookmark1', '.card-container');
        $I->dontSee('bookmark2', '.card-container');
        $I->dontSee('bookmark3', '.card-container');

        $I->click('Reset All');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks');
        $I->see('4 results');
    }
}
