<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\acceptance\track;

use AcceptanceTester;
use app\tests\acceptance\fixtures\TrackFixture;

class NowCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'tracks' => TrackFixture::class,
        ]);
    }

    public function ensureThatTrackNowWorks(AcceptanceTester $I): void
    {
        $I->seeBadRequest(['/track/now', 'id' => 1]);
    }
}
