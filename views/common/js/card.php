<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @var yii\web\View $this
 */

$this->registerJs(<<<'JS'
$(document).on('ready pjax:success', function() {
    var $container = $('.card-container');
    $container.each(function() {
        this.addEventListener('load', function() {
            $container.masonry({transitionDuration: 0});
        }, true);
    });
    $(document).on('lazybeforeunveil', function(){
        $container.find('.card-play').css({
            'opacity': .6,
            'transition': 'opacity 200ms'
        });
    });
});
JS
);
