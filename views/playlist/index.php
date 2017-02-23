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
/* @var $data yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = 'Playlists - '.app()->name;
?>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-5">
        <h2>Playlists</h2>
        <i class="fa fa-fw fa-info-circle"></i> It does not work well with mobile.
    </div>
    <div class="col-sm-5">
        <?php /* @var $model app\models\Playlist */ ?>
        <ul class="playlist-title">
            <?php foreach ($data->models as $model): ?>
                <li>
                    <span class="playlist-frequency"><?= h(sprintf('%02d', $model->frequency)) ?> tracks</span>
                    <?= Html::a(h($model->title), ['view', 'id' => hashids()->encode($model->id)]) ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
    <div class="col-sm-1"></div>
</div><!-- /.row -->
