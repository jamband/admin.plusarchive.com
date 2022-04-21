<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmarks;

use AcceptanceTester;
use app\controllers\bookmarks\CreateController;
use app\tests\acceptance\fixtures\BookmarkFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see CreateController
 */
class CreateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['bookmarks'] = BookmarkFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatBookmarksCreateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/bookmarks/create'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/bookmarks/admin'));
        $I->see('Admin: 4', '#menu-action');

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/create'));

        $I->fillField('#bookmark-name', 'new_bookmark');
        $I->fillField('#bookmark-url', 'https://newbookmark.example.com');
        $I->click('button[type=submit]');
        $I->waitForText('Bookmark has been added.');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/view/5'));

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 5', '#menu-action');
    }
}
