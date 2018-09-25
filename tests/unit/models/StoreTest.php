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

namespace app\tests\unit\models;

use app\models\Store;
use app\tests\unit\fixtures\store\StoreAllFixture;
use Codeception\Test\Unit;

class StoreTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testAll(): void
    {
        $this->tester->haveFixtures([
            StoreAllFixture::class,
        ]);

        // no parameters
        $stores = Store::all()->models;
        $this->assertSame(4, count($stores));
        $this->assertSame('store2', $stores[0]->name);

        $this->assertSame(1, count($stores[1]->storeTags));
        $this->assertSame('tag1', $stores[1]->storeTags[0]->name);

        // sort=Name
        $stores = Store::all('Name')->models;
        $this->assertSame(4, count($stores));
        $this->assertSame('store1', $stores[0]->name);

        // country=Japan
        $stores = Store::all(null, 'Japan')->models;
        $this->assertSame(2, count($stores));
        $this->assertSame('store1', $stores[0]->name);
        $this->assertSame('store4', $stores[1]->name);

        // tag=tag1
        $stores = Store::all(null, null, 'tag1')->models;
        $this->assertSame(1, count($stores));
        $this->assertSame('store1', $stores[0]->name);

        // country=Japan&tag=tag2
        $stores = Store::all(null, 'Japan', 'tag2')->models;
        $this->assertSame(0, count($stores));

        // search=3
        $stores = Store::all(null, null, null, '3')->models;
        $this->assertSame(1, count($stores));
        $this->assertSame('store3', $stores[0]->name);
    }
}
