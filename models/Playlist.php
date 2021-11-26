<?php

declare(strict_types=1);

namespace app\models;

use app\models\query\PlaylistQuery;
use yii\data\ActiveDataProvider;

class Playlist extends Music
{
    public static function find(): PlaylistQuery
    {
        return new PlaylistQuery(static::class);
    }

    public static function all(): ActiveDataProvider
    {
        $query = static::find();

        return new ActiveDataProvider([
            'query' => $query->latest(),
            'pagination' => false,
        ]);
    }
}
