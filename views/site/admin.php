<?php

/**
 * @var yii\web\View $this
 * @var app\models\Track[] $tracks
 */

 use yii\helpers\Html;

$this->title = 'Admin - '.app()->name;
?>
<div class="text-center">
    <?= $this->render('/common/nav/base') ?>
    <div class="d-inline-block dropdown">
        <a id="menu-action" class="tag" href="#" data-bs-toggle="dropdown">
            Action
            <i class="fas fa-fw fa-sm fa-angle-down"></i>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= url(['/track/stop-all-urge']) ?>" data-confirm="Are you sure?" data-method="post">
                Stop All Urge
            </a>
        </div>
    </div>
</div>
<h1 class="mb-3">
    Recent <small class="text-muted">favorite tracks</small>
</h1>
<div class="row text-center">
    <?php foreach ($tracks as $track): ?>
        <div class="col-md-6 col-lg-4 mb-sm-4">
            <div class="card">
                <div class="card-img-wrap">
                    <a href="<?= url(['/track/view', 'id' => hashids()->encode($track->id)]) ?>" class="d-inline-block ratio <?= preg_match('/\A(Bandcamp|SoundCloud)\z/', $track->providerText) ? 'ratio-1x1' : 'ratio-16x9' ?>">
                        <?= Html::tag('img', '', [
                            'class' => 'card-img-top opacity-75',
                            'src' => h($track->image),
                            'alt' => '',
                            'loading' => 'lazy',
                        ]) ?>
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
                            <i class="fas fa-fw fa-sm fa-edit"></i> Update
                        </a>
                    </div>
                </div>
            </div>
            <hr class="d-sm-none">
        </div>
    <?php endforeach ?>
</div>
