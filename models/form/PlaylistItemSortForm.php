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
use yii\base\Model;

class PlaylistItemSortForm extends Model
{
    public $ids;
    public $playlist_id;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ids' => 'Playlist items',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['ids', 'validateId'],
            ['ids', 'validateIdTotal'],
            ['playlist_id', 'in', 'range' => Playlist::getIds()],
        ];
    }

    /**
     * Validates whether valid id.
     * @param string $attribute
     * @param array $params
     */
    public function validateId($attribute, $params)
    {
        foreach ($this->getIds() as $id) {
            $query = PlaylistItem::find()
                ->andWhere([
                    'id' => $id,
                    'playlist_id' => $this->playlist_id,
                ]);

            if (!$query->exists()) {
                $this->addError($attribute, 'It contains an invalid track.');
            }
        }
    }

    /**
     * Validates whether the number of tracks is valid.
     * @param string $attribute
     * @param array $params
     */
    public function validateIdTotal($attribute, $params)
    {
        $query = PlaylistItem::find()
            ->andWhere(['playlist_id' => $this->playlist_id]);

        if (count($this->getIds()) !== (int)$query->count()) {
            $this->addError($attribute, 'The number of tracks is not valid.');
        }
    }

    /**
     * Change the order of the tracks of a particular playlist.
     * @return boolean
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        foreach ($this->getIds() as $k => $id) {
            $playlistItem = PlaylistItem::findOne($id);
            if (null !== $playlistItem) {
                $playlistItem->track_number = (int)$k + 1;
                $playlistItem->save();
            }
        }
        return true;
    }

    /**
     * @return array
     */
    private function getIds()
    {
        return array_filter(array_values(array_unique(explode(',', $this->ids))));
    }
}
