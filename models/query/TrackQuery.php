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

        return false === $provider ? $this : $this->andWhere(['provider' => $provider]);
    }

    /**
     * @param null|string $type
     * @return TrackQuery
     */
    public function type(?string $type): TrackQuery
    {
        $type = array_search($type, Track::TYPES, true);

        return false === $type ? $this : $this->andWhere(['type' => $type]);
    }

    /**
     * @param string $search
     * @return TrackQuery
     */
    public function search(string $search): TrackQuery
    {
        return $this->andFilterWhere(['like', 'title', trim($search)])
            ->orderBy(['title' => SORT_ASC]);
    }

    /**
     * @param null|string $sort
     * @return TrackQuery
     */
    public function sort(?string $sort): TrackQuery
    {
        switch ($sort) {
            case 'Title':
                return $this->orderBy(['title' => SORT_ASC]);
            case 'Latest':
                return $this->orderBy(['created_at' => SORT_DESC]);
            case 'Update':
                return $this->orderBy(['updated_at' => SORT_DESC]);
            default:
                return $this->orderBy(['created_at' => SORT_DESC]);
        }
    }
}
