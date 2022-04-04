<?php

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\Store;
use app\tests\unit\fixtures\store\StoreAllFixture;
use Codeception\Test\Unit;
use UnitTester;

class StoreTest extends Unit
{
    protected UnitTester $tester;

    public function testAll(): void
    {
        $fixtures['stores'] = StoreAllFixture::class;
        $this->tester->haveFixtures($fixtures);

        // no parameters
        $stores = Store::all()->models;
        $this->assertSame(4, count($stores));
        $this->assertSame('store2', $stores[0]->name);

        $this->assertSame(1, count($stores[1]->tags));
        $this->assertSame('tag1', $stores[1]->tags[0]->name);

        // country=Japan
        $stores = Store::all(country: 'Japan')->models;
        $this->assertSame(2, count($stores));
        $this->assertSame('store1', $stores[0]->name);
        $this->assertSame('store4', $stores[1]->name);

        // tag=tag1
        $stores = Store::all(tag: 'tag1')->models;
        $this->assertSame(1, count($stores));
        $this->assertSame('store1', $stores[0]->name);

        // country=Japan&tag=tag2
        $stores = Store::all(country: 'Japan', tag: 'tag2')->models;
        $this->assertSame(0, count($stores));

        // search=3
        $stores = Store::all(search: '3')->models;
        $this->assertSame(1, count($stores));
        $this->assertSame('store3', $stores[0]->name);
    }
}
