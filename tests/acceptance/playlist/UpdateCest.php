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

namespace app\tests\acceptance\playlist;

use AcceptanceTester;
use app\tests\acceptance\fixtures\PlaylistFixture;

class UpdateCest
{
    private $fixtures;

    public function _before(AcceptanceTester $I): void
    {
        $fixtures['playlists'] = PlaylistFixture::class;
        $I->haveFixtures($fixtures);
        $this->fixtures = $I->grabFixture('playlists');
    }

    public function ensureThatPlaylistUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/playlist/update', 'id' => 3]);

        $I->loginAsAdmin();

        $I->amOnPage(url(['/playlist/update', 'id' => 3]));
        $I->seeInField('#playlistupdateform-url', $this->fixtures['playlist3']['url']);
        $I->seeInField('#playlistupdateform-title', $this->fixtures['playlist3']['title']);
        $I->seeInField('#playlistupdateform-image', $this->fixtures['playlist3']['image']);

        $I->fillField('#playlistupdateform-title', 'Updated Title');
        $I->click('button[type=submit]');
        $I->wait(1);

        $I->seeCurrentUrlEquals('/index-test.php/playlist/admin');
        $I->see('Playlist has been updated.');
        $I->see('Admin: 3' ,'#menu-action');
        $I->see('Updated Title');
    }
}
