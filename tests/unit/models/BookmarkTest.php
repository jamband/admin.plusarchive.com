<?php

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\Bookmark;
use app\models\query\BookmarkQuery;
use Codeception\Test\Unit;
use UnitTester;

/** @see Bookmark */
class BookmarkTest extends Unit
{
    protected UnitTester $tester;

    public function testFind(): void
    {
        $this->assertInstanceOf(BookmarkQuery::class, Bookmark::find());
    }
}
