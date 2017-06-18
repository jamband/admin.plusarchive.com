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
 * @var string $sort
 * @var string $status
 * @var string $search
 */

use app\models\Track;
use app\models\TrackGenre;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="col-xs-12 col-sm-4 col-md-3 card">
    <div class="thumbnail">
        <div class="caption">
            <a class="refresh-link" href="<?= url(['']) ?>">Reset All</a>
            <br>
            <span class="dropdown">
                <?= Html::a(h($sort), '#', [
                    'id' => 'search-sort',
                    'class' => 'dropdown-toggle label label-default',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <ul class="dropdown-menu">
                    <li><a href="<?= Url::currentPlus(['sort' => null, 'search' => null]) ?>">Reset</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= Url::currentPlus(['sort' => 'Title', 'search' => null]) ?>">Title</a></li>
                    <li><a href="<?= Url::currentPlus(['sort' => 'Latest', 'search' => null]) ?>">Latest</a></li>
                    <li><a href="<?= Url::currentPlus(['sort' => 'Update', 'search' => null]) ?>">Updated</a></li>
                </ul>
            </span><!-- /.dropdown -->

            <span class="dropdown">
                <?= Html::a(h($status), '#', [
                    'id' => 'search-status',
                    'class' => 'dropdown-toggle label label-default',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <ul class="dropdown-menu">
                    <li><a href="<?= Url::currentPlus(['status' => null, 'search' => null]) ?>">Reset</a></li>
                    <li role="separator" class="divider"></li>
                    <?php foreach (Track::STATUSES as $status): ?>
                        <li><a href="<?= Url::currentPlus(['status' => $status, 'search' => null]) ?>"><?= h($status) ?></a></li>
                    <?php endforeach ?>
                </ul>
            </span><!-- /.dropdown -->
            <br>

            <span class="dropdown">
                <?= Html::a(h($provider), '#', [
                    'id' => 'search-provider',
                    'class' => 'dropdown-toggle label label-default',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <ul class="dropdown-menu">
                    <li><a href="<?= Url::currentPlus(['provider' => null, 'search' => null]) ?>">Reset</a></li>
                    <li role="separator" class="divider"></li>
                    <?php foreach (Track::PROVIDERS as $provider): ?>
                        <li><a href="<?= Url::currentPlus(['provider' => $provider, 'search' => null]) ?>"><?= h($provider) ?></a></li>
                    <?php endforeach ?>
                </ul>
            </span><!-- /.dropdown -->

            <span class="dropdown">
                <?= Html::a(h($genre), '#', [
                    'id' => 'search-genre',
                    'class' => 'dropdown-toggle label label-default',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <ul class="dropdown-menu dropdown-menu-right scrollable-menu">
                    <li><a href="<?= Url::currentPlus(['genre' => null, 'search' => null]) ?>">Reset</a></li>
                    <li role="separator" class="divider"></li>
                    <?php foreach (TrackGenre::getNames()->column() as $name): ?>
                        <li><a href="<?= Url::currentPlus(['genre' => $name, 'search' => null]) ?>"><?= h($name) ?></a></li>
                    <?php endforeach ?>
                </ul>
            </span><!-- /.dropdown -->
            <p class="clearfix"></p>

            <?= $this->render('/common/form/search', [
                'search' => $search,
                'placeholder' => 'Search artist or title ...',
            ]) ?>
        </div><!-- /.caption -->
    </div><!-- /.thumbnail -->
</div><!-- .card -->
