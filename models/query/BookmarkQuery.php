<?php

declare(strict_types=1);

namespace app\models\query;

use app\models\Bookmark;
use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method BookmarkQuery allTagValues($values, $attribute = null)
 * @see Bookmark
 */
class BookmarkQuery extends ActiveQuery
{
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
            ['like', 'name', trim($search)],
            ['like', 'link', trim($search)],
        ]);
    }

    public function inNameOrder(): BookmarkQuery
    {
        return $this->orderBy(['name' => SORT_ASC]);
    }

    public function latest(): BookmarkQuery
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }
}
