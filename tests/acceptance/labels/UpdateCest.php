<?php

declare(strict_types=1);

namespace app\tests\acceptance\labels;

use AcceptanceTester;
use app\controllers\labels\UpdateController;
use app\tests\acceptance\fixtures\LabelFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see UpdateController
 */
class UpdateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['labels'] = LabelFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLabelsUpdateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/labels/update/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/labels/admin'));
        $I->click('//*[@id="grid-view-labels"]/table/tbody/tr[1]/td[7]/a[2]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/update/1'));
        $I->see('Label', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/admin'));
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/create'));
        $I->moveBack();

        $I->seeInField('#label-name', 'label1');
        $I->seeInField('#label-country', 'Japan');
        $I->seeInField('#label-url', 'https://label1.example.com/');
        $I->seeInField('#label-link', "https://twitter.com/label1records\nhttps://soundcloud.com/label1records");

        $I->fillField('#label-name', '');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#label-name', 'label-one');
        $I->click('button[type=submit]');
        $I->waitForText('Label has been updated.');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/view/1'));

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->waitForText('Admin: 3', selector: '#menu-action');
        $I->see('label-one', '.grid-view');
        $I->dontSee('label1', '.grid-view');

        $I->click('//*[@id="grid-view-labels"]/table/tbody/tr[1]/td[7]/a[2]/i');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/update/1'));

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->waitForText('Admin: 2', selector: '#menu-action');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/admin'));
        $I->dontSee('label-one', '.grid-view');
    }
}
