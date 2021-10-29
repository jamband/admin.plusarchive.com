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
class ThirdPartyLicensesCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatThirdPartyLicensesWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/site/third-party-licenses/index']));
        $I->see('Third-Party Licenses', 'h1');
        $I->see('jquery');
    }
}
