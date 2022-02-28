<?php

/**
 * @var yii\web\View $this
 * @var string $sort
 * @var string $country
 * @var string $tag
 * @var string $search
 * @var int $total
 */

use app\models\Store;
use app\models\StoreTag;
use yii\helpers\Url;

?>
<a class="text-body" href="<?= url(['']) ?>">
    <i class="fas fa-fw fa-redo-alt"></i> Reset All
</a>
<br>
<div class="d-inline-block dropdown">
    <a class="tag" href="#" data-bs-toggle="dropdown">
        <?= h($sort) ?> <i class="fas fa-fw fa-angle-down"></i>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Name', 'search' => null]) ?>">Name</a>
        <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Latest', 'search' => null]) ?>">Latest</a>
    </div>
</div>
<div class="d-inline-block dropdown">
    <a class="tag" href="#" data-bs-toggle="dropdown">
        <?= h($country) ?> <i class="fas fa-fw fa-angle-down"></i>
    </a>
    <div class="dropdown-menu scrollable-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['country' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <?php foreach (Store::getCountries() as $country): ?>
            <a class="dropdown-item" href="<?= Url::currentPlus(['country' => $country, 'search' => null]) ?>"><?= h($country) ?></a>
        <?php endforeach ?>
    </div>
</div>
<div class="d-inline-block dropdown">
    <a class="tag" href="#" data-bs-toggle="dropdown">
        <?= h($tag) ?> <i class="fas fa-fw fa-angle-down"></i>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['tag' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <?php foreach (StoreTag::getNames() as $tag): ?>
            <a class="dropdown-item" href="<?= Url::currentPlus(['tag' => $tag, 'search' => null]) ?>"><?= h($tag) ?></a>
        <?php endforeach ?>
    </div>
</div>
<?= $this->render('/common/form/search', [
    'search' => $search,
    'placeholder' => 'name or link ...',
]) ?>
<div class="text-end text-muted">
    <?= h(number_format($total)) ?> results
</div>
