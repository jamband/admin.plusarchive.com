<?php

/*
 * This file is part of the admin.plusarchive.com
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
$(document).on('click', '.card-img-top', function () {
    var $this = $(this);
    $.ajax($this.attr('data-action'), {
        timeout: 10000,
        data: {
          id: $this.attr('data-id'),
          url: $this.attr('data-url'),
          title: $this.attr('data-title'),
          provider: $this.attr('data-provider'),
          key: $this.attr('data-key')
        }
    }).done(function (data) {
        $('#now-playing').hide().html(data).fadeIn();
    }).fail(function () {
        alert('Request failure.');
    });
});
JS
);
