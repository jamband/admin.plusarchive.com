<?php

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\Playlist;
use app\models\query\PlaylistQuery;
use Codeception\Test\Unit;
use UnitTester;

class PlaylistTest extends Unit
{
    protected UnitTester $tester;

    public function testFind(): void
    {
        $this->assertInstanceOf(PlaylistQuery::class, Playlist::find());
    }
}
