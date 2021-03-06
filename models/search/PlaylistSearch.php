<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Playlist;

class PlaylistSearch extends Playlist
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['title'], 'trim'],
            [['provider', 'title'], 'safe'],

            ['provider', 'in', 'range' => array_keys(Playlist::PROVIDERS)],
        ];
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params = []): ActiveDataProvider
    {
        $query = static::find();

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
                ->andFilterWhere(['provider' => $this->provider]);
        }

        return $data;
    }
}
