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

namespace app\models;

use app\models\query\TrackQuery;
use yii\data\ActiveDataProvider;

class Track extends Music
{
    /**
     * @return TrackQuery
     */
    public static function find(): TrackQuery
    {
        return new TrackQuery(static::class);
    }

    /**
     * @param null|string $provider
     * @param null|string $genre
     * @param null|string $search
     * @return ActiveDataProvider
     */
    public static function all(?string $provider = null, ?string $genre = null, ?string $search = null): ActiveDataProvider
    {
        $query = static::find()
            ->with(['musicGenres']);

        if (null !== $provider) {
            $query->provider($provider);
        }

        if (null === $search) {
            $query->latest();
        } else {
            $query->search($search)
                ->inTitleOrder();
        }

        if (null !== $genre && '' !== $genre) {
            $query->allTagValues($genre);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 24,
            ],
        ]);
    }

    /**
     * @param null|string $sort
     * @param null|string $provider
     * @param null|string $genre
     * @param null|string $search
     * @return ActiveDataProvider
     */
    public static function allAsAdmin(?string $sort = null, ?string $provider = null, ?string $genre = null, ?string $search = null): ActiveDataProvider
    {
        $query = static::find()
            ->with(['musicGenres']);

        if (null !== $provider) {
            $query->provider($provider);
        }

        if (null === $search) {
            $query->sort($sort);
        } else {
            $query->search($search)
                ->inTitleOrder();
        }

        if (null !== $genre && '' !== $genre) {
            $query->allTagValues($genre);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 24,
            ],
        ]);
    }
}
