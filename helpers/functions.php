<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// Core components
if (!function_exists('app')) {
    function app() {
        return Yii::$app;
    }
}
if (!function_exists('db')) {
    function db() {
        return Yii::$app->getDb();
    }
}
if (!function_exists('formatter')) {
    function formatter() {
        return Yii::$app->getFormatter();
    }
}
if (!function_exists('request')) {
    function request() {
        return Yii::$app->getRequest();
    }
}
if (!function_exists('response')) {
    function response() {
        return Yii::$app->getResponse();
    }
}
if (!function_exists('session')) {
    function session() {
        return Yii::$app->getSession();
    }
}
if (!function_exists('security')) {
    function security() {
        return Yii::$app->getSecurity();
    }
}
if (!function_exists('user')) {
    function user() {
        return Yii::$app->getUser();
    }
}

// Custom components
if (!function_exists('hashids')) {
    function hashids() {
        return Yii::$app->get('hashids');
    }
}

// Other
if (!function_exists('url')) {
    function url($url = '', $scheme = false) {
        return yii\helpers\Url::to($url, $scheme);
    }
}
if (!function_exists('h')) {
    function h($string) {
        return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
if (!function_exists('asset')) {
    function asset($file) {
        $manifest = Yii::getAlias('@app/web/assets/manifest.json');

        $manifest = file_exists($manifest)
            ? json_decode(file_get_contents($manifest))
            : new stdClass;

        return property_exists($manifest, $file)
            ? '/assets/'.$manifest->$file
            : '/assets/'.$file;
    }
}
if (!function_exists('custom_domains')) {
    function custom_domains() {
        static $domains;
        if (null === $domains) {
            $domains = array_fill_keys(jamband\ripple\Bandcamp::$hosts, 'bandcamp');
        }
        return $domains;
    }
}
