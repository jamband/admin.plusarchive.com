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
$I->wantTo('ensure that third-party-licenses works');
$I->amOnPage(url(['/site/third-party-licenses/index']));
$I->see('Third-Party Licenses', 'h2');
$I->see('jquery');
