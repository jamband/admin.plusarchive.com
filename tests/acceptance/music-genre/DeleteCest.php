<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\acceptance\musicGenre;

use AcceptanceTester;
use app\tests\acceptance\fixtures\MusicGenreFixture;

class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['genres'] = MusicGenreFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatMusicGenreDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/music-genre/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/music-genre/delete', 'id' => 1]);
    }
}
