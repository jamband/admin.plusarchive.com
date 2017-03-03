<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models\query;

use yii\db\ActiveQuery;

class PlaylistItemQuery extends ActiveQuery
{
    /**
     * @param int $playlist_id
     * @return $this
     */
    public function playlist($playlist_id)
    {
        return $this->andWhere(['playlist_id' => $playlist_id]);
    }

    /**
     * @param int $track_id
     * @return $this
     */
    public function track($track_id)
    {
        return $this->andWhere(['track_id' => $track_id]);
    }
}
