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
 * @var yii\widgets\ActiveForm $form
 * @var string $status
 * @var string $provider
 * @var string $genre
 * @var string $search
 * @var yii\data\ActiveDataProvider $data
 * @var string $embedUrl
 * @var app\models\form\PlaylistItemCreateForm $model
 */

use app\models\Playlist;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$this->title = 'Create Playlist Item - '.app()->name;
?>
<?= $this->render('/common/nav/create', ['model' => $model]) ?>

<div class="row">
    <div class="col-xs-12 col-sm-1"></div>
    <div class="col-xs-12 col-sm-5">
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'playlist_id')->dropDownList(Playlist::getListData(), [
                'prompt' => 'Please select a playlist',
                'data-url' => url(['list']),
            ]) ?>
            <div id="playlist-items"></div>
            <?= $form->field($model, 'track_id')->textInput([
                'readonly' => true,
                'placeholder' => 'Please select a track by clicking on the title',
            ]) ?>
            <?= $form->field($model, 'track_title')->textInput([
                'readonly' => true,
                'placeholder' => 'Please select a track by clicking on the title',
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-xs-12 col-sm-5">
        <div class="alert alert-info">
            <p>
                <i class="fa fa-fw fa-info-circle"></i>
                <strong><?= h($model->getAttributeLabel('track_id')) ?></strong> と
                <strong><?= h($model->getAttributeLabel('track_title')) ?></strong>
                は以下のリストのタイトルをクリックすると自動でフォームに入力されます。
            </p>
            <p>
                <i class="fa fa-fw fa-info-circle"></i>
                現在のところ SoundCloud と YouTube のトラックのみ追加することができ、
                また各 <strong><?= h($model->getAttributeLabel('playlist_id')) ?></strong> は、
                そのどちらかに統一して下さい。
            </p>
        </div>
    </div>
    <div class="col-xs-12 col-sm-1"></div>
</div><!-- /.row -->

<div id="track-now" class="text-center"></div>

<?php Pjax::begin() ?>
    <div id="tile-container" class="row text-center">
        <?= $this->render('_search-admin', [
            'provider' => $provider,
            'genre' => $genre,
            'status' => $status,
            'search' => $search,
        ]) ?>
        <?php foreach ($data->models as $track): ?>
            <div class="col-xs-12 col-sm-3 tile">
                <div class="thumbnail clearfix">
                    <?= Html::tag('img', '', [
                        'class' => 'lazy track-image',
                        'data-original' => without_scheme_url(h($track->image)),
                        'data-url' => $embedUrl,
                        'data-id' => hashids()->encode($track->id),
                    ]) ?>
                    <div class="caption clearfix">
                        <?= Html::a(h($track->title), '#', [
                            'class' => 'track-title',
                            'data-id' => $track->id,
                            'data-title' => $track->title,
                        ]) ?>
                    </div><!-- /.caption -->
                </div><!-- /.thumbnail -->
            </div><!-- /.tile -->
        <?php endforeach ?>
    </div><!-- /.row -->
    <?= LinkPager::widget(['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>

<?= $this->render('/common/js/tile') ?>
<?= $this->render('/track/_now') ?>

<?php
$this->registerJs(<<<'JS'
$(document).on('change', '#playlistitemcreateform-playlist_id', function() {
    var $el = $(this);
    $.ajax($el.attr('data-url'), {
        timeout: 10000,
        data: {
            playlistId: $el.val(),
            playlistTitle: $el.find('option:selected').text()
        }
    }).done(function(data) {
        $('#playlist-items').html(data);
    }).fail(function(data) {
        alert('Request failure.');
    });
});
$(document).on('ready pjax:success', function() {
    $('.track-title').on('click', function() {
        $('#playlistitemcreateform-track_id').val($(this).attr('data-id'));
        $('#playlistitemcreateform-track_title').val($(this).attr('data-title'));
        window.scroll(0, 0);
        return false;
    });
});
JS
);
