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

namespace app\tests\acceptance\track;

use AcceptanceTester;
use app\tests\acceptance\fixtures\TrackFixture;
use Facebook\WebDriver\WebDriverKeys;

class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatTracksWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/track/index']));
        $I->see('Providers', '.dropdown-toggle');
        $I->see('Genres', '.dropdown-toggle');
        $I->see('5 results');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');

        $I->click('#search-provider');
        $I->click('Bandcamp', '#search-provider + .dropdown-menu');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/tracks?provider=Bandcamp');
        $I->see('Bandcamp', '#search-provider');
        $I->see('1 results');
        $I->see('track1', '.card-title');
        $I->dontSee('track2', '.card-title');

        $I->click('#search-genre');
        $I->click('genre2', '#search-genre + .dropdown-menu');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/tracks?provider=Bandcamp&genre=genre2');
        $I->see('0 results');
        $I->see('genre2', '#search-genre');

        $I->click('Reset All');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/tracks');
        $I->see('Providers', '#search-provider');
        $I->see('5 results');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');

        $I->fillField(['name' => 'search'], '3');
        $I->pressKey('input[name=search]', WebDriverKeys::ENTER);
        $I->wait(0.5);
        $I->seeInField(['name' => 'search'], '3');
        $I->see('1 results');
        $I->see('track3', '.card-title');
        $I->dontSee('track1', '.card-title');
        $I->dontSee('track2', '.card-title');
    }
}
