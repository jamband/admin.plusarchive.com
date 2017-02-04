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
$I->seePageNotFound(['/bookmark/delete', 'id' => 1]);
$I->loginAsAdmin();
$I->seeMethodNotAllowed(['/bookmark/delete', 'id' => 1]);
