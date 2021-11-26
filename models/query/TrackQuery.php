<?php

declare(strict_types=1);

namespace app\models\query;

use app\models\Music;
use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method TrackQuery allTagValues($values, $attribute = null)
 */
class TrackQuery extends ActiveQuery
{
    use ActiveQueryTrait;

    public function init(): void
    {
        parent::init();

        $this->where(['type' => Music::TYPE_TRACK]);
    }

    public function behaviors(): array
    {
        return [
            TaggableQueryBehavior::class,
        ];
    }

    public function provider(string|null $provider): TrackQuery
    {
        $provider = array_search($provider, Music::PROVIDERS, true);

        return $this->andWhere(['provider' => false !== $provider ? $provider : '']);
    }

    public function search(string $search): TrackQuery
    {
        return $this->andFilterWhere(['like', 'title', trim($search)]);
    }

    public function inTitleOrder(): TrackQuery
    {
        return $this->orderBy(['title' => SORT_ASC]);
    }

    public function inUpdateOrder(): TrackQuery
    {
        return $this->orderBy(['updated_at' => SORT_DESC]);
    }

    public function sort(string|null $sort): TrackQuery
    {
        if ('Title' === $sort) {
            return $this->inTitleOrder();

        } elseif ('Update' === $sort) {
            return $this->inUpdateOrder();
        }

        return $this->latest();
    }

    public function favorites(): TrackQuery
    {
        return $this->andWhere(['urge' => true]);
    }
}
