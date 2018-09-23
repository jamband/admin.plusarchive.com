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

namespace app\tests\acceptance\trackGenre;

use AcceptanceTester;
use app\tests\acceptance\fixtures\TrackGenreFixture;

class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'track-genres' => TrackGenreFixture::class,
        ]);
    }

    public function ensureThatTrackGenreDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/track-genre/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/track-genre/delete', 'id' => 1]);
    }
}
