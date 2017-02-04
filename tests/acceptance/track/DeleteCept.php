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
$I->haveFixtures(['tracks' => app\tests\fixtures\TrackFixture::class]);

$I->wantTo('ensure that track/delete works');
$I->seePageNotFound(['/track/delete', 'id' => 1]);
$I->loginAsAdmin();
$I->seeMethodNotAllowed(['/track/delete', 'id' => 1]);
