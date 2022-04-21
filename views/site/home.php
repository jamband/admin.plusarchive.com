<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var array $genres
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<h1 class="mb-3">
    Recent <small class="fw-normal text-body">favorite tracks</small>
</h1>
<div class="row text-center card-container">
    <?php /** @var app\models\Track $model */ ?>
    <?php foreach ($data->models as $model): ?>
        <div class="col-md-6 col-lg-4 mb-sm-4">
            <div class="card">
                <div class="card-img-wrap">
                    <a href="<?= Url::to(['/tracks/view/index', 'id' => Yii::$app->hashids->encode($model->id)]) ?>" class="d-block ratio <?= preg_match('/\A(Bandcamp|SoundCloud)\z/', $model->providerText) ? 'ratio-1x1' : 'ratio-16x9' ?>">
                        <?= Html::tag('img', '', [
                            'class' => 'card-img-top opacity-75',
                            'src' => Html::encode($model->image),
                            'alt' => '',
                            'loading' => 'lazy',
                        ]) ?>
                    </a>
                    <i class="fas fa-play-circle card-play"></i>
                </div>
                <div class="card-body">
                    <h6 class="card-title">
                        <a class="text-light" href="<?= Url::to(['/tracks/view/index', 'id' => Yii::$app->hashids->encode($model->id)]) ?>">
                            <?= Html::encode($model->title) ?>
                        </a>
                    </h6>
                    <div class="card-text">
                        <a class="tag" href="<?= Url::to(['/tracks', 'provider' => $model->providerText]) ?>">
                            <?= Html::encode($model->providerText) ?>
                        </a>
                        <?php foreach ($model->genres as $genre): ?>
                            <a class="mb-2 tag" href="<?= Url::to(['/tracks', 'genre' => $genre->name]) ?>">
                                <?= Html::encode($genre->name) ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                    <div class="card-date">
                        <i class="fas fa-fw fa-sm fa-clock"></i>
                        <?= Yii::$app->formatter->asDate($model->created_at) ?>
                    </div>
                </div>
            </div>
            <hr class="d-sm-none">
        </div>
    <?php endforeach ?>
</div>
<h1 class="my-2">
    Search
    <small class="fw-normal text-body">by genres</small>
</h1>
<div class="d-inline-block">
    <?php foreach ($genres as $genre): ?>
        <a href="<?= Url::to(['/tracks', 'genre' => $genre]) ?>" class="mb-2 tag"><?= Html::encode($genre) ?></a>
    <?php endforeach ?>
</div>
<div class="text-center pt-3 pb-4">
    <a href="<?= Url::to(['/tracks']) ?>">
        Go to Tracks
    </a>
    <span class="mx-1">or</span>
    <a href="<?= Url::to(['/playlists']) ?>">
        Playlists<i class="fas fa-fw fa-sm fa-angle-right"></i>
    </a>
</div>
