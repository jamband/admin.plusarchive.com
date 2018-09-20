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

$I->wantTo('ensure that track/create works');
$I->seePageNotFound(['/track/create']);
$I->loginAsAdmin();

$I->amOnPage(url(['/track/admin']));
$I->click('#menu-action');
$I->click('Create', '#menu-action + .dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/track/create');
$I->see('Track', '#menu-controller');
$I->see('Create', '#menu-action');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeElement('.is-invalid');
