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
use app\models\query\LabelQuery;
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
 * @property LabelTag[] $labelTags
 */
class Label extends ActiveRecord
{
    use ActiveRecordTrait;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'label';
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
     * @return LabelQuery
     */
    public static function find(): LabelQuery
    {
        return new LabelQuery(static::class);
    }

    /**
     * @return ActiveQuery
     */
    public function getLabelTags(): ActiveQuery
    {
        return $this->hasMany(LabelTag::class, ['id' => 'label_tag_id'])
            ->viaTable('label_tag_assn', ['label_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
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
                'tagRelation' => 'labelTags',
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
