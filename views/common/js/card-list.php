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
var card = function () {
    var $card = $('.card-container').masonry({ transitionDuration: 0 });
    $(window).on('load', function () {
        $card.masonry('layout');
    });
}
$(card);
$(document).on('pjax:success', card);
JS
);
