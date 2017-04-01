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
 * @var string $search
 * @var string $embedUrl
 */

use app\models\TrackGenre;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = app()->name;
?>
<div id="now-playing" class="text-center"></div>

<?php Pjax::begin() ?>
    <div class="row text-center tile-container">
        <?= $this->render('_search-index', [
            'provider' => $provider,
            'genre' => $genre,
            'search' => $search,
            'total' => $data->totalCount,
        ]) ?>
        <?php foreach ($data->models as $model): ?>
            <div class="col-xs-12 col-sm-3 tile">
                <div class="thumbnail clearfix">
                    <div class="tile-image-wrap">
                        <?= Html::tag('img', '', [
                            'class' => 'lazyload img-responsive tile-image',
                            'src' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNQqgcAAMYAogMXSH0AAAAASUVORK5CYII=',
                            'data-src' => without_scheme_url(h($model->image)),
                            'data-url' => $embedUrl,
                            'data-id' => hashids()->encode($model->id),
                        ]) ?>
                        <div class="tile-play"></div>
                    </div>
                    <div class="caption">
                        <?= Html::a(h($model->title), ['view', 'id' => hashids()->encode($model->id)], [
                            'class' => 'tile-title',
                            'data-pjax' => '0',
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
                        <div class="hidden-xs text-right tile-created-date">

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
