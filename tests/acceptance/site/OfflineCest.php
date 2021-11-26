<?php

declare(strict_types=1);

namespace app\tests\acceptance\site;

use AcceptanceTester;

/**
 * @noinspection PhpUnused
 */
class OfflineCest
{
    /**
     * @noinspection PhpUnused
     */
    public function ensureThatOfflineWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/site/offline/index']);
    }
}
