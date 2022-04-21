<?php

declare(strict_types=1);

namespace app\tests\acceptance\tracks;

use AcceptanceTester;
use app\controllers\tracks\StopAllUrgeController;
use app\tests\acceptance\fixtures\TrackStopAllUrgeFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see StopAllUrgeController
 */
class StopAllUrgeCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackStopAllUrgeFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatTracksStopAllUrgeWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/tracks/stop-all-urge'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();
        $I->seeMethodNotAllowed('/tracks/stop-all-urge');

        $I->amOnPage(Url::toRoute('/admin'));
        $I->see('Action', '#menu-action');
        $I->see('track1', '.card-title');
        $I->see('track2', '.card-title');
        $I->see('track3', '.card-title');

        $I->click('#menu-action');
        $I->click('Stop All Urge');
        $I->seeInPopup('Are you sure?');
        $I->cancelPopup();

        $I->click('#menu-action');
        $I->click('Stop All Urge');
        $I->acceptPopup();
        $I->seeCurrentUrlEquals(Url::toRoute('/admin'));
        $I->dontSee('track1', '.card-title');
        $I->dontSee('track2', '.card-title');
        $I->dontSee('track3', '.card-title');
    }
}
