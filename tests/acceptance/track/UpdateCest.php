<?php

declare(strict_types=1);

namespace app\tests\acceptance\track;

use AcceptanceTester;
use app\tests\acceptance\fixtures\TrackFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
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
    public function ensureThatTrackUpdateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/track/update', 'id' => 5]);

        $I->loginAsAdmin();

        $I->amOnPage(Url::to(['/track/update', 'id' => 5]));

        $I->seeInField('#trackupdateform-url', $this->fixtures['track5']['url']);
        $I->seeInField('#trackupdateform-title', $this->fixtures['track5']['title']);
        $I->seeInField('#trackupdateform-image', $this->fixtures['track5']['image']);

        $I->fillField('#trackupdateform-title', 'Updated Title');
        $I->click('button[type=submit]');
        $I->waitForText('Track has been updated.');
        $I->seeCurrentUrlEquals('/index-test.php/tracks/admin');
        $I->see('Admin: 5' ,'#menu-action');
        $I->see('Updated Title', ['css' => '.card:nth-child(1)']);
    }
}
