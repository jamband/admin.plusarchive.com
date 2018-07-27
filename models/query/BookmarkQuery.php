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
 * @method BookmarkQuery allTagValues($values, $attribute = null)
 *
 * @see \app\models\Bookmark
 */
class BookmarkQuery extends ActiveQuery
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
     * @return BookmarkQuery
     */
    public function country(?string $country): BookmarkQuery
    {
        return $this->andFilterWhere(['country' => $country]);
    }

    /**
     * @param int $status
     * @return BookmarkQuery
     */
    public function status(int $status): BookmarkQuery
    {
        return $this->andWhere(['status' => $status]);
    }

    /**
     * @param string $search
     * @return BookmarkQuery
     */
    public function search(string $search): BookmarkQuery
    {
        return $this->andFilterWhere(['or',
            ['like', 'bookmark.name', trim($search)],
            ['like', 'link', trim($search)],
        ])->orderBy(['bookmark.name' => SORT_ASC]);
    }

    /**
     * @param null|string $sort
     * @return BookmarkQuery
     */
    public function sort(?string $sort): BookmarkQuery
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
