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
use app\models\Playlist;

class PlaylistSearch extends Playlist
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'trim'],
            [['title', 'status'], 'safe'],

            ['status', 'in', 'range' => array_keys(self::STATUS_DATA)],
        ];
    }

    /**
     * Creates data provider instance with search query applied.
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params = [])
    {
        $query = Playlist::find();

        $data = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);
        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['status' => $this->status]);
        }

        return $data;
    }
}
