<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\StoreTag;
use yii\data\ActiveDataProvider;

class StoreTagSearch extends StoreTag
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
        $query = StoreTag::find();

        $data = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', 'name', $this->name]);
        }

        return $data;
    }
}
