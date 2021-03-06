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
 * @var string $provider
 * @var string $genre
 * @var string $search
 * @var string $embedAction
 */

use app\models\MusicGenre;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = app()->name;
?>
<div id="now-playing" class="text-center"></div>
<?php Pjax::begin() ?>
    <div class="row text-center card-container">
        <?= $this->render('_search-index', [
            'provider' => $provider,
            'genre' => $genre,
            'search' => $search,
            'total' => $data->totalCount,
        ]) ?>
        <?php foreach ($data->models as $model): ?>
            <div class="col-md-6 col-lg-4 mb-sm-4">
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
                        <i class="fas fa-play-circle card-play"></i>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">
                            <a class="text-body" href="<?= url(['view', 'id' => hashids()->encode($model->id)]) ?>" data-pjax="0">
                                <?= h($model->title) ?>
                            </a>
                        </h6>
                        <div class="card-text">
                            <a class="tag" href="<?= url(['', 'provider' => $model->providerText]) ?>">
                                <?= h($model->providerText) ?>
                            </a>
                            <?php /** @var MusicGenre $genre */ ?>
                            <?php foreach ($model->musicGenres as $genre): ?>
                                <a class="tag" href="<?= url(['', 'genre' => $genre->name]) ?>">
                                    <?= h($genre->name) ?>
                                </a>
                            <?php endforeach ?>
                        </div>
                        <div class="card-date">
                            <i class="fas fa-sm fa-fw fa-clock"></i> <?= formatter()->asDate($model->created_at) ?>
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
