<?php

/**
 * @var yii\web\View $this
 * @var app\models\Track[] $tracks
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Admin - '.Yii::$app->name;
?>
<div class="text-center">
    <?= $this->render('/common/nav/base') ?>
    <div class="d-inline-block dropdown">
        <a id="menu-action" class="tag" href="#" data-bs-toggle="dropdown">
            Action
            <i class="fas fa-fw fa-sm fa-angle-down"></i>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= Url::to(['/track/stop-all-urge']) ?>" data-confirm="Are you sure?" data-method="post">
                Stop All Urge
            </a>
        </div>
    </div>
</div>
<h1 class="mb-3">
    Recent <small class="fw-normal text-muted">favorite tracks</small>
</h1>
<div class="row text-center">
    <?php foreach ($tracks as $track): ?>
        <div class="col-md-6 col-lg-4 mb-sm-4">
            <div class="card">
                <div class="card-img-wrap">
                    <a href="<?= Url::to(['/track/view', 'id' => Yii::$app->hashids->encode($track->id)]) ?>" class="d-block ratio <?= preg_match('/\A(Bandcamp|SoundCloud)\z/', $track->providerText) ? 'ratio-1x1' : 'ratio-16x9' ?>">
                        <?= Html::tag('img', '', [
                            'class' => 'card-img-top opacity-75',
                            'src' => Html::encode($track->image),
                            'alt' => '',
                            'loading' => 'lazy',
                        ]) ?>
                    </a>
                    <i class="fas fa-play-circle card-play"></i>
                </div>
                <div class="card-body">
                    <h6 class="card-title">
                        <?= Html::encode($track->title) ?>
                    </h6>
                    <div class="card-text">
                        <a class="tag" href="<?= Url::to(['/track/admin', 'provider' => $track->providerText]) ?>">
                            <?= Html::encode($track->providerText) ?>
                        </a>
                        <?php foreach ($track->genres as $genre): ?>
                            <a class="mb-2 tag" href="<?= Url::to(['/track/admin', 'genre' => $genre->name]) ?>">
                                <?= Html::encode($genre->name) ?>
                            </a>
                        <?php endforeach ?>
                    </div>
                    <div class="card-date">
                        <a class="text-body" href="<?= Url::to(['/track/update', 'id' => $track->id]) ?>" data-pjax="0">
                            <i class="fas fa-fw fa-sm fa-edit"></i> Update
                        </a>
                    </div>
                </div>
            </div>
            <hr class="d-sm-none">
        </div>
    <?php endforeach ?>
</div>
