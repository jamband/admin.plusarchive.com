<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\controllers\site\AdminController;
use app\tests\acceptance\fixtures\AdminUserFixture;
use app\tests\acceptance\fixtures\HomeFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see AdminController
 */
class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['users'] = AdminUserFixture::class;
        $fixtures['tracks'] = HomeFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/site/admin/index']);

        $I->loginAsAdmin();
        $I->amOnPage(Url::to(['/site/admin/index']));

        $I->click('#menu-controller');
        $I->click('Tracks', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/tracks/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Playlists', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/playlists/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('MusicGenres', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/music-genres/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Labels', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/labels/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('LabelTags', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/label-tags/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Stores', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/stores/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('StoreTags', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/store-tags/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('Bookmarks', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks/admin');
        $I->moveBack();

        $I->click('#menu-controller');
        $I->click('BookmarkTags', '#menu-controller + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmark-tags/admin');
        $I->moveBack();

        $I->see('Recent favorite tracks');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');
        $I->see('track3', '.card-title');

        $I->click('genre1', '.card-text');
        $I->seeCurrentUrlEquals('/index-test.php/tracks/admin?genre=genre1');
        $I->moveBack();

        $I->click('Update', '.card-date');
        $I->seeCurrentUrlEquals('/index-test.php/tracks/update/1');
        $I->moveBack();
    }
}
