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

use app\models\Track;
use yii\helpers\Html;

$this->title = 'Playlists - '.app()->name;
?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
        <h2>Playlists <small>via SoundCloud or YouTube</small></h2>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-5">
        <ul class="playlist-title">
            <?php /** @var Track $model */ ?>
            <?php foreach ($data->models as $model): ?>
                <li><?= Html::a(h($model->title), ['view', 'id' => hashids()->encode($model->id)]) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
</div><!-- /.row -->
