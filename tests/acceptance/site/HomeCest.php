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

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\tests\acceptance\fixtures\HomeFixture;

class HomeCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = HomeFixture::class;
        $I->haveFixtures($fixtures);
    }

    public function ensureThatAboutWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->see('Recent favorite tracks', 'h2');
        $I->see('Search by genres', 'h2');

        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');
        $I->see('track3', '.card-title');

        $I->click('genre1');
        $I->seeCurrentUrlEquals('/index-test.php/tracks?genre=genre1');
        $I->moveBack();

        $I->click('Go to Tracks');
        $I->seeCurrentUrlEquals('/index-test.php/tracks');
        $I->moveBack();

        $I->click('Playlists');
        $I->seeCurrentUrlEquals('/index-test.php/playlists');
        $I->moveBack();
    }
}
