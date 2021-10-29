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
use app\tests\acceptance\fixtures\TrackStopAllUrgeFixture;

class StopAllUrgeCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackStopAllUrgeFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatTrackStopAllUrgeWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/site/admin/index']);

        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/track/stop-all-urge']);

        $I->amOnPage(url(['/site/admin/index']));
        $I->see('Action', '#menu-action');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');
        $I->see('track3', '.card-title');

        $I->click('#menu-action');
        $I->click('Stop All Urge');
        $I->wait(0.5);
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Stop All Urge');
        $I->acceptPopup();
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/admin');
        $I->dontSee('track1', '.card-title');
        $I->dontSee('track2', '.card-title');
        $I->dontSee('track3', '.card-title');
    }
}
