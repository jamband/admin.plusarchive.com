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
/* @var $provider string */
/* @var $genre string */
/* @var $search string */
/* @var $embedUrl string */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$this->title = 'Tracks - '.app()->name;
?>
<div id="track-now" class="text-center"></div>

<?php Pjax::begin() ?>
    <div id="tile-container" class="row text-center">
        <?= $this->render('_search-index', [
            'provider' => $provider,
            'genre' => $genre,
            'search' => $search,
            'totalCount' => $data->totalCount,
        ]) ?>
        <?php /* @var $model app\models\Track */ ?>
        <?php /* @var $genre app\models\TrackGenre */ ?>
        <?php foreach ($data->models as $model): ?>
            <div class="col-xs-12 col-sm-3 tile">
                <div class="thumbnail">
                    <?= Html::tag('img', '', [
                        'class' => 'lazy track-image',
                        'title' => 'Play',
                        'data-original' => without_scheme_url(h($model->image)),
                        'data-url' => $embedUrl,
                        'data-id' => hashids()->encode($model->id),
                    ]) ?>
                    <div class="caption">
                        <?= Html::a(h($model->title), ['view', 'id' => hashids()->encode($model->id)], [
                            'class' => 'track-title',
                            'title' => 'View',
                            'data-pjax' => '0',
                        ]) ?>
                        <?php if (null !== $model->newText): ?>
                            <span class="label label-new"><?= h($model->newText) ?></span>
                        <?php endif ?>
                        <?= Html::a(h($model->providerText), ['', 'provider' => $model->providerText], [
                                'class' => 'label label-default',
                        ]) ?>
                        <?php foreach ($model->trackGenres as $genre): ?>
                            <?= Html::a(h($genre->name), ['', 'genre' => $genre->name], [
                                'class' => 'label label-default',
                            ]) ?>
                        <?php endforeach ?>
                        <br>
                        <div class="hidden-xs pull-right track-created-date">
                            <?= formatter()->asDate($model->created_at) ?>
                        </div>
                        <div class="clearfix"></div>
                    </div><!-- /.caption -->
                </div><!-- /.thumbnail -->
            </div><!-- /.tile -->
        <?php endforeach ?>
    </div><!-- /.row -->

    <?= LinkPager::widget(['pagination' => $data->pagination]) ?>
<?php Pjax::end() ?>

<?= $this->render('/common/js/tile') ?>
<?= $this->render('_now') ?>
