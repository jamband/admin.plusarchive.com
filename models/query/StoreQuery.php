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

use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method StoreQuery allTagValues($values, $attribute = null)
 *
 * @see \app\models\Store
 */
class StoreQuery extends ActiveQuery
{
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
        return $this->andFilterWhere(['country' => $country]);
    }

    /**
     * @param null|string $sort
     * @return StoreQuery
     */
    public function sort(?string $sort): StoreQuery
    {
        switch ($sort) {
            case 'Name':
                return $this->orderBy(['name' => SORT_ASC]);
            case 'Latest':
                return $this->orderBy(['created_at' => SORT_DESC]);
            default:
                return $this->orderBy(['created_at' => SORT_DESC]);
        }
    }

    /**
     * @param string $search
     * @return StoreQuery
     */
    public function search(string $search): StoreQuery
    {
        return $this->andFilterWhere(['or',
            ['like', 'name', $search],
            ['like', 'link', $search],
        ])->orderBy(['name' => SORT_ASC]);
    }
}
