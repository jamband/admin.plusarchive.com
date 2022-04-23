<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\Label;
use app\models\LabelTag;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class LabelSearch extends Label
{
    public string|null $tag = null;

    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'safe'],

            ['country', 'safe'],
            ['country', 'in', 'range' => static::getCountries()],

            ['link', 'trim'],
            ['link', 'safe'],

            ['tag', 'safe'],
            ['tag', 'in', 'range' => LabelTag::getNames()],
        ];
    }

    public function search(array $params = []): ActiveDataProvider
    {
        $query = Label::find()
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
