<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\Store;
use app\models\StoreTag;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class StoreSearch extends Store
{
    public $tag;

    public function rules(): array
    {
        return [
            [['name', 'link'], 'trim'],
            [['name', 'country', 'link', 'tag'], 'safe'],

            ['country', 'in', 'range' => static::getCountries()],
            ['tag', 'in', 'range' => StoreTag::getNames()],
        ];
    }

    public function search(array $params = []): ActiveDataProvider
    {
        $query = Store::find()
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
