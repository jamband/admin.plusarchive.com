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
$I->haveFixtures(['bookmarks' => app\tests\fixtures\BookmarkFixture::class]);

$I->wantTo('ensure that bookmark/admin works');
$I->seePageNotFound(['/bookmark/admin']);
$I->loginAsAdmin();

$I->amOnPage(url(['/bookmark/admin']));
$I->see('Bookmark', '#menu-controller');
$I->see('Admin: 4', '#menu-action');
$I->see('bookmark1', '.grid-view');
$I->see('bookmark2', '.grid-view');
$I->see('bookmark3', '.grid-view');
$I->see('bookmark4', '.grid-view');
$I->see('Private', '.grid-view');
$I->see('Publish', '.grid-view');

$I->fillField('input[name="BookmarkSearch[name]"]', 4);
$I->pressKey(['name' => 'BookmarkSearch[name]'], WebDriverKeys::ENTER);
$I->wait(1);
$I->see('Admin: 1', '#menu-action');
$I->see('bookmark4', '.grid-view');
$I->dontSee('bookmark1', '.grid-view');
$I->dontSee('bookmark2', '.grid-view');
$I->dontSee('bookmark3', '.grid-view');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->see('Admin: 4', '#menu-action');
$I->see('bookmark1', '.grid-view');
$I->see('bookmark2', '.grid-view');
$I->see('bookmark3', '.grid-view');
$I->see('bookmark4', '.grid-view');

$I->fillField('input[name="BookmarkSearch[link]"]', 'you');
$I->pressKey(['name' => 'BookmarkSearch[link]'], WebDriverKeys::ENTER);
$I->wait(1);
$I->see('Admin: 1', '#menu-action');
$I->see('bookmark4', '.grid-view');
$I->seeElement('.fa-youtube-square');
$I->dontSee('bookmark1', '.grid-view');
$I->dontSee('bookmark2', '.grid-view');
$I->dontSee('bookmark3', '.grid-view');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->see('Admin: 4', '#menu-action');
$I->see('bookmark1', '.grid-view');
$I->see('bookmark2', '.grid-view');
$I->see('bookmark3', '.grid-view');
$I->see('bookmark4', '.grid-view');

$I->selectOption('select[name="BookmarkSearch[status]"]', 'Private');
$I->wait(1);
$I->see('Admin: 1', '#menu-action');
$I->see('bookmark4', '.grid-view');
$I->dontSee('bookmark1', '.grid-view');
$I->dontSee('bookmark2', '.grid-view');
$I->dontSee('bookmark3', '.grid-view');
