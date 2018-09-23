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

namespace app\tests\acceptance\auth;

use AcceptanceTester;
use app\tests\acceptance\fixtures\AdminUserFixture;

class LogoutCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'users' => AdminUserFixture::class,
        ]);
    }

    public function ensureThatLogoutWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/auth/login/index']));
        $I->see('Log in', 'h2');
        $I->dontSee('Logout');

        $I->loginAsAdmin();
        $I->wait(1);
        $I->see('Logout');

        $I->click('Logout', '.navbar');
        $I->wait(1);
        $I->dontSee('Logout', '.navbar');
        $I->seeCurrentUrlEquals('/index-test.php');
    }
}
