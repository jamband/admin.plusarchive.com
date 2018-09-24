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
 * @var string $provider
 * @var string $genre
 * @var string $search
 * @var int $total
 */

use app\models\Track;
use app\models\MusicGenre;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="col-sm-6 col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <a class="refresh-link" href="<?= url(['']) ?>"><i class="fas fa-fw fa-redo-alt"></i> Reset All</a>
            <br>
            <span class="dropdown">
                <?= Html::a(h($provider).' <i class="fas fa-fw fa-angle-down"></i>', '#', [
                    'id' => 'search-provider',
                    'class' => 'dropdown-toggle badge badge-secondary',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= Url::currentPlus(['provider' => null, 'search' => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <?php foreach (Track::PROVIDERS as $provider): ?>
                        <a class="dropdown-item" href="<?= Url::currentPlus(['provider' => $provider, 'search' => null]) ?>"><?= h($provider) ?></a>
                    <?php endforeach ?>
                </div>
            </span>
            <span class="dropdown">
                <?= Html::a(h($genre).' <i class="fas fa-fw fa-angle-down"></i>', '#', [
                    'id' => 'search-genre',
                    'class' => 'dropdown-toggle badge badge-secondary',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <div class="dropdown-menu scrollable-menu">
                    <a class="dropdown-item" href="<?= Url::currentPlus(['genre' => null, 'search' => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <?php foreach (MusicGenre::getNames()->column() as $genre): ?>
                        <a class="dropdown-item" href="<?= Url::currentPlus(['genre' => $genre, 'search' => null]) ?>"><?= h($genre) ?></a>
                    <?php endforeach ?>
                </div>
            </span>
            <?= $this->render('/common/form/search', [
                'search' => $search,
                'placeholder' => 'Search artist or title ...',
            ]) ?>
            <div class="total-count"><?= h(number_format($total)) ?> results</div>
        </div>
    </div>
</div>
