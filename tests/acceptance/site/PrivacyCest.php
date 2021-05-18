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

class PrivacyCest
{
    public function ensureThatPrivacyWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/site/privacy/index']));
        $I->see('Privacy Policy', 'h1');
    }
}
