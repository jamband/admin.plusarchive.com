<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmarks;

use AcceptanceTester;
use app\controllers\bookmarks\ViewController;
use app\tests\acceptance\fixtures\BookmarkFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see ViewController
 */
class ViewCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['bookmarks'] = BookmarkFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatBookmarksViewWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/bookmarks/view/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/bookmarks/admin'));
        $I->click('//*[@id="grid-view-bookmarks"]/table/tbody/tr[1]/td[7]/a[1]/i'); // View link
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/view/1'));
        $I->see('Bookmark', '#menu-controller');
        $I->see('View', '#menu-action');
        $I->see('bookmark1', '.detail-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/admin'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/create'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Update', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/update/1'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 3', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/admin'));
    }
}
