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
$I->haveFixtures(['tracks' => app\tests\acceptance\fixtures\TrackFixture::class]);

$I->wantTo('ensure that track/now works');
$I->seePageNotFound(['/track/now', 'id' => 1]);
