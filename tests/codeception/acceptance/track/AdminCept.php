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
$I->wantTo('ensure that track/admin works');
$I->seePageNotFound(['/track/admin']);
$I->loginAsAdmin();

$I->amOnPage(url(['/track/admin']));
$I->see('Track', '#menu-controller');
$I->see('Providers', '#search-provider');
$I->see('Genres', '#search-genre');
$I->seeElement('.track-image');
$I->see('Admin: 5', '#menu-action');

$I->click('#search-provider');
$I->click('Bandcamp', '#search-provider + .dropdown-menu');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/track/admin?provider=Bandcamp');
$I->dontSee('Providers', '#search-provider');
$I->see('Bandcamp', '#search-provider');
$I->see('Admin: 1', '#menu-action');

$I->click('#search-genre');
$I->click('genre1', '#search-genre + .dropdown-menu');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/track/admin?provider=Bandcamp&genre=genre1');
$I->see('Admin: 0', '#menu-action');
$I->dontSee('Genres', '#search-genre');
$I->see('genre1', '#search-genre');
$I->dontSeeElement('.track-image');

$I->click('Reset All', '.thumbnail');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/track/admin');
$I->see('Providers', '#search-provider');
$I->dontSee('Bandcamp', '#search-provider');
$I->seeElement('.track-image');
$I->see('Admin: 5', '#menu-action');

$I->click('#search-status');
$I->click('Private', '#search-status + .dropdown-menu');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/track/admin?&status=Private');
$I->see('Admin: 1', '#menu-action');

$I->click('YouTube', '.track-image + .caption');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/track/admin?provider=YouTube');
$I->see('YouTube', '.dropdown-toggle');
$I->see('Admin: 2', '#menu-action');

$I->fillField(['name' => 'search'], '3');
$I->click('.fa-search');
$I->wait(1);
$I->seeInField(['name' => 'search'], '3');
$I->see('Admin: 1', '#menu-action');
$I->see('track3', '.track-image + .caption');

$I->click('//*[@id="tile-container"]/div[2]/div/div/a[3]'); // Update link
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/track/update/3');
$I->moveBack();

$I->click('#search-status');
$I->click('Private', '#search-status + .dropdown-menu');
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/track/admin?status=Private');

$I->click('//*[@id="tile-container"]/div[2]/div/div/a[4]'); // Delete link
$I->seeInPopup('Are you sure you want to delete this item?');
$I->cancelPopup();

$I->click('//*[@id="tile-container"]/div[2]/div/div/a[4]'); // Delete link
$I->acceptPopup();
$I->wait(1);
$I->seeCurrentUrlEquals('/index-test.php/track/admin');
$I->see('Track has been deleted.');
$I->see('Admin: 4', '#menu-action');
$I->dontSee('track5', '.track-image + .caption');
