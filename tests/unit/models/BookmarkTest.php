<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\Bookmark;
use app\tests\unit\fixtures\bookmark\BookmarkAllFixture;
use Codeception\Test\Unit;
use UnitTester;

class BookmarkTest extends Unit
{
    protected UnitTester $tester;

    public function testAll(): void
    {
        $fixtures['bookmarks'] = BookmarkAllFixture::class;
        $this->tester->haveFixtures($fixtures);

        // no parameters
        $bookmarks = Bookmark::all()->models;
        $this->assertSame(4, count($bookmarks));
        $this->assertSame('bookmark2', $bookmarks[0]->name);

        $this->assertSame(1, count($bookmarks[1]->bookmarkTags));
        $this->assertSame('tag1', $bookmarks[1]->bookmarkTags[0]->name);

        // sort=Name
        $bookmarks = Bookmark::all('Name')->models;
        $this->assertSame(4, count($bookmarks));
        $this->assertSame('bookmark1', $bookmarks[0]->name);

        // country=Japan
        $bookmarks = Bookmark::all(null, 'Japan')->models;
        $this->assertSame(2, count($bookmarks));
        $this->assertSame('bookmark1', $bookmarks[0]->name);
        $this->assertSame('bookmark4', $bookmarks[1]->name);

        // tag=tag1
        $bookmarks = Bookmark::all(null, null, 'tag1')->models;
        $this->assertSame(1, count($bookmarks));
        $this->assertSame('bookmark1', $bookmarks[0]->name);

        // country=Japan&tag=tag2
        $bookmarks = Bookmark::all(null, 'Japan', 'tag2')->models;
        $this->assertSame(0, count($bookmarks));

        // search=3
        $bookmarks = Bookmark::all(null, null, null, '3')->models;
        $this->assertSame(1, count($bookmarks));
        $this->assertSame('bookmark3', $bookmarks[0]->name);
    }
}
