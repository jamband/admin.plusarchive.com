<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__.'/../../../config/web.php',
    require __DIR__.'/config.php'
);
$config['components']['log']['targets'] = [];

return $config;
