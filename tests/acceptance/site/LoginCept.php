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
$I->haveFixtures(['users' => app\tests\fixtures\UserFixture::class]);
$I->wantTo('ensure that login works');
$I->amOnPage(url(['/']));
$I->dontSee('Login', '.navbar');

$I->amOnPage(url(['/site/login']));
$I->see('Log in', 'h2');

$I->click('button[type=submit]');
$I->wait(1);
$I->seeElement('.error-summary');

$I->fillField('#loginform-username', 'admin');
$I->fillField('#loginform-password', 'admin');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeElement('.error-summary');

$I->fillField('#loginform-password', 'adminadmin');
$I->click('button[type=submit]');
$I->wait(1);
$I->dontSeeElement('.error-summary');
$I->seeCurrentUrlEquals('/index-test.php');
$I->see('Logged in successfully.');
$I->see('Logout', '.navbar');
