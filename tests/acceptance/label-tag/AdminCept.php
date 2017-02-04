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
$I->haveFixtures(['users' => app\tests\fixtures\UserFixture::class]);
$I->haveFixtures(['label-tags' => app\tests\fixtures\LabelTagFixture::class]);

$I->wantTo('ensure that label-tag/admin works');
$I->seePageNotFound(['/label-tag/admin']);
$I->loginAsAdmin();

$I->amOnPage(url(['/label-tag/admin']));
$I->see('LabelTag', '#menu-controller');
$I->see('Admin: 3', '#menu-action');
$I->see('tag1', '.grid-view');
$I->see('tag2', '.grid-view');
$I->see('tag3', '.grid-view');

$I->fillField('input[name="LabelTagSearch[name]"]', 3);
$I->pressKey(['name' => 'LabelTagSearch[name]'], WebDriverKeys::ENTER);
$I->wait(1);
$I->see('Admin: 1', '#menu-action');
$I->see('tag3', '.grid-view');
$I->dontSee('tag1', '.grid-view');
$I->dontSee('tag2', '.grid-view');

$I->moveMouseOver('#menu-action');
$I->click('Admin', '#menu-action + .dropdown-menu');
$I->see('Admin: 3', '#menu-action');
$I->see('tag1', '.grid-view');
$I->see('tag2', '.grid-view');
$I->see('tag3', '.grid-view');
