<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\Music;
use yii\data\ActiveDataProvider;
use app\models\Playlist;

class PlaylistSearch extends Playlist
{
    public function rules(): array
    {
        return [
            [['title'], 'trim'],
            [['provider', 'title'], 'safe'],

            ['provider', 'in', 'range' => array_keys(Music::PROVIDERS)],
        ];
    }

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
