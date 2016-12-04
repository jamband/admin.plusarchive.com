<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\codeception\_support;

use Codeception\Module;
use Codeception\TestCase;
use tests\codeception\fixtures\BookmarkFixture;
use tests\codeception\fixtures\BookmarkTagFixture;
use tests\codeception\fixtures\LabelFixture;
use tests\codeception\fixtures\LabelTagFixture;
use tests\codeception\fixtures\PlaylistFixture;
use tests\codeception\fixtures\PlaylistItemFixture;
use tests\codeception\fixtures\StoreFixture;
use tests\codeception\fixtures\StoreTagFixture;
use tests\codeception\fixtures\TrackFixture;
use tests\codeception\fixtures\TrackGenreFixture;
use tests\codeception\fixtures\UserFixture;
use yii\test\FixtureTrait;

class FixtureHelper extends Module
{
    use FixtureTrait;

    /**
     * @inheritdoc
     */
    public function _before(TestCase $test)
    {
        $this->loadFixtures();
    }

    /**
     * @inheritdoc
     */
    public function _after(TestCase $test)
    {
        $this->unloadFixtures();
    }

    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'bookmarks' => BookmarkFixture::class,
            'bookmarkTAg' => BookmarkTagFixture::class,
            'labels' => LabelFixture::class,
            'labelTags' => LabelTagFixture::class,
            'playlists' => PlaylistFixture::class,
            'playlistItems' => PlaylistItemFixture::class,
            'stores' => StoreFixture::class,
            'storeTags' => StoreTagFixture::class,
            'tracks' => TrackFixture::class,
            'trackGenres' => TrackGenreFixture::class,
            'users' => UserFixture::class,
        ];
    }
}
