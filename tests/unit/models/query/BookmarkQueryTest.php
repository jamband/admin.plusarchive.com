<?php

declare(strict_types=1);

namespace app\tests\unit\models\query;

use app\models\Bookmark;
use app\models\query\BookmarkQuery;
use app\tests\unit\fixtures\bookmark\BookmarkQueryBehaviorsFixture;
use app\tests\unit\fixtures\bookmark\BookmarkQueryCountryFixture;
use app\tests\unit\fixtures\bookmark\BookmarkQueryInNameOrderFixture;
use app\tests\unit\fixtures\bookmark\BookmarkQueryLatestFixture;
use app\tests\unit\fixtures\bookmark\BookmarkQuerySearchFixture;
use Codeception\Test\Unit;
use UnitTester;

/** @see BookmarkQuery */
class BookmarkQueryTest extends Unit
{
    protected UnitTester $tester;

    public function testBehaviors(): void
    {
        $fixtures['bookmarks'] = BookmarkQueryBehaviorsFixture::class;
        $this->tester->haveFixtures($fixtures);

        $bookmarks = Bookmark::find()->allTagValues('tag1')->all();
        $this->assertSame(1, count($bookmarks));
        $this->assertSame('bookmark1', $bookmarks[0]->name);
    }

    public function testCountry(): void
    {
        $fixtures['bookmarks'] = BookmarkQueryCountryFixture::class;
        $this->tester->haveFixtures($fixtures);

        $bookmarks = Bookmark::find()->country(null)->all();
        $this->assertSame(0, count($bookmarks));

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
        $fixtures['bookmarks'] = BookmarkQuerySearchFixture::class;
        $this->tester->haveFixtures($fixtures);

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
        $fixtures['bookmarks'] = BookmarkQueryInNameOrderFixture::class;
        $this->tester->haveFixtures($fixtures);

        $bookmarks = Bookmark::find()->inNameOrder()->all();
        $this->assertSame(3, count($bookmarks));
        $this->assertSame('bar', $bookmarks[0]->name);
        $this->assertSame('baz', $bookmarks[1]->name);
        $this->assertSame('foo', $bookmarks[2]->name);
    }

    public function testLatest(): void
    {
        $fixtures['bookmarks'] = BookmarkQueryLatestFixture::class;
        $this->tester->haveFixtures($fixtures);

        $bookmarks = Bookmark::find()->latest()->all();
        $this->assertSame(3, count($bookmarks));
        $this->assertSame('bookmark1', $bookmarks[0]->name);
        $this->assertSame('bookmark3', $bookmarks[1]->name);
        $this->assertSame('bookmark2', $bookmarks[2]->name);
    }
}
