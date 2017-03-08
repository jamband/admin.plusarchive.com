<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models\form;

use app\models\Playlist;
use app\models\PlaylistItem;
use app\models\Track;
use Exception;
use yii\base\Model;

class PlaylistItemCreateForm extends Model
{
    public $playlist_id;
    public $track_id;
    public $track_title;

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'playlist_id' => 'Playlist',
            'track_title' => 'Track Title',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['playlist_id', 'track_title', 'track_id'], 'required'],

            ['playlist_id', 'in', 'range' => Playlist::getIds()],
            ['track_id', 'in', 'range' => Track::getIds()],
            ['track_id', 'validateProvider'],
            ['track_id', 'validateUnique'],
        ];
    }

    /**
     * Validates whether same provider.
     * @param string $attribute
     */
    public function validateProvider($attribute)
    {
        $item = PlaylistItem::find()
            ->playlist($this->playlist_id)
            ->limit(1)
            ->one();

        $track = Track::findOne($this->track_id);
        if (null === $item || null === $track) {
            return;
        }
        if ($track->provider !== $item->track->provider) {
            $this->addError($attribute, sprintf('In %s, should be a track which is provided from %s.',
                $item->playlist->title,
                $item->track->providerText
            ));
        }
    }

    /**
     * Validates whether unique item in selected playlist.
     * @param string $attribute
     */
    public function validateUnique($attribute)
    {
        $query = PlaylistItem::find()
            ->andWhere([
                'playlist_id' => $this->playlist_id,
                'track_id' => $this->track_id,
            ]);

        if ($query->exists()) {
            $this->addError($attribute, 'The track already exists.');
        }
    }

    /**
     * Creates a new playlist item.
     * @return bool
     * @throws Exception
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $transaction = db()->beginTransaction();
        try {
            $item = new PlaylistItem;
            $item->playlist_id = $this->playlist_id;
            $item->track_id = $this->track_id;
            $item->track_number = $this->getLastTrackNumberByPlaylistId();
            if (!$item->save()) {
                return false;
            }
            Playlist::saveFrequency($item->playlist_id);
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * Returns last track number by playlist_id
     * @return int
     */
    private function getLastTrackNumberByPlaylistId()
    {
        $max = PlaylistItem::find()
            ->select('track_number')
            ->playlist($this->playlist_id)
            ->max('track_number');

        return null === $max ? 1 : (int)$max + 1;
    }
}
