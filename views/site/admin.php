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
 * @var app\models\Track[] $tracks
 */

$this->title = 'Admin Site - '.app()->name;
?>
<div class="text-center">
    <?= $this->render('/common/nav/base') ?>
</div>
<h1 class="mb-3">
    Recent <small class="text-muted">favorite tracks</small>
</h1>
<div class="row text-center">
    <?php foreach ($tracks as $track): ?>
        <div class="col-md-6 col-lg-4 mb-sm-4">
            <div class="card">
                <div class="card-img-wrap">
                    <a href="<?= url(['/track/view', 'id' => hashids()->encode($track->id)]) ?>">
                        <img src="<?= $track->image ?>" class="card-img-top" alt="">
                    </a>
                    <i class="fas fa-play-circle card-play"></i>
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <?= h($track->title) ?>
                    </div>
                    <div class="card-text">
                        <a class="tag" href="<?= url(['/track/admin', 'provider' => $track->providerText]) ?>">
                            <?= h($track->providerText) ?>
                        </a>
                        <?php foreach ($track->musicGenres as $genre): ?>
                            <a class="tag" href="<?= url(['/track/admin', 'genre' => $genre->name]) ?>">
                                <?= h($genre->name) ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                    <div class="card-date">
                        <a class="text-body" href="<?= url(['/track/update', 'id' => $track->id]) ?>" data-pjax="0">
                            <i class="fas fa-sm fa-fw fa-edit"></i> Update
                        </a>
                    </div>
                </div>
            </div>
            <hr class="d-sm-none">
        </div>
    <?php endforeach ?>
</div>
