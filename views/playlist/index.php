<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 */

use app\models\Playlist;

$this->title = 'Playlists - '.app()->name;
?>
<div class="row">
    <div class="col-lg-5 offset-lg-1">
        <h1>Playlists</h1>
        <p>via SoundCloud or YouTube</p>
    </div>
    <div class="col-lg-5">
        <ul class="list-unstyled text-truncate">
            <?php /** @var Playlist $model */ ?>
            <?php foreach ($data->models as $model): ?>
                <li class="ms-1 mt-1 h5 fw-bold"><a href="<?= url(['view', 'id' => hashids()->encode($model->id)]) ?>"><?= h($model->title) ?> <i class="fas fa-fw fa-sm fa-angle-right"></i></a></li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
