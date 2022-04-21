<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmarks;

use AcceptanceTester;
use app\controllers\bookmarks\DeleteController;
use app\tests\acceptance\fixtures\BookmarkFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see DeleteController
 */
class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['bookmarks'] = BookmarkFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatBookmarksDeleteWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/bookmarks/delete/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->seeMethodNotAllowed('/bookmarks/delete/1');
    }
}
