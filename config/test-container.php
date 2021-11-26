<?php

 declare(strict_types=1);

Yii::$container->set(Jamband\Ripple\Ripple::class, function () {
    $response['title'] = 'Foo Title';
    $response['thumbnail_url'] = 'http://dev.plusarchive:8080/assets/apple-touch-icon.png';
    $response = json_encode($response);

    $ripple = new Jamband\Ripple\Ripple;
    $ripple->options(['response' => $response]);
    return $ripple;
});
