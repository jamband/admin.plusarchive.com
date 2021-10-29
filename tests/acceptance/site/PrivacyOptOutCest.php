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

/**
 * @noinspection PhpUnused
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
        $I->wait(0.5);
        $I->see(app()->name, 'footer');
        $I->dontSee('Privacy Policy', 'footer');

        $I->click('Opt-Out');
        $I->wait(0.5);
        $I->seeInPopup('Google Analytics opt-out has been completed.');
        $I->acceptPopup();
        $I->see('Privacy Policy', 'footer');
        $I->dontSee(app()->name, 'footer');
    }
}
