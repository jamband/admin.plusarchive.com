<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\Music;
use app\models\Playlist;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class PlaylistSearch extends Playlist
{
    public function rules(): array
    {
        return [
            ['title', 'trim'],
            ['title', 'safe'],

            ['provider', 'in', 'range' => array_keys(Music::PROVIDERS)],
            ['provider', 'safe'],
        ];
    }

    public function search(array $params = []): ActiveDataProvider
    {
        $query = static::find();

        /** @var Pagination $pagination */
        $pagination = Yii::createObject(Pagination::class);

        $data = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
                'params' => array_merge($params, [
                    $pagination->pageParam => null,
                ]),
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
