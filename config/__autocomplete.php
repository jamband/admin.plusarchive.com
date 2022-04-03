<?php

declare(strict_types=1);

use app\components\Formatter;
use app\components\Hashids;
use yii\console\Application as ConsoleApplication;
use yii\rbac\DbManager;
use yii\web\Application as WebApplication;

class Yii
{
    public static WebApplication|ConsoleApplication|__Application $app;
}

/**
 * @property DbManager $authManager
 * @property Hashids $hashids
 * @property Formatter $formatter
 */
class __Application
{
}
