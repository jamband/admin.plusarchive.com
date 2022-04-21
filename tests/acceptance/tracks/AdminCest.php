<?php

declare(strict_types=1);

namespace app\tests\acceptance\tracks;

use AcceptanceTester;
use app\controllers\tracks\AdminController;
use app\tests\acceptance\fixtures\TrackFixture;
use Facebook\WebDriver\WebDriverKeys;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see AdminController
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
    public function ensureThatTracksAdminWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/tracks/admin'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/tracks/admin'));
        $I->see('Track', '#menu-controller');
        $I->see('Providers', '#search-provider');
        $I->see('Genres', '#search-genre');
        $I->see('Admin: 5', '#menu-action');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');

        $I->click('#search-provider');
        $I->click('Bandcamp', '#search-provider + .dropdown-menu');
        $I->waitForText('Bandcamp', selector: '#search-provider');
        $I->seeCurrentUrlEquals(Url::toRoute('/tracks/admin?provider=Bandcamp'));
        $I->dontSee('Providers', '#search-provider');
        $I->see('Admin: 1', '#menu-action');
        $I->see('track1', '.card-title');
        $I->dontSee('track2', '.card-title');

        $I->click('#search-genre');
        $I->click('genre2', '#search-genre + .dropdown-menu');
        $I->waitForText('Admin: 0', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/tracks/admin?provider=Bandcamp&genre=genre2'));
        $I->dontSee('Genres', '#search-genre');
        $I->see('genre2', '#search-genre');

        $I->click('Reset All');
        $I->waitForText('Providers', selector: '#search-provider');
        $I->seeCurrentUrlEquals(Url::toRoute('/tracks/admin'));
        $I->dontSee('Bandcamp', '#search-provider');
        $I->see('Admin: 5', '#menu-action');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');

        $I->fillField(['name' => 'search'], '5');
        $I->pressKey('input[name=search]', WebDriverKeys::ENTER);
        $I->waitForText('Admin: 1', selector: '#menu-action');
        $I->seeInField(['name' => 'search'], '5');
        $I->see('track5', '.card-title');

        $I->click('YouTube', '.card-img-wrap + .card-body');
        $I->waitForText('YouTube', selector: '#search-provider');
        $I->seeCurrentUrlEquals(Url::toRoute('/tracks/admin?provider=YouTube'));
        $I->see('Admin: 2', '#menu-action');
        $I->see('track4', '.card-title');
        $I->see('track5', '.card-title');
        $I->dontSee('track1', '.card-title');
    }
}
