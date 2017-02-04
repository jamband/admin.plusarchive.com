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
$I->haveFixtures(['bookmarks' => app\tests\acceptance\fixtures\BookmarkFixture::class]);

$I->wantTo('ensure that bookmark/view works');
$I->seePageNotFound(['/bookmark/view', 'id' => 1]);
$I->loginAsAdmin();

$I->amOnPage(url(['/bookmark/admin']));
$I->click('//*[@id="w0"]/table/tbody/tr[1]/td[7]/a[1]/i'); // View link
$I->seeCurrentUrlEquals('/index-test.php/bookmark/1');
$I->see('Bookmark', '#menu-controller');
$I->see('View', '#menu-action');
$I->see('bookmark1', '.detail-view');
$I->see('Publish', '.detail-view');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Create', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/bookmark/create');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Update', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/bookmark/update/1');
$I->moveBack();

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->seeInPopup('Are you sure you want to delete this item?');
$I->cancelPopup();

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->acceptPopup();
$I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
$I->see('Admin: 3', '#menu-action');
