<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $url
 * @property int $provider
 * @property string $provider_key
 * @property string $title
 * @property string $image
 * @property int $type
 * @property int $urge
 * @property int $created_at
 * @property int $updated_at
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

    public static function tableName(): string
    {
        return 'music';
    }

    /**
     * @noinspection PhpUnused
     */
    public function getProviderText(): string
    {
        return self::PROVIDERS[$this->provider];
    }

    /**
     * @noinspection PhpUnused
     */
    public function getTypeText(): string
    {
        return self::TYPES[$this->type];
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }
}
