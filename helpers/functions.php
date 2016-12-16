<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// core components and more
function app() {
    return Yii::$app;
}
function db() {
    return Yii::$app->getDb();
}
function formatter() {
    return Yii::$app->getFormatter();
}
function request() {
    return Yii::$app->getRequest();
}
function response() {
    return Yii::$app->getResponse();
}
function session() {
    return Yii::$app->getSession();
}
function security() {
    return Yii::$app->getSecurity();
}
function user() {
    return Yii::$app->getUser();
}
function hashids() {
    return Yii::$app->hashids;
}

// others
function url($url = '', $scheme = false) {
    return yii\helpers\Url::to($url, $scheme);
}
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function asset_revision($file) {
    return yii\helpers\Url::to("@web/$file").'?v='.filemtime(Yii::getAlias("@app/web/$file"));
}
function custom_domains_for_as_sns_icon_link() {
    return array_fill_keys(jamband\ripple\Bandcamp::$hosts, 'bandcamp');
}
