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
use app\tests\acceptance\fixtures\SignupFixture;

class SignupCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['users'] = SignupFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatSignupWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->click('#dropdownMoreLinks');
        $I->dontSee('Signup');

        $I->seePageNotFound(['/auth/signup/index']);
        $I->loginAsAdmin();

        $I->seeCurrentUrlEquals('/index-test.php');
        $I->click('#dropdownMoreLinks');
        $I->click('Signup', '.dropdown-menu');
        $I->see('Sign up', 'h1');

        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->seeElement('.is-invalid');

        $I->fillField('#signupform-username', 'newuser');
        $I->fillField('#signupform-email', 'newuser@example.com');
        $I->fillField('#signupform-password', 'newusernewuser');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->see('Signed up successfully.');
        $I->seeCurrentUrlEquals('/index-test.php');
    }
}
