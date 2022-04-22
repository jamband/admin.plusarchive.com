<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\BookmarkTag;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

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
