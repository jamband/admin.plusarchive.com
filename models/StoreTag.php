<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property int $frequency
 * @property int $created_at
 * @property int $updated_at
 */
class StoreTag extends ActiveRecord
{
    use ActiveRecordTrait;

    public static function tableName(): string
    {
        return 'store_tag';
    }

    public static function find(): ActiveQuery
    {
        return parent::find();
    }

    public function rules(): array
    {
        return [
            ['name', 'required'],
            ['name', 'trim'],
            ['name', 'string', 'max' => 100]
        ];
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }
}
