<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use yii\web\Application;

if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

require __DIR__.'/../vendor/autoload.php';

if (preg_match('/\A(localhost|dev.admin.plusarchive)\z/', $_SERVER['SERVER_NAME'])) {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'test');

    $dotenv = Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();
}

require __DIR__.'/../vendor/yiisoft/yii2/Yii.php';

(new Application(require __DIR__.'/../config/test.php'))->run();
