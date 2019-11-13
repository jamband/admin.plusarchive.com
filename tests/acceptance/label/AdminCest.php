<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\acceptance\label;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelFixture;
use WebDriverKeys;

class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['labels'] = LabelFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatLabelAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label/admin']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/label/admin']));
        $I->see('Label', '#menu-controller');
        $I->see('Admin: 3', '#menu-action');
        $I->see('label1', '.grid-view');
        $I->see('label2', '.grid-view');
        $I->see('label3', '.grid-view');

        $I->fillField('input[name="LabelSearch[name]"]', 3);
        $I->pressKey(['name' => 'LabelSearch[name]'], WebDriverKeys::ENTER);
        $I->wait(1);
        $I->see('Admin: 1', '#menu-action');
        $I->see('label3', '.grid-view');
        $I->dontSee('label1', '.grid-view');
        $I->dontSee('label2', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->wait(1);
        $I->see('Admin: 3', '#menu-action');
        $I->see('label1', '.grid-view');
        $I->see('label2', '.grid-view');
        $I->see('label3', '.grid-view');

        $I->selectOption('select[name="LabelSearch[country]"]', 'Japan');
        $I->wait(1);
        $I->see('Admin: 1', '#menu-action');
        $I->see('Japan', '.grid-view');
        $I->dontSee('label2', '.grid-view');
        $I->dontSee('label3', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->wait(1);

        $I->fillField('input[name="LabelSearch[link]"]', 'you');
        $I->pressKey(['name' => 'LabelSearch[link]'], WebDriverKeys::ENTER);
        $I->wait(1);
        $I->see('Admin: 1', '#menu-action');
        $I->see('label3', '.grid-view');
        $I->seeElement('.fa-youtube-square');
        $I->dontSee('label1', '.grid-view');
        $I->dontSee('label2', '.grid-view');
    }
}
