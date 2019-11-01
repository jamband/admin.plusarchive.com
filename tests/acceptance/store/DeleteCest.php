<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\acceptance\store;

use AcceptanceTester;
use app\tests\acceptance\fixtures\StoreFixture;

class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'stores' => StoreFixture::class,
        ]);
    }

    public function ensureThatStoreDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label/store', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/store/delete', 'id' => 1]);
    }
}