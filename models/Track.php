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
use app\models\common\DataTransformationTrait;
use app\models\query\TrackQuery;
use app\models\validators\RippleValidatorTrait;
use creocoder\taggable\TaggableBehavior;
use jamband\ripple\Ripple;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $url
 * @property integer $status
 * @property integer $provider
 * @property string $provider_key
 * @property string $title
 * @property string $image
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $tagValues
 */
class Track extends ActiveRecord
{
    use ActiveRecordTrait;
    use RippleValidatorTrait;
    use DataTransformationTrait;

    const STATUS_PRIVATE = 0;
    const STATUS_PUBLISH = 1;

    const STATUS_PRIVATE_TEXT = 'Private';
    const STATUS_PUBLISH_TEXT = 'Publish';

    const STATUS_DATA = [
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

    const PROVIDER_DATA = [
        self::PROVIDER_BANDCAMP => self::PROVIDER_BANDCAMP_TEXT,
        self::PROVIDER_SOUNDCLOUD => self::PROVIDER_SOUNDCLOUD_TEXT,
        self::PROVIDER_VIMEO => self::PROVIDER_VIMEO_TEXT,
        self::PROVIDER_YOUTUBE => self::PROVIDER_YOUTUBE_TEXT,
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'track';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tagValues' => 'Genres',
        ];
    }

    /**
     * @inheritdoc
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
            ->viaTable('track_genre_assn', ['track_id' => 'id']);
    }

    /**
     * Transformation of provider attribute.
     * @return string
     */
    public function getProviderText()
    {
        return self::PROVIDER_DATA[$this->provider];
    }

    /**
     * Transformation of status attribute.
     * @return string
     */
    public function getStatusText()
    {
        return self::STATUS_DATA[$this->status];
    }

    /**
     * Sets some attributes. (provider, provider_key, title, image)
     * @return Track
     */
    public function setContents()
    {
        $ripple = new Ripple($this->url);

        if ($ripple->isValidUrl()) {
            $ripple->request();

            $provider = array_search($ripple->provider(), self::PROVIDER_DATA, true);
            $this->provider = $provider ?: null;
            $this->provider_key = $ripple->id();
            $this->title = $this->title ?: $ripple->title();
            $this->image = $this->image ?: $ripple->image();
        }
        return $this;
    }

    /**
     * @inheritdoc
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
            ['status', 'in', 'range' => array_keys(self::STATUS_DATA)],
            ['title', 'string', 'max' => 200],
            ['tagValues', 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }
        $playlist_ids = PlaylistItem::getPlaylistIdsByTrackId($this->id);
        PlaylistItem::removeTracks($this->id);

        foreach ($playlist_ids as $playlist_id) {
            if (!PlaylistItem::hasTracksByPlaylistId($playlist_id)) {
                Playlist::toIncomplete($playlist_id);
            }
        }
        return true;
    }
}
