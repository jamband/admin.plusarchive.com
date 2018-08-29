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
 */

$cid = app()->controller->id;
$aid = app()->controller->action->id;
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= app()->homeUrl ?>"><?= h(app()->name) ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item<?= 'track' === $cid ? ' active' : '' ?>">
                    <a class="nav-link" href="<?= url(['/track/index']) ?>">Track</a>
                </li>
                <li class="nav-item<?= 'playlist' === $cid ? ' active' : '' ?>">
                    <a class="nav-link" href="<?= url(['/playlist/index']) ?>">Playlist</a>
                </li>
                <li class="nav-item<?= 'label' === $cid ? ' active' : '' ?>">
                    <a class="nav-link" href="<?= url(['/label/index']) ?>">Label</a>
                </li>
                <li class="nav-item<?= 'store' === $cid ? ' active' : '' ?>">
                    <a class="nav-link" href="<?= url(['/store/index']) ?>">Store</a>
                </li>
                <li class="nav-item<?= 'bookmark' === $cid ? ' active' : '' ?>">
                    <a class="nav-link" href="<?= url(['/bookmark/index']) ?>">Bookmark</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item<?= 'contact' === $aid ? ' active' : '' ?>">
                    <a class="nav-link" href="<?= url(['/site/contact/index']) ?>">Contact</a>
                </li>
                <li class="nav-item<?= 'about' === $aid ? ' active' : '' ?>">
                    <a class="nav-link" href="<?= url(['/site/about/index']) ?>">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
