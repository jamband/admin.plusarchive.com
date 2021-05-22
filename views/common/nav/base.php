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

use yii\helpers\Inflector;

?>
<div class="d-inline-block dropdown">
    <a id="menu-controller" class="dropdown-toggle tag" href="#" data-bs-toggle="dropdown">
        <?= preg_replace('#/[a-z/]+\z#', '', Inflector::id2camel(app()->controller->id)) ?>
        <i class="fas fa-angle-down fa-fw"></i>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/track/admin']) ?>">Track</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/playlist/admin']) ?>">Playlist</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/music-genre/admin']) ?>">MusicGenre</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/label/admin']) ?>">Label</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/label-tag/admin']) ?>">LabelTag</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/store/admin']) ?>">Store</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/store-tag/admin']) ?>">StoreTag</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/bookmark/admin']) ?>">Bookmark</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/bookmark-tag/admin']) ?>">BookmarkTag</a>
    </div>
</div>
