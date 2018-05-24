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
toastr.options = {
  timeOut: 0,
  extendedTimeOut: 0,
  tapToDismiss: false,
  positionClass: 'toast-bottom-full-width',
  closeButton: true,
  closeHtml: '<button type="button">OK</button>',
  onCloseClick: function () {
    $.ajax({
      url: 'privacy-consent'
    }).done(function () {
      // ...
    }).fail(function () {
        alert('Request failure.');
    });
  }
};
toastr.info('We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.');
JS
);
