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
 */

$cid = app()->controller->id;
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= app()->homeUrl ?>"><?= h(app()->name) ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <div class="d-md-none navbar-nav">
                <a class="nav-link<?= 'track' === $cid ? ' active' : '' ?>" href="<?= url(['/track/index']) ?>">Track</a>
                <a class="nav-link<?= 'playlist' === $cid ? ' active' : '' ?>" href="<?= url(['/playlist/index']) ?>">Playlist</a>
                <a class="nav-link<?= 'label' === $cid ? ' active' : '' ?>" href="<?= url(['/label/index']) ?>">Label</a>
                <a class="nav-link<?= 'store' === $cid ? ' active' : '' ?>" href="<?= url(['/store/index']) ?>">Store</a>
                <a class="nav-link<?= 'bookmark' === $cid ? ' active' : '' ?>" href="<?= url(['/bookmark/index']) ?>">Bookmark</a>
                <a class="nav-link<?= 'site/contact' === $cid ? ' active' : '' ?>" href="<?= url(['/site/contact/index']) ?>">Contact</a>
                <a class="nav-link<?= 'site/about' === $cid ? ' active' : '' ?>" href="<?= url(['/site/about/index']) ?>">About</a>
            </div>
            <div class="d-none d-md-flex navbar-nav">
                <a class="nav-link<?= 'track' === $cid ? ' active' : '' ?>" href="<?= url(['/track/index']) ?>">Track</a>
                <a class="nav-link<?= 'playlist' === $cid ? ' active' : '' ?>" href="<?= url(['/playlist/index']) ?>">Playlist</a>
                <a class="nav-link<?= 'label' === $cid ? ' active' : '' ?>" href="<?= url(['/label/index']) ?>">Label</a>
                <a class="nav-link<?= 'store' === $cid ? ' active' : '' ?>" href="<?= url(['/store/index']) ?>">Store</a>
                <a class="nav-link<?= 'bookmark' === $cid ? ' active' : '' ?>" href="<?= url(['/bookmark/index']) ?>">Bookmark</a>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMoreLinks" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMoreLinks">
                        <a class="dropdown-item" href="<?= url(['/site/about/index']) ?>">About</a>
                        <a class="dropdown-item" href="<?= url(['/site/privacy/index']) ?>">Privacy</a>
                        <a class="dropdown-item" href="<?= url(['/site/contact/index']) ?>">Contact</a>
                        <a class="dropdown-item" href="<?= url(['/site/third-party-licenses/index']) ?>">Third Party Licenses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
