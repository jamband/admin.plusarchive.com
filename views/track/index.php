<?php

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
        <?php /** @var app\models\Track $model */ ?>
        <?php foreach ($data->models as $model): ?>
            <div class="col-md-6 col-lg-4 mb-sm-4">
                <div class="card">
                    <div class="card-img-wrap">
                        <div class="ratio <?= preg_match('/\A(Bandcamp|SoundCloud)\z/', $model->providerText) ? 'ratio-1x1' : 'ratio-16x9' ?>">
                            <?= Html::tag('img', '', [
                                'class' => 'card-img-top opacity-75',
                                'src' => h($model->image),
                                'alt' => '',
                                'loading' => 'lazy',
                                'data-action' => $embedAction,
                                'data-id' => hashids()->encode($model->id),
                                'data-url' => $model->url,
                                'data-title' => $model->title,
                                'data-provider' => $model->providerText,
                                'data-key' => $model->provider_key,
                            ]) ?>
                        </div>
                        <i class="fas fa-play-circle card-play"></i>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">
                            <a class="text-light" href="<?= url(['view', 'id' => hashids()->encode($model->id)]) ?>" data-pjax="0">
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
                            <i class="fas fa-fw fa-sm fa-clock"></i> <?= formatter()->asDate($model->created_at) ?>
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
