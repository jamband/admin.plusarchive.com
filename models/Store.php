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
use app\models\query\StoreQuery;
use creocoder\taggable\TaggableBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * @property int $id
 * @property string $name
 * @property string $country
 * @property string $url
 * @property string $link
 * @property int $created_at
 * @property int $updated_at
 *
 * @property StoreTag[] $storeTags
 */
class Store extends ActiveRecord
{
    use ActiveRecordTrait;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'store';
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
     * @return StoreQuery
     */
    public static function find(): StoreQuery
    {
        return new StoreQuery(static::class);
    }

    /**
     * @return ActiveQuery
     */
    public function getStoreTags(): ActiveQuery
    {
        return $this->hasMany(StoreTag::class, ['id' => 'store_tag_id'])
            ->viaTable('store_tag_assn', ['store_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }

    /**
     * @param null|string $sort
     * @param null|string $country
     * @param null|string $tag
     * @param null|string $search
     * @return ActiveDataProvider
     */
    public static function all(?string $sort, ?string $country, ?string $tag, ?string $search): ActiveDataProvider
    {
        $query = static::find()
            ->with(['storeTags']);

        if (null === $search) {
            $query->country($country)
                ->sort($sort);
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

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['name', 'url'], 'required'],
            [['name', 'country', 'url', 'link'], 'trim'],
            [['name', 'url'], 'unique'],
            [['name', 'country'], 'string', 'max' => 200],

            ['url', 'url'],
            ['link', 'string', 'max' => 1000],
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
                'tagRelation' => 'storeTags',
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
