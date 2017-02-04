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
$I->haveFixtures(['bookmarks' => app\tests\acceptance\fixtures\BookmarkFixture::class]);

$I->wantTo('ensure that bookmarks works');
$I->amOnPage(url(['/']));
$I->click('Bookmark', '.navbar');
$I->seeCurrentUrlEquals('/index-test.php/bookmarks');
$I->waitForText('Bookmarks', 1, 'h2');
$I->see('bookmark1', '.caption');
$I->see('bookmark2', '.caption');
$I->see('bookmark3', '.caption');
$I->seeElement('.fa-soundcloud');
$I->seeElement('.fa-twitter-square');
$I->see('3 results', '.total-count');

$I->fillField('input[name=search]', '1');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/bookmarks?search=1');
$I->see('1 results', '.total-count');
$I->see('bookmark1', '.caption');
$I->dontSee('bookmark2', '.caption');
$I->dontSee('bookmark3', '.caption');

$I->click('Reset All', '.caption');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/bookmarks');
$I->see('3 results', '.total-count');
