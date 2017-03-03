<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models\common;

use yii\base\UnknownMethodException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * @method ActiveQuery find()
 */
trait ActiveRecordTrait
{
    /**
     * Returns all name attribute values.
     * @return ActiveQuery
     */
    public static function getNames()
    {
        return static::find()
            ->select('name')
            ->orderBy(['name' => SORT_ASC]);
    }

    /**
     * Returns all countries.
     * @return array
     */
    public static function getCountries()
    {
        return static::find()
            ->select('country')
            ->distinct()
            ->orderBy(['country' => SORT_ASC])
            ->column();
    }

    /**
     * Returns all ids.
     * @return array
     */
    public static function getIds()
    {
        return static::find()
            ->select('id')
            ->column();
    }

    /**
     * Updates a timestamp attribute to the current timestamp.
     * @param int $id
     * @param string $attribute
     * @see TimestampBehavior::touch()
     */
    public static function updateTimestampAttribute($id, $attribute = 'updated_at')
    {
        /** @var ActiveQuery $model */
        $model = static::findOne($id);

        if (!$model->hasMethod('touch')) {
            throw new UnknownMethodException('Calling unknown method: '.self::class.'::touch()');
        }
        if (null !== $model) {
            /** @var TimestampBehavior $model */
            $model->touch($attribute);
        }
    }
}
