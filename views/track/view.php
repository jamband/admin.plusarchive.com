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
    <div class="ratio ratio-16x9">
        <iframe src="<?= h($embed) ?>" allowfullscreen></iframe>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="ratio ratio-1x1">
                <iframe src="<?= h($embed) ?>" allowfullscreen></iframe>
            </div>
        </div>
    </div>
<?php endif ?>
<div class="text-center">
    <h5 class="pt-3"><?= h($model->title) ?></h5>
    <a class="tag" href="<?= url(['index', 'provider' => $model->providerText]) ?>">
        <?= h($model->providerText) ?>
    </a>
    <?php /** @var MusicGenre $genre */ ?>
    <?php foreach ($model->musicGenres as $genre): ?>
        <a class="tag" href="<?= url(['index', 'genre' => $genre->name]) ?>">
            <?= h($genre->name) ?>
        </a>
    <?php endforeach ?>
    <div class="text-center py-2">
        <a href="<?= url(['index']) ?>"><i class="fas fa-fw fa-angle-left"></i> Back to tracks</a>
        <span class="mx-1 text-muted">or</span>
        <a href="<?= url(['/']) ?>">Recent Favorites</a>
    </div>
</div>
