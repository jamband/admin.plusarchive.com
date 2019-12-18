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
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    public function loginAsAdmin(): void
    {
        $I = $this;
        $I->amOnPage(url(['/auth/login/index']));
        $I->fillField('#loginform-username', app()->params['admin-username']);
        $I->fillField('#loginform-password', app()->params['admin-password']);
        $I->click('button[type=submit]');
        $I->wait(1);
    }

    /**
     * @param array|string $url
     */
    public function seeBadRequest($url): void
    {
        $I = $this;
        $I->amOnPage(url($url));
        $I->see('Invalid request.');
    }

    /**
     * @param array|string $url
     */
    public function seePageNotFound($url): void
    {
        $I = $this;
        $I->amOnPage(url($url));
        $I->see('Page not found.');
    }

    /**
     * @param array|string $url
     */
    public function seeMethodNotAllowed($url): void
    {
        $I = $this;
        $I->amOnPage(url($url));
        $I->see('Method not allowed.');
    }
}
