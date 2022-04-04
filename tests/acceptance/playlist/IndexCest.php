<?php

declare(strict_types=1);

namespace app\tests\acceptance\playlist;

use AcceptanceTester;
use app\tests\acceptance\fixtures\PlaylistFixture;
use Yii;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 */
class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['playlist'] = PlaylistFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPlaylistsWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::to(['/']));
        $I->click('Playlist', '#navbar');
        $I->seeCurrentUrlEquals('/index-test.php/playlists');
        $I->see('Playlists', 'h1');
        $I->see('playlist1');
        $I->see('playlist2');
        $I->see('playlist3');

        $I->click('playlist1');
        $I->seeCurrentUrlEquals('/index-test.php/playlists/'.Yii::$app->hashids->encode(1));

        $I->click('Back to playlists');
        $I->seeCurrentUrlEquals('/index-test.php/playlists');
    }
}
