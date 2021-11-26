<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;

/**
 * @noinspection PhpUnused
 */
class PrivacyCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatPrivacyWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/site/privacy/index']));
        $I->see('Privacy Policy', 'h1');
    }
}
