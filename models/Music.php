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

use creocoder\taggable\TaggableBehavior;
use Jamband\Ripple\Ripple;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $url
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
 * @property musicGenre[] $musicGenres
 *
 * @property string $providerText
 * @property string $typeText
 */
class Music extends ActiveRecord
{
    use ActiveRecordTrait;

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
     * @var Ripple
     */
    private $_ripple;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'music';
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
     * @return ActiveQuery
     */
    public function getMusicGenres(): ActiveQuery
    {
        return $this->hasMany(MusicGenre::class, ['id' => 'music_genre_id'])
            ->viaTable('music_genre_assn', ['music_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
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
            ['url', 'validateValidUrl'],
            ['url', 'validateHasContent'],
            ['title', 'string', 'max' => 200],
            ['type', 'in', 'range' => array_keys(self::TYPES)],
            ['tagValues', 'safe'],
        ];
    }

    /**
     * @param string $attribute
     * @return void
     */
    public function validateValidUrl(string $attribute): void
    {
        if (null === $this->_ripple->url()) {
            $this->addError($attribute, 'The URL is invalid.');
        }
    }

    /**
     * @param string $attribute
     * @return void
     */
    public function validateHasContent(string $attribute): void
    {
        if (null === $this->provider_key) {
            $this->addError($attribute, 'Unable to retrieve the contents from the URL.');
        }
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
                'tagValuesAsArray' => true,
                'tagRelation' => 'musicGenres',
            ],
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate(): bool
    {
        $this->_ripple = Yii::createObject(Ripple::class);
        $this->_ripple->request($this->url);

        $this->url = $this->_ripple->url() ?? $this->url;
        $this->provider = array_search($this->_ripple->provider(), self::PROVIDERS, true) ?: null;
        $this->provider_key = $this->_ripple->id();
        $this->title = $this->title ?: $this->_ripple->title();
        $this->image = $this->image ?: $this->_ripple->image();

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
