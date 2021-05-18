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

class LoginCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['users'] = AdminUserFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatLoginWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->dontSee('Login', '.navbar');

        $I->amOnPage(url(['/auth/login/index']));
        $I->see('Log in', 'h1');

        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeElement('.error-summary');

        $I->fillField('#loginform-username', app()->params['admin-username']);
        $I->fillField('#loginform-password', app()->params['admin-username']);
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeElement('.error-summary');

        $I->fillField('#loginform-password', app()->params['admin-password']);
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->dontSeeElement('.error-summary');
        $I->seeCurrentUrlEquals('/index-test.php');
        $I->see('Logged in successfully.');
        $I->see('Logout', '.navbar');

        $I->amOnPage(url(['/auth/login/index']));
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php');
    }
}
