<?php

declare(strict_types=1);

namespace app\tests\acceptance\tracks;

use AcceptanceTester;
use app\controllers\tracks\NowController;
use app\tests\acceptance\fixtures\TrackFixture;

/**
 * @noinspection PhpUnused
 * @see NowController
 */
class NowCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatTracksNowWorks(AcceptanceTester $I): void
    {
        $I->seeBadRequest('/tracks/now');
    }
}
