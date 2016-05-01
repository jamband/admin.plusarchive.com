<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that logout works');
$I->amOnPage(url(['/site/login']));
$I->see('Log in', 'h2');
$I->dontSee('Logout');

$I->loginAsAdmin();
$I->see('Logout');

$I->click('Logout', '.navbar');
$I->dontSee('Logout', '.navbar');
$I->seeCurrentUrlEquals('/index-test.php');
