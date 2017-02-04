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
$I->haveFixtures(['playlists' => app\tests\fixtures\PlaylistFixture::class]);

$I->wantTo('ensure that playlists works');
$I->amOnPage(url(['/']));
$I->click('Playlist', '.navbar');
$I->seeCurrentUrlEquals('/index-test.php/playlists');
$I->see('Playlists', 'h2');
$I->see('playlist1', 'h4');
$I->see('playlist2', 'h4');
$I->dontSee('playlist3', 'h4');

$I->click('playlist1', 'h4');
$I->seeCurrentUrlEquals('/index-test.php/playlist/'.hashids()->encode(1));

$I->click('Back to playlist');
$I->seeCurrentUrlEquals('/index-test.php/playlists');
