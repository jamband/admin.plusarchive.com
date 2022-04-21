<?php

declare(strict_types=1);

namespace app\tests\acceptance\labels;

use AcceptanceTester;
use app\controllers\labels\IndexController;
use app\tests\acceptance\fixtures\LabelFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see IndexController
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
        $I->amOnPage(Url::toRoute('/'));
        $I->click('Label', '#navbar');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels'));
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
        $I->seeCurrentUrlEquals(Url::toRoute('/labels?country=Japan'));
        $I->dontSee('label2');
        $I->dontSee('label3');
        $I->see('1 results');

        $I->click('Reset All');
        $I->seeCurrentUrlEquals(Url::toRoute('/labels'));
        $I->waitForText('3 results');
    }
}
