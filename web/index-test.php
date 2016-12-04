<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}
require __DIR__.'/../vendor/autoload.php';

if (preg_match('/\A(localhost|dev.plusarchive)\z/', $_SERVER['SERVER_NAME'])) {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'test');
    (new Dotenv\Dotenv(dirname(__DIR__)))->load();
}
require __DIR__.'/../vendor/yiisoft/yii2/Yii.php';
require __DIR__.'/../helpers/functions.php';

(new yii\web\Application(require __DIR__.'/../config/test.php'))->run();
