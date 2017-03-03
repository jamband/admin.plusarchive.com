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
 * @var app\models\Playlist $model
 * @var string $provider
 * @var string $embed
 */

use app\models\PlaylistItem;

$this->title = "$model->title - ".app()->name

?>
<div class="row">
    <div class="col-sm-6">
        <h4><?= h($model->title) ?> <small>via <?= h($provider) ?></small></h4>
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
        <h4 class="hidden-xs">Playlist <small> missing track will be skipped</small></h4>
        <ol id="playlist">
            <?php /* @var PlaylistItem $item */ ?>
            <?php foreach ($model->items as $item): ?>
                <li data-provider-key="<?= h($item->track->provider_key) ?>"><?= h($item->track->title) ?></li>
            <?php endforeach ?>
        </ol>
    </div>
</div><!-- /.row -->

<p class="text-center">
    <a href="<?= url(['index']) ?>"><i class="fa fa-fw fa-angle-left"></i> Back to playlists</a>
</p>

<?php
if ('YouTube' === $provider) {
    echo $this->render('/common/js/player-youtube');
} elseif ('SoundCloud' === $provider) {
    echo $this->render('/common/js/player-soundcloud');
}
