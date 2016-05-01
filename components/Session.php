<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\components;

use Yii;

class Session extends \yii\web\Session
{
    /**
     * @inheritdoc
     * @link https://github.com/yiisoft/yii2/issues/10583
     */
    public function regenerateID($deleteOldSession = false)
    {
        if (interface_exists('\Throwable')) {
            try {
                session_regenerate_id($deleteOldSession);
            } catch (\Throwable $t) {
                Yii::error($t->getMessage());
            }
        } else {
            @session_regenerate_id($deleteOldSession);
        }
    }
}
