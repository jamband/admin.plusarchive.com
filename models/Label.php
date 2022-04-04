<?php

declare(strict_types=1);

namespace app\models;

use app\models\query\LabelQuery;
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
 *
 * @property LabelTag[] $tags
 * @see Label::getTags()
 */
class Label extends ActiveRecord
{
    use ActiveRecordTrait;

    public static function tableName(): string
    {
        return 'label';
    }

    public function attributeLabels(): array
    {
        return [
            'tagValues' => 'Tag',
        ];
    }

    public static function find(): LabelQuery
    {
        return new LabelQuery(static::class);
    }

    public function getTags(): ActiveQuery
    {
        return $this->hasMany(LabelTag::class, ['id' => 'label_tag_id'])
            ->viaTable('label_tag_assn', ['label_id' => 'id'])
            ->orderBy(['name' => SORT_ASC]);
    }

    public static function all(
        string|null $country = null,
        string|null $tag = null,
        string|null $search = null,
    ): ActiveDataProvider {
        $query = static::find()
            ->with(['tags']);

        if (null !== $country) {
            $query->country($country);
        }

        if (null !== $tag) {
            $query->allTagValues($tag);
        }

        if (null !== $search) {
            $query->search($search)
                ->inNameOrder();
        } else {
            $query->latest();
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
            [['name', 'url'], 'unique'],
            [['name', 'country'], 'string', 'max' => 200],

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
