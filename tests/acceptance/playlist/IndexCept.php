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
$I->haveFixtures(['playlists' => app\tests\acceptance\fixtures\PlaylistFixture::class]);

$I->wantTo('ensure that playlists works');
$I->amOnPage(url(['/']));
$I->click('Playlist', '.navbar');
$I->seeCurrentUrlEquals('/index-test.php/playlists');
$I->see('Playlists', 'h2');
$I->see('playlist1', '.playlist-title');
$I->see('playlist3', '.playlist-title');
$I->dontSee('playlist2', '.playlist-title');

$I->click('playlist1', '.playlist-title');
$I->seeCurrentUrlEquals('/index-test.php/playlist/'.hashids()->encode(1));

// close privacy consent popup
$I->click('.toast-close-button');
$I->wait(1);

$I->click('Back to playlists');
$I->seeCurrentUrlEquals('/index-test.php/playlists');
