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

use app\models\Bookmark;
use app\models\BookmarkTag;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= Html::a('<i class="fas fa-fw fa-redo-alt"></i> Reset All', [''], ['class' => 'refresh-link']) ?>
<br>
<span class="dropdown">
    <?= Html::a(h($sort).' <i class="fas fa-fw fa-angle-down"></i>', '#', [
        'class' => 'dropdown-toggle badge badge-secondary',
        'data-toggle' => 'dropdown',
    ]) ?>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Name', 'search' => null]) ?>">Name</a>
        <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Latest', 'search' => null]) ?>">Latest</a>
    </div>
</span>
<span class="dropdown">
    <?= Html::a(h($country).' <i class="fas fa-fw fa-angle-down"></i>', '#', [
        'id' => 'search-country',
        'class' => 'dropdown-toggle badge badge-secondary',
        'data-toggle' => 'dropdown',
    ]) ?>
    <div class="dropdown-menu scrollable-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['country' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <?php foreach (Bookmark::getCountries() as $country): ?>
            <a class="dropdown-item" href="<?= Url::currentPlus(['country' => $country, 'search' => null]) ?>"><?= h($country) ?></a>
        <?php endforeach ?>
    </div>
</span>
<span class="dropdown">
    <?= Html::a(h($tag).' <i class="fas fa-fw fa-angle-down"></i>', '#', [
        'class' => 'dropdown-toggle badge badge-secondary',
        'data-toggle' => 'dropdown',
    ]) ?>
    <div class="dropdown-menu scrollable-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['tag' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <?php foreach (BookmarkTag::getNames() as $tag): ?>
            <a class="dropdown-item" href="<?= Url::currentPlus(['tag' => $tag, 'search' => null]) ?>"><?= h($tag) ?></a>
        <?php endforeach ?>
    </div>
</span>
<?= $this->render('/common/form/search', [
    'search' => $search,
    'placeholder' => 'name or link ...',
]) ?>
<div class="total-count"><?= h(number_format($total)) ?> results</div>
