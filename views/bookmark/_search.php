<?php

/**
 * @var yii\web\View $this
 * @var string|null $country
 * @var string|null $tag
 * @var string|null $search
 * @var int $total
 */

use app\models\Bookmark;
use app\models\BookmarkTag;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<a class="text-body" href="<?= Url::to(['']) ?>">
    <i class="fas fa-fw fa-redo-alt"></i> Reset All
</a>
<br>
<div class="d-inline-block dropdown">
    <a id="search-country" class="tag" href="#" data-bs-toggle="dropdown">
        <?= Html::encode($country ?? 'Countries') ?> <i class="fas fa-fw fa-sm fa-angle-down"></i>
    </a>
    <div class="dropdown-menu scrollable-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['country' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <?php foreach (Bookmark::getCountries() as $country): ?>
            <a class="dropdown-item" href="<?= Url::currentPlus(['country' => $country, 'search' => null]) ?>"><?= Html::encode($country) ?></a>
        <?php endforeach ?>
    </div>
</div>
<div class="d-inline-block dropdown">
    <a class="tag" href="#" data-bs-toggle="dropdown">
        <?= Html::encode($tag ?? 'Tags') ?> <i class="fas fa-fw fa-sm fa-angle-down"></i>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?= Url::currentPlus(['tag' => null, 'search' => null]) ?>">Reset</a>
        <div class="dropdown-divider"></div>
        <?php foreach (BookmarkTag::getNames() as $tag): ?>
            <a class="dropdown-item" href="<?= Url::currentPlus(['tag' => $tag, 'search' => null]) ?>"><?= Html::encode($tag) ?></a>
        <?php endforeach ?>
    </div>
</div>
<?= $this->render('/common/form/search', [
    'search' => $search,
    'placeholder' => 'name or link ...',
]) ?>
<div class="text-end text-muted">
    <?= Html::encode(number_format($total)) ?> results
</div>
