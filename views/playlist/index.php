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
 * @var yii\data\ActiveDataProvider $data
 */

use app\models\Playlist;

$this->title = 'Playlists - '.app()->name;
?>
<div class="row">
    <div class="col-lg-5 offset-lg-1">
        <h1 class="mb-3 mb-lg-0">Playlists <small class="text-muted">via SoundCloud or YouTube</small></h1>
    </div>
    <div class="col-lg-5">
        <ul class="list-unstyled text-truncate">
            <?php /** @var Playlist $model */ ?>
            <?php foreach ($data->models as $model): ?>
                <li class="h5"><a href="<?= url(['view', 'id' => hashids()->encode($model->id)]) ?>"><?= h($model->title) ?> <i class="fas fa-angle-right fa-fw"></i></a></li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
