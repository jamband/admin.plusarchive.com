<?php

declare(strict_types=1);

namespace app\tests\acceptance\playlist;

use AcceptanceTester;
use app\tests\acceptance\fixtures\PlaylistFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 */
class UpdateCest
{
    private mixed $fixtures;

    public function _before(AcceptanceTester $I): void
    {
        $fixtures['playlists'] = PlaylistFixture::class;
        $I->haveFixtures($fixtures);
        $this->fixtures = $I->grabFixture('playlists');
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPlaylistUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/playlist/update', 'id' => 3]);

        $I->loginAsAdmin();

        $I->amOnPage(Url::to(['/playlist/update', 'id' => 3]));
        $I->seeInField('#playlistupdateform-url', $this->fixtures['playlist3']['url']);
        $I->seeInField('#playlistupdateform-title', $this->fixtures['playlist3']['title']);
        $I->seeInField('#playlistupdateform-image', $this->fixtures['playlist3']['image']);

        $I->fillField('#playlistupdateform-title', 'Updated Title');
        $I->click('button[type=submit]');

        $I->waitForText('Playlist has been updated.');
        $I->seeCurrentUrlEquals('/index-test.php/playlists/admin');
        $I->see('Admin: 3' ,'#menu-action');
        $I->see('Updated Title');
    }
}
