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
 * @var array $genres
 */

$this->title = app()->name;
?>
<h2 class="mb-3">
    Recent <small class="text-muted">favorite tracks</small>
</h2>
<div class="row text-center card-container">
    <?php foreach ($data->models as $model): ?>
        <div class="col-md-4 mb-sm-4">
            <div class="card">
                <div class="card-img-wrap">
                    <a href="<?= url(['/track/view', 'id' => hashids()->encode($model->id)]) ?>">
                        <img src="<?= $model->image ?>" class="card-img-top" alt="">
                    </a>
                    <i class="fas fa-play-circle card-play"></i>
                </div>
                <div class="card-body">
                    <div class="card-title text-white text-truncate">
                        <a class="text-white" href="<?= url(['/track/view', 'id' => hashids()->encode($model->id)]) ?>">
                            <?= h($model->title) ?>
                        </a>
                    </div>
                    <div class="card-text">
                        <?php foreach ($model->musicGenres as $genre): ?>
                            <a class="badge badge-secondary" href="<?= url(['/tracks', 'genre' => $genre->name]) ?>">
                                <?= h($genre->name) ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                    <div class="card-date">
                        <?php if ('Bandcamp' === $model->providerText): ?>
                            <i class="fab fa-bandcamp"></i> <?= h($model->providerText) ?>
                        <?php elseif ('SoundCloud' === $model->providerText): ?>
                            <i class="fab fa-soundcloud"></i> <?= h($model->providerText) ?>
                        <?php elseif ('Vimeo' === $model->providerText): ?>
                            <i class="fab fa-vimeo-square"></i> <?= h($model->providerText) ?>
                        <?php elseif ('YouTube' === $model->providerText): ?>
                            <i class="fab fa-youtube-square"></i> <?= h($model->providerText) ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <hr class="d-sm-none">
        </div>
    <?php endforeach ?>
</div>
<h2 class="my-2">
    Search
    <small class="text-muted">by genres</small>
</h2>
<div class="d-inline-block">
    <?php foreach ($genres as $genre): ?>
        <a href="<?= url(['/tracks', 'genre' => $genre]) ?>" class="badge badge-secondary"><?= h($genre) ?></a>
    <?php endforeach ?>
</div>
<div class="text-center pt-3 pb-4 small">
    <a href="<?= url(['/tracks']) ?>">
        Go to Tracks
    </a>
    <span class="text-muted px-1">or</span>
    <a href="<?= url(['/playlists']) ?>">
        Playlists<i class="fas fa-angle-right fa-fw"></i>
    </a>
</div>
