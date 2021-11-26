<?php

declare(strict_types=1);

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\BookmarkTag;

class BookmarkTagSearch extends BookmarkTag
{
    public function rules(): array
    {
        return [
            ['name', 'safe'],
        ];
    }

    public function search(array $params = []): ActiveDataProvider
    {
        $query = BookmarkTag::find();

        $data = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],
        ]);

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'name', $this->name]);
        }

        return $data;
    }
}
