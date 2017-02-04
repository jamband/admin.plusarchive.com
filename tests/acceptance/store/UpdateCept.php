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
$I->haveFixtures(['stores' => app\tests\fixtures\StoreFixture::class]);

$I->wantTo('ensure that store/update works');
$I->seePageNotFound(['/store/update', 'id' => 1]);
$I->loginAsAdmin();

$I->amOnPage(url(['/store/admin']));
$I->click('//*[@id="w0"]/table/tbody/tr[1]/td[6]/a[2]/i');
$I->seeCurrentUrlEquals('/index-test.php/store/update/1');
$I->see('Store', '#menu-controller');
$I->see('Update', '#menu-action');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/store/admin');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Create', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/store/create');
$I->moveBack();

$I->seeInField('#store-name', 'store1');
$I->seeInField('#store-url', 'https://store1.example.com/');
$I->seeInField('#store-link', "https://twitter.com/store1\nhttps://soundcloud.com/store1");

$I->fillField('#store-name', '');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeElement('.has-error');

$I->fillField('#store-name', 'store-one');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/store/1');
$I->see('Store has been updated.');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->see('Admin: 3', '#menu-action');
$I->see('store-one', '.grid-view');
$I->dontSee('store1', '.grid-view');

$I->click('//*[@id="w0"]/table/tbody/tr[1]/td[6]/a[2]/i');
$I->seeCurrentUrlEquals('/index-test.php/store/update/1');

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->seeInPopup('Are you sure you want to delete this item?');
$I->cancelPopup();

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->acceptPopup();
$I->seeCurrentUrlEquals('/index-test.php/store/admin');
$I->see('Admin: 2', '#menu-action');
$I->dontSee('store-one', '.grid-view');
