<?php

declare(strict_types=1);

namespace app\models\query;

use app\models\Store;
use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method StoreQuery allTagValues($values, $attribute = null)
 * @see Store
 */
class StoreQuery extends ActiveQuery
{
    public function behaviors(): array
    {
        return [
            TaggableQueryBehavior::class,
        ];
    }

    public function country(string|null $country): StoreQuery
    {
        if (in_array($country, Store::getCountries(), true)) {
            return $this->andWhere(['country' => $country]);
        }

        return $this->andWhere(['country' => '']);
    }

    public function search(string $search): StoreQuery
    {
        return $this->andFilterWhere(['or',
            ['like', 'name', trim($search)],
            ['like', 'link', trim($search)],
        ]);
    }

    public function inNameOrder(): StoreQuery
    {
        return $this->orderBy(['name' => SORT_ASC]);
    }

    public function latest(): StoreQuery
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }
}
