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

use app\models\Track;
use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method TrackQuery allTagValues($values, $attribute = null)
 *
 * @see \app\models\Track
 */
class TrackQuery extends ActiveQuery
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
     * @param null|string $provider
     * @return TrackQuery
     */
    public function provider(?string $provider): TrackQuery
    {
        $provider = array_search($provider, Track::PROVIDERS, true);

        return $this->andWhere(['provider' => false !== $provider ? $provider : '']);
    }

    /**
     * @return TrackQuery
     */
    public function track(): TrackQuery
    {
        return $this->andWhere(['type' => Track::TYPE_TRACK]);
    }

    /**
     * @return TrackQuery
     */
    public function playlist(): TrackQuery
    {
        return $this->andWhere(['type' => Track::TYPE_PLAYLIST]);
    }

    /**
     * @param string $search
     * @return TrackQuery
     */
    public function search(string $search): TrackQuery
    {
        return $this->andFilterWhere(['like', 'title', trim($search)]);
    }

    /**
     * @return TrackQuery
     */
    public function inTitleOrder(): TrackQuery
    {
        return $this->orderBy(['title' => SORT_ASC]);
    }

    /**
     * @return TrackQuery
     */
    public function inUpdateOrder(): TrackQuery
    {
        return $this->orderBy(['updated_at' => SORT_DESC]);
    }

    /**
     * @param null|string $sort
     * @return TrackQuery
     */
    public function sort(?string $sort): TrackQuery
    {
        if ('Title' === $sort) {
            return $this->inTitleOrder();

        } elseif ('Update' === $sort) {
            return $this->inUpdateOrder();
        }

        return $this->latest();
    }
}
