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
 * @var yii\data\ActiveDataProvider $data
 */

use app\models\Playlist;

$this->title = 'Playlists - '.app()->name;
?>
<div class="row">
    <div class="col-md-5 offset-md-1">
        <h2>Playlists <small class="text-muted">via SoundCloud or YouTube</small></h2>
    </div>
    <div class="col-md-6">
        <ul class="list-unstyled playlist-title text-truncate">
            <?php /** @var Playlist $model */ ?>
            <?php foreach ($data->models as $model): ?>
                <li><a href="<?= url(['view', 'id' => hashids()->encode($model->id)]) ?>"><?= h($model->title) ?> <i class="fas fa-angle-right fa-fw"></i></a></li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
