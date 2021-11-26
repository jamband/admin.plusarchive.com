<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\tests\acceptance\fixtures\HomeFixture;
use Codeception\Util\Locator;

/**
 * @noinspection PhpUnused
 */
class HomeCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = HomeFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatAboutWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/']));
        $I->see('Recent favorite tracks', 'h1');
        $I->see('Search by genres', 'h1');

        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');
        $I->see('track3', '.card-title');

        $I->click('genre1');
        $I->seeCurrentUrlEquals('/index-test.php/tracks?genre=genre1');
        $I->moveBack();

        $I->click('Go to Tracks');
        $I->seeCurrentUrlEquals('/index-test.php/tracks');
        $I->moveBack();

        $I->click(Locator::elementAt('//a[contains(text(), "Playlists")]', 2));
        $I->seeCurrentUrlEquals('/index-test.php/playlists');
        $I->moveBack();
    }
}
