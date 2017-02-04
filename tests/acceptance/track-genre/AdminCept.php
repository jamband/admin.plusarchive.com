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
$I->haveFixtures(['track-genres' => app\tests\acceptance\fixtures\TrackGenreFixture::class]);

$I->wantTo('ensure that track-genre/admin works');
$I->seePageNotFound(['/track-genre/admin']);
$I->loginAsAdmin();

$I->amOnPage(url(['/track-genre/admin']));
$I->see('TrackGenre', '#menu-controller');
$I->see('Admin: 5', '#menu-action');
$I->see('genre1', '.grid-view');
$I->see('genre2', '.grid-view');
$I->see('genre3', '.grid-view');

$I->fillField('input[name="TrackGenreSearch[name]"]', 3);
$I->pressKey(['name' => 'TrackGenreSearch[name]'], WebDriverKeys::ENTER);
$I->wait(1);
$I->see('Admin: 1', '#menu-action');
$I->see('genre3', '.grid-view');
$I->dontSee('genre1', '.grid-view');
$I->dontSee('genre2', '.grid-view');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->see('Admin: 5', '#menu-action');
$I->see('genre1', '.grid-view');
$I->see('genre2', '.grid-view');
$I->see('genre3', '.grid-view');
