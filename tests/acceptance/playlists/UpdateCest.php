<?php

declare(strict_types=1);

namespace app\tests\acceptance\playlists;

use AcceptanceTester;
use app\controllers\playlists\UpdateController;
use app\tests\acceptance\fixtures\AdminUserFixture;
use app\tests\acceptance\fixtures\PlaylistFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see UpdateController
 */
class UpdateCest
{
    private mixed $fixtures;

    public function _before(AcceptanceTester $I): void
    {
        $fixtures['users'] = AdminUserFixture::class;
        $fixtures['playlists'] = PlaylistFixture::class;
        $I->haveFixtures($fixtures);
        $this->fixtures = $I->grabFixture('playlists');
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPlaylistsUpdateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/playlists/update/3'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/playlists/update/3'));
        $I->seeInField('#playlistupdateform-url', $this->fixtures['playlist3']['url']);
        $I->seeInField('#playlistupdateform-title', $this->fixtures['playlist3']['title']);
        $I->seeInField('#playlistupdateform-image', $this->fixtures['playlist3']['image']);

        $I->fillField('#playlistupdateform-title', 'Updated Title');
        $I->click('button[type=submit]');

        $I->waitForText('Playlist has been updated.');
        $I->seeCurrentUrlEquals(Url::toRoute('/playlists/admin'));
        $I->see('Admin: 3' ,'#menu-action');
        $I->see('Updated Title');
    }
}
