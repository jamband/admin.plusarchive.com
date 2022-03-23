<?php

declare(strict_types=1);

namespace app\tests\acceptance\track;

use AcceptanceTester;
use app\tests\acceptance\fixtures\TrackFixture;
use Facebook\WebDriver\WebDriverKeys;

/**
 * @noinspection PhpUnused
 */
class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatTracksWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/track/index']));
        $I->see('Providers', '#search-provider');
        $I->see('Genres', '#search-genre');
        $I->see('5 results');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');

        $I->click('#search-provider');
        $I->click('Bandcamp', '#search-provider + .dropdown-menu');
        $I->waitForText('Bandcamp', selector: '#search-provider');
        $I->seeCurrentUrlEquals('/index-test.php/tracks?provider=Bandcamp');
        $I->see('1 results');
        $I->see('track1', '.card-title');
        $I->dontSee('track2', '.card-title');

        $I->click('#search-genre');
        $I->click('genre2', '#search-genre + .dropdown-menu');
        $I->waitForText('0 results');
        $I->seeCurrentUrlEquals('/index-test.php/tracks?provider=Bandcamp&genre=genre2');
        $I->see('genre2', '#search-genre');

        $I->click('Reset All');
        $I->waitForText('Providers', selector: '#search-provider');
        $I->seeCurrentUrlEquals('/index-test.php/tracks');
        $I->see('5 results');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');

        $I->fillField(['name' => 'search'], '3');
        $I->pressKey('input[name=search]', WebDriverKeys::ENTER);
        $I->waitForText('1 results');
        $I->seeInField(['name' => 'search'], '3');
        $I->see('track3', '.card-title');
        $I->dontSee('track1', '.card-title');
        $I->dontSee('track2', '.card-title');
    }
}
