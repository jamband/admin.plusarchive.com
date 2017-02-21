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
/* @var $sort string */
/* @var $country string */
/* @var $tag string */
/* @var $search string */

use app\models\Store;
use app\models\StoreTag;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="thumbnail">
    <div class="caption">
        <?= Html::a('Reset All', [''], ['class' => 'refresh-link']) ?>
        <br>
        <span class="dropdown">
            <?= Html::a(h($sort).' <span class="caret"></span>', '#', [
                'class' => 'dropdown-toggle label label-default',
                'data-toggle' => 'dropdown',
            ]) ?>
            <ul class="dropdown-menu">
                <li><a href="<?= Url::currentPlus(['sort' => null, 'search' => null]) ?>">Reset</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?= Url::currentPlus(['sort' => 'Name', 'search' => null]) ?>">Name</a></li>
                <li><a href="<?= Url::currentPlus(['sort' => 'Latest', 'search' => null]) ?>">Latest</a></li>
            </ul>
        </span><!-- /.dropdown -->

        <span class="dropdown">
            <?= Html::a(h($country).' <span class="caret"></span>', '#', [
                'class' => 'dropdown-toggle label label-default',
                'data-toggle' => 'dropdown',
            ]) ?>
            <ul class="dropdown-menu scrollable-menu">
                <li><a href="<?= Url::currentPlus(['country' => null, 'search' => null]) ?>">Reset</a></li>
                <li role="separator" class="divider"></li>
                <?php foreach (Store::getCountries() as $country): ?>
                    <li><a href="<?= Url::currentPlus(['country' => $country, 'search' => null]) ?>"><?= h($country) ?></a></li>
                <?php endforeach ?>
            </ul>
        </span><!-- /.dropdown -->

        <span class="dropdown">
            <?= Html::a(h($tag).' <span class="caret"></span>', '#', [
                'class' => 'dropdown-toggle label label-default',
                'data-toggle' => 'dropdown',
            ]) ?>
            <ul class="dropdown-menu scrollable-menu">
                <li><a href="<?= Url::currentPlus(['tag' => null, 'search' => null]) ?>">Reset</a></li>
                <li role="separator" class="divider"></li>
                <?php foreach (StoreTag::getNames()->column() as $tag): ?>
                    <li><a href="<?= Url::currentPlus(['tag' => $tag, 'search' => null]) ?>"><?= h($tag) ?></a></li>
                <?php endforeach ?>
            </ul>
        </span><!-- /.dropdown -->

        <?= $this->render('/common/form/search', [
            'search' => $search,
            'placeholder' => 'name or link ...',
        ]) ?>

        <div class="pull-right total-count"><?= h($totalCount) ?> results</div>
        <div class="clearfix"></div>
    </div><!-- /.caption -->
</div><!-- /.thumbnail -->
