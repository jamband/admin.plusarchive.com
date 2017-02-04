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
$I->wantTo('ensure that admin works');
$I->amOnPage(url(['/']));
$I->dontSee('Admin', '.navbar');

$I->seePageNotFound(['/site/admin']);
$I->loginAsAdmin();
$I->wait(1);

$I->click('Admin', '.navbar');
$I->seeCurrentUrlEquals('/index-test.php/admin');
$I->see('Site', '#menu-controller');

$I->moveMouseOver('#menu-controller');
$I->click('Track', '.dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/track/admin');
$I->moveBack();

$I->moveMouseOver('#menu-controller');
$I->click('TrackGenre', '.dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/track-genre/admin');
$I->moveBack();

$I->moveMouseOver('#menu-controller');
$I->click('Playlist', '.dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/playlist/admin');
$I->moveBack();

$I->moveMouseOver('#menu-controller');
$I->click('PlaylistItem', '.dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/playlist-item/admin');
$I->moveBack();

$I->moveMouseOver('#menu-controller');
$I->click('Label', '.dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/label/admin');
$I->moveBack();

$I->moveMouseOver('#menu-controller');
$I->click('LabelTag', '.dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/label-tag/admin');
$I->moveBack();

$I->moveMouseOver('#menu-controller');
$I->click('Store', '.dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/store/admin');
$I->moveBack();

$I->moveMouseOver('#menu-controller');
$I->click('StoreTag', '.dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/store-tag/admin');
$I->moveBack();

$I->moveMouseOver('#menu-controller');
$I->click('Bookmark', '.dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
$I->moveBack();

$I->moveMouseOver('#menu-controller');
$I->click('BookmarkTag', '.dropdown-menu');
$I->seeCurrentUrlEquals('/index-test.php/bookmark-tag/admin');
$I->moveBack();
