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
$I->wantTo('ensure that playlist/create works');
$I->seePageNotFound(['/playlist/create']);
$I->loginAsAdmin();

$I->amOnPage(url(['/playlist/admin']));
$I->see('Admin: 3', '#menu-action');

$I->moveMouseOver('#menu-action');
$I->click('Create', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/playlist/create');

$I->click('button[type=submit]');
$I->seeElement('.has-error');

$I->fillField('#playlist-title', 'newplaylist');
$I->click('button[type=submit]');
$I->see('Playlist has been added.');
$I->seeCurrentUrlEquals('/index-test.php/playlist-item/create');

$I->moveMouseOver('#menu-controller');
$I->click('Playlist', '#menu-controller + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/playlist/admin');
$I->see('Admin: 4', '#menu-action');

$I->selectOption('select[name="PlaylistSearch[status]"]', 'Incomplete');
$I->wait(1);
$I->see('Admin: 2', '#menu-action');
$I->see('newplaylist', '.grid-view');
