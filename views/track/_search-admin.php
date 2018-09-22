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
 * @var string $sort
 * @var string $provider
 * @var string $genre
 * @var string $search
 */

use app\models\Track;
use app\models\TrackGenre;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="col-sm-6 col-md-4 mb-4">
    <div class="card">
        <div class="card-body">
            <a class="refresh-link" href="<?= url(['']) ?>"><i class="fas fa-fw fa-redo-alt"></i> Reset All</a>
            <br>
            <span class="dropdown">
                <?= Html::a(h($sort).' <i class="fas fa-fw fa-angle-down"></i>', '#', [
                    'id' => 'search-sort',
                    'class' => 'dropdown-toggle badge badge-secondary',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => null, 'search' => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Title', 'search' => null]) ?>">Title</a>
                    <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Latest', 'search' => null]) ?>">Latest</a>
                    <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Update', 'search' => null]) ?>">Updated</a>
                </div>
            </span>
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
                <div class="dropdown-menu dropdown-menu-right scrollable-menu">
                    <a class="dropdown-item" href="<?= Url::currentPlus(['genre' => null, 'search' => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <?php foreach (TrackGenre::getNames()->column() as $name): ?>
                        <a class="dropdown-item" href="<?= Url::currentPlus(['genre' => $name, 'search' => null]) ?>"><?= h($name) ?></a>
                    <?php endforeach ?>
                </div>
            </span>
            <?= $this->render('/common/form/search', [
                'search' => $search,
                'placeholder' => 'Search artist or title ...',
            ]) ?>
        </div>
    </div>
</div>
