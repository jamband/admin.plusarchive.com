<?php

declare(strict_types=1);

namespace app\tests\acceptance\playlists;

use AcceptanceTester;
use app\controllers\playlists\DeleteController;
use app\tests\acceptance\fixtures\PlaylistFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see DeleteController
 */
class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['playlists'] = PlaylistFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPlaylistsDeleteWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/playlists/delete/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->seeMethodNotAllowed('/playlists/delete/1');
    }
}
