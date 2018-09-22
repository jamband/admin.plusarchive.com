<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models\query;

use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method LabelQuery allTagValues($values, $attribute = null)
 *
 * @see \app\models\Label
 */
class LabelQuery extends ActiveQuery
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
     * @return LabelQuery
     */
    public function country(?string $country): LabelQuery
    {
        return $this->andFilterWhere(['country' => $country]);
    }

    /**
     * @param string $search
     * @return LabelQuery
     */
    public function search(string $search): LabelQuery
    {
        return $this->andFilterWhere(['or',
            ['like', 'name', trim($search)],
            ['like', 'link', trim($search)],
        ]);
    }

    /**
     * @return LabelQuery
     */
    public function inNameOrder(): LabelQuery
    {
        return $this->orderBy(['name' => SORT_ASC]);
    }

    /**
     * @param null|string $sort
     * @return LabelQuery
     */
    public function sort(?string $sort): LabelQuery
    {
        if ('Name' === $sort) {
            return $this->inNameOrder();
        }

        return $this->latest();
    }
}
