<?php

declare(strict_types=1);

namespace app\tests\acceptance\storeTags;

use AcceptanceTester;
use app\controllers\storeTags\DeleteController;
use app\tests\acceptance\fixtures\StoreTagFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see DeleteController
 */
class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tags'] = StoreTagFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatStoreTagsDeleteWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/storeTags/delete/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->seeMethodNotAllowed('/storeTags/delete/1');
    }
}
