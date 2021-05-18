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
 * @var app\models\Track $model
 * @var string $embed
 * @var string $id
 * @var string $title
 * @var string $provider
 */

?>
<div id="track-modal" class="modal fade">
    <div class="text-center modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <iframe src="<?= h($embed) ?>" frameborder="0" data-provider="<?= h($provider) ?>" allowfullscreen></iframe>
                <a class="badge badge-secondary" href="<?= url(['view', 'id' => $id])?>">
                    View <i class="fas fa-angle-right fa-fw"></i>
                </a>
            </div>
        </div>
        <div class="now-playing-loading">
            <span>.</span><span>.</span><span>.</span>
        </div>
    </div>
</div>
<div class="now-playing-title mb-2">
    <i class="fas fa-fw fa-volume-up"></i> <?= h($title) ?>
    <span class="now-playing-clear"><i class="fas fa-fw fa-times"></i></span>
</div>

<?php
$this->registerJs(<<<'JS'
var $modal = $('#track-modal');
var $iframe = $modal.find('iframe');

if (/^(Vimeo|YouTube)$/.test($iframe.attr('data-provider'))) {
    $iframe.wrap('<div class="embed-responsive embed-responsive-16by9" />').addClass('embed-responsive-item');
} else {
    $iframe.attr({ 'width': '100%', 'height': '120' });
}
$modal.modal('show');

$iframe.on('load', function () {
    $('.now-playing-loading').fadeOut();
});
$(document).on('click', '.now-playing-title', function () {
    $('#track-modal').modal('show');
});
$(document).on('click', '.now-playing-clear', function () {
    $('#now-playing').children().fadeOut(function () {
        $(this).remove();
    });
});
JS
);
