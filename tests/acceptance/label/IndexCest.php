<?php

/*
 * This file is part of the admin.plusarchive.com
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

class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['labels'] = LabelFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatLabelsWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->click('Label', '.navbar');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/labels');
        $I->see('Labels', 'h2');

        $I->see('label1', '.card-container');
        $I->see('label2', '.card-container');
        $I->see('label3', '.card-container');
        $I->seeElement('.fa-soundcloud');
        $I->seeElement('.fa-youtube-square');
        $I->seeElement('.fa-twitter-square');
        $I->see('3 results', '.total-count');

        $I->click('Countries', '.col-sm-4');
        $I->wait(1);
        $I->click('Japan', '.col-sm-4');
        $I->wait(1);
        $I->seeCurrentUrlEquals('/index-test.php/labels?country=Japan');
        $I->see('label1', '.card-container');
        $I->dontSee('label2', '.card-container');
        $I->dontSee('label3', '.card-container');
        $I->see('1 results', '.total-count');

        $I->click('Reset All', '.col-sm-4');
        $I->seeCurrentUrlEquals('/index-test.php/labels');
        $I->wait(1);
        $I->see('3 results', '.total-count');
    }
}
