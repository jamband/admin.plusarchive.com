<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$_SERVER['SCRIPT_FILENAME'] = YII_TEST_ENTRY_FILE;
$_SERVER['SCRIPT_NAME'] = YII_TEST_ENTRY_URL;

return yii\helpers\ArrayHelper::merge(
    require __DIR__.'/../../../config/web.php',
    require __DIR__.'/config.php',
    [
        'components' => [
            'request' => [
                'enableCsrfValidation' => false,
            ],
        ],
    ]
);
