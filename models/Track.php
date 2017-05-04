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
 * @property string $tagValues
 */
class Track extends ActiveRecord
{
    use ActiveRecordTrait;
    use RippleValidatorTrait;

    const STATUS_PRIVATE = 0;
    const STATUS_PUBLISH = 1;

    const STATUS_PRIVATE_TEXT = 'Private';
    const STATUS_PUBLISH_TEXT = 'Publish';

    const STATUSES = [
        self::STATUS_PRIVATE => self::STATUS_PRIVATE_TEXT,
        self::STATUS_PUBLISH => self::STATUS_PUBLISH_TEXT,
    ];

    const PROVIDER_BANDCAMP = 1;
    const PROVIDER_SOUNDCLOUD = 2;
    const PROVIDER_VIMEO = 3;
    const PROVIDER_YOUTUBE = 4;

    const PROVIDER_BANDCAMP_TEXT = 'Bandcamp';
    const PROVIDER_SOUNDCLOUD_TEXT = 'SoundCloud';
    const PROVIDER_VIMEO_TEXT = 'Vimeo';
    const PROVIDER_YOUTUBE_TEXT = 'YouTube';

    const PROVIDERS = [
        self::PROVIDER_BANDCAMP => self::PROVIDER_BANDCAMP_TEXT,
        self::PROVIDER_SOUNDCLOUD => self::PROVIDER_SOUNDCLOUD_TEXT,
        self::PROVIDER_VIMEO => self::PROVIDER_VIMEO_TEXT,
        self::PROVIDER_YOUTUBE => self::PROVIDER_YOUTUBE_TEXT,
    ];

    const TYPE_TRACK = 1;
    const TYPE_ALBUM = 2;
    const TYPE_PLAYLIST = 3;

    const TYPE_TRACK_TEXT = 'Track';
    const TYPE_ALBUM_TEXT = 'Album';
    const TYPE_PLAYLIST_TEXT = 'Playlist';

    const TYPES = [
        self::TYPE_TRACK => self::TYPE_TRACK_TEXT,
        self::TYPE_ALBUM => self::TYPE_ALBUM_TEXT,
        self::TYPE_PLAYLIST => self::TYPE_PLAYLIST_TEXT,
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
