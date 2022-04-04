<?php

/**
 * @var yii\web\View $this
 */

$this->title = 'Privacy Policy - '.Yii::$app->name;
?>
<div class="row">
    <div class="col-lg-8 offset-lg-1">
        <h1>Privacy Policy</h1>
        <p>This site uses Google Analytics. The Google Analytics tool uses "Cookies" which are text files placed on your computer, to collect internet log information and visitor behavior information in an anonymous form. About the information collected by Google Analytics, please see the following links.</p>
        <a href="https://policies.google.com/privacy?hl=en" rel="noopener" target="_blank">
            <i class="fas fa-external-link-alt"></i> Google Privacy & Terms
        </a>

        <h4 class="mt-5 mb-3">For what purpose do this site use Google Analytics?</h4>
        <ul>
            <li>To know this site traffic and web page usage</li>
            <li>To know where it was accessed</li>
            <li>To know the type of OS and device</li>
        </ul>
        Knowing them helps make this site better.

        <h4 class="mt-5 mb-3">How long is the retention period of data by Google Analytics?</h4>
        Data retention period is "<strong>26 months</strong>".

        <h4 class="mt-5 mb-3">Google Analytics Opt-Out</h4>
        If pop-up related to cookie is displayed at the bottom of the screen,
        it means that you have not consent to the privacy policy of this site yet.
        If you consent, please press the OK button
        <p>
            Ever after consenting, you can opt-out by pressing the following link:
            <button type="button" class="m-0 p-0 align-baseline btn btn-link privacy-opt-out">Opt-Out</button>
        </p>

        <div class="my-5"></div>
    </div>
    <div class="col-lg-2">
    </div>
</div>

<?php
$this->registerJs(<<<'JS'
$(document).on('click', '.privacy-opt-out', function (event) {
  event.preventDefault();
  $.ajax({
    url: 'privacy-opt-out'
  }).done(function () {
    alert('Google Analytics opt-out has been completed.');
    location.reload();
  }).fail(function () {
    alert('Request failure.');
  });
});
JS
);
