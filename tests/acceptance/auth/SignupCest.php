<?php

declare(strict_types=1);

namespace app\tests\acceptance\auth;

use AcceptanceTester;
use app\tests\acceptance\fixtures\SignupFixture;

/**
 * @noinspection PhpUnused
 */
class SignupCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['users'] = SignupFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
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
        $I->waitForElement('.is-invalid');

        $I->fillField('#signupform-username', 'newuser');
        $I->fillField('#signupform-email', 'newuser@example.com');
        $I->fillField('#signupform-password', 'newusernewuser');
        $I->click('button[type=submit]');
        $I->waitForText('Signed up successfully.');
        $I->seeCurrentUrlEquals('/index-test.php');
    }
}
