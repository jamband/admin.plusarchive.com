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

use app\models\query\PlaylistQuery;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class Playlist extends Track
{
    /**
     * @return ActiveQuery
     */
    public static function find(): ActiveQuery
    {
        return new PlaylistQuery(static::class);
    }

    /**
     * @param null|string ...$params
     * @return ActiveDataProvider
     */
    public static function all(?string ...$params): ActiveDataProvider
    {
        /** @var $query PlaylistQuery */
        $query = static::find();

        return new ActiveDataProvider([
            'query' => $query->latest(),
            'pagination' => false,
        ]);
    }
}
