<?php

declare(strict_types=1);

namespace app\tests\acceptance\labelTag;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelTagFixture;
use Facebook\WebDriver\WebDriverKeys;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 */
class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tags'] = LabelTagFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLabelTagAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label-tag/admin']);
        $I->loginAsAdmin();

        $I->amOnPage(Url::to(['/label-tag/admin']));
        $I->see('LabelTag', '#menu-controller');
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag1', '.grid-view');
        $I->see('tag2', '.grid-view');
        $I->see('tag3', '.grid-view');

        $I->fillField('input[name="LabelTagSearch[name]"]', 3);
        $I->pressKey(['name' => 'LabelTagSearch[name]'], WebDriverKeys::ENTER);
        $I->waitForText('Admin: 1', selector: '#menu-action');
        $I->see('tag3', '.grid-view');
        $I->dontSee('tag1', '.grid-view');
        $I->dontSee('tag2', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 3', '#menu-action');
        $I->see('tag1', '.grid-view');
        $I->see('tag2', '.grid-view');
        $I->see('tag3', '.grid-view');
    }
}
