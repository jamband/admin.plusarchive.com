<?php

declare(strict_types=1);

namespace app\tests\acceptance\track;

use AcceptanceTester;
use app\tests\acceptance\fixtures\TrackFixture;

/**
 * @noinspection PhpUnused
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
    public function ensureThatTrackNowWorks(AcceptanceTester $I): void
    {
        $I->seeBadRequest(['/track/now', 'id' => 1]);
    }
}
