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
 * @var app\models\Track $model
 * @var string $embed
 */

$this->title = "$model->title - ".app()->name;
?>
<?php if (preg_match('/\A(YouTube|Vimeo)\z/', $model->providerText)): ?>
    <div class="embed-responsive embed-responsive-16by9">
<?php else: ?>
    <div class="embed-responsive embed-responsive-1by1-half mx-auto">
<?php endif ?>
        <iframe class="embed-responsive-item" src="<?= h($embed) ?>" frameborder="0" allowfullscreen></iframe>
    </div>
<h5 class="text-center my-2">
    <?= h($model->title) ?> <small class="text-muted">via <?= h($model->providerText) ?></small>
</h5>
<p class="text-center small">
    <a href="<?= url(['index']) ?>"><i class="fas fa-fw fa-angle-left"></i> Back to playlists</a>
</p>
