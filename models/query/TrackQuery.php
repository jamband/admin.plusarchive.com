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

use app\models\Track;
use creocoder\taggable\TaggableQueryBehavior;
use yii\db\ActiveQuery;

/**
 * @method $this allTagValues($values, $attribute = null)
 */
class TrackQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::class,
        ];
    }

    /**
     * @param string $provider
     * @return $this
     */
    public function provider($provider)
    {
        $provider = array_search($provider, Track::PROVIDERS, true);
        return false === $provider ? $this : $this->andWhere(['provider' => $provider]);
    }

    /**
     * @param string $status
     * @return $this
     */
    public function status($status)
    {
        $status = array_search($status, Track::STATUSES, true);
        return false === $status ? $this : $this->andWhere(['status' => $status]);
    }

    /**
     * @param string $type
     * @return $this
     */
    public function type($type)
    {
        $type = array_search($type, Track::TYPES, true);
        return false === $type ? $this : $this->andWhere(['type' => $type]);
    }

    /**
     * @param string $search
     * @return $this
     */
    public function search($search)
    {
        return $this->andFilterWhere(['like', 'title', trim($search)])
            ->orderBy(['title' => SORT_ASC]);
    }

    /**
     * @param string $sort
     * @return $this
     */
    public function sort($sort)
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
