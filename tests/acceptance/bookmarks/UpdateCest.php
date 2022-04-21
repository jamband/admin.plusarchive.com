<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmarks;

use AcceptanceTester;
use app\controllers\bookmarks\UpdateController;
use app\tests\acceptance\fixtures\BookmarkFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see UpdateController
 */
class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['bookmarks'] = BookmarkFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatBookmarksUpdateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/bookmarks/update/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute(['/bookmarks/admin']));
        $I->click('//*[@id="grid-view-bookmarks"]/table/tbody/tr[1]/td[7]/a[2]/i'); // Update link
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/update/1'));
        $I->see('Bookmark', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/admin'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/create'));
        $I->moveBack();

        $I->seeInField('#bookmark-name', 'bookmark1');
        $I->seeInField('#bookmark-country', 'Japan');
        $I->seeInField('#bookmark-url', 'https://bookmark1.example.com/');
        $I->seeInField('#bookmark-link', "https://twitter.com/bookmark1\nhttps://soundcloud.com/bookmark1");

        $I->fillField('#bookmark-name', '');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#bookmark-name', 'bookmark-one');
        $I->click('button[type=submit]');
        $I->waitForText('Bookmark has been updated.');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/view/1'));

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 4', '#menu-action');
        $I->see('bookmark-one', '.grid-view');
        $I->dontSee('bookmark1', '.grid-view');

        $I->click('//*[@id="grid-view-bookmarks"]/table/tbody/tr[1]/td[7]/a[2]/i'); // Update link
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/update/1'));

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 3', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarks/admin'));
        $I->dontSee('bookmark-one', '.grid-view');
    }
}
