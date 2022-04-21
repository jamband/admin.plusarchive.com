<?php

declare(strict_types=1);

namespace app\tests\acceptance\labelTags;

use AcceptanceTester;
use app\controllers\labelTags\UpdateController;
use app\tests\acceptance\fixtures\LabelTagFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see UpdateController
 */
class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tags'] = LabelTagFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLabelTagsUpdateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/labelTags/update/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/labelTags/admin'));
        $I->click('//*[@id="grid-view-label-tags"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/labelTags/update/1'));
        $I->see('LabelTag', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->seeInField('#labeltag-name', 'tag1');

        $I->fillField('#labeltag-name', '');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#labeltag-name', 'tag-one');
        $I->click('button[type=submit]');
        $I->waitForText('Label tag has been updated.');
        $I->seeCurrentUrlEquals(Url::toRoute('/labelTags/admin'));
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag-one', '.grid-view');
        $I->dontSee('tag1', '.grid-view');

        $I->click('//*[@id="grid-view-label-tags"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/labelTags/update/1'));

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 2', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/labelTags/admin'));
        $I->dontSee('tag-one', '.grid-view');
    }
}
