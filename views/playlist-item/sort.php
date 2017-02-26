<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this yii\web\View */
/* @var $playlistTitle string */
/* @var $provider string */
/* @var $playlist_id integer */
/* @var $items app\models\PlaylistItem */
/* @var $model app\models\form\PlaylistItemSortForm */
/* @var $embed string */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Sort Playlist Item - '.app()->name;
?>
<div class="text-center">
    <?= $this->render('/common/nav/base') ?>

    <span class="dropdown">
        <?= Html::a('Sort <i class="fa fa-fw fa-angle-down"></i>', '#', [
            'class' => 'dropdown-toggle label label-default',
            'data-toggle' => 'dropdown',
            'data-hover' => 'dropdown',
        ]) ?>
        <ul class="dropdown-menu">
            <li><a href="<?= url(['admin']) ?>">Admin</a></li>
            <li><a href="<?= url(['create']) ?>">Create</a></li>
        </ul>
    </span><!-- /.dropdown -->
</div>
<p class="clearfix"></p>

<div class="row">
    <div class="col-sm-6">
        <h4><?= h($playlistTitle) ?> <small>via <?= h($provider) ?></small></h4>
        <?php if ('YouTube' === $provider): ?>
            <div class="embed-responsive embed-responsive-16by9">
                <div id="player" class="embed-responsive-item"></div>
            </div>
        <?php elseif ('SoundCloud' === $provider): ?>
            <div class="embed-responsive embed-responsive-1by1">
                <iframe id="player" class="embed-responsive-item" src="<?= h($embed) ?>" frameborder="0"></iframe>
            </div>
        <?php endif ?>
        <br>
    </div>
    <div class="col-sm-6">
        <h4 class="hidden-xs">Playlist</h4>
        <ol id="playlist">
            <?php foreach ($items as $item): ?>
                <li data-id="<?= h($item->id) ?>" data-provider-key="<?= h($item->track->provider_key) ?>"><?= h($item->track->title) ?></li>
            <?php endforeach ?>
        </ol>
        <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'playlist_id')->hiddenInput(['value' => $playlist_id])->label(false) ?>
            <?= $form->field($model, 'ids')->hiddenInput()->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                <span class="text text-info">
                    <i class="fa fa-fw fa-info"></i> You can change the track order by drag and drop.
                </span>
            </div>
        <?php ActiveForm::end() ?>
    </div>
</div><!-- /.row -->

<?php
if ('YouTube' === $provider) {
    echo $this->render('/common/js/player-youtube');
} elseif ('SoundCloud' === $provider) {
    echo $this->render('/common/js/player-soundcloud');
}
$this->registerJs(<<<'JS'
$('#playlist').sortable().on('sortupdate', function() {
    $('li', this).each(function() {
        var $this = $(this);
        if ($this.hasClass('active')) {
            plusarchive.nowPlaying = $this.index();
            return false;
        }
    });
    $('#playlistitemsortform-ids').val($('li', this).map(function() {
        return $(this).attr('data-id');
    }).get());
});
JS
);
