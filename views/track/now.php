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
 * @var app\models\Track $model
 * @var string $embed
 * @var string $id
 */

use yii\helpers\Html;

?>
<div id="track-modal" class="modal fade">
    <div class="text-center modal-dialog">
        <?= Html::tag('iframe', '', [
            'src' => h($embed),
            'data-provider' => h($model->providerText),
            'frameborder' => '0',
            'allowfullscreen' => true,
        ]) ?>
        <?= Html::a('View <i class="fa fa-fw fa-angle-right"></i>', ['view', 'id' => $id], [
            'class' => 'label label-default',
        ]) ?>
        <div id="now-playing-loading">
            <div class="line-scale"><div></div><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
</div>
<p id="now-playing-title">
    <?= h($model->title) ?>
    <span id="now-playing-clear"></span>
</p>

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

$iframe.load(function() {
    $('#now-playing-loading').fadeOut();
});
$(document).on('click', '#now-playing-title', function() {
    $('#track-modal').modal('show');
});
$(document).on('click', '#now-playing-clear', function() {
    $('#now-playing').children().fadeOut(function() {
        $(this).remove();
    });
});
JS
);
