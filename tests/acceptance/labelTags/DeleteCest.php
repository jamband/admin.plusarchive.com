<?php

declare(strict_types=1);

namespace app\tests\acceptance\labelTags;

use AcceptanceTester;
use app\controllers\labelTags\DeleteController;
use app\tests\acceptance\fixtures\LabelTagFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see DeleteController
 */
class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tags'] = LabelTagFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLabelTagsDeleteWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/labelTags/delete/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->seeMethodNotAllowed('/labelTags/delete/1');
    }
}
