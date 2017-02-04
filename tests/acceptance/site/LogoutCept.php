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
$I->haveFixtures(['users' => app\tests\acceptance\fixtures\UserFixture::class]);
$I->wantTo('ensure that logout works');
$I->amOnPage(url(['/site/login']));
$I->see('Log in', 'h2');
$I->dontSee('Logout');

$I->loginAsAdmin();
$I->wait(1);
$I->see('Logout');

$I->click('Logout', '.navbar');
$I->wait(1);
$I->dontSee('Logout', '.navbar');
$I->seeCurrentUrlEquals('/index-test.php');
