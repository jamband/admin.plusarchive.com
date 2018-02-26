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
 * @var string $provider
 * @var string $genre
 * @var string $status
 * @var string $sort
 * @var string $search
 * @var string $embedAction
 */

use app\models\TrackGenre;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Admin Tracks - '.app()->name;
?>
<div id="now-playing" class="text-center"></div>
<?php Pjax::begin(['id' => 'track-pjax']) ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
    ]) ?>
    <div class="row text-center card-container">
        <?= $this->render('_search-admin', [
            'provider' => $provider,
            'genre' => $genre,
            'sort' => $sort,
            'status' => $status,
            'search' => $search,
        ]) ?>
        <?php foreach ($data->models as $model): ?>
            <div class="col-sm-6 col-md-4 mb-sm-4">
                <div class="card">
                    <div class="card-img-wrap">
                        <?= Html::tag('img', '', [
                            'class' => 'lazyload card-img-top',
                            'src' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNQqgcAAMYAogMXSH0AAAAASUVORK5CYII=',
                            'data-src' => h($model->image),
                            'data-action' => $embedAction,
                            'data-id' => hashids()->encode($model->id),
                            'data-url' => $model->url,
                            'data-title' => $model->title,
                            'data-provider' => $model->providerText,
                            'data-key' => $model->provider_key,
                        ]) ?>
                        <div class="card-play"></div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-truncate">
                            <?= Html::a(h($model->title), ['view', 'id' => hashids()->encode($model->id)], [
                                'class' => 'text-white',
                                'data-pjax' => '0',
                            ]) ?>
                        </h6>
                        <div class="card-text">
                            <?= Html::a(h($model->statusText), ['', 'status' => $model->statusText], [
                                'class' => 'badge badge-secondary',
                            ]) ?>
                            <?= Html::a(h($model->providerText), ['', 'provider' => $model->providerText], [
                                'class' => 'badge badge-secondary',
                            ]) ?>
                            <?php /** @var TrackGenre $genre */ ?>
                            <?php foreach ($model->trackGenres as $genre): ?>
                                <?= Html::a(h($genre->name), ['', 'genre' => $genre->name], [
                                    'class' => 'badge badge-secondary',
                                ]) ?>
                            <?php endforeach ?>
                            <br>
                            <?= Html::a('<i class="fa fa-fw fa-edit"></i> Update', ['update', 'id' => $model->id], [
                                'class' => 'badge badge-secondary',
                                'data-pjax' => '0',
                            ]) ?>
                            <?= Html::a('<i class="fa fa-fw fa-trash-o"></i> Delete', ['delete', 'id' => $model->id], [
                                'class' => 'badge badge-secondary',
                                'data-confirm' => 'Are you sure you want to delete this item?',
                                'data-method' => 'post',
                            ]) ?>
                        </div>
                        <div class="card-date">
                            <i class="fa fa-fw fa-clock-o"></i> <?= formatter()->asDate($model->created_at) ?>
                        </div>
                    </div>
                </div>
                <hr class="d-sm-none">
            </div>
        <?php endforeach ?>
    </div>
    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>
<?= $this->render('/common/js/card') ?>
<?= $this->render('_now') ?>
