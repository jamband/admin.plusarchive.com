<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Codeception\Module;
use Codeception\TestCase;
use app\tests\fixtures\BookmarkFixture;
use app\tests\fixtures\BookmarkTagFixture;
use app\tests\fixtures\LabelFixture;
use app\tests\fixtures\LabelTagFixture;
use app\tests\fixtures\PlaylistFixture;
use app\tests\fixtures\PlaylistItemFixture;
use app\tests\fixtures\StoreFixture;
use app\tests\fixtures\StoreTagFixture;
use app\tests\fixtures\TrackFixture;
use app\tests\fixtures\TrackGenreFixture;
use app\tests\fixtures\UserFixture;
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
