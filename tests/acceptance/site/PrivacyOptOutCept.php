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
$I->wantTo('ensure that privacy opt-out works');
$I->seeBadRequest(['/site/privacy-opt-out']);

$I->amOnPage(url(['/privacy']));
$I->see('Privacy Policy', '.toast-message');
$I->click('.toast-message a');
//
$I->click('.toast-close-button');
$I->wait(1);
$I->dontSeeElement('.toast-message');

$I->click('.privacy-opt-out');
$I->wait(1);
$I->seeInPopup('Google Analytics opt-out has been completed.');
$I->acceptPopup();
$I->seeElement('.toast-message');