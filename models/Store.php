<?php

declare(strict_types=1);

namespace app\models;

use app\models\query\StoreQuery;
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
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StoreTag[] $tags
 * @see Store::getTags()
 */
class Store extends ActiveRecord
{
    use ActiveRecordTrait;

    public static function tableName(): string
    {
        return 'store';
    }

    public function attributeLabels(): array
    {
        return [
            'tagValues' => 'Tag',
        ];
    }

    public static function find(): StoreQuery
    {
        return new StoreQuery(static::class);
    }

    public function getTags(): ActiveQuery
    {
        return $this->hasMany(StoreTag::class, ['id' => 'store_tag_id'])
            ->viaTable('store_tag_assn', ['store_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }

    public function rules(): array
    {
        return [
            ['name', 'required'],
            ['name', 'trim'],
            ['name', 'unique'],
            ['name', 'string', 'max' => 200],

            ['country', 'trim'],
            ['country', 'string', 'max' => 200],

            ['url', 'required'],
            ['url', 'trim'],
            ['url', 'url'],
            ['url', 'unique'],
            ['url', 'string', 'max' => 200],

            ['link', 'trim'],
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
                'tagRelation' => 'tags',
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
