<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return yii\helpers\ArrayHelper::merge(require __DIR__.'/common.php', [
    'id' => 'plusarchive-console',
    'controllerNamespace' => 'app\commands',
]);
