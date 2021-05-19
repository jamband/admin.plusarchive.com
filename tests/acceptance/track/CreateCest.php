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

class CreateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackFixture::class;
        $I->haveFixtures($fixtures);
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
        $I->wait(0.5);
        $I->seeElement('.is-invalid');

        $I->fillField('#trackcreateform-url', 'https://www.youtube.com/watch?v=foo');
        $I->selectOption('#trackcreateform-tagvalues', ['genre1', 'genre2']);
        $I->click('button[type=submit]');
        $I->wait(0.5);

        $I->seeCurrentUrlEquals('/index-test.php/track/admin');
        $I->see('Track has been added.');
        $I->see('Admin: 6' ,'#menu-action');
        $I->see('Foo Title', ['css' => '.card:nth-child(1)']);
        $I->see('genre1 genre2', ['css' => '.card:nth-child(1)']);
    }
}
