<?php

declare(strict_types=1);

namespace app\tests\acceptance\auth;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LoginFixture;

/**
 * @noinspection PhpUnused
 */
class LogoutCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['users'] = LoginFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLogoutWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/auth/login/index']));
        $I->see('Log in', 'h1');
        $I->dontSee('Admin', '.navbar');

        $I->loginAsAdmin();
        $I->see('Admin', '.navbar');

        $I->click('#dropdownMoreLinks');
        $I->click('Logout', '.dropdown-menu');

        $I->click('#dropdownMoreLinks');
        $I->dontSee('Logout');
        $I->seeCurrentUrlEquals('/index-test.php');
    }
}
