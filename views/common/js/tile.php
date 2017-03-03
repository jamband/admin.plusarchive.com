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
    var $container = $('#tile-container');
    $('.lazy').lazyload({
        threshold: 500,
        effect: 'fadeIn',
        placeholder: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNQqgcAAMYAogMXSH0AAAAASUVORK5CYII=',
        load: function() {
            $container.imagesLoaded(function() {
                $container.masonry({
                    columnWidth: '.tile',
                    itemSelector: '.tile',
                    transitionDuration: 0
                });
                $container.find('.tile').css({'opacity': 1});
            });
        }
    });
});
JS
);
