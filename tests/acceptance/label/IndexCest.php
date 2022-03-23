<?php

declare(strict_types=1);

namespace app\tests\acceptance\label;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelFixture;

/**
 * @noinspection PhpUnused
 */
class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['labels'] = LabelFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLabelsWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->click('Label', '#navbar');
        $I->seeCurrentUrlEquals('/index-test.php/labels');
        $I->see('Labels', 'h1');

        $I->see('label1');
        $I->see('label2');
        $I->see('label3');
        $I->seeElement('.fa-soundcloud');
        $I->seeElement('.fa-youtube-square');
        $I->seeElement('.fa-twitter-square');
        $I->see('3 results');

        $I->click('Countries', '.col-lg-4');
        $I->click('Japan', '.col-lg-4');
        $I->waitForText('label1');
        $I->seeCurrentUrlEquals('/index-test.php/labels?country=Japan');
        $I->dontSee('label2');
        $I->dontSee('label3');
        $I->see('1 results');

        $I->click('Reset All');
        $I->seeCurrentUrlEquals('/index-test.php/labels');
        $I->waitForText('3 results');
    }
}
