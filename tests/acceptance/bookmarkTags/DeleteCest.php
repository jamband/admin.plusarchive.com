<?php

declare(strict_types=1);

namespace app\tests\acceptance\bookmarkTags;

use AcceptanceTester;
use app\controllers\bookmarkTags\DeleteController;
use app\tests\acceptance\fixtures\BookmarkTagFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see DeleteController
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
    public function ensureThatBookmarkTagsDeleteWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/bookmarkTags/delete/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->seeMethodNotAllowed('/bookmarkTags/delete/1');
    }
}
