<?php

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\Music;
use app\models\Track;
use app\tests\unit\fixtures\music\TrackQueryFindFixture;
use app\tests\unit\fixtures\music\TrackStopAllUrgeFixture;
use Codeception\Test\Unit;
use UnitTester;

class TrackTest extends Unit
{
    protected UnitTester $tester;

    public function testFind(): void
    {
        $fixtures['tracks'] = TrackQueryFindFixture::class;
        $this->tester->haveFixtures($fixtures);

        $tracks = Track::find()->all();
        $this->assertSame(2, count($tracks));
        $this->assertSame(Music::TYPE_TRACK, $tracks[0]->type);
        $this->assertSame(Music::TYPE_TRACK, $tracks[1]->type);
    }

    public function testStopAllUrge(): void
    {
        $fixtures['tracks'] = TrackStopAllUrgeFixture::class;
        $this->tester->haveFixtures($fixtures);

        Track::stopAllUrge();
        $this->assertSame('0', Track::find()->where(['urge' => 1])->count());
    }
}
