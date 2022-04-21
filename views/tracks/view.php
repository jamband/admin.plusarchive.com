<?php

/**
 * @var yii\web\View $this
 * @var app\models\Track $model
 * @var string $embed
 */

use app\models\MusicGenre;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "$model->title - ".Yii::$app->name;
?>
<?php if (preg_match('/\A(YouTube|Vimeo)\z/', $model->providerText)): ?>
    <div class="ratio ratio-16x9">
        <iframe class="rounded" src="<?= Html::encode($embed) ?>" allowfullscreen></iframe>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="ratio ratio-1x1">
                <iframe class="rounded" src="<?= Html::encode($embed) ?>" allowfullscreen></iframe>
            </div>
        </div>
    </div>
<?php endif ?>
<div class="mt-2 text-center">
    <h5><?= Html::encode($model->title) ?></h5>
    <a class="tag" href="<?= Url::to(['/tracks', 'provider' => $model->providerText]) ?>">
        <?= Html::encode($model->providerText) ?>
    </a>
    <?php /** @var MusicGenre $genre */ ?>
    <?php foreach ($model->genres as $genre): ?>
        <a class="tag" href="<?= Url::to(['/tracks', 'genre' => $genre->name]) ?>">
            <?= Html::encode($genre->name) ?>
        </a>
    <?php endforeach ?>
    <div class="mt-4">
        <a href="<?= Url::toRoute('/tracks') ?>"><i class="fas fa-fw fa-sm fa-angle-left"></i> Back to tracks</a>
        <span class="mx-1">or</span>
        <a href="<?= Url::to(['/']) ?>">Recent Favorites</a>
    </div>
</div>
