<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;

/**
 * @noinspection PhpUnused
 */
class AboutCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatAboutWorks(AcceptanceTester $I): void
    {
        $I->amOnPage(url(['/site/about/index']));
        $I->see('About', 'h1');
    }
}
