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

namespace app\tests\acceptance\site;

use AcceptanceTester;

class PrivacyConsentCest
{
    public function ensureThatPrivacyConsentWorks(AcceptanceTester $I): void
    {
        $I->seeBadRequest(['/site/privacy-consent/index']);

        $I->amOnPage(url(['/']));
        $I->click('Privacy Policy', 'footer');
        $I->seeCurrentUrlEquals('/index-test.php/privacy');

        $I->click('ACCEPT', 'footer');
        $I->wait(0.5);
        $I->see(app()->name, 'footer');
    }
}
