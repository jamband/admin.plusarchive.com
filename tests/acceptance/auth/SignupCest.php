<?php

declare(strict_types=1);

namespace app\tests\acceptance\auth;

use AcceptanceTester;
use app\controllers\auth\SignupController;
use app\tests\acceptance\fixtures\SignupFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see SignupController
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
        $I->amOnPage(Url::toRoute('/signup'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(url::toRoute('/admin'));
        $I->click('#dropdownMoreLinks');
        $I->click('Signup', '.dropdown-menu');
        $I->see('Sign up', 'h1');

        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#signupform-username', 'new_user');
        $I->fillField('#signupform-email', 'new_user@example.com');
        $I->fillField('#signupform-password', 'new_user_new_user');
        $I->click('button[type=submit]');
        $I->waitForText('Signed up successfully.');
        $I->seeCurrentUrlEquals(Url::home());
    }
}
