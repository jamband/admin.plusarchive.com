<?php

declare(strict_types=1);

namespace app\tests\acceptance\playlist;

use AcceptanceTester;
use app\tests\acceptance\fixtures\PlaylistFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
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
    public function ensureThatPlaylistCreateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/playlist/create']);

        $I->loginAsAdmin();

        $I->amOnPage(Url::to(['/playlist/admin']));
        $I->see('Admin: 3', '#menu-action');

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/playlists/create');

        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#playlistcreateform-url', 'https://www.youtube.com/playlist?list=foo');
        $I->click('button[type=submit]');

        $I->waitForText('Playlist has been added.');
        $I->seeCurrentUrlEquals('/index-test.php/playlists/admin');
        $I->see('Admin: 4' ,'#menu-action');
        $I->see('Foo Title');
    }
}
