<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\MusicGenre;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class MusicGenreSearch extends MusicGenre
{
    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'safe'],
        ];
    }

    public function search(array $params = []): ActiveDataProvider
    {
        $query = MusicGenre::find();

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
            $query->andFilterWhere(['like', 'name', $this->name]);
        }

        return $data;
    }
}
