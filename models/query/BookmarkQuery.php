<?php

declare(strict_types=1);

namespace app\models\query;

use app\models\Bookmark;
use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method BookmarkQuery allTagValues($values, $attribute = null)
 */
class BookmarkQuery extends ActiveQuery
{
    use ActiveQueryTrait;

    public function behaviors(): array
    {
        return [
            TaggableQueryBehavior::class,
        ];
    }

    public function country(string|null $country): BookmarkQuery
    {
        if (in_array($country, Bookmark::getCountries(), true)) {
            return $this->andWhere(['country' => $country]);
        }

        return $this->andWhere(['country' => '']);
    }

    public function search(string $search): BookmarkQuery
    {
        return $this->andFilterWhere(['or',
            ['like', 'bookmark.name', trim($search)],
            ['like', 'link', trim($search)],
        ]);
    }

    public function inNameOrder(): BookmarkQuery
    {
        return $this->orderBy(['bookmark.name' => SORT_ASC]);
    }

    public function sort(string|null $sort): BookmarkQuery
    {
        if ('Name' === $sort) {
            return $this->inNameOrder();
        }

        return $this->latest();
    }
}
