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
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = Yii::$app->name;
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
                                'src' => Html::encode($model->image),
                                'alt' => '',
                                'loading' => 'lazy',
                                'data-action' => $embedAction,
                                'data-id' => Yii::$app->hashids->encode($model->id),
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
                            <a class="text-light" href="<?= Url::to(['view', 'id' => Yii::$app->hashids->encode($model->id)]) ?>" data-pjax="0">
                                <?= Html::encode($model->title) ?>
                            </a>
                        </h6>
                        <div class="card-text">
                            <a class="tag" href="<?= Url::to(['', 'provider' => $model->providerText]) ?>">
                                <?= Html::encode($model->providerText) ?>
                            </a>
                            <?php /** @var MusicGenre $genre */ ?>
                            <?php foreach ($model->genres as $genre): ?>
                                <a class="mb-2 tag" href="<?= Url::to(['', 'genre' => $genre->name]) ?>">
                                    <?= Html::encode($genre->name) ?>
                                </a>
                            <?php endforeach ?>
                        </div>
                        <div class="card-date">
                            <i class="fas fa-fw fa-sm fa-clock"></i> <?= Yii::$app->formatter->asDate($model->created_at) ?>
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
