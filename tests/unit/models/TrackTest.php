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

use app\models\Track;
use app\models\MusicGenre;
use app\tests\unit\fixtures\TrackAllFixture;
use Codeception\Test\Unit;

class TrackTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testAll(): void
    {
        $this->tester->haveFixtures([
            'tracks' => TrackAllFixture::class,
        ]);

        // no parameters
        $tracks = Track::all()->models;

        $this->assertSame(5, count($tracks));
        $this->assertInstanceOf(Track::class, $tracks[0]);
        $this->assertSame('track4', $tracks[0]->title);

        $this->assertSame(1, count($tracks[4]->musicGenres));
        $this->assertInstanceOf(MusicGenre::class, $tracks[4]->musicGenres[0]);
        $this->assertSame('genre1', $tracks[4]->musicGenres[0]->name);

        // provider=YouTube
        $tracks = Track::all('YouTube')->models;

        $this->assertSame(2, count($tracks));
        $this->assertSame('track3', $tracks[0]->title);

        // genre=genre1
        $tracks = Track::all(null, 'genre1')->models;

        $this->assertSame(1, count($tracks));
        $this->assertSame('track1', $tracks[0]->title);

        // provider=YouTube&genre=genre1
        $tracks = Track::all('YouTube', 'genre1')->models;
        $this->assertSame(0, count($tracks));

        // search=3
        $tracks = Track::all(null, null, '3')->models;
        $this->assertSame(1, count($tracks));
        $this->assertSame('track3', $tracks[0]->title);
    }

    public function testAllAsAdmin(): void
    {
        $this->tester->haveFixtures([
            'tracks' => TrackAllFixture::class,
        ]);

        // no parameters
        $tracks = Track::allAsAdmin()->models;

        $this->assertSame(5, count($tracks));
        $this->assertInstanceOf(Track::class, $tracks[0]);
        $this->assertSame('track4', $tracks[0]->title);

        $this->assertSame(1, count($tracks[4]->musicGenres));
        $this->assertInstanceOf(MusicGenre::class, $tracks[4]->musicGenres[0]);
        $this->assertSame('genre1', $tracks[4]->musicGenres[0]->name);

        // sort=Title
        $tracks = Track::allasAdmin('Title')->models;

        $this->assertSame(5, count($tracks));
        $this->assertSame('track1', $tracks[0]->title);

        // provider=YouTube
        $tracks = Track::allasAdmin(null, 'YouTube')->models;

        $this->assertSame(2, count($tracks));
        $this->assertSame('track3', $tracks[0]->title);

        // genre=genre1
        $tracks = Track::allAsAdmin(null, null, 'genre1')->models;

        $this->assertSame(1, count($tracks));
        $this->assertSame('track1', $tracks[0]->title);

        // provider=YouTube&genre=genre1
        $tracks = Track::allAsAdmin(null, 'YouTube', 'genre1')->models;
        $this->assertSame(0, count($tracks));

        // search=3
        $tracks = Track::allAsAdmin(null, null, null, '3')->models;
        $this->assertSame(1, count($tracks));
        $this->assertSame('track3', $tracks[0]->title);
    }
}
