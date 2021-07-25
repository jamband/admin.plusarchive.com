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
    <a id="menu-controller" class="tag" href="#" data-bs-toggle="dropdown">
        <?= preg_replace('#/[a-z/]+\z#', '', Inflector::pluralize(Inflector::id2camel(app()->controller->id))) ?>
        <i class="fas fa-angle-down fa-fw"></i>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/track/admin']) ?>">Tracks</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/playlist/admin']) ?>">Playlists</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/music-genre/admin']) ?>">MusicGenres</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/label/admin']) ?>">Labels</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/label-tag/admin']) ?>">LabelTags</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/store/admin']) ?>">Stores</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/store-tag/admin']) ?>">StoreTags</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/bookmark/admin']) ?>">Bookmarks</a>
        <a class="dropdown-item" data-pjax="0" href="<?= url(['/bookmark-tag/admin']) ?>">BookmarkTags</a>
    </div>
</div>
