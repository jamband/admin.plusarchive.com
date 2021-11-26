<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmarkTag;

use AcceptanceTester;
use app\tests\acceptance\fixtures\BookmarkTagFixture;

/**
 * @noinspection PhpUnused
 */
class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tags'] = BookmarkTagFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatBookmarkTagDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/bookmark-tag/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/bookmark-tag/delete', 'id' => 1]);
    }
}
