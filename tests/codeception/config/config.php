<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'controllerMap' => [
        'fixture' => [
            'class' => yii\faker\FixtureController::class,
            'fixtureDataPath' => '@tests/codeception/fixtures',
            'templatePath' => '@tests/codeception/templates',
            'namespace' => 'tests\codeception\fixtures',
        ],
    ],
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=plusarchive_test',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
