<?php

/**
 * @var yii\web\View $this
 * @var app\models\Playlist $model
 * @var string $embed
 */

$this->title = "$model->title - ".app()->name;
?>
<?php if (preg_match('/\A(YouTube|Vimeo)\z/', $model->providerText)): ?>
    <div class="ratio ratio-16x9">
        <iframe class="rounded" src="<?= h($embed) ?>" allowfullscreen></iframe>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="ratio ratio-1x1">
                <iframe class="rounded" src="<?= h($embed) ?>" allowfullscreen></iframe>
            </div>
        </div>
    </div>
<?php endif ?>
<h5 class="text-center my-2">
    <?= h($model->title) ?> <span class="text-muted">via <?= h($model->providerText) ?></span>
</h5>
<p class="text-center">
    <a href="<?= url(['index']) ?>"><i class="fas fa-fw fa-sm fa-angle-left"></i> Back to playlists</a>
</p>
