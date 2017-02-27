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
use app\models\query\StoreQuery;
use creocoder\taggable\TaggableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * @property integer $id
 * @property string $name
 * @property string $country
 * @property string $url
 * @property string $link
 * @property integer $created_at
 * @property integer $updated_at
 */
class Store extends ActiveRecord
{
    use ActiveRecordTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tagValues' => 'Tag',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new StoreQuery(static::class);
    }

    /**
     * @return ActiveQuery
     */
    public function getStoreTags()
    {
        return $this->hasMany(StoreTag::class, ['id' => 'store_tag_id'])
            ->viaTable('store_tag_assn', ['store_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
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
     * @inheritdoc
     */
    public function behaviors()
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
     * @inheritdoc
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
}
