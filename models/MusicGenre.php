<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
class MusicGenre extends ActiveRecord
{
    use ActiveRecordTrait;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'music_genre';
    }

    /**
     * @return ActiveQuery
     */
    public static function find(): ActiveQuery
    {
        return parent::find();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['name', 'required'],
            ['name', 'trim'],
            ['name', 'string', 'max' => 100],
        ];
    }

    /**
     * @param int $limit
     * @return array
     */
    public static function minimal(int $limit): array
    {
        $data = static::find()
            ->select('name')
            ->orderBy(['frequency' => SORT_DESC])
            ->limit($limit)
            ->column();

        sort($data, SORT_STRING);

        return $data;
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }
}
