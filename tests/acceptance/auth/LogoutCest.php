<?php

declare(strict_types=1);

namespace app\tests\acceptance\auth;

use AcceptanceTester;
use app\controllers\auth\LogoutController;
use app\tests\acceptance\fixtures\LoginFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see LogoutController
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
        $I->amOnPage(Url::toRoute('/logout'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/admin'));
        $I->click('#dropdownMoreLinks');
        $I->click('Logout', '.dropdown-menu');
        $I->waitForText('Logged out successfully.');
        $I->seeCurrentUrlEquals(Url::home());
    }
}
