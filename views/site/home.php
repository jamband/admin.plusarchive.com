<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var array $genres
 */

 use yii\helpers\Html;

$this->title = app()->name;
?>
<h1 class="mb-3">
    Recent <small class="fw-normal text-muted">favorite tracks</small>
</h1>
<div class="row text-center card-container">
    <?php /** @var app\models\Track $model */ ?>
    <?php foreach ($data->models as $model): ?>
        <div class="col-md-6 col-lg-4 mb-sm-4">
            <div class="card">
                <div class="card-img-wrap">
                    <a href="<?= url(['/track/view', 'id' => hashids()->encode($model->id)]) ?>" class="d-block ratio <?= preg_match('/\A(Bandcamp|SoundCloud)\z/', $model->providerText) ? 'ratio-1x1' : 'ratio-16x9' ?>">
                        <?= Html::tag('img', '', [
                            'class' => 'card-img-top opacity-75',
                            'src' => h($model->image),
                            'alt' => '',
                            'loading' => 'lazy',
                        ]) ?>
                    </a>
                    <i class="fas fa-play-circle card-play"></i>
                </div>
                <div class="card-body">
                    <h6 class="card-title">
                        <a class="text-body" href="<?= url(['/track/view', 'id' => hashids()->encode($model->id)]) ?>">
                            <?= h($model->title) ?>
                        </a>
                    </h6>
                    <div class="card-text">
                        <a class="tag" href="<?= url(['/tracks', 'provider' => $model->providerText]) ?>">
                            <?= h($model->providerText) ?>
                        </a>
                        <?php foreach ($model->musicGenres as $genre): ?>
                            <a class="tag" href="<?= url(['/tracks', 'genre' => $genre->name]) ?>">
                                <?= h($genre->name) ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                    <div class="card-date">
                        <i class="fas fa-fw fa-sm fa-clock"></i>
                        <?= formatter()->asDate($model->created_at) ?>
                    </div>
                </div>
            </div>
            <hr class="d-sm-none">
        </div>
    <?php endforeach ?>
</div>
<h1 class="my-2">
    Search
    <small class="fw-normal text-muted">by genres</small>
</h1>
<div class="d-inline-block">
    <?php foreach ($genres as $genre): ?>
        <a href="<?= url(['/tracks', 'genre' => $genre]) ?>" class="tag"><?= h($genre) ?></a>
    <?php endforeach ?>
</div>
<div class="text-center pt-3 pb-4">
    <a href="<?= url(['/tracks']) ?>">
        Go to Tracks
    </a>
    <span class="mx-1 text-muted">or</span>
    <a href="<?= url(['/playlists']) ?>">
        Playlists<i class="fas fa-fw fa-sm fa-angle-right"></i>
    </a>
</div>
