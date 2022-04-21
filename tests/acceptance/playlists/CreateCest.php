<?php

declare(strict_types=1);

namespace app\tests\acceptance\playlists;

use AcceptanceTester;
use app\controllers\playlists\CreateController;
use app\tests\acceptance\fixtures\PlaylistFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see CreateController
 */
class CreateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['playlists'] = PlaylistFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPlaylistsCreateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/playlists/create'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/playlists/admin'));
        $I->see('Admin: 3', '#menu-action');

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/playlists/create'));

        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#playlistcreateform-url', 'https://www.youtube.com/playlist?list=foo');
        $I->click('button[type=submit]');

        $I->waitForText('Playlist has been added.');
        $I->seeCurrentUrlEquals(Url::toRoute('/playlists/admin'));
        $I->see('Admin: 4' ,'#menu-action');
        $I->see('Foo Title');
    }
}
