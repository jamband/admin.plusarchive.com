<?php

declare(strict_types=1);

namespace app\models;

use app\models\query\TrackQuery;
use creocoder\taggable\TaggableBehavior;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * @property string $tagValues
 *
 * @property musicGenre[] $genres
 * @see Track::getGenres()
 */
class Track extends Music
{
    public function getGenres(): ActiveQuery
    {
        return $this->hasMany(MusicGenre::class, ['id' => 'music_genre_id'])
            ->viaTable('music_genre_assn', ['music_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }

    public static function find(): TrackQuery
    {
        return new TrackQuery(static::class);
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
                'tagRelation' => 'genres',
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
