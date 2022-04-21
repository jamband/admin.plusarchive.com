<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmarkTags;

use AcceptanceTester;
use app\controllers\bookmarkTags\UpdateController;
use app\tests\acceptance\fixtures\BookmarkTagFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see UpdateController
 */
class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tags'] = BookmarkTagFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatBookmarkTagsUpdateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/bookmarkTags/update/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/bookmarkTags/admin'));
        $I->click('//*[@id="grid-view-bookmark-tags"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarkTags/update/1'));
        $I->see('BookmarkTag', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->seeInField('#bookmarktag-name', 'tag1');

        $I->fillField('#bookmarktag-name', '');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#bookmarktag-name', 'tag-one');
        $I->click('button[type=submit]');
        $I->waitForText('Bookmark tag has been updated.');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarkTags/admin'));
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag-one', '.grid-view');
        $I->dontSee('tag1', '.grid-view');

        $I->click('//*[@id="grid-view-bookmark-tags"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarkTags/update/1'));

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 2', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/bookmarkTags/admin'));
        $I->dontSee('tag-one', '.grid-view');
    }
}
