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
$I->haveFixtures(['tracks' => app\tests\acceptance\fixtures\TrackFixture::class]);

$I->wantTo('ensure that track/update works');
$I->seePageNotFound(['/track/update', 'id' => 1]);
$I->loginAsAdmin();

// $I->amOnPage(url(['/track/admin']));
// $I->click('//*[@id="tile-container"]/div[2]/div/div/a[3]'); // Update link
// $I->seeCurrentUrlEquals('/index-test.php/track/update/1');
// $I->see('Track', '#menu-controller');
// $I->see('Update', '#menu-action');

// $I->moveMouseOver('#menu-action');
// $I->click('Admin', '#menu-action + .dropdown-menu');
// $I->seeCurrentUrlEquals('/index-test.php/track/admin');
// $I->moveBack();

// $I->moveMouseOver('#menu-action');
// $I->click('Create', '#menu-action + .dropdown-menu');
// $I->seeCurrentUrlEquals('/index-test.php/track/create');
// $I->moveBack();

// $I->seeInField('#track-url', 'https://example.bandcamp.com/track/track1');
// $I->seeOptionIsSelected('#track-status', 'Publish');
// $I->seeInField('#track-title', 'track1');
// $I->seeInField('#track-image', 'track1.jpg');
