<?php

/**
 * @var yii\web\View $this
 * @var string $sort
 * @var string $provider
 * @var string $genre
 * @var string $search
 */

use app\models\Track;
use app\models\MusicGenre;
use yii\helpers\Url;

?>
<div class="col-md-6 col-lg-4 mb-4">
    <div class="card">
        <div class="card-body">
            <a class="text-body" href="<?= url(['']) ?>">
                <i class="fas fa-redo-alt fa-fw"></i> Reset All
            </a>
            <br>
            <div class="d-inline-block dropdown">
                <a id="search-sort" class="tag" href="#" data-bs-toggle="dropdown">
                    <?= h($sort) ?> <i class="fas fa-angle-down fa-fw"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => null, 'search' => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Title', 'search' => null]) ?>">Title</a>
                    <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Latest', 'search' => null]) ?>">Latest</a>
                    <a class="dropdown-item" href="<?= Url::currentPlus(['sort' => 'Update', 'search' => null]) ?>">Updated</a>
                </div>
            </div>
            <div class="d-inline-block dropdown">
                <a id="search-provider" class="tag" href="#" data-bs-toggle="dropdown">
                    <?= h($provider) ?> <i class="fas fa-angle-down fa-fw"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= Url::currentPlus(['provider' => null, 'search' => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <?php foreach (Track::PROVIDERS as $provider): ?>
                        <a class="dropdown-item" href="<?= Url::currentPlus(['provider' => $provider, 'search' => null]) ?>"><?= h($provider) ?></a>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="d-inline-block dropdown">
                <a id="search-genre" class="tag" href="#" data-bs-toggle="dropdown">
                    <?= h($genre) ?> <i class="fas fa-angle-down fa-fw"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= Url::currentPlus(['genre' => null, 'search' => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <?php foreach (MusicGenre::getNames() as $name): ?>
                        <a class="dropdown-item" href="<?= Url::currentPlus(['genre' => $name, 'search' => null]) ?>"><?= h($name) ?></a>
                    <?php endforeach ?>
                </div>
            </div>
            <?= $this->render('/common/form/search', [
                'search' => $search,
                'placeholder' => 'Search artist or title ...',
            ]) ?>
        </div>
    </div>
</div>
