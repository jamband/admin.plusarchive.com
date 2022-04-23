<?php

declare(strict_types=1);

namespace app\models\query;

use app\models\Music;
use app\models\Playlist;
use yii\db\ActiveQuery;

/** @see Playlist */
class PlaylistQuery extends ActiveQuery
{
    public function init(): void
    {
        parent::init();

        $this->where(['type' => Music::TYPE_PLAYLIST]);
    }

    public function latest(): PlaylistQuery
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }
}
