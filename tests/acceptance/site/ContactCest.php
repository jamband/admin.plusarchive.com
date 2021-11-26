<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;

/**
 * @noinspection PhpUnused
 */
class ContactCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatContactWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/site/contact/index']));
        $I->see('Contact', 'h1');
    }
}
