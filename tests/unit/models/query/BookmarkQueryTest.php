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

namespace app\tests\unit\models\query;

use app\models\Bookmark;
use app\tests\unit\fixtures\bookmark\BookmarkQueryBehaviorsFixture;
use app\tests\unit\fixtures\bookmark\BookmarkQueryCountryFixture;
use app\tests\unit\fixtures\bookmark\BookmarkQueryInNameOrderFixture;
use app\tests\unit\fixtures\bookmark\BookmarkQuerySearchFixture;
use app\tests\unit\fixtures\bookmark\BookmarkQuerySortFixture;
use Codeception\Test\Unit;

class BookmarkQueryTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testBehaviors(): void
    {
        $this->tester->haveFixtures([
            BookmarkQueryBehaviorsFixture::class,
        ]);

        $bookmarks = Bookmark::find()->allTagValues('tag1')->all();
        $this->assertSame(1, count($bookmarks));
        $this->assertSame('bookmark1', $bookmarks[0]->name);
    }

    public function testCountry(): void
    {
        $this->tester->haveFixtures([
            BookmarkQueryCountryFixture::class,
        ]);

        $bookmarks = Bookmark::find()->country(null)->all();
        $this->assertSame(4, count($bookmarks));

        $bookmarks = Bookmark::find()->country('Foo')->all();
        $this->assertSame(0, count($bookmarks));

        $bookmarks = Bookmark::find()->country('Japan')->all();
        $this->assertSame(2, count($bookmarks));
        $this->assertSame('Japan', $bookmarks[0]->country);
        $this->assertSame('Japan', $bookmarks[1]->country);

        $bookmarks = Bookmark::find()->country('US')->all();
        $this->assertSame(1, count($bookmarks));
        $this->assertSame('US', $bookmarks[0]->country);
    }

    public function testSearch(): void
    {
        $this->tester->haveFixtures([
            BookmarkQuerySearchFixture::class,
        ]);

        $bookmarks = Bookmark::find()->search('')->all();
        $this->assertSame(3, count($bookmarks));

        $bookmarks = Bookmark::find()->search('fo')->all();
        $this->assertSame(1, count($bookmarks));
        $this->assertSame('foo', $bookmarks[0]->name);

        $bookmarks = Bookmark::find()->search('ba')->orderBy(['name' => SORT_ASC])->all();
        $this->assertSame(2, count($bookmarks));
        $this->assertSame('bar', $bookmarks[0]->name);
        $this->assertSame('baz', $bookmarks[1]->name);

        $bookmarks = Bookmark::find()->search('cloud')->orderBy(['name' => SORT_ASC])->all();
        $this->assertSame(2, count($bookmarks));
        $this->assertSame('baz', $bookmarks[0]->name);
        $this->assertSame('foo', $bookmarks[1]->name);
    }

    public function testInNameOrder(): void
    {
        $this->tester->haveFixtures([
            BookmarkQueryInNameOrderFixture::class,
        ]);

        $bookmarks = Bookmark::find()->inNameOrder()->all();
        $this->assertSame(3, count($bookmarks));
        $this->assertSame('bar', $bookmarks[0]->name);
        $this->assertSame('baz', $bookmarks[1]->name);
        $this->assertSame('foo', $bookmarks[2]->name);
    }

    public function testSort(): void
    {
        $this->tester->haveFixtures([
            BookmarkQuerySortFixture::class,
        ]);

        $bookmarks = Bookmark::find()->sort('Name')->all();
        $this->assertSame(3, count($bookmarks));
        $this->assertSame('bar', $bookmarks[0]->name);
        $this->assertSame('baz', $bookmarks[1]->name);
        $this->assertSame('foo', $bookmarks[2]->name);

        $bookmarks = Bookmark::find()->sort('Foo')->all();
        $this->assertSame(3, count($bookmarks));
        $this->assertSame('foo', $bookmarks[0]->name);
        $this->assertSame('baz', $bookmarks[1]->name);
        $this->assertSame('bar', $bookmarks[2]->name);

        $bookmarks = Bookmark::find()->sort(null)->all();
        $this->assertSame(3, count($bookmarks));
        $this->assertSame('foo', $bookmarks[0]->name);
        $this->assertSame('baz', $bookmarks[1]->name);
        $this->assertSame('bar', $bookmarks[2]->name);
    }
}
