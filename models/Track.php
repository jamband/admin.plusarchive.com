<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\models;

use app\models\query\TrackQuery;
use creocoder\taggable\TaggableBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * @property string $tagValues
 *
 * @property musicGenre[] $musicGenres
 */
class Track extends Music
{
    /**
     * @return ActiveQuery
     */
    public function getMusicGenres(): ActiveQuery
    {
        return $this->hasMany(MusicGenre::class, ['id' => 'music_genre_id'])
            ->viaTable('music_genre_assn', ['music_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }

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

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'taggable' => [
                'class' => TaggableBehavior::class,
                'tagValuesAsArray' => true,
                'tagRelation' => 'musicGenres',
            ],
        ]);
    }

    /**
     * @return array
     */
    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
}
