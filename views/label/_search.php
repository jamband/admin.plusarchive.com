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
 * @var string $country
 * @var string $tag
 * @var string $search
 * @var int $total
 */

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
            <?= Html::a(h($sort), '#', [
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
            <?= Html::a(h($country), '#', [
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
            <?= Html::a(h($tag), '#', [
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

        <div class="text-right total-count"><?= h(number_format($total)) ?> results</div>
    </div><!-- /.caption -->
</div><!-- /.thumbnail -->
