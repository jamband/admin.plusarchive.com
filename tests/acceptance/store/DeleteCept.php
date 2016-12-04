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
$I->wantTo('ensure that store/view works');
$I->seePageNotFound(['/label/store', 'id' => 1]);
$I->loginAsAdmin();
$I->seeMethodNotAllowed(['/store/delete', 'id' => 1]);
