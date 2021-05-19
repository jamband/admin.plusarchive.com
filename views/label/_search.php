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
 * @var string $sort
 * @var string $country
 * @var string $tag
 * @var string $search
 * @var int $total
 */

use app\models\Label;
use app\models\LabelTag;
use yii\helpers\Url;

?>
<a class="refresh-link" href="<?= url(['']) ?>">
    <i class="fas fa-redo-alt fa-fw"></i> Reset All
</a>
<br>
<div class="d-inline-block dropdown">
    <a class="dropdown-toggle tag" href="#" data-toggle="dropdown">
        <?= h($sort) ?> <i class="fas fa-angle-down fa-fw"></i>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Name', 'search' => null]) ?>">Name</a>
        <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Latest', 'search' => null]) ?>">Latest</a>
    </div>
</div>
<div class="d-inline-block dropdown">
    <a class="dropdown-toggle tag" href="#" data-toggle="dropdown">
        <?= h($country) ?> <i class="fas fa-angle-down fa-fw"></i>
    </a>
    <ul class="dropdown-menu scrollable-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['country' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <?php foreach (Label::getCountries() as $country): ?>
            <a class="dropdown-item" href="<?= Url::currentPlus(['country' => $country, 'search' => null]) ?>"><?= h($country) ?></a>
        <?php endforeach ?>
    </ul>
</div>
<div class="d-inline-block dropdown">
    <a class="dropdown-toggle tag" href="#" data-toggle="dropdown">
        <?= h($tag) ?> <i class="fas fa-angle-down fa-fw"></i>
    </a>
    <ul class="dropdown-menu scrollable-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['tag' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <?php foreach (LabelTag::getNames() as $tag): ?>
            <a class="dropdown-item" href="<?= Url::currentPlus(['tag' => $tag, 'search' => null]) ?>"><?= h($tag) ?></a>
        <?php endforeach ?>
    </ul>
</div>
<?= $this->render('/common/form/search', [
    'search' => $search,
    'placeholder' => 'name or link ...',
]) ?>
<div class="total-count"><?= h(number_format($total)) ?> results</div>
