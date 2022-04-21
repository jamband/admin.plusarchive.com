<?php

declare(strict_types=1);

namespace app\tests\acceptance\musicGenres;

use AcceptanceTester;
use app\controllers\musicGenres\DeleteController;
use app\tests\acceptance\fixtures\MusicGenreFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see DeleteController
 */
class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['genres'] = MusicGenreFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatMusicGenresDeleteWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/musicGenres/delete/1'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();
        $I->seeMethodNotAllowed('/musicGenres/delete/1');
    }
}
