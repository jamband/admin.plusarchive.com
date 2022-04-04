<?php

declare(strict_types=1);

namespace app\tests\acceptance\track;

use AcceptanceTester;
use app\tests\acceptance\fixtures\TrackFixture;
use yii\helpers\Url;

/**
 * @noinspection PhpUnused
 */
class CreateCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tracks'] = TrackFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatTrackCreateWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/track/create']);

        $I->loginAsAdmin();

        $I->amOnPage(Url::to(['/track/admin']));
        $I->click('#menu-action');
        $I->click('Create', '#menu-action + .dropdown-menu');
        $I->seeCurrentUrlEquals('/index-test.php/tracks/create');
        $I->see('Track', '#menu-controller');
        $I->see('Create', '#menu-action');
        $I->click('button[type=submit]');
        $I->waitForElement('.is-invalid');

        $I->fillField('#trackcreateform-url', 'https://www.youtube.com/watch?v=foo');
        $I->selectOption('#trackcreateform-tagvalues', ['genre1', 'genre2']);
        $I->click('button[type=submit]');
        $I->waitForText('New track has been added.');
        $I->seeCurrentUrlEquals('/index-test.php/tracks/admin');
        $I->see('Admin: 6' ,'#menu-action');
        $I->see('Foo Title', ['css' => '.card:nth-child(1)']);
        $I->see('genre1 genre2', ['css' => '.card:nth-child(1)']);
    }
}
