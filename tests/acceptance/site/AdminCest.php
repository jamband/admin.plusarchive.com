<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\tests\acceptance\fixtures\AdminUserFixture;
use app\tests\acceptance\fixtures\HomeFixture;

class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['users'] = AdminUserFixture::class;
        $fixtures['tracks'] = HomeFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/site/admin/index']);

        $I->loginAsAdmin();
        $I->wait(1);

        $I->amOnPage(url(['/site/admin/index']));

        $I->click('#menu-controller');
        $I->click('Track', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/track/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Playlist', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/playlist/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('MusicGenre', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/music-genre/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Label', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/label/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('LabelTag', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/label-tag/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Store', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/store/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('StoreTag', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/store-tag/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Bookmark', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('BookmarkTag', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark-tag/admin');
        $I->moveBack();

        $I->see('Recent favorite tracks');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');
        $I->see('track3', '.card-title');

        $I->click('genre1', '.card-text');
        $I->seeCurrentUrlEquals('/index-test.php/track/admin?genre=genre1');
        $I->moveBack();

        $I->click('Update', '.card-date');
        $I->seeCurrentUrlEquals('/index-test.php/track/update/1');
        $I->moveBack();
    }
}
