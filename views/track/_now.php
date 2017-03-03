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
$(document).on('click', '.track-image', function() {
    var $this = $(this);
    $.ajax($this.attr('data-url'), {
        timeout: 10000,
        data: { id: $this.attr('data-id') }
    }).done(function(data) {
        $('#track-now').hide().html(data).fadeIn();
    }).fail(function(data) {
        alert('Request failure.');
    });
});
JS
);
