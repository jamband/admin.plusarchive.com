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
/* @var $total integer */

use app\models\Label;
use app\models\LabelTag;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="thumbnail">
    <div class="caption">
        <?= Html::a('Reset All', [''], ['class' => 'refresh-link']) ?>
        <br>
        <span class="dropdown">
            <?= Html::a(h($sort).' <i class="fa fa-fw fa-angle-down"></i>', '#', [
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
            <?= Html::a(h($country).' <i class="fa fa-fw fa-angle-down"></i>', '#', [
                'class' => 'dropdown-toggle label label-default',
                'data-toggle' => 'dropdown',
            ]) ?>
            <ul class="dropdown-menu scrollable-menu">
                <li><a href="<?= Url::currentPlus(['country' => null, 'search' => null]) ?>">Reset</a></li>
                <li role="separator" class="divider"></li>
                <?php foreach (Label::getCountries() as $country): ?>
                    <li><a href="<?= Url::currentPlus(['country' => $country, 'search' => null]) ?>"><?= h($country) ?></a></li>
                <?php endforeach ?>
            </ul>
        </span><!-- /.dropdown -->

        <span class="dropdown">
            <?= Html::a(h($tag).' <i class="fa fa-fw fa-angle-down"></i>', '#', [
                'class' => 'dropdown-toggle label label-default',
                'data-toggle' => 'dropdown',
            ]) ?>
            <ul class="dropdown-menu scrollable-menu">
                <li><a href="<?= Url::currentPlus(['tag' => null, 'search' => null]) ?>">Reset</a></li>
                <li role="separator" class="divider"></li>
                <?php foreach (LabelTag::getNames()->column() as $tag): ?>
                    <li><a href="<?= Url::currentPlus(['tag' => $tag, 'search' => null]) ?>"><?= h($tag) ?></a></li>
                <?php endforeach ?>
            </ul>
        </span><!-- /.dropdown -->

        <?= $this->render('/common/form/search', [
            'search' => $search,
            'placeholder' => 'name or link ...',
        ]) ?>

        <div class="pull-right total-count"><?= h(number_format($total)) ?> results</div>
        <div class="clearfix"></div>
    </div><!-- /.caption -->
</div><!-- /.thumbnail -->
