<?php

declare(strict_types=1);

namespace app\tests\acceptance\label;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelFixture;

/**
 * @noinspection PhpUnused
 */
class CreateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['labels'] = LabelFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLabelCreateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label/create']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/label/admin']));
        $I->see('Admin: 3', '#menu-action');

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->seeElement('.is-invalid');

        $I->fillField('#label-name', 'newlabel');
        $I->fillField('#label-url', 'https://newlabel.example.com');
        $I->click('button[type=submit]');
        $I->wait(0.5);
        $I->seeCurrentUrlEquals('/index-test.php/labels/4');
        $I->see('Label has been added.');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 4', '#menu-action');
    }
}
