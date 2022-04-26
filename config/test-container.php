<?php

declare(strict_types=1);

use Jamband\Ripple\Ripple;

Yii::$container->set(Ripple::class, function () {
    $response['title'] = 'Foo Title';
    $response['thumbnail_url'] = 'http://dev.plusarchive:8080/assets/apple-touch-icon.png';
    $response = json_encode($response);

    $ripple = new Ripple();
    $ripple->options(['response' => $response]);

    return $ripple;
});
