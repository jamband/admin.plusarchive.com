<?php

/*
 * This file is part of the plusarchive.com
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

class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'users' => AdminUserFixture::class,
        ]);
    }

    public function ensureThatAdminWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->dontSee('Admin', '.navbar');

        $I->seePageNotFound(['/site/admin/index']);
        $I->loginAsAdmin();
        $I->wait(1);

        $I->click('Admin', '.navbar');
        $I->seeCurrentUrlEquals('/index-test.php/admin');
        $I->see('Site', '#menu-controller');

        $I->click('#menu-controller');
        $I->click('Track', '.dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/track/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Playlist', '.dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/playlist/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('MusicGenre', '.dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/music-genre/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Label', '.dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/label/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('LabelTag', '.dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/label-tag/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Store', '.dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/store/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('StoreTag', '.dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/store-tag/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Bookmark', '.dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('BookmarkTag', '.dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark-tag/admin');
        $I->moveBack();
    }
}
