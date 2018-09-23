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

class CreateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'tracks' => TrackFixture::class,
        ]);
    }

    public function ensureThatTrackCreateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/track/create']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/track/admin']));
        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/track/create');
        $I->see('Track', '#menu-controller');
        $I->see('Create', '#menu-action');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeElement('.is-invalid');
    }
}
