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

use app\models\common\ActiveRecordTrait;
use app\models\query\TrackQuery;
use app\models\validators\RippleValidatorTrait;
use creocoder\taggable\TaggableBehavior;
use jamband\ripple\Ripple;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $url
 * @property int $status
 * @property int $provider
 * @property string $provider_key
 * @property string $title
 * @property string $image
 * @property int $type
 * @property int $created_at
 * @property int $updated_at
 *
 * @property string $tagValues
 *
 * @property trackGenre[] $trackGenres
 *
 * @property string $statusText
 * @property string $providerText
 * @property string $typeText
 */
class Track extends ActiveRecord
{
    use ActiveRecordTrait;
    use RippleValidatorTrait;

    public const STATUS_PRIVATE = 0;
    public const STATUS_PUBLISH = 1;

    public const STATUSES = [
        self::STATUS_PRIVATE => 'Private',
        self::STATUS_PUBLISH => 'Publish',
    ];

    public const PROVIDER_BANDCAMP = 1;
    public const PROVIDER_SOUNDCLOUD = 2;
    public const PROVIDER_VIMEO = 3;
    public const PROVIDER_YOUTUBE = 4;

    public const PROVIDERS = [
        self::PROVIDER_BANDCAMP => 'Bandcamp',
        self::PROVIDER_SOUNDCLOUD => 'SoundCloud',
        self::PROVIDER_VIMEO => 'Vimeo',
        self::PROVIDER_YOUTUBE => 'YouTube',
    ];

    public const TYPE_TRACK = 1;
    public const TYPE_ALBUM = 2;
    public const TYPE_PLAYLIST = 3;

    public const TYPES = [
        self::TYPE_TRACK => 'Track',
        self::TYPE_ALBUM => 'Album',
        self::TYPE_PLAYLIST => 'Playlist',
    ];

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'track';
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'tagValues' => 'Genres',
        ];
    }

    /**
     * @return TrackQuery
     */
    public static function find(): TrackQuery
    {
        return new TrackQuery(static::class);
    }

    /**
     * @return ActiveQuery
     */
    public function getTrackGenres(): ActiveQuery
    {
        return $this->hasMany(TrackGenre::class, ['id' => 'track_genre_id'])
            ->viaTable('track_genre_assn', ['track_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }

    /**
     * Transformation of status attribute.
     *
     * @return string
     */
    public function getStatusText(): string
    {
        return self::STATUSES[$this->status];
    }

    /**
     * Transformation of provider attribute.
     *
     * @return string
     */
    public function getProviderText(): string
    {
        return self::PROVIDERS[$this->provider];
    }

    /**
     * Transformation of type attribute.
     *
     * @return string
     */
    public function getTypeText(): string
    {
        return self::TYPES[$this->type];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['url'], 'required'],
            [['url', 'title', 'image'], 'trim'],
            [['url', 'image'], 'url'],

            ['url', 'unique'],
            ['url', 'validateUrl'],
            ['url', 'validateContent'],
            ['status', 'in', 'range' => array_keys(self::STATUSES)],
            ['title', 'string', 'max' => 200],
            ['type', 'in', 'range' => array_keys(self::TYPES)],
            ['tagValues', 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            'taggable' => [
                'class' => TaggableBehavior::class,
                'tagRelation' => 'trackGenres',
            ],
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate(): bool
    {
        $ripple = new Ripple($this->url);
        $ripple->request();

        $this->provider = array_search($ripple->provider(), self::PROVIDERS, true) ?: null;
        $this->provider_key = $ripple->id();
        $this->title = $this->title ?: $ripple->title();
        $this->image = $this->image ?: $ripple->image();

        return parent::beforeValidate();
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
