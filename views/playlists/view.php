<?php

/**
 * @var yii\web\View $this
 * @var app\models\Playlist $model
 * @var string $embed
 */

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
<section class="mt-2 text-center">
    <h5><?= Html::encode($model->title) ?></h5>
    <p class="mb-4">via <?= Html::encode($model->providerText) ?></p>
</section>
<div class="text-center">
    <a href="<?= Url::toRoute('/playlists') ?>"><i class="fas fa-fw fa-sm fa-angle-left"></i> Back to playlists</a>
</div>
