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
 * @property integer $id
 * @property integer $playlist_id
 * @property integer $track_id
 * @property integer $track_number
 * @property integer $created_at
 * @property integer $updated_at
 */
class PlaylistItem extends ActiveRecord
{
    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    public static function find()
    {
        return new PlaylistItemQuery(static::class);
    }

    /**
     * @param integer $track_id track id
     * @return array track ids
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
     * @param integer $playlist_id
     * @return boolean
     */
    public static function hasTracksByPlaylistId($playlist_id)
    {
        return static::find()
            ->andWhere(['playlist_id' => $playlist_id])
            ->exists();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_DELETE,
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
        if (!static::hasTracksByPlaylistId($this->playlist_id)) {
            Playlist::toIncomplete($this->playlist_id);
        }
        Playlist::updateTimestampAttribute($this->playlist_id);
    }

    /**
     * Removes all of the specific tracks
     * @param integer $track_id
     */
    public static function removeTracks($track_id)
    {
        static::deleteAll(['track_id' => $track_id]);
    }

    /**
     * Removes all of the specific playlist
     * @param integer $playlist_id
     */
    public static function removePlaylists($playlist_id)
    {
        static::deleteAll(['playlist_id' => $playlist_id]);
    }
}
