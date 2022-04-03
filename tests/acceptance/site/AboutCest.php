<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;
use app\controllers\site\AboutController;

/**
 * @noinspection PhpUnused
 * @see AboutController
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
