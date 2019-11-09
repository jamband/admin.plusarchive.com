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

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * @method static|ActiveQuery find()
 */
trait ActiveRecordTrait
{
    /**
     * Returns all names.
     *
     * @return array
     */
    public static function getNames(): array
    {
        return static::find()
            ->select('name')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }

    /**
     * Returns all countries.
     *
     * @return array
     */
    public static function getCountries(): array
    {
        return static::find()
            ->select('country')
            ->distinct()
            ->orderBy(['country' => SORT_ASC])
            ->column();
    }

    /**
     * @param string $key
     * @param string|null $value
     * @param string|null $sortKey
     * @return array
     */
    public static function listData(string $key, ?string $value = null, ?string $sortKey = null): array
    {
        $data = static::find()
            ->orderBy([$sortKey ?? $key => SORT_ASC])
            ->asArray()
            ->all();

        return ArrayHelper::map($data, $key, $value ?? $key);
    }
}
