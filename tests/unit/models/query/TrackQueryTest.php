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

use app\models\Track;
use app\tests\unit\fixtures\music\TrackQueryBehaviorsFixture;
use app\tests\unit\fixtures\music\TrackQueryFindFixture;
use app\tests\unit\fixtures\music\TrackQueryInTitleOrderFixture;
use app\tests\unit\fixtures\music\TrackQueryInUpdateOrderFixture;
use app\tests\unit\fixtures\music\TrackQueryProviderFixture;
use app\tests\unit\fixtures\music\TrackQuerySearchFixture;
use app\tests\unit\fixtures\music\TrackQuerySortFixture;
use Codeception\Test\Unit;

class TrackQueryTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testInit(): void
    {
        $this->tester->haveFixtures([
            TrackQueryFindFixture::class,
        ]);

        $tracks = Track::find()->all();
        $this->assertSame(2, count($tracks));
        $this->assertSame(Track::TYPE_TRACK, $tracks[0]->type);
        $this->assertSame(Track::TYPE_TRACK, $tracks[1]->type);
    }

    public function testBehaviors(): void
    {
        $this->tester->haveFixtures([
            TrackQueryBehaviorsFixture::class,
        ]);

        $tracks = Track::find()->allTagValues('genre1')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame('track1', $tracks[0]->title);
    }

    public function testProvider(): void
    {
        $this->tester->haveFixtures([
            TrackQueryProviderFixture::class,
        ]);

        $tracks = Track::find()->provider(null)->all();
        $this->assertSame(0, count($tracks));

        $tracks = Track::find()->provider('Foo')->all();
        $this->assertSame(0, count($tracks));

        $tracks = Track::find()->provider('Bandcamp')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame(Track::PROVIDER_BANDCAMP, $tracks[0]->provider);

        $tracks = Track::find()->provider('SoundCloud')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame(Track::PROVIDER_SOUNDCLOUD, $tracks[0]->provider);

        $tracks = Track::find()->provider('Vimeo')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame(Track::PROVIDER_VIMEO, $tracks[0]->provider);

        $tracks = Track::find()->provider('YouTube')->all();
        $this->assertSame(1, count($tracks));
        $this->assertSame(Track::PROVIDER_YOUTUBE, $tracks[0]->provider);
    }

    public function testSearch(): void
    {
        $this->tester->haveFixtures([
            TrackQuerySearchFixture::class,
        ]);

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
        $this->tester->haveFixtures([
            TrackQueryInTitleOrderFixture::class,
        ]);

        $tracks = Track::find()->inTitleOrder()->all();
        $this->assertSame(3, count($tracks));
        $this->assertSame('bar', $tracks[0]->title);
        $this->assertSame('baz', $tracks[1]->title);
        $this->assertSame('foo', $tracks[2]->title);
    }

    public function testInUpdateOrder(): void
    {
        $this->tester->haveFixtures([
            TrackQueryInUpdateOrderFixture::class,
        ]);

        $tracks = Track::find()->inUpdateOrder()->all();
        $this->assertSame(3, count($tracks));
        $this->assertSame('bar', $tracks[0]->title);
        $this->assertSame('foo', $tracks[1]->title);
        $this->assertSame('baz', $tracks[2]->title);
    }

    public function testSort(): void
    {
        $this->tester->haveFixtures([
            TrackQuerySortFixture::class,
        ]);

        $tracks = Track::find()->sort('Title')->all();
        $this->assertSame(3, count($tracks));
        $this->assertSame('bar', $tracks[0]->title);
        $this->assertSame('baz', $tracks[1]->title);
        $this->assertSame('foo', $tracks[2]->title);

        $tracks = Track::find()->sort('Update')->all();
        $this->assertSame(3, count($tracks));
        $this->assertSame('bar', $tracks[0]->title);
        $this->assertSame('foo', $tracks[1]->title);
        $this->assertSame('baz', $tracks[2]->title);

        $tracks = Track::find()->sort('Foo')->all();
        $this->assertSame(3, count($tracks));
        $this->assertSame('baz', $tracks[0]->title);
        $this->assertSame('bar', $tracks[1]->title);
        $this->assertSame('foo', $tracks[2]->title);

        $tracks = Track::find()->sort(null)->all();
        $this->assertSame(3, count($tracks));
        $this->assertSame('baz', $tracks[0]->title);
        $this->assertSame('bar', $tracks[1]->title);
        $this->assertSame('foo', $tracks[2]->title);
    }
}
