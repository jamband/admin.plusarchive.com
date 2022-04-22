<?php

/**
 * @var yii\web\View $this
 * @var string|null $provider
 * @var string|null $genre
 * @var string|null $search
 * @var string $pageParam
 */

use app\models\Music;
use app\models\MusicGenre;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="col-md-6 col-lg-4 mb-4">
    <div class="card">
        <div class="card-body">
            <a class="text-body" href="<?= Url::to(['']) ?>">
                <i class="fas fa-fw fa-redo-alt"></i> Reset All
            </a>
            <br>
            <div class="d-inline-block dropdown">
                <a id="search-provider" class="tag" href="#" data-bs-toggle="dropdown">
                    <?= Html::encode($provider ?? 'Providers') ?> <i class="fas fa-fw fa-sm fa-angle-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= Url::current(['provider' => null, 'search' => null, $pageParam => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <?php foreach (Music::PROVIDERS as $provider): ?>
                        <a class="dropdown-item" href="<?= Url::current(['provider' => $provider, 'search' => null, $pageParam => null]) ?>"><?= Html::encode($provider) ?></a>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="d-inline-block dropdown">
                <a id="search-genre" class="tag" href="#" data-bs-toggle="dropdown">
                    <?= Html::encode($genre ?? 'Genres') ?> <i class="fas fa-fw fa-sm fa-angle-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= Url::current(['genre' => null, 'search' => null, $pageParam => null]) ?>">Reset</a>
                    <div class="dropdown-divider"></div>
                    <?php foreach (MusicGenre::getNames() as $name): ?>
                        <a class="dropdown-item" href="<?= Url::current(['genre' => $name, 'search' => null, $pageParam => null]) ?>"><?= Html::encode($name) ?></a>
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
