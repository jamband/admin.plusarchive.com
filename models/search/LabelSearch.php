<?php

declare(strict_types=1);

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Label;
use app\models\LabelTag;

class LabelSearch extends Label
{
    public $tag;

    public function rules(): array
    {
        return [
            [['name', 'link'], 'trim'],
            [['name', 'country', 'link', 'tag'], 'safe'],

            ['country', 'in', 'range' => static::getCountries()],
            ['tag', 'in', 'range' => LabelTag::getNames()],
        ];
    }

    public function search(array $params = []): ActiveDataProvider
    {
        $query = Label::find()
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
