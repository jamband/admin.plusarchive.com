<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * @method static|ActiveQuery find()
 */
trait ActiveRecordTrait
{
    public static function getNames(): array
    {
        return static::find()
            ->select('name')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }

    public static function getCountries(): array
    {
        return static::find()
            ->select('country')
            ->distinct()
            ->orderBy(['country' => SORT_ASC])
            ->column();
    }

    public static function listData(
        string $key,
        string|null $value = null,
        string|null $sortKey = null,
    ): array {
        $data = static::find()
            ->orderBy([$sortKey ?? $key => SORT_ASC])
            ->asArray()
            ->all();

        return ArrayHelper::map($data, $key, $value ?? $key);
    }
}
