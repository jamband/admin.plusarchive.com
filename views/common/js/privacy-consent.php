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
 * @var string $privacyUrl
 * @var string $privacyConsentUrl
 */

$privacyUrl = url(['/site/privacy/index']);
$privacyConsentUrl = url(['/site/privacy-consent/index']);

$this->registerJs(<<<JS
toastr.options = {
  timeOut: 0,
  extendedTimeOut: 0,
  tapToDismiss: false,
  positionClass: 'toast-bottom-full-width',
  closeButton: true,
  closeHtml: '<button type="button">OK</button>',
  onCloseClick: function () {
    jQuery.ajax({
      url: '$privacyConsentUrl'
    }).done(function () {
      // ...
    }).fail(function () {
        alert('Request failure.');
    });
  }
};
toastr.info('This site uses cookies to provide better experience. If you continue to use this site we will assume that you are happy with <a href="$privacyUrl">Privacy Policy</a>.');
JS
);
