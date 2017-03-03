<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\PlaylistItem;

class PlaylistItemSearch extends PlaylistItem
{
    public $playlist;
    public $title;
    public $provider;
    public $status;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['playlist', 'status', 'title', 'provider'], 'trim'],
            [['playlist', 'status', 'title', 'provider'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied.
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params = [])
    {
        $query = PlaylistItem::find()
            ->joinWith(['playlist p', 'track t']);

        $data = new ActiveDataProvider(['query' => $query]);
        $data->sort->defaultOrder = ['created_at' => SORT_DESC];

        $data->sort->attributes['playlist'] = [
            'asc' => ['p.title' => SORT_ASC],
            'desc' => ['p.title' => SORT_DESC],
        ];
        $data->sort->attributes['status'] = [
            'asc' => ['p.status' => SORT_ASC],
            'desc' => ['p.status' => SORT_DESC],
        ];
        $data->sort->attributes['title'] = [
            'asc' => ['t.title' => SORT_ASC],
            'desc' => ['t.title' => SORT_DESC],
        ];
        $data->sort->attributes['provider'] = [
            'asc' => ['t.provider' => SORT_ASC],
            'desc' => ['t.provider' => SORT_DESC],
        ];
        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['playlist_id' => $this->playlist])
                ->andFilterWhere(['p.status' => $this->status])
                ->andFilterWhere(['like', 't.title', $this->title])
                ->andFilterWhere(['t.provider' => $this->provider]);
        }

        return $data;
    }
}
