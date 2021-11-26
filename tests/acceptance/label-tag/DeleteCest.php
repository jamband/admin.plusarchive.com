<?php

declare(strict_types=1);

namespace app\tests\acceptance\labelTag;

use AcceptanceTester;
use app\tests\acceptance\fixtures\LabelTagFixture;

/**
 * @noinspection PhpUnused
 */
class DeleteCest
{
    public function _before(AcceptanceTester $I): void
    {
        $fixtures['tags'] = LabelTagFixture::class;
        $I->haveFixtures($fixtures);
    }

    /**
     * @noinspection PhpUnused
     */
    public function ensureThatLabelTagDeleteWorks(AcceptanceTester $I): void
    {
        $I->seePageNotFound(['/label-tag/delete', 'id' => 1]);
        $I->loginAsAdmin();
        $I->seeMethodNotAllowed(['/label-tag/delete', 'id' => 1]);
    }
}
