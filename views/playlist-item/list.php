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
/* @var $models app\models\PlaylistItem */
/* @var $provider string */
/* @var $playlistTitle string */

use yii\helpers\Html;

?>
<div class="form-group">
    <button type="button" id="playlist-show" class="btn btn-default">See Playlist</button>
</div>
<div id="playlist-modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4><?= h($playlistTitle) ?> <small>Provided by <?= h($provider) ?></small></h4>
            </div>
            <div class="modal-body">
                <ul id="playlist">
                    <?php foreach ($models as $model): ?>
                        <li><small><?= h($model->track_number) ?>.</small> <?= h($model->track->title) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs(<<<'JS'
$('#playlist-show').on('click', function() {
    $('#playlist-modal').modal('show');
});
JS
);
