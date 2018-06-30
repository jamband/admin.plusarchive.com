<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

    const STATUS_PRIVATE = 0;
    const STATUS_PUBLISH = 1;

    const STATUSES = [
        self::STATUS_PRIVATE => 'Private',
        self::STATUS_PUBLISH => 'Publish',
    ];

    const PROVIDER_BANDCAMP = 1;
    const PROVIDER_SOUNDCLOUD = 2;
    const PROVIDER_VIMEO = 3;
    const PROVIDER_YOUTUBE = 4;

    const PROVIDERS = [
        self::PROVIDER_BANDCAMP => 'Bandcamp',
        self::PROVIDER_SOUNDCLOUD => 'SoundCloud',
        self::PROVIDER_VIMEO => 'Vimeo',
        self::PROVIDER_YOUTUBE => 'YouTube',
    ];

    const TYPE_TRACK = 1;
    const TYPE_ALBUM = 2;
    const TYPE_PLAYLIST = 3;

    const TYPES = [
        self::TYPE_TRACK => 'Track',
        self::TYPE_ALBUM => 'Album',
        self::TYPE_PLAYLIST => 'Playlist',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'track';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tagValues' => 'Genres',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TrackQuery
     */
    public static function find()
    {
        return new TrackQuery(static::class);
    }

    /**
     * @return ActiveQuery
     */
    public function getTrackGenres()
    {
        return $this->hasMany(TrackGenre::class, ['id' => 'track_genre_id'])
            ->viaTable('track_genre_assn', ['track_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }

    /**
     * Transformation of status attribute.
     * @return string
     */
    public function getStatusText()
    {
        return self::STATUSES[$this->status];
    }

    /**
     * Transformation of provider attribute.
     * @return string
     */
    public function getProviderText()
    {
        return self::PROVIDERS[$this->provider];
    }

    /**
     * Transformation of type attribute.
     * @return string
     */
    public function getTypeText()
    {
        return self::TYPES[$this->type];
    }


    /**
     * Sets some attributes. (provider, provider_key, title, image)
     * @return $this
     */
    public function setContents()
    {
        $ripple = new Ripple($this->url);

        if ($ripple->isValidUrl()) {
            $ripple->request();

            $provider = array_search($ripple->provider(), self::PROVIDERS, true);
            $this->provider = $provider ?: null;
            $this->provider_key = $ripple->id();
            $this->title = $this->title ?: $ripple->title();
            $this->image = $this->image ?: $ripple->image();
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
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
     * {@inheritdoc}
     */
    public function behaviors()
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
     * {@inheritdoc}
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
}
