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
 * @var app\models\Track $model
 * @var string $embed
 */

use app\models\MusicGenre;

$this->title = "$model->title - ".app()->name;
?>
<?php if (preg_match('/\A(YouTube|Vimeo)\z/', $model->providerText)): ?>
    <div class="embed-responsive embed-responsive-16by9">
<?php else: ?>
    <div class="embed-responsive embed-responsive-1by1-half">
<?php endif ?>
        <iframe class="embed-responsive-item" src="<?= h($embed) ?>" frameborder="0" allowfullscreen></iframe>
    </div>
<div class="text-center">
    <h5 class="pt-3"><?= h($model->title) ?></h5>
    <a class="badge badge-secondary" href="<?= url(['index', 'provider' => $model->providerText]) ?>">
        <?= h($model->providerText) ?>
    </a>
    <?php /** @var MusicGenre $genre */ ?>
    <?php foreach ($model->musicGenres as $genre): ?>
        <a class="badge badge-secondary" href="<?= url(['index', 'genre' => $genre->name]) ?>">
            <?= h($genre->name) ?>
        </a>
    <?php endforeach ?>
    <div class="text-center small py-2">
        <a href="<?= url(['index']) ?>"><i class="fas fa-fw fa-angle-left"></i> Back to tracks</a>
        <span class="text-muted px-1">or</span>
        <a href="<?= url(['/']) ?>">Recent Favorites</a>
    </div>
</div>
