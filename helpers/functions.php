<?php

declare(strict_types=1);

// Core components
if (!function_exists('app')) {
    function app(): yii\console\Application|yii\web\Application {
        return Yii::$app;
    }
}

if (!function_exists('db')) {
    function db(): yii\db\Connection {
        return Yii::$app->getDb();
    }
}

if (!function_exists('formatter')) {
    function formatter(): app\components\Formatter|yii\i18n\Formatter {
        return Yii::$app->getFormatter();
    }
}

if (!function_exists('request')) {
    function request(): yii\console\Request|yii\web\Request {
        return Yii::$app->getRequest();
    }
}

if (!function_exists('response')) {
    function response(): yii\console\Response|yii\web\Response {
        return Yii::$app->getResponse();
    }
}

if (!function_exists('session')) {
    function session(): yii\web\Session {
        return Yii::$app->getSession();
    }
}

if (!function_exists('security')) {
    function security(): yii\base\Security {
        return Yii::$app->getSecurity();
    }
}

if (!function_exists('user')) {
    function user(): yii\web\User {
        return Yii::$app->getUser();
    }
}

// Custom components
if (!function_exists('hashids')) {
    function hashids(): object|null {
        return Yii::$app->get('hashids');
    }
}

// Others
if (!function_exists('url')) {
    function url(array|string $url = '', bool $scheme = false): string {
        return yii\helpers\Url::to($url, $scheme);
    }
}

if (!function_exists('h')) {
    function h(string $string): string {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE);
    }
}

if (!function_exists('asset')) {
    function asset(string $file): string {
        $manifest = Yii::getAlias('@app/web/assets/manifest.json');

        $manifest = file_exists($manifest)
            ? json_decode(file_get_contents($manifest))
            : new stdClass;

        return property_exists($manifest, $file)
            ? '/assets/'.$manifest->$file
            : '/assets/'.$file;
    }
}
