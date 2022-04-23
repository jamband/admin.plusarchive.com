<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\Bookmark;
use app\models\BookmarkTag;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class BookmarkSearch extends Bookmark
{
    public string|null $tag = null;

    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'safe'],

            ['country', 'trim'],
            ['country', 'in', 'range' => static::getCountries()],
            ['country', 'safe'],

            ['link', 'trim'],
            ['link', 'safe'],

            ['tag', 'in', 'range' => BookmarkTag::getNames()],
            ['tag', 'safe'],
        ];
    }

    public function search(array $params = []): ActiveDataProvider
    {
        $query = Bookmark::find()
            ->with(['tags']);

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
