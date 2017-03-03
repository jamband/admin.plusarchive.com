<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use app\models\query\PlaylistItemQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $playlist_id
 * @property int $track_id
 * @property int $track_number
 * @property int $created_at
 * @property int $updated_at
 * @property Playlist $playlist
 * @property Track $track
 */
class PlaylistItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'playlist_item';
    }

    /**
     * @return ActiveQuery
     */
    public function getPlaylist()
    {
        return $this->hasOne(Playlist::class, ['id' => 'playlist_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTrack()
    {
        return $this->hasOne(Track::class, ['id' => 'track_id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function find()
    {
        return new PlaylistItemQuery(static::class);
    }

    /**
     * @param int $track_id track id
     * @return string[] track ids
     */
    public static function getPlaylistIdsByTrackId($track_id)
    {
        return static::find()
            ->select('playlist_id')
            ->andWhere(['track_id' => $track_id])
            ->column();
    }

    /**
     * Whether has some tracks.
     * @param int $playlist_id
     * @return bool
     */
    public static function hasTracksByPlaylistId($playlist_id)
    {
        return static::find()
            ->andWhere(['playlist_id' => $playlist_id])
            ->exists();
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_DELETE,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function afterDelete()
    {
        if (!static::hasTracksByPlaylistId($this->playlist_id)) {
            Playlist::toIncomplete($this->playlist_id);
        }
        Playlist::saveFrequency($this->playlist_id);
    }

    /**
     * Removes all of the specific tracks
     * @param int $track_id
     */
    public static function removeTracks($track_id)
    {
        static::deleteAll(['track_id' => $track_id]);
    }

    /**
     * Removes all of the specific playlist
     * @param int $playlist_id
     */
    public static function removePlaylists($playlist_id)
    {
        static::deleteAll(['playlist_id' => $playlist_id]);
    }
}
