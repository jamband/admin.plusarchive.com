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
$I->haveFixtures(['stores' => app\tests\acceptance\fixtures\StoreFixture::class]);

$I->wantTo('ensure that stores works');
$I->amOnPage(url(['/']));
$I->click('Store', '.navbar');
$I->seeCurrentUrlEquals('/index-test.php/stores');
$I->waitForText('Stores', 1, 'h2');
$I->see('store1', '.caption');
$I->see('store2', '.caption');
$I->see('store3', '.caption');
$I->seeElement('.fa-soundcloud');
$I->seeElement('.fa-youtube-square');
$I->seeElement('.fa-twitter-square');
$I->see('3 results', '.total-count');

$I->click('Countries', '.caption');
$I->wait(1);
$I->click('Japan', '.caption');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/stores?country=Japan');
$I->see('store1', '.caption');
$I->dontSee('store2', '.caption');
$I->dontSee('store3', '.caption');
$I->see('1 results', '.total-count');

$I->fillField('input[name=search]', '1');
$I->click('button[type=submit]');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/stores?search=1');
$I->see('1 results', '.total-count');
$I->see('store1', '.caption');
$I->dontSee('store2', '.caption');
$I->dontSee('store3', '.caption');

$I->click('Reset All', '.caption');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/stores');
$I->see('3 results', '.total-count');
