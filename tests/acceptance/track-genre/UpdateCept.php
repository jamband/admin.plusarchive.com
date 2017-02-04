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
$I->haveFixtures(['track-genres' => app\tests\fixtures\TrackGenreFixture::class]);

$I->wantTo('ensure that track-genre/update works');
$I->seePageNotFound(['/track-genre/update', 'id' => 1]);
$I->loginAsAdmin();

$I->amOnPage(url(['/track-genre/admin']));
$I->click('//*[@id="w0"]/table/tbody/tr[1]/td[5]/a[1]/i');
$I->seeCurrentUrlEquals('/index-test.php/track-genre/update/1');
$I->see('TrackGenre', '#menu-controller');
$I->see('Update', '#menu-action');

$I->seeInField('#trackgenre-name', 'genre1');

$I->fillField('#trackgenre-name', '');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeElement('.has-error');

$I->fillField('#trackgenre-name', 'genre-one');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/track-genre/admin');
$I->see('Track genre has been updated.');
$I->see('Admin: 5', '#menu-action');
$I->see('genre-one', '.grid-view');
$I->dontSee('genre1', '.grid-view');

$I->click('//*[@id="w0"]/table/tbody/tr[1]/td[5]/a[1]/i');
$I->seeCurrentUrlEquals('/index-test.php/track-genre/update/1');

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->seeInPopup('Are you sure you want to delete this item?');
$I->cancelPopup();

$I->moveMouseOver('#menu-action');
$I->click('Delete', '#menu-action + .dropdown-menu');
$I->acceptPopup();
$I->seeCurrentUrlEquals('/index-test.php/track-genre/admin');
$I->see('Admin: 4', '#menu-action');
$I->dontSee('genre-one', '.grid-view');
