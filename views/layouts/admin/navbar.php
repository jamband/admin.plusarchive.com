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
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Menu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= app()->homeUrl ?>"><?= h(app()->name) ?></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?= 'site/admin' === "$cid/$aid" ? 'active' : '' ?>"><a href="<?= url(['/site/admin']) ?>">Admin</a></li>
                <li class="<?= 'track' === $cid ? 'active' : '' ?>"><a href="<?= url(['/track/index']) ?>">Track</a></li>
                <li class="<?= 'playlist' === $cid ? 'active' : '' ?>"><a href="<?= url(['/playlist/index']) ?>">Playlist</a></li>
                <li class="<?= 'label' === $cid ? 'active' : '' ?>"><a href="<?= url(['/label/index']) ?>">Label</a></li>
                <li class="<?= 'store' === $cid ? 'active' : '' ?>"><a href="<?= url(['/store/index']) ?>">Store</a></li>
                <li class="<?= 'bookmark' === $cid ? 'active' : '' ?>"><a href="<?= url(['/bookmark/index']) ?>">Bookmark</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="<?= 'signup' === $aid ? 'active' : '' ?>"><a href="<?= url(['/site/signup']) ?>">Signup</a></li>
                <li><a href="<?= url(['/site/logout']) ?>" data-method="post">Logout</a></li>
                <li class="<?= 'contact' === $aid ? 'active' : '' ?>"><a href="<?= url(['/site/contact']) ?>">Contact</a></li>
                <li class="<?= 'about' === $aid ? 'active' : '' ?>"><a href="<?= url(['/site/about']) ?>">About</a></li>
            </ul>
        </div>
    </div>
</nav>
