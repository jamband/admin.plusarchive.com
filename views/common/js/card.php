<?php

/**
 * @var yii\web\View $this
 */

$this->registerJs(<<<'JS'
var card = function () {
    var $container = $('.card-container');
    $container.each(function () {
        this.addEventListener('load', function () {
            $container.masonry({transitionDuration: 0});
        }, true);
    });
}
$(card);
$(document).on('pjax:success', card);
JS
);
