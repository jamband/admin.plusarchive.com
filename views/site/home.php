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
 * @var array $genres
 */

 use yii\helpers\Html;

$this->title = app()->name;
?>
<h1 class="mb-3">
    Recent <small class="text-muted">favorite tracks</small>
</h1>
<div class="row text-center card-container">
    <?php foreach ($data->models as $model): ?>
        <div class="col-md-6 col-lg-4 mb-sm-4">
            <div class="card">
                <div class="card-img-wrap">
                    <a href="<?= url(['/track/view', 'id' => hashids()->encode($model->id)]) ?>">
                        <?= Html::tag('img', '', [
                            'class' => 'lazyload card-img-top',
                            'src' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNQqgcAAMYAogMXSH0AAAAASUVORK5CYII=',
                            'data-src' => h($model->image),
                            'alt' => '',
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
                        <i class="fas fa-sm fa-fw fa-clock"></i>
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
    <small class="text-muted">by genres</small>
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
        Playlists<i class="fas fa-angle-right fa-fw"></i>
    </a>
</div>
