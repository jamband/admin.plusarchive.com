<?php

declare(strict_types=1);

namespace app\tests\acceptance\musicGenre;

use AcceptanceTester;
use app\tests\acceptance\fixtures\MusicGenreFixture;

/**
 * @noinspection PhpUnused
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
    public function ensureThatMusicGenreDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/music-genre/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/music-genre/delete', 'id' => 1]);
    }
}
