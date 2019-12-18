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

namespace app\models\query;

use app\models\Playlist;
use yii\db\ActiveQuery;

/**
 * @see \app\models\Playlist
 */
class PlaylistQuery extends ActiveQuery
{
    use ActiveQueryTrait;

    /**
     * @return void
     */
    public function init(): void
    {
        parent::init();

        $this->where(['type' => Playlist::TYPE_PLAYLIST]);
    }
}
