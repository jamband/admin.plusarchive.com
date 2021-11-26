<?php

declare(strict_types=1);

namespace app\models;

use app\models\query\BookmarkQuery;
use creocoder\taggable\TaggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string $country
 * @property string $url
 * @property string $link
 * @property int $created_at
 * @property int $updated_at
 * @property BookmarkTag[] $bookmarkTags
 *
 * @property string $statusText
 */
class Bookmark extends ActiveRecord
{
    use ActiveRecordTrait;

    public static function tableName(): string
    {
        return 'bookmark';
    }

    public function attributeLabels(): array
    {
        return [
            'tagValues' => 'Tag',
        ];
    }

    public static function find(): BookmarkQuery
    {
        return new BookmarkQuery(static::class);
    }

    /**
     * @noinspection PhpUnused
     */
    public function getBookmarkTags(): ActiveQuery
    {
        return $this->hasMany(BookmarkTag::class, ['id' => 'bookmark_tag_id'])
            ->viaTable('bookmark_tag_assn', ['bookmark_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }

    public static function all(
        string|null $sort = null,
        string|null $country = null,
        string|null $tag = null,
        string|null $search = null,
    ): ActiveDataProvider {
        $query = static::find()
            ->with(['bookmarkTags']);

        if (null !== $country) {
            $query->country($country);
        }

        if (null === $search) {
            $query->sort($sort);
        } else {
            $query->search($search)
                ->inNameOrder();
        }

        if (null !== $tag) {
            $query->allTagValues($tag);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);
    }

    public function rules(): array
    {
        return [
            [['name', 'url'], 'required'],
            [['name', 'country', 'url', 'link'], 'trim'],
            [['name', 'country', 'url'], 'string', 'max' => 255],
            [['name', 'url'], 'unique'],

            ['url', 'url'],
            ['link', 'string', 'max' => 1000],
            ['tagValues', 'safe'],
        ];
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            'taggable' => [
                'class' => TaggableBehavior::class,
                'tagValuesAsArray' => true,
                'tagRelation' => 'bookmarkTags',
            ],
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
}
