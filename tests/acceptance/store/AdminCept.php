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
$I->haveFixtures(['stores' => app\tests\acceptance\fixtures\StoreFixture::class]);

$I->wantTo('ensure that store/admin works');
$I->seePageNotFound(['/store/admin']);
$I->loginAsAdmin();

$I->amOnPage(url(['/store/admin']));
$I->see('Store', '#menu-controller');
$I->see('Admin: 3', '#menu-action');
$I->see('store1', '.grid-view');
$I->see('store2', '.grid-view');
$I->see('store3', '.grid-view');

$I->fillField('input[name="StoreSearch[name]"]', 3);
$I->pressKey(['name' => 'StoreSearch[name]'], WebDriverKeys::ENTER);
$I->wait(1);
$I->see('Admin: 1', '#menu-action');
$I->see('store3', '.grid-view');
$I->dontSee('store1', '.grid-view');
$I->dontSee('store2', '.grid-view');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->see('Admin: 3', '#menu-action');
$I->see('store1', '.grid-view');
$I->see('store2', '.grid-view');
$I->see('store3', '.grid-view');

$I->fillField('input[name="StoreSearch[link]"]', 'you');
$I->pressKey(['name' => 'StoreSearch[link]'], WebDriverKeys::ENTER);
$I->wait(1);
$I->see('Admin: 1', '#menu-action');
$I->see('store3', '.grid-view');
$I->seeElement('.fa-youtube-square');
$I->dontSee('store1', '.grid-view');
$I->dontSee('store2', '.grid-view');
