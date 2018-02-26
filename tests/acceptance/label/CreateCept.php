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
$I->haveFixtures(['labels' => app\tests\acceptance\fixtures\LabelFixture::class]);

$I->wantTo('ensure that label/create works');
$I->seePageNotFound(['/label/create']);
$I->loginAsAdmin();

$I->amOnPage(url(['/label/admin']));
$I->see('Admin: 3', '#menu-action');

$I->click('#menu-action');
$I->click('Create', '#menu-action + .dropdown-menu');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/label/create');

$I->click('button[type=submit]');
$I->wait(1);
$I->seeElement('.is-invalid');

$I->fillField('#label-name', 'newlabel');
$I->fillField('#label-url', 'http://newlabel.example.com');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/label/4');
$I->see('Label has been added.');

$I->click('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->wait(1);
$I->see('Admin: 4', '#menu-action');
