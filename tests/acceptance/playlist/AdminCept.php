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
$I->haveFixtures(['playlists' => app\tests\acceptance\fixtures\PlaylistFixture::class]);

$I->wantTo('ensure that playlist/admin works');
$I->seePageNotFound(['/playlist/admin']);
$I->loginAsAdmin();

$I->amOnPage(url(['/playlist/admin']));
$I->see('Playlist', '#menu-controller');
$I->see('Admin: 3', '#menu-action');
$I->see('playlist1', '.grid-view');
$I->see('playlist2', '.grid-view');
$I->see('playlist3', '.grid-view');
$I->see('Publish', '.grid-view');
$I->see('Incomplete', '.grid-view');

$I->fillField('input[name="PlaylistSearch[title]"]', 3);
$I->pressKey(['name' => 'PlaylistSearch[title]'], WebDriverKeys::ENTER);
$I->wait(1);
$I->see('Admin: 1', '#menu-action');
$I->see('playlist3', '.grid-view');
$I->dontSee('bookmark1', '.grid-view');
$I->dontSee('bookmark2', '.grid-view');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->see('Admin: 3', '#menu-action');
$I->see('playlist1', '.grid-view');
$I->see('playlist2', '.grid-view');
$I->see('playlist3', '.grid-view');

$I->selectOption('select[name="PlaylistSearch[status]"]', 'Incomplete');
$I->wait(1);
$I->see('Admin: 1', '#menu-action');
$I->see('playlist3', '.grid-view');
$I->dontSee('playlist1', '.grid-view');
$I->dontSee('playlist2', '.grid-view');
