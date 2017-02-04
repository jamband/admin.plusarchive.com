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
$I->haveFixtures(['label-tags' => app\tests\acceptance\fixtures\LabelTagFixture::class]);

$I->wantTo('ensure that label-tag/update works');
$I->seePageNotFound(['/label-tag/update', 'id' => 1]);
$I->loginAsAdmin();

$I->amOnPage(url(['/label-tag/admin']));
$I->click('//*[@id="grid-view-label-tag"]/table/tbody/tr[1]/td[5]/a[1]/i');
$I->seeCurrentUrlEquals('/index-test.php/label-tag/update/1');
$I->see('LabelTag', '#menu-controller');
$I->see('Update', '#menu-action');

$I->seeInField('#labeltag-name', 'tag1');

$I->fillField('#labeltag-name', '');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeElement('.has-error');

$I->fillField('#labeltag-name', 'tag-one');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/label-tag/admin');
$I->see('Label tag has been updated.');
$I->see('Admin: 3', '#menu-action');
$I->see('tag-one', '.grid-view');
$I->dontSee('tag1', '.grid-view');

$I->click('//*[@id="grid-view-label-tag"]/table/tbody/tr[1]/td[5]/a[1]/i');
$I->seeCurrentUrlEquals('/index-test.php/label-tag/update/1');

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->seeInPopup('Are you sure you want to delete this item?');
$I->cancelPopup();

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->acceptPopup();
$I->seeCurrentUrlEquals('/index-test.php/label-tag/admin');
$I->see('Admin: 2', '#menu-action');
$I->dontSee('tag-one', '.grid-view');
