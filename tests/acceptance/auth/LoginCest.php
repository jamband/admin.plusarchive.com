<?php

declare(strict_types=1);

namespace app\tests\acceptance\auth;

use AcceptanceTester;
use app\controllers\auth\LoginController;
use app\tests\acceptance\fixtures\LoginFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see LoginController
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
        $I->amOnPage(Url::toRoute('/login'));
        $I->see('Log in', 'h1');

        $I->click('button[type=submit]');
        $I->waitForElement('.error-summary');

        $I->fillField('#loginform-username', 'admin');
        $I->fillField('#loginform-password', 'wrong_password');
        $I->click('button[type=submit]');
        $I->waitForElement('.error-summary');

        $I->fillField('#loginform-password', 'adminadmin');
        $I->click('button[type=submit]');
        $I->waitForText('Admin', selector: '.navbar');
        $I->seeCurrentUrlEquals(Url::home());

        $I->amOnPage(Url::toRoute('/login'));
        $I->seeCurrentUrlEquals(Url::home());
    }
}
