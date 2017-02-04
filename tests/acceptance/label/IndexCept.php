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

$I->wantTo('ensure that labels works');
$I->amOnPage(url(['/']));
$I->click('Label', '.navbar');
$I->seeCurrentUrlEquals('/index-test.php/labels');
$I->waitForText('Labels', 1, 'h2');
$I->see('label1', '.caption');
$I->see('label2', '.caption');
$I->see('label3', '.caption');
$I->seeElement('.fa-soundcloud');
$I->seeElement('.fa-youtube-square');
$I->seeElement('.fa-twitter-square');
$I->see('3 results', '.total-count');

$I->click('Countries', '.caption');
$I->wait(1);
$I->click('Japan', '.caption');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/labels?country=Japan');
$I->see('label1', '.caption');
$I->dontSee('label2', '.caption');
$I->dontSee('label3', '.caption');
$I->see('1 results', '.total-count');

$I->click('Reset All', '.caption');
$I->seeCurrentUrlEquals('/index-test.php/labels');
$I->wait(1);
$I->see('3 results', '.total-count');

