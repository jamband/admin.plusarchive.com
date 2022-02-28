<?php

/**
 * @var yii\web\View $this
 */

$privacyConsentUrl = url(['/site/privacy-consent/index']);

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
<button type="button" class="privacy-accept m-0 p-0 align-baseline btn btn-link fw-bold">ACCEPT</button>, you consent.
See <a href="<?= url(['/site/privacy/index']) ?>">Privacy Policy</a> for details.
