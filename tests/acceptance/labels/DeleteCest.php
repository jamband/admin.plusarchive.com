<?php

declare(strict_types=1);

namespace app\tests\acceptance\labels;

use AcceptanceTester;
use app\controllers\labels\DeleteController;
use app\tests\acceptance\fixtures\LabelFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see DeleteController
 */
class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['labels'] = LabelFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLabelsDeleteWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/labels/delete/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->seeMethodNotAllowed('/labels/delete/1');
    }
}
