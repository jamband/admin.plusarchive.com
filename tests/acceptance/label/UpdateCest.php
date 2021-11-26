<?php

declare(strict_types=1);

namespace app\tests\acceptance\label;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelFixture;

/**
 * @noinspection PhpUnused
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
    public function ensureThatLabelUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label/update', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/label/admin']));
        $I->click('//*[@id="grid-view-label"]/table/tbody/tr[1]/td[7]/a[2]/i');
        $I->seeCurrentUrlEquals('/index-test.php/labels/update/1');
        $I->see('Label', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/labels/admin');
        $I->moveBack();

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/labels/create');
        $I->moveBack();

        $I->seeInField('#label-name', 'label1');
        $I->seeInField('#label-country', 'Japan');
        $I->seeInField('#label-url', 'https://label1.example.com/');
        $I->seeInField('#label-link', "https://twitter.com/label1records\nhttps://soundcloud.com/label1records");

        $I->fillField('#label-name', '');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->seeElement('.is-invalid');

        $I->fillField('#label-name', 'label-one');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/labels/1');
        $I->see('label has been updated.');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->wait(0.5);
        $I->see('Admin: 3', '#menu-action');
        $I->see('label-one', '.grid-view');
        $I->dontSee('label1', '.grid-view');

        $I->click('//*[@id="grid-view-label"]/table/tbody/tr[1]/td[7]/a[2]/i');
        $I->seeCurrentUrlEquals('/index-test.php/labels/update/1');

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->wait(0.5);
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/labels/admin');
        $I->see('Admin: 2', '#menu-action');
        $I->dontSee('label-one', '.grid-view');
    }
}
