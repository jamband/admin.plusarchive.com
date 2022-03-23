<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;

/**
 * @noinspection PhpUnused
 */
class PrivacyConsentCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPrivacyConsentWorks(AcceptanceTester $I): void
    {
        $I->seeBadRequest(['/site/privacy-consent/index']);

        $I->amOnPage(url(['/']));
        $I->click('Privacy Policy', 'footer');
        $I->seeCurrentUrlEquals('/index-test.php/privacy');

        $I->click('ACCEPT', 'footer');
        $I->waitForText(app()->name, selector: 'footer');
    }
}
