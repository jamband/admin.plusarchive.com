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
use app\models\query\BookmarkQuery;
use creocoder\taggable\TaggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string $country
 * @property string $url
 * @property string $link
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property BookmarkTag[] $bookmarkTags
 *
 * @property string $statusText
 */
class Bookmark extends ActiveRecord
{
    use ActiveRecordTrait;

    public const STATUS_PRIVATE = 0;
    public const STATUS_PUBLISH = 1;

    public const STATUSES = [
        self::STATUS_PRIVATE => 'Private',
        self::STATUS_PUBLISH => 'Publish',
    ];

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'bookmark';
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'tagValues' => 'Tag',
        ];
    }

    /**
     * @return BookmarkQuery
     */
    public static function find(): BookmarkQuery
    {
        return new BookmarkQuery(static::class);
    }

    /**
     * @return ActiveQuery
     */
    public function getBookmarkTags(): ActiveQuery
    {
        return $this->hasMany(BookmarkTag::class, ['id' => 'bookmark_tag_id'])
            ->viaTable('bookmark_tag_assn', ['bookmark_id' => 'id'])
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
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'url'], 'required'],
            [['name', 'country', 'url', 'link'], 'trim'],
            [['name', 'country', 'url'], 'string', 'max' => 255],
            [['name', 'url'], 'unique'],

            ['url', 'url'],
            ['link', 'string', 'max' => 1000],
            ['status', 'in', 'range' => array_keys(self::STATUSES)],
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
                'tagRelation' => 'bookmarkTags',
            ],
        ];
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
