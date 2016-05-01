<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$this->registerJs(<<<'JS'
$(document).on('ready pjax:success', function() {
    var $container = $('#tile-container');
    $container.imagesLoaded(function() {
        $('.lazy').lazyload({
            threshold: 500,
            placeholder: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNQqgcAAMYAogMXSH0AAAAASUVORK5CYII=',
            load: function() {
                $container.masonry({
                    itemSelector: '.tile',
                    transitionDuration: 0
                });
            }
        });
        $container.css({'opacity': 1});
    });
});
JS
);
