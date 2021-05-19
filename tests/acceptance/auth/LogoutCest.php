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

namespace app\tests\acceptance\auth;

use AcceptanceTester;
use app\tests\acceptance\fixtures\AdminUserFixture;

class LogoutCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['users'] = AdminUserFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatLogoutWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/auth/login/index']));
        $I->see('Log in', 'h1');
        $I->dontSee('Admin', '.navbar');

        $I->loginAsAdmin();
        $I->wait(1);
        $I->see('Admin', '.navbar');

        $I->click('#dropdownMoreLinks');
        $I->click('Logout', '.dropdown-menu');

        $I->click('#dropdownMoreLinks');
        $I->dontSee('Logout');
        $I->seeCurrentUrlEquals('/index-test.php');
    }
}
