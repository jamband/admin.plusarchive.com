<?php

declare(strict_types=1);

namespace app\tests\acceptance\labelTag;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelTagFixture;

/**
 * @noinspection PhpUnused
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
    public function ensureThatLabelTagUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label-tag/update', 'id' => 1]);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/label-tag/admin']));
        $I->click('//*[@id="grid-view-label-tag"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/label-tags/update/1');
        $I->see('LabelTag', '#menu-controller');
        $I->see('Update', '#menu-action');

        $I->seeInField('#labeltag-name', 'tag1');

        $I->fillField('#labeltag-name', '');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->seeElement('.is-invalid');

        $I->fillField('#labeltag-name', 'tag-one');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/label-tags/admin');
        $I->see('Label tag has been updated.');
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag-one', '.grid-view');
        $I->dontSee('tag1', '.grid-view');

        $I->click('//*[@id="grid-view-label-tag"]/table/tbody/tr[1]/td[5]/a[1]/i');
        $I->seeCurrentUrlEquals('/index-test.php/label-tags/update/1');

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Delete', '#menu-action + .dropdown-menu');
        $I->acceptPopup();
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/label-tags/admin');
        $I->see('Admin: 2', '#menu-action');
        $I->dontSee('tag-one', '.grid-view');
    }
}
