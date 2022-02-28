<?php

/**
 * @var yii\web\View $this
 * @var string $provider
 * @var string $genre
 * @var string $search
 * @var int $total
 */

use app\models\Music;
use app\models\MusicGenre;
use yii\helpers\Url;

?>
<div class="col-md-6 col-lg-4 mb-4">
    <div class="card">
        <div class="card-body">
            <a class="text-body" href="<?= url(['']) ?>">
                <i class="fas fa-fw fa-redo-alt"></i> Reset All
            </a>
            <br>
            <div class="d-inline-block dropdown">
                <a id="search-provider" class="tag" href="#" data-bs-toggle="dropdown">
                    <?= h($provider) ?> <i class="fas fa-fw fa-sm fa-angle-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= Url::currentPlus(['provider' => null, 'search' => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <?php foreach (Music::PROVIDERS as $provider): ?>
                        <a class="dropdown-item" href="<?= Url::currentPlus(['provider' => $provider, 'search' => null]) ?>"><?= h($provider) ?></a>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="d-inline-block dropdown">
                <a id="search-genre" class="tag" href="#" data-bs-toggle="dropdown">
                    <?= h($genre) ?> <i class="fas fa-fw fa-sm fa-angle-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= Url::currentPlus(['genre' => null, 'search' => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <?php foreach (MusicGenre::getNames() as $genre): ?>
                        <a class="dropdown-item" href="<?= Url::currentPlus(['genre' => $genre, 'search' => null]) ?>"><?= h($genre) ?></a>
                    <?php endforeach ?>
                </div>
            </div>
            <?= $this->render('/common/form/search', [
                'search' => $search,
                'placeholder' => 'Search artist or title ...',
            ]) ?>
            <div class="mt-1 text-end text-muted"><?= h(number_format($total)) ?> results</div>
        </div>
    </div>
</div>
