<?php

/*
 * This file is part of the admin.plusarchive.com
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
use Facebook\WebDriver\WebDriverKeys;

/**
 * @noinspection PhpUnused
 */
class AdminCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['genres'] = MusicGenreFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatMusicGenreAdminWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/music-genre/admin']);
        $I->loginAsAdmin();

        $I->amOnPage(url(['/music-genre/admin']));
        $I->see('MusicGenre', '#menu-controller');
        $I->see('Admin: 5', '#menu-action');
        $I->see('genre1', '.grid-view');
        $I->see('genre2', '.grid-view');
        $I->see('genre3', '.grid-view');

        $I->fillField('input[name="MusicGenreSearch[name]"]', 3);
        $I->pressKey(['name' => 'MusicGenreSearch[name]'], WebDriverKeys::ENTER);
        $I->wait(0.5);
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
