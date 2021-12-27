<?php

declare(strict_types=1);

namespace app\tests\acceptance\track;

use AcceptanceTester;
use app\tests\acceptance\fixtures\TrackFixture;
use Facebook\WebDriver\WebDriverKeys;

/**
 * @noinspection PhpUnused
 */
class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatTrackAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/track/admin']);

        $I->loginAsAdmin();

        $I->amOnPage(url(['/track/admin']));
        $I->see('Track', '#menu-controller');
        $I->see('Providers', '#search-provider');
        $I->see('Genres', '#search-genre');
        $I->see('Admin: 5', '#menu-action');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');

        $I->click('#search-provider');
        $I->click('Bandcamp', '#search-provider + .dropdown-menu');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/tracks/admin?provider=Bandcamp');
        $I->dontSee('Providers', '#search-provider');
        $I->see('Bandcamp', '#search-provider');
        $I->see('Admin: 1', '#menu-action');
        $I->see('track1', '.card-title');
        $I->dontSee('track2', '.card-title');

        $I->click('#search-genre');
        $I->click('genre2', '#search-genre + .dropdown-menu');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/tracks/admin?provider=Bandcamp&genre=genre2');
        $I->see('Admin: 0', '#menu-action');
        $I->dontSee('Genres', '#search-genre');
        $I->see('genre2', '#search-genre');

        $I->click('Reset All');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/tracks/admin');
        $I->see('Providers', '#search-provider');
        $I->dontSee('Bandcamp', '#search-provider');
        $I->see('Admin: 5', '#menu-action');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');

        $I->fillField(['name' => 'search'], '5');
        $I->pressKey('input[name=search]', WebDriverKeys::ENTER);
        $I->wait(1);
        $I->seeInField(['name' => 'search'], '5');
        $I->see('Admin: 1', '#menu-action');
        $I->see('track5', '.card-title');

        $I->click('YouTube', '.card-img-wrap + .card-body');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/tracks/admin?provider=YouTube');
        $I->see('YouTube', '#search-provider');
        $I->see('Admin: 2', '#menu-action');
        $I->see('track4', '.card-title');
        $I->see('track5', '.card-title');
        $I->dontSee('track1', '.card-title');
    }
}
