<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\controllers\site\PrivacyOptOutController;

/**
 * @noinspection PhpUnused
 * @see PrivacyOptOutController
 */
class PrivacyOptOutCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPrivacyOptOutWorks(AcceptanceTester $I): void
    {
        $I->seeBadRequest(['/site/privacy-opt-out/index']);

        $I->amOnPage(url(['/site/privacy/index']));
        $I->see('Privacy Policy', 'footer');
        $I->dontSee(app()->name, 'footer');

        $I->click('ACCEPT', 'footer');
        $I->waitForText(app()->name, selector: 'footer');
        $I->dontSee('Privacy Policy', 'footer');

        $I->click('Opt-Out');
        $I->wait(1);
        $I->seeInPopup('Google Analytics opt-out has been completed.');
        $I->acceptPopup();
        $I->see('Privacy Policy', 'footer');
        $I->dontSee(app()->name, 'footer');
    }
}
