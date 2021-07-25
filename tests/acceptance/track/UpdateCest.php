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

class UpdateCest
{
    private $fixtures;

    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackFixture::class;
        $I->haveFixtures($fixtures);
        $this->fixtures = $I->grabFixture('tracks');
    }

    public function ensureThatTrackUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/track/update', 'id' => 5]);

        $I->loginAsAdmin();

        $I->amOnPage(url(['/track/update', 'id' => 5]));

        $I->seeInField('#trackupdateform-url', $this->fixtures['track5']['url']);
        $I->seeInField('#trackupdateform-title', $this->fixtures['track5']['title']);
        $I->seeInField('#trackupdateform-image', $this->fixtures['track5']['image']);

        $I->fillField('#trackupdateform-title', 'Updated Title');
        $I->click('button[type=submit]');
        $I->wait(0.5);

        $I->seeCurrentUrlEquals('/index-test.php/tracks/admin');
        $I->see('Track has been updated.');
        $I->see('Admin: 5' ,'#menu-action');
        $I->see('Updated Title', ['css' => '.card:nth-child(1)']);
    }
}
