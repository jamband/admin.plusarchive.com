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
    var lazy = $('.track-image').lazyload({
        threshold: 500,
        placeholder: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNQqgcAAMYAogMXSH0AAAAASUVORK5CYII=',
    });
    var $container = $('#tile-container');
    var masonry = $container.masonry({
        columnWidth: '.tile',
        itemSelector: '.tile',
        transitionDuration: 0
    });
    $container.imagesLoaded().progress(function() {
        masonry.masonry('layout');
        $container.find('.tile').css({'visibility': 'visible'});
    });
    lazy.load(function() {
        masonry.masonry('layout');
    })
});
JS
);
