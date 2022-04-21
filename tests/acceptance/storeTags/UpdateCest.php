<?php

declare(strict_types=1);

namespace app\tests\acceptance\storeTags;

use AcceptanceTester;
use app\controllers\storeTags\UpdateController;
use app\tests\acceptance\fixtures\StoreTagFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see UpdateController
 */
class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tags'] = StoreTagFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatStoreTagsUpdateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/storeTags/update/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/storeTags/admin'));
        $I->click('//*[@id="grid-view-store-tags"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/storeTags/update/1'));
        $I->see('StoreTag', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->seeInField('#storetag-name', 'tag1');

        $I->fillField('#storetag-name', '');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#storetag-name', 'tag-one');
        $I->click('button[type=submit]');
        $I->waitForText('Store tag has been updated.');
        $I->seeCurrentUrlEquals(Url::toRoute('/storeTags/admin'));
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag-one', '.grid-view');
        $I->dontSee('tag1', '.grid-view');

        $I->click('//*[@id="grid-view-store-tags"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/storeTags/update/1'));

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 2', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/storeTags/admin'));
        $I->dontSee('tag-one', '.grid-view');
    }
}
