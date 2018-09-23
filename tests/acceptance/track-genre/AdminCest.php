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

namespace app\tests\acceptance\trackGenre;

use AcceptanceTester;
use app\tests\acceptance\fixtures\TrackGenreFixture;
use WebDriverKeys;

class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'track-genres' => TrackGenreFixture::class,
        ]);
    }

    public function ensureThatTrackGenreAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/track-genre/admin']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/track-genre/admin']));
        $I->see('TrackGenre', '#menu-controller');
        $I->see('Admin: 5', '#menu-action');
        $I->see('genre1', '.grid-view');
        $I->see('genre2', '.grid-view');
        $I->see('genre3', '.grid-view');

        $I->fillField('input[name="TrackGenreSearch[name]"]', 3);
        $I->pressKey(['name' => 'TrackGenreSearch[name]'], WebDriverKeys::ENTER);
        $I->wait(1);
        $I->see('Admin: 1', '#menu-action');
        $I->see('genre3', '.grid-view');
        $I->dontSee('genre1', '.grid-view');
        $I->dontSee('genre2', '.grid-view');

        $I->click('#menu-action');
        $I->click('Admin', '#menu-action + .dropdown-menu');
        $I->see('Admin: 5', '#menu-action');
        $I->see('genre1', '.grid-view');
        $I->see('genre2', '.grid-view');
        $I->see('genre3', '.grid-view');
    }
}
