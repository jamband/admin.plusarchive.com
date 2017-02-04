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
$I->haveFixtures(['tracks' => app\tests\fixtures\TrackFixture::class]);
$I->haveFixtures(['track-genres' => app\tests\fixtures\TrackGenreFixture::class]);

$I->wantTo('ensure that tracks works');
$I->amOnPage(url(['/track/index']));
$I->see('Providers', '.dropdown-toggle');
$I->see('Genres', '.dropdown-toggle');
$I->see('4 results', '.total-count');

$I->click('#search-provider');
$I->click('Bandcamp', '#search-provider + .dropdown-menu');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/tracks?provider=Bandcamp');
$I->see('Bandcamp', '#search-provider');
$I->see('1 results', '.total-count');

$I->click('#search-genre');
$I->click('genre1', '#search-genre + .dropdown-menu');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/tracks?provider=Bandcamp&genre=genre1');
$I->see('0 results', '.total-count');
$I->see('genre1', '#search-genre');

$I->click('Reset All', '.thumbnail');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/tracks');
$I->see('Providers', '#search-provider');
$I->see('4 results', '.total-count');

$I->fillField(['name' => 'search'], '3');
$I->click('.input-group-btn button');
$I->wait(1);
$I->seeInField(['name' => 'search'], '3');
$I->see('1 results', '.total-count');
