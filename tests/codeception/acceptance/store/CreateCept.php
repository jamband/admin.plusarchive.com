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
$I->wantTo('ensure that store/create works');
$I->seePageNotFound(['/store/create']);
$I->loginAsAdmin();

$I->amOnPage(url(['/store/admin']));
$I->see('Admin: 3', '#menu-action');

$I->moveMouseOver('#menu-action');
$I->click('Create', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/store/create');

$I->click('button[type=submit]');
$I->seeElement('.has-error');

$I->fillField('#store-name', 'newstore');
$I->fillField('#store-url', 'http://newstore.example.com');
$I->click('button[type=submit]');
$I->see('Store has been added.');
$I->seeCurrentUrlEquals('/index-test.php/store/4');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->see('Admin: 4', '#menu-action');
