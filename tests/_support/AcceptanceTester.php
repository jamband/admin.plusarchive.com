<?php

declare(strict_types=1);

use yii\helpers\Url;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    public function loginAsAdmin(): void
    {
        $I = $this;
        $I->amOnPage(Url::toRoute('/login'));
        $I->fillField('#loginform-username', 'admin');
        $I->fillField('#loginform-password', 'adminadmin');
        $I->click('button[type=submit]');
        $I->waitForText('Logged in successfully.');
    }

    public function seeBadRequest(string $url): void
    {
        $I = $this;
        $I->amOnPage(Url::toRoute($url));
        $I->see('Invalid request.');
    }

    public function seePageNotFound(string $url): void
    {
        $I = $this;
        $I->amOnPage(Url::toRoute($url));
        $I->see('Page not found.');
    }

    public function seeMethodNotAllowed(string $url): void
    {
        $I = $this;
        $I->amOnPage(Url::toRoute($url));
        $I->see('Method not allowed.');
    }
}
