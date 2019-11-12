<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Yii::$container->set(Jamband\Ripple\Ripple::class, function () {
    $response['title'] = 'Foo Title';
    $response['thumbnail_url'] = 'http://dev.plusarchive:8080/assets/apple-touch-icon.png';
    $response = json_encode($response);

    $ripple = new Jamband\Ripple\Ripple;
    $ripple->options(['response' => $response]);
    return $ripple;
});
