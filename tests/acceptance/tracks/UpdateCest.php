<?php

declare(strict_types=1);

namespace app\tests\acceptance\tracks;

use AcceptanceTester;
use app\controllers\tracks\UpdateController;
use app\tests\acceptance\fixtures\TrackFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 * @see UpdateController
 */
class UpdateCest
{
    private mixed $fixtures;

    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackFixture::class;
        $I->haveFixtures($fixtures);
        $this->fixtures = $I->grabFixture('tracks');
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatTracksUpdateWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(Url::toRoute('/tracks/update/5'));
        $I->seeInCurrentUrl(Url::toRoute('/login'));

        $I->loginAsAdmin();

        $I->amOnPage(Url::toRoute('/tracks/update/5'));

        $I->seeInField('#trackupdateform-url', $this->fixtures['track5']['url']);
        $I->seeInField('#trackupdateform-title', $this->fixtures['track5']['title']);
        $I->seeInField('#trackupdateform-image', $this->fixtures['track5']['image']);

        $I->fillField('#trackupdateform-title', 'Updated Title');
        $I->click('button[type=submit]');
        $I->waitForText('Track has been updated.');
        $I->seeCurrentUrlEquals(Url::toRoute('/tracks/admin'));
        $I->see('Admin: 5' ,'#menu-action');
        $I->see('Updated Title', ['css' => '.card:nth-child(1)']);
    }
}
