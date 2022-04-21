<?php

/**
 * @var yii\web\View $this
 */

use yii\helpers\Url;

$privacyConsentUrl = Url::toRoute('/privacy-consent');

$this->registerJs(<<<JS
$(document).on('click', '.privacy-accept', function () {
    $.ajax({
        url: '$privacyConsentUrl'
    }).done(function () {
        location.reload();
    }).fail(function () {
        alert('Request failure.');
    });
});
JS
)

?>
<i class="fas fa-fw fa-info-circle"></i>
This site uses Google Analytics to provide better experience. By pressing
<button type="button" class="privacy-accept m-0 p-0 align-baseline btn btn-link">ACCEPT</button>, you consent.
See <a href="<?= Url::toRoute('/privacy') ?>">Privacy Policy</a> for details.
