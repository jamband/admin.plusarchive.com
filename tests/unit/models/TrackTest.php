<?php

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\query\TrackQuery;
use app\models\Track;
use app\tests\unit\fixtures\music\TrackStopAllUrgeFixture;
use Codeception\Test\Unit;
use UnitTester;

class TrackTest extends Unit
{
    protected UnitTester $tester;

    public function testFind(): void
    {
        $this->assertInstanceOf(TrackQuery::class, Track::find());
    }

    public function testStopAllUrge(): void
    {
        $fixtures['tracks'] = TrackStopAllUrgeFixture::class;
        $this->tester->haveFixtures($fixtures);

        Track::stopAllUrge();
        $this->assertSame('0', Track::find()->where(['urge' => 1])->count());
    }
}
