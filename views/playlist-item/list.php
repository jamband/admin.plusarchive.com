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
 * @var app\models\PlaylistItem $models
 * @var string $provider
 * @var string $playlistTitle
 */

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
                <h4><?= h($playlistTitle) ?> <small>via <?= h($provider) ?></small></h4>
            </div>
            <div class="modal-body">
                <ol id="playlist">
                    <?php foreach ($models as $model): ?>
                        <li><?= h($model->track->title) ?></li>
                    <?php endforeach ?>
                </ol>
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
