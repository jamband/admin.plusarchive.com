<?php

declare(strict_types=1);

namespace app\tests\unit\models\query;

use app\models\query\StoreQuery;
use app\models\Store;
use app\tests\unit\fixtures\store\StoreQueryBehaviorsFixture;
use app\tests\unit\fixtures\store\StoreQueryCountryFixture;
use app\tests\unit\fixtures\store\StoreQueryInNameOrderFixture;
use app\tests\unit\fixtures\store\StoreQueryLatestFixture;
use app\tests\unit\fixtures\store\StoreQuerySearchFixture;
use Codeception\Test\Unit;
use UnitTester;

/** @see StoreQuery */
class StoreQueryTest extends Unit
{
    protected UnitTester $tester;

    public function testBehaviors(): void
    {
        $fixtures['stores'] = StoreQueryBehaviorsFixture::class;
        $this->tester->haveFixtures($fixtures);

        $stores = Store::find()->allTagValues('tag1')->all();
        $this->assertSame(1, count($stores));
        $this->assertSame('store1', $stores[0]->name);
    }

    public function testCountry(): void
    {
        $fixtures['stores'] = StoreQueryCountryFixture::class;
        $this->tester->haveFixtures($fixtures);

        $stores = Store::find()->country(null)->all();
        $this->assertSame(0, count($stores));

        $stores = Store::find()->country('Foo')->all();
        $this->assertSame(0, count($stores));

        $stores = Store::find()->country('Japan')->all();
        $this->assertSame(2, count($stores));
        $this->assertSame('Japan', $stores[0]->country);
        $this->assertSame('Japan', $stores[1]->country);

        $stores = Store::find()->country('US')->all();
        $this->assertSame(1, count($stores));
        $this->assertSame('US', $stores[0]->country);
    }

    public function testSearch(): void
    {
        $fixtures['stores'] = StoreQuerySearchFixture::class;
        $this->tester->haveFixtures($fixtures);

        $stores = Store::find()->search('')->all();
        $this->assertSame(3, count($stores));

        $stores = Store::find()->search('fo')->all();
        $this->assertSame(1, count($stores));
        $this->assertSame('foo', $stores[0]->name);

        $stores = Store::find()->search('ba')->orderBy(['name' => SORT_ASC])->all();
        $this->assertSame(2, count($stores));
        $this->assertSame('bar', $stores[0]->name);
        $this->assertSame('baz', $stores[1]->name);

        $stores = Store::find()->search('cloud')->orderBy(['name' => SORT_ASC])->all();
        $this->assertSame(2, count($stores));
        $this->assertSame('baz', $stores[0]->name);
        $this->assertSame('foo', $stores[1]->name);
    }

    public function testInNameOrder(): void
    {
        $fixtures['stores'] = StoreQueryInNameOrderFixture::class;
        $this->tester->haveFixtures($fixtures);

        $stores = Store::find()->inNameOrder()->all();
        $this->assertSame(3, count($stores));
        $this->assertSame('bar', $stores[0]->name);
        $this->assertSame('baz', $stores[1]->name);
        $this->assertSame('foo', $stores[2]->name);
    }

    public function testLatest(): void
    {
        $fixtures['stores'] = StoreQueryLatestFixture::class;
        $this->tester->haveFixtures($fixtures);

        $stores = Store::find()->latest()->all();
        $this->assertSame(3, count($stores));
        $this->assertSame('store1', $stores[0]->name);
        $this->assertSame('store3', $stores[1]->name);
        $this->assertSame('store2', $stores[2]->name);
    }
}
