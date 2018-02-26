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

$I->wantTo('ensure that label/update works');
$I->seePageNotFound(['/label/update', 'id' => 1]);
$I->loginAsAdmin();

$I->amOnPage(url(['/label/admin']));
$I->click('//*[@id="grid-view-label"]/table/tbody/tr[1]/td[7]/a[2]/i');
$I->seeCurrentUrlEquals('/index-test.php/label/update/1');
$I->see('Label', '#menu-controller');
$I->see('Update', '#menu-action');

$I->click('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/label/admin');
$I->moveBack();

$I->click('#menu-action');
$I->click('Create', '#menu-action + .dropdown-menu');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/label/create');
$I->moveBack();

$I->seeInField('#label-name', 'label1');
$I->seeInField('#label-country', 'Japan');
$I->seeInField('#label-url', 'https://label1.example.com/');
$I->seeInField('#label-link', "https://twitter.com/label1records\nhttps://soundcloud.com/label1records");

$I->fillField('#label-name', '');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeElement('.is-invalid');

$I->fillField('#label-name', 'label-one');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/label/1');
$I->see('label has been updated.');

$I->click('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->wait(1);
$I->see('Admin: 3', '#menu-action');
$I->see('label-one', '.grid-view');
$I->dontSee('label1', '.grid-view');

$I->click('//*[@id="grid-view-label"]/table/tbody/tr[1]/td[7]/a[2]/i');
$I->seeCurrentUrlEquals('/index-test.php/label/update/1');

$I->click('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->wait(1);
$I->seeInPopup('Are you sure you want to delete this item?');
$I->cancelPopup();

$I->click('Delete', '#menu-action + .dropdown-menu');
$I->acceptPopup();
$I->seeCurrentUrlEquals('/index-test.php/label/admin');
$I->see('Admin: 2', '#menu-action');
$I->dontSee('label-one', '.grid-view');
