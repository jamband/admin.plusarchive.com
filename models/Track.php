<?php

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
     * @noinspection PhpUnused
     */
    public function getMusicGenres(): ActiveQuery
    {
        return $this->hasMany(MusicGenre::class, ['id' => 'music_genre_id'])
            ->viaTable('music_genre_assn', ['music_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }

    public static function find(): TrackQuery
    {
        return new TrackQuery(static::class);
    }

    public static function all(
        string|null $provider = null,
        string|null $genre = null,
        string|null $search = null,
    ): ActiveDataProvider {
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

    public static function allAsAdmin(
        string|null $sort = null,
        string|null $provider = null,
        string|null $genre = null,
        string|null $search = null,
    ): ActiveDataProvider {
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

    public static function stopAllUrge(): void
    {
        self::updateAll(['urge' => 0], 'urge = 1');
    }

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

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
}
