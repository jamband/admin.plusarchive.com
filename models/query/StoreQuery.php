<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\models\query;

use app\models\Store;
use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method StoreQuery allTagValues($values, $attribute = null)
 *
 * @see \app\models\Store
 */
class StoreQuery extends ActiveQuery
{
    use ActiveQueryTrait;

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            TaggableQueryBehavior::class,
        ];
    }

    /**
     * @param null|string $country
     * @return StoreQuery
     */
    public function country(?string $country): StoreQuery
    {
        if (in_array($country, Store::getCountries(), true)) {
            return $this->andWhere(['country' => $country]);
        }

        return $this->andWhere(['country' => '']);
    }

    /**
     * @param string $search
     * @return StoreQuery
     */
    public function search(string $search): StoreQuery
    {
        return $this->andFilterWhere(['or',
            ['like', 'name', trim($search)],
            ['like', 'link', trim($search)],
        ]);
    }

    /**
     * @return StoreQuery
     */
    public function inNameOrder(): StoreQuery
    {
        return $this->orderBy(['name' => SORT_ASC]);
    }

    /**
     * @param null|string $sort
     * @return StoreQuery
     */
    public function sort(?string $sort): StoreQuery
    {
        if ('Name' === $sort) {
            return $this->inNameOrder();
        }

        return $this->latest();
    }
}
