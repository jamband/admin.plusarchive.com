<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$_ = function ($component) {
    return parse_url(Codeception\Configuration::config()['config']['test_entry_url'], $component);
};

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');
defined('YII_TEST_ENTRY_URL') or define('YII_TEST_ENTRY_URL', $_(PHP_URL_PATH));
defined('YII_TEST_ENTRY_FILE') or define('YII_TEST_ENTRY_FILE', dirname(dirname(__DIR__)).'/web/index-test.php');

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../vendor/yiisoft/yii2/Yii.php';
require_once __DIR__.'/../../helpers/functions.php';

(new Dotenv\Dotenv(dirname(dirname(__DIR__))))->load();

$_SERVER['SCRIPT_FILENAME'] = YII_TEST_ENTRY_FILE;
$_SERVER['SCRIPT_NAME'] = YII_TEST_ENTRY_URL;
$_SERVER['SERVER_NAME'] = $_(PHP_URL_HOST);
$_SERVER['SERVER_PORT'] = $_(PHP_URL_PORT);

Yii::setAlias('@tests', dirname(__DIR__));
