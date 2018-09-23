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

namespace app\tests\acceptance\labelTag;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelTagFixture;

class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $I->haveFixtures([
            'label-tags' => LabelTagFixture::class,
        ]);
    }

    public function ensureThatLabelTagDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label-tag/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/label-tag/delete', 'id' => 1]);
    }
}
