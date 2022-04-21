<?php

/**
 * @var yii\web\View $this
 */

use yii\helpers\Html;
use yii\helpers\Url;

[$group, $action] = explode('/', Yii::$app->controller->id);
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="fw-bold navbar-brand" href="<?= Yii::$app->homeUrl ?>"><?= Html::encode(Yii::$app->name) ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <div class="d-md-none navbar-nav">
                <?php if (Yii::$app->user->can('admin')): ?>
                    <a class="nav-link<?= 'admin' === $action ? ' active' : '' ?>" href="<?= Url::toRoute('/admin') ?>">Admin</a>
                <?php endif ?>
                <a class="nav-link<?= 'tracks' === $group ? ' active' : '' ?>" href="<?= Url::toRoute('/tracks') ?>">Tracks</a>
                <a class="nav-link<?= 'playlists' === $group ? ' active' : '' ?>" href="<?= Url::toRoute('/playlists') ?>">Playlists</a>
                <a class="nav-link<?= 'labels' === $group ? ' active' : '' ?>" href="<?= Url::toRoute('/labels') ?>">Labels</a>
                <a class="nav-link<?= 'stores' === $group ? ' active' : '' ?>" href="<?= Url::toRoute('/stores') ?>">Stores</a>
                <a class="nav-link<?= 'bookmarks' === $group ? ' active' : '' ?>" href="<?= Url::toRoute('/bookmarks') ?>">Bookmarks</a>
                <a class="nav-link<?= 'about' === $action ? ' active' : '' ?>" href="<?= Url::toRoute('/about') ?>">Abouts</a>
                <a class="nav-link<?= 'privacy' === $action ? ' active' : '' ?>" href="<?= Url::toRoute('/privacy') ?>">Privacy</a>
                <a class="nav-link<?= 'contact' === $action ? ' active' : '' ?>" href="<?= Url::toRoute('/contact') ?>">Contact</a>
                <a class="nav-link<?= 'third-party-licenses' === $action ? ' active' : '' ?>" href="<?= Url::toRoute('/third-party-licenses') ?>">Third Party Licenses</a>
            </div>
            <div id="navbar" class="d-none d-md-flex navbar-nav">
                <?php if (Yii::$app->user->can('admin')): ?>
                    <a class="nav-link<?= 'admin/index' === $action ? ' active' : '' ?>" href="<?= Url::toRoute('/admin') ?>">Admin</a>
                <?php endif ?>
                <a class="nav-link<?= 'tracks' === $group ? ' active' : '' ?>" href="<?= Url::toRoute('/tracks') ?>">Tracks</a>
                <a class="nav-link<?= 'playlists' === $group ? ' active' : '' ?>" href="<?= Url::toRoute('/playlists') ?>">Playlists</a>
                <a class="nav-link<?= 'labels' === $group ? ' active' : '' ?>" href="<?= Url::toRoute('/labels') ?>">Labels</a>
                <a class="nav-link<?= 'stores' === $group ? ' active' : '' ?>" href="<?= Url::toRoute('/stores') ?>">Stores</a>
                <a class="nav-link<?= 'bookmarks' === $group ? ' active' : '' ?>" href="<?= Url::toRoute('/bookmarks') ?>">Bookmarks</a>
                <div class="dropdown">
                    <a class="nav-link" href="#" id="dropdownMoreLinks" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMoreLinks">
                        <a class="dropdown-item" href="<?= Url::toRoute('/about') ?>">About</a>
                        <a class="dropdown-item" href="<?= Url::toRoute('/privacy') ?>">Privacy</a>
                        <a class="dropdown-item" href="<?= Url::toRoute('/contact') ?>">Contact</a>
                        <a class="dropdown-item" href="<?= Url::toRoute('/third-party-licenses') ?>">Third Party Licenses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
