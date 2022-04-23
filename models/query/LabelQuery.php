<?php

namespace app\models\query;

use app\models\Label;
use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method LabelQuery allTagValues($values, $attribute = null)
 * @see Label
 */
class LabelQuery extends ActiveQuery
{
    public function behaviors(): array
    {
        return [
            TaggableQueryBehavior::class,
        ];
    }

    public function country(string|null $country): LabelQuery
    {
        if (in_array($country, Label::getCountries(), true)) {
            return $this->andWhere(['country' => $country]);
        }

        return $this->andWhere(['country' => '']);
    }

    public function search(string $search): LabelQuery
    {
        return $this->andFilterWhere(['or',
            ['like', 'name', trim($search)],
            ['like', 'link', trim($search)],
        ]);
    }

    public function inNameOrder(): LabelQuery
    {
        return $this->orderBy(['name' => SORT_ASC]);
    }

    public function latest(): LabelQuery
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }
}
