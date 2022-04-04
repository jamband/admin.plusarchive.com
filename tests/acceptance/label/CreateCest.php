<?php

declare(strict_types=1);

namespace app\tests\acceptance\label;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelFixture;
use yii\helpers\Url;

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

        $I->amOnPage(Url::to(['/label/admin']));
        $I->see('Admin: 3', '#menu-action');

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#label-name', 'newlabel');
        $I->fillField('#label-url', 'https://newlabel.example.com');
        $I->click('button[type=submit]');
        $I->waitForText('Label has been added.');
        $I->seeCurrentUrlEquals('/index-test.php/labels/4');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 4', '#menu-action');
    }
}
