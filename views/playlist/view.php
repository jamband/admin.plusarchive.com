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
    <div class="embed-responsive embed-responsive-1by1-half">
<?php endif ?>
    <iframe class="embed-responsive-item" src="<?= h($embed) ?>" frameborder="0" allowfullscreen></iframe>
</div>
<h4 class="text-center">
    <?= h($model->title) ?> <small>via <?= h($model->providerText) ?></small>
</h4>
<div class="text-center">
    <p><a href="<?= url(['index']) ?>"><i class="fa fa-fw fa-angle-left"></i> Back to playlists</a></p>
</div>
