<?php

declare(strict_types=1);

namespace app\tests\acceptance\playlists;

use AcceptanceTester;
use app\controllers\playlists\AdminController;
use app\tests\acceptance\fixtures\PlaylistFixture;
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
        $fixtures['playlists'] = PlaylistFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPlaylistsAdminWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/playlists/admin'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/playlists/admin'));
        $I->see('Playlists', '#menu-controller');
        $I->see('Admin: 3', '#menu-action');
        $I->see('playlist1', '.grid-view');
        $I->see('playlist2', '.grid-view');
        $I->see('playlist3', '.grid-view');

        $I->fillField('input[name="PlaylistSearch[title]"]', 3);
        $I->pressKey(['name' => 'PlaylistSearch[title]'], WebDriverKeys::ENTER);
        $I->waitForText('Admin: 1', selector: '#menu-action');
        $I->see('playlist3', '.grid-view');
        $I->dontSee('playlist1', '.grid-view');
        $I->dontSee('playlist2', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 3', '#menu-action');
        $I->see('playlist1', '.grid-view');
        $I->see('playlist2', '.grid-view');
        $I->see('playlist3', '.grid-view');
    }
}
