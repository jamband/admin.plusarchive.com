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

class BookmarkQuery extends ActiveQuery
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::class,
        ];
    }

    /**
     * @param string $country
     * @return BookmarkQuery
     */
    public function country($country)
    {
        return $this->andFilterWhere(['country' => $country]);
    }

    /**
     * @param integer $status
     * @return BookmarkQuery
     */
    public function status($status)
    {
        return $this->andWhere(['status' => $status]);
    }

    /**
     * @param string $search
     * @return BookmarkQuery
     */
    public function search($search)
    {
        return $this->andFilterWhere(['or',
            ['like', 'bookmark.name', trim($search)],
            ['like', 'link', trim($search)],
        ])->orderBy(['bookmark.name' => SORT_ASC]);
    }

    /**
     * @param string $sort
     * @return BookmarkQuery
     */
    public function sort($sort)
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
}
