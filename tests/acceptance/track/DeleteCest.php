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

namespace app\tests\acceptance\track;

use AcceptanceTester;
use app\tests\acceptance\fixtures\TrackFixture;

/**
 * @noinspection PhpUnused
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
    public function ensureThatTrackDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/track/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/track/delete', 'id' => 1]);
    }
}
