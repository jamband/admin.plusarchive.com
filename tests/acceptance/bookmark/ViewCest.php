<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmark;

use AcceptanceTester;
use app\tests\acceptance\fixtures\BookmarkFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
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
    public function ensureThatBookmarkViewWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/bookmark/view', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(Url::to(['/bookmark/admin']));
        $I->click('//*[@id="grid-view-bookmark"]/table/tbody/tr[1]/td[7]/a[1]/i'); // View link
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks/1');
        $I->see('Bookmark', '#menu-controller');
        $I->see('View', '#menu-action');
        $I->see('bookmark1', '.detail-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks/admin');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks/create');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Update', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks/update/1');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 3', selector: '#menu-action');
        $I->seeCurrentUrlEquals('/index-test.php/bookmarks/admin');
    }
}
