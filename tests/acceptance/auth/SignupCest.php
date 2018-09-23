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
use app\tests\acceptance\fixtures\SignupFixture;

class SignupCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'users' => SignupFixture::class,
        ]);
    }

    public function ensureThatSignupWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->dontSee('Sign up', '.navbar');

        $I->seePageNotFound(['/auth/signup/index']);
        $I->loginAsAdmin();

        $I->seeCurrentUrlEquals('/index-test.php');
        $I->click('Signup', '.navbar');
        $I->see('Sign up', 'h2');

        $I->click('button[type=submit]');
        $I->wait(1);
        $I->seeElement('.is-invalid');

        $I->fillField('#signupform-username', 'newuser');
        $I->fillField('#signupform-email', 'newuser@example.com');
        $I->fillField('#signupform-password', 'newusernewuser');
        $I->click('button[type=submit]');
        $I->wait(1);
        $I->see('Signed up successfully.');
        $I->seeCurrentUrlEquals('/index-test.php');
    }
}
