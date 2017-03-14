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
use app\models\Track;

class PlaylistSearch extends Track
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provider_key', 'title'], 'trim'],
            [['status', 'provider', 'provider_key', 'title'], 'safe'],

            ['status', 'in', 'range' => array_keys(self::STATUS_DATA)],
            ['provider', 'in', 'range' => array_keys(self::PROVIDER_DATA)],
        ];
    }

    /**
     * Creates data provider instance with search query applied.
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params = [])
    {
        $query = Track::find()
            ->type(Track::TYPE_PLAYLIST_TEXT);

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
                ->andFilterWhere(['like', 'provider_key', $this->provider_key])
                ->andFilterWhere(['status' => $this->status])
                ->andFilterWhere(['provider' => $this->provider]);
        }

        return $data;
    }
}
