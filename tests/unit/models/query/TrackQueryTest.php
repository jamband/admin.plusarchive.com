<?php

declare(strict_types=1);

namespace app\tests\unit\models\query;

use app\models\Music;
use app\models\query\TrackQuery;
use app\models\Track;
use app\tests\unit\fixtures\music\TrackQueryBehaviorsFixture;
use app\tests\unit\fixtures\music\TrackQueryFavoritesFixture;
use app\tests\unit\fixtures\music\TrackQueryInitFixture;
use app\tests\unit\fixtures\music\TrackQueryInTitleOrderFixture;
use app\tests\unit\fixtures\music\TrackQueryLatestFixture;
use app\tests\unit\fixtures\music\TrackQueryProviderFixture;
use app\tests\unit\fixtures\music\TrackQuerySearchFixture;
use Codeception\Test\Unit;
use UnitTester;

/** @see TrackQuery */
class TrackQueryTest extends Unit
{
    protected UnitTester $tester;

    public function testInit(): void
    {
        $fixtures['tracks'] = TrackQueryInitFixture::class;
        $this->tester->haveFixtures($fixtures);

        $tracks = Track::find()->all();
        $this->assertSame(2, count($tracks));
        $this->assertSame(Music::TYPE_TRACK, $tracks[0]->type);
        $this->assertSame(Music::TYPE_TRACK, $tracks[1]->type);
    }

    public function testBehaviors(): void
    {
        $fixtures['tracks'] = TrackQueryBehaviorsFixture::class;
        $this->tester->haveFixtures($fixtures);

        $tracks = Track::find()->allTagValues('genre1')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame('track1', $tracks[0]->title);
    }

    public function testProvider(): void
    {
        $fixtures['tracks'] = TrackQueryProviderFixture::class;
        $this->tester->haveFixtures($fixtures);

        $tracks = Track::find()->provider(null)->all();
        $this->assertSame(0, count($tracks));

        $tracks = Track::find()->provider('Foo')->all();
        $this->assertSame(0, count($tracks));

        $tracks = Track::find()->provider('Bandcamp')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame(Music::PROVIDER_BANDCAMP, $tracks[0]->provider);

        $tracks = Track::find()->provider('SoundCloud')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame(Music::PROVIDER_SOUNDCLOUD, $tracks[0]->provider);

        $tracks = Track::find()->provider('Vimeo')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame(Music::PROVIDER_VIMEO, $tracks[0]->provider);

        $tracks = Track::find()->provider('YouTube')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame(Music::PROVIDER_YOUTUBE, $tracks[0]->provider);
    }

    public function testSearch(): void
    {
        $fixtures['tracks'] = TrackQuerySearchFixture::class;
        $this->tester->haveFixtures($fixtures);

        $tracks = Track::find()->search('')->all();
        $this->assertSame(3, count($tracks));

        $tracks = Track::find()->search('o')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame('foo', $tracks[0]->title);

        $tracks = Track::find()->search('ba')->orderBy(['title' => SORT_ASC])->all();
        $this->assertSame(2, count($tracks));
        $this->assertSame('bar', $tracks[0]->title);
        $this->assertSame('baz', $tracks[1]->title);
    }

    public function testInTitleOrder(): void
    {
        $fixtures['tracks'] = TrackQueryInTitleOrderFixture::class;
        $this->tester->haveFixtures($fixtures);

        $tracks = Track::find()->inTitleOrder()->all();
        $this->assertSame(3, count($tracks));
        $this->assertSame('bar', $tracks[0]->title);
        $this->assertSame('baz', $tracks[1]->title);
        $this->assertSame('foo', $tracks[2]->title);
    }

    public function testLatest(): void
    {
        $fixtures['tracks'] = TrackQueryLatestFixture::class;
        $this->tester->haveFixtures($fixtures);

        $tracks = Track::find()->latest()->all();
        $this->assertSame(3, count($tracks));
        $this->assertSame('track1', $tracks[0]->title);
        $this->assertSame('track3', $tracks[1]->title);
        $this->assertSame('track2', $tracks[2]->title);
    }

    public function testFavorites(): void
    {
        $fixtures['tracks'] = TrackQueryFavoritesFixture::class;
        $this->tester->haveFixtures($fixtures);

        $tracks = Track::find()->favorites()->all();
        $this->assertSame(3, count($tracks));
        $this->assertSame('title2', $tracks[0]->title);
        $this->assertSame('title4', $tracks[1]->title);
        $this->assertSame('title5', $tracks[2]->title);
    }
}
