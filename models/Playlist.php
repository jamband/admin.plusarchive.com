<?php

declare(strict_types=1);

namespace app\models;

use app\models\query\PlaylistQuery;

class Playlist extends Music
{
    public static function find(): PlaylistQuery
    {
        return new PlaylistQuery(static::class);
    }
}
