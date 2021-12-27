<?php

declare(strict_types=1);

namespace app\tests\acceptance\auth;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LoginFixture;

/**
 * @noinspection PhpUnused
 */
class LoginCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['users'] = LoginFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLoginWorks(AcceptanceTester $I): void
    {
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
        $I->see('Admin', '.navbar');

        $I->amOnPage(url(['/auth/login/index']));
        $I->seeCurrentUrlEquals('/index-test.php');
    }
}
