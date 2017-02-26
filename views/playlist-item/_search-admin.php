<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this yii\web\View */
/* @var $provider string */
/* @var $genre string */
/* @var $sort string */
/* @var $status string */
/* @var $search string */

use app\models\Track;
use app\models\TrackGenre;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="col-xs-12 col-sm-3 tile">
    <div class="thumbnail">
        <div class="caption">
            <?= Html::a('Reset All', [''], ['class' => 'refresh-link']) ?>
            <br>
            <span class="dropdown">
                <?= Html::a(h($status).' <i class="fa fa-fw fa-angle-down"></i>', '#', [
                    'class' => 'dropdown-toggle label label-default',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <ul class="dropdown-menu">
                    <li><a href="<?= Url::currentPlus(['official' => null, 'search' => null]) ?>">Reset</a></li>
                    <li role="separator" class="divider"></li>
                    <?php foreach (Track::STATUS_DATA as $status): ?>
                        <li><a href="<?= Url::currentPlus(['provider' => $status, 'search' => null]) ?>"><?= h($status) ?></a></li>
                    <?php endforeach ?>
                </ul>
            </span><!-- /.dropdown -->
            <br>

            <span class="dropdown">
                <?= Html::a(h($provider).' <i class="fa fa-fw fa-angle-down"></i>', '#', [
                    'class' => 'dropdown-toggle label label-default',
                    'data-toggle' => 'dropdown',
                ]) ?>
                <ul class="dropdown-menu">
                    <li><a href="<?= Url::currentPlus(['provider' => null, 'search' => null]) ?>">Reset</a></li>
                    <li role="separator" class="divider"></li>
                    <?php foreach (Track::PROVIDER_DATA as $provider): ?>
                        <li><a href="<?= Url::currentPlus(['provider' => $provider, 'search' => null]) ?>"><?= h($provider) ?></a></li>
                    <?php endforeach ?>
                </ul>
            </span><!-- /.dropdown -->

            <span class="dropdown">
                <?= Html::a(h($genre).' <i class="fa fa-fw fa-angle-down"></i>', '#', [
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
</div><!-- .tile -->
