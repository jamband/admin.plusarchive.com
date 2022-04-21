<?php

declare(strict_types=1);

namespace app\tests\acceptance\labels;

use AcceptanceTester;
use app\controllers\labels\CreateController;
use app\tests\acceptance\fixtures\LabelFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see CreateController
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
    public function ensureThatLabelsCreateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/labels/create'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/labels/admin'));
        $I->see('Admin: 3', '#menu-action');

        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#label-name', 'new_label');
        $I->fillField('#label-url', 'https://newlabel.example.com');
        $I->click('button[type=submit]');
        $I->waitForText('Label has been added.');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels/view/4'));

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 4', '#menu-action');
    }
}
