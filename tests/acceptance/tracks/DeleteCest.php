<?php

declare(strict_types=1);

namespace app\tests\acceptance\tracks;

use AcceptanceTester;
use app\controllers\tracks\DeleteController;
use app\tests\acceptance\fixtures\TrackFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see DeleteController
 */
class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatTracksDeleteWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/tracks/delete/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->seeMethodNotAllowed('/tracks/delete/1');
    }
}
