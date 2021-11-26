<?php

declare(strict_types=1);

namespace app\tests\acceptance\storeTag;

use AcceptanceTester;
use app\tests\acceptance\fixtures\StoreTagFixture;

/**
 * @noinspection PhpUnused
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
    public function ensureThatStoreTagDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/store-tag/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/store-tag/delete', 'id' => 1]);
    }
}
