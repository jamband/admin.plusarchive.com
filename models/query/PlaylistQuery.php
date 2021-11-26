<?php

declare(strict_types=1);

namespace app\models\query;

use app\models\Music;
use yii\db\ActiveQuery;

class PlaylistQuery extends ActiveQuery
{
    use ActiveQueryTrait;

    public function init(): void
    {
        parent::init();

        $this->where(['type' => Music::TYPE_PLAYLIST]);
    }
}
