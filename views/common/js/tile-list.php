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
        $container.masonry({
            columnWidth: '.list',
            itemSelector: '.list',
            transitionDuration: 0
        });
        $container.css({'opacity': 1});
    });
});
JS
);
