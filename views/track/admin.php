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
 * @var string $embedUrl
 */

use app\models\TrackGenre;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Admin Tracks - '.app()->name;
?>
<div id="track-now" class="text-center"></div>

<?php Pjax::begin(['id' => 'track-pjax']) ?>
    <?= $this->render('/common/nav/admin', [
        'total' => $data->totalCount,
    ]) ?>
    <div id="tile-container" class="row text-center">
        <?= $this->render('_search-admin', [
            'provider' => $provider,
            'genre' => $genre,
            'sort' => $sort,
            'status' => $status,
            'search' => $search,
        ]) ?>
        <?php foreach ($data->models as $model): ?>
            <div class="col-xs-12 col-sm-3 tile">
                <div class="thumbnail clearfix">
                    <?= Html::tag('img', '', [
                        'class' => 'lazyload track-image',
                        'src' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNQqgcAAMYAogMXSH0AAAAASUVORK5CYII=',
                        'data-src' => without_scheme_url(h($model->image)),
                        'data-url' => $embedUrl,
                        'data-id' => hashids()->encode($model->id),
                    ]) ?>
                    <div class="caption">
                        <?= Html::a(h($model->title), ['view', 'id' => hashids()->encode($model->id)], [
                            'class' => 'track-title',
                            'data-pjax' => '0',
                        ]) ?>
                        <?= Html::a(h($model->statusText), ['', 'status' => $model->statusText], [
                            'class' => 'label label-default',
                        ]) ?>
                        <?= Html::a(h($model->providerText), ['', 'provider' => $model->providerText], [
                                'class' => 'label label-default',
                        ]) ?>
                        <?php /** @var TrackGenre $genre */ ?>
                        <?php foreach ($model->trackGenres as $genre): ?>
                            <?= Html::a(h($genre->name), ['', 'genre' => $genre->name], [
                                'class' => 'label label-default',
                            ]) ?>
                        <?php endforeach ?>
                        <br>
                        <?= Html::a('<i class="fa fa-fw fa-edit"></i> Update', ['update', 'id' => $model->id], [
                            'class' => 'label label-default',
                            'data-pjax' => '0',
                        ]) ?>
                        <?= Html::a('<i class="fa fa-fw fa-trash-o"></i> Delete', ['delete', 'id' => $model->id], [
                            'class' => 'label label-default',
                            'data-confirm' => 'Are you sure you want to delete this item?',
                            'data-method' => 'post',
                        ]) ?>
                        <br>
                        <div class="hidden-xs text-right track-created-date">
                            <?= formatter()->asDate($model->created_at) ?>
                        </div>
                    </div><!-- /.caption -->
                </div><!-- /.thumbnail -->
            </div><!-- /.tile -->
        <?php endforeach ?>
    </div><!-- /.row -->

    <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>

<?= $this->render('/common/js/tile') ?>
<?= $this->render('_now') ?>
