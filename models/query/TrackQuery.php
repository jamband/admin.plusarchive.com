<?php

declare(strict_types=1);

namespace app\models\query;

use app\models\Music;
use app\models\Track;
use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method TrackQuery allTagValues($values, $attribute = null)
 * @see Track
 */
class TrackQuery extends ActiveQuery
{
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

    public function latest(): TrackQuery
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }

    public function favorites(): TrackQuery
    {
        return $this->andWhere(['urge' => true]);
    }
}
