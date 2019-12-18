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

use app\models\query\PlaylistQuery;
use yii\data\ActiveDataProvider;

class Playlist extends Music
{
    /**
     * @return PlaylistQuery
     */
    public static function find(): PlaylistQuery
    {
        return new PlaylistQuery(static::class);
    }

    /**
     * @return ActiveDataProvider
     */
    public static function all(): ActiveDataProvider
    {
        $query = static::find();

        return new ActiveDataProvider([
            'query' => $query->latest(),
            'pagination' => false,
        ]);
    }
}
