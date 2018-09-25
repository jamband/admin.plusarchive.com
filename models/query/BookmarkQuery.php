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
     * @return BookmarkQuery
     */
    public function country(?string $country): BookmarkQuery
    {
        return $this->andFilterWhere(['country' => $country]);
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
        ]);
    }

    /**
     * @return BookmarkQuery
     */
    public function inNameOrder(): BookmarkQuery
    {
        return $this->orderBy(['bookmark.name' => SORT_ASC]);
    }

    /**
     * @param null|string $sort
     * @return BookmarkQuery
     */
    public function sort(?string $sort): BookmarkQuery
    {
        if ('Name' === $sort) {
            return $this->inNameOrder();
        }

        return $this->latest();
    }
}
