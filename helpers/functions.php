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
if (!function_exists('asset_revision')) {
    function asset_revision($file) {
        return yii\helpers\Url::to("@web/$file").'?v='.filemtime(Yii::getAlias("@app/web/$file"));
    }
}
if (!function_exists('without_scheme_url')) {
    function without_scheme_url($url) {
        return preg_replace('#\Ahttps?://#', '//', $url);
    }
}
if (!function_exists('custom_domains_for_as_sns_icon_link')) {
    function custom_domains_for_as_sns_icon_link() {
        return array_fill_keys(jamband\ripple\Bandcamp::$hosts, 'bandcamp');
    }
}
