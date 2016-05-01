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
$I->wantTo('ensure that label/view works');
$I->seePageNotFound(['/label/view', 'id' => 1]);
$I->loginAsAdmin();

$I->amOnPage(url(['/label/admin']));
$I->click('//*[@id="w1"]/table/tbody/tr[1]/td[7]/a[1]/i');
$I->seeCurrentUrlEquals('/index-test.php/label/1');
$I->see('Label', '#menu-controller');
$I->see('View', '#menu-action');
$I->see('label1', '.detail-view');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/label/admin');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Create', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/label/create');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Update', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/label/update/1');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->seeInPopup('Are you sure you want to delete this item?');
$I->cancelPopup();

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->acceptPopup();
$I->seeCurrentUrlEquals('/index-test.php/label/admin');
$I->see('Admin: 2', '#menu-action');
