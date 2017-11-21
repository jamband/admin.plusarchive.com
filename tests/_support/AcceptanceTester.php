<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    public function loginAsAdmin()
    {
        $I = $this;
        $I->amOnPage(url(['/site/login']));
        $I->fillField('#loginform-username', 'admin');
        $I->fillField('#loginform-password', 'adminadmin');
        $I->click('button[type=submit]');
        $I->wait(1);
    }

    /**
     * @param array|string $url
     */
    public function seeBadRequest($url)
    {
        $I = $this;
        $I->amOnPage(url($url));
        $I->see('Invalid request.');
    }

    /**
     * @param array|string $url
     */
    public function seePageNotFound($url)
    {
        $I = $this;
        $I->amOnPage(url($url));
        $I->see('Page not found.');
    }

    /**
     * @param array|string $url
     */
    public function seeMethodNotAllowed($url)
    {
        $I = $this;
        $I->amOnPage(url($url));
        $I->see('Method not allowed.');
    }
}
