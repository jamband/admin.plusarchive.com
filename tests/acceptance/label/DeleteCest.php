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

namespace app\tests\acceptance\label;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelFixture;

class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'labels' => LabelFixture::class,
        ]);
    }

    public function ensureThatLabelDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/label/delete', 'id' => 1]);
    }
}
