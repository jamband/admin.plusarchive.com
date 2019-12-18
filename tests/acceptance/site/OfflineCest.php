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

class OfflineCest
{
    public function ensureThatOfflineWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/site/offline/index']);
    }
}
