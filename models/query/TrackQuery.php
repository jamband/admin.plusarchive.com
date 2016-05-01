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

class TrackQuery extends ActiveQuery
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
     * @param string $provider
     * @return TrackQuery
     */
    public function provider($provider)
    {

        $provider = array_search($provider, Track::PROVIDER_DATA, true);
        return false === $provider ? $this : $this->andWhere(['provider' => $provider]);
    }

    /**
     * @param string $status
     * @return TrackQuery
     */
    public function status($status)
    {
        $status = array_search($status, Track::STATUS_DATA, true);
        return false === $status ? $this : $this->andWhere(['status' => $status]);
    }

    /**
     * @param string $search
     * @return TrackQuery
     */
    public function search($search)
    {
        return $this->andFilterWhere(['like', 'title', trim($search)])
            ->orderBy(['title' => SORT_ASC]);
    }

    /**
     * @param string $sort
     * @return TrackQuery
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
