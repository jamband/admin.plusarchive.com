<?php

declare(strict_types=1);

namespace app\tests\acceptance\labels;

use AcceptanceTester;
use app\controllers\labels\AdminController;
use app\tests\acceptance\fixtures\LabelFixture;
use Facebook\WebDriver\WebDriverKeys;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see AdminController
 */
class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['labels'] = LabelFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLabelsAdminWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/labels/admin'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/labels/admin'));
        $I->see('Label', '#menu-controller');
        $I->see('Admin: 3', '#menu-action');
        $I->see('label1', '.grid-view');
        $I->see('label2', '.grid-view');
        $I->see('label3', '.grid-view');

        $I->fillField('input[name="LabelSearch[name]"]', 3);
        $I->pressKey(['name' => 'LabelSearch[name]'], WebDriverKeys::ENTER);
        $I->waitForText('Admin: 1', selector: '#menu-action');
        $I->see('label3', '.grid-view');
        $I->dontSee('label1', '.grid-view');
        $I->dontSee('label2', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 3', '#menu-action');
        $I->see('label1', '.grid-view');
        $I->see('label2', '.grid-view');
        $I->see('label3', '.grid-view');

        $I->selectOption('select[name="LabelSearch[country]"]', 'Japan');
        $I->waitForText('Admin: 1', selector: '#menu-action');
        $I->see('Japan', '.grid-view');
        $I->dontSee('label2', '.grid-view');
        $I->dontSee('label3', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');

        $I->fillField('input[name="LabelSearch[link]"]', 'you');
        $I->pressKey(['name' => 'LabelSearch[link]'], WebDriverKeys::ENTER);
        $I->waitForText('Admin: 1', selector: '#menu-action');
        $I->see('label3', '.grid-view');
        $I->seeElement('.fa-youtube-square');
        $I->dontSee('label1', '.grid-view');
        $I->dontSee('label2', '.grid-view');
    }
}
