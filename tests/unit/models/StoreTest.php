<?php

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\query\StoreQuery;
use app\models\Store;
use Codeception\Test\Unit;
use UnitTester;

/** @see Store */
class StoreTest extends Unit
{
    protected UnitTester $tester;

    public function testFind(): void
    {
        $this->assertInstanceOf(StoreQuery::class, Store::find());
    }
}
