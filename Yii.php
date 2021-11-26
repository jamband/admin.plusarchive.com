<?php

declare(strict_types=1);

class Yii extends yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication
     */
    public static $app;
}

/**
 *
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * @property app\components\Formatter $formatter
 * @method app\components\Formatter getFormatter()
 */
class WebApplication extends yii\web\Application
{
}

/**
 *
 */
class ConsoleApplication extends yii\console\Application
{
}
