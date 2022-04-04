<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\Bookmark;
use app\models\BookmarkTag;
use yii\data\ActiveDataProvider;

class BookmarkSearch extends Bookmark
{
    public $tag;

    public function rules(): array
    {
        return [
            [['name', 'link'], 'trim'],
            [['name', 'country', 'link', 'status', 'tag'], 'safe'],

            ['country', 'in', 'range' => static::getCountries()],
            ['tag', 'in', 'range' => BookmarkTag::getNames()],
        ];
    }

    public function search(array $params = []): ActiveDataProvider
    {
        $query = Bookmark::find()
            ->with(['tags']);

        $data = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);

        if ($this->load($params) && $this->validate()) {
            $query->andFilterWhere(['like', static::tableName().'.name', $this->name])
                ->andFilterWhere(['country' => $this->country])
                ->andFilterWhere(['like', 'link', $this->link]);

            if ('' !== $this->tag) {
                $query->allTagValues($this->tag);
            }
        }

        return $data;
    }
}
