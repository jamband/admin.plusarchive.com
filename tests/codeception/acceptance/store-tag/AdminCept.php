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
$I->wantTo('ensure that store-tag/admin works');
$I->seePageNotFound(['/store-tag/admin']);
$I->loginAsAdmin();

$I->amOnPage(url(['/store-tag/admin']));
$I->see('StoreTag', '#menu-controller');
$I->see('Admin: 3', '#menu-action');
$I->see('tag1', '.grid-view');
$I->see('tag2', '.grid-view');
$I->see('tag3', '.grid-view');

$I->fillField('input[name="StoreTagSearch[name]"]', 3);
$I->pressKey(['name' => 'StoreTagSearch[name]'], WebDriverKeys::ENTER);
$I->wait(1);
$I->see('Admin: 1', '#menu-action');
$I->see('tag3', '.grid-view');
$I->dontSee('tag1', '.grid-view');
$I->dontSee('tag2', '.grid-view');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->see('Admin: 3', '#menu-action');
$I->see('tag1', '.grid-view');
$I->see('tag2', '.grid-view');
$I->see('tag3', '.grid-view');
